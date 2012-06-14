POURSUITES_MAX_AUTORISEES = 20000;
BASE_CELIBATAIRE = 1200;
BASE_COUPLE = 1700;
BASE_ENFANTS_MOINS_6 = 300;
BASE_ENFANTS_ENTRE_6_ET_12 = 400;
BASE_ENFANTS_PLUS_12 = 550;
IMPOT = 2.5; // 2.5x le salaire net
ASSURANCE_MALADIE_ADULTE = 250;
ASSURANCE_MALADIE_ENFANT = 90;

MONTANT_MAX_PERMIS_SEJOUR_ENTRE_6_ET_12_MOIS = 15000;


var manager = null;

var activateValidation = (DEV_ENVIRONMENT == 2 || DEV_ENVIRONMENT == 1) ? true : false;


$(document).ready(function() {
	
	
	if( DEV_ENVIRONMENT ==2 ){
		_gaq.push(['_trackPageview', '/'+shortlang+"/demande-credit.html?etape=1"]);
		_gaq.push(['_trackPageview', "etapenl1"]);
	}
	
	
	var demandeCreditManager = new DemandeCreditManager();
	demandeCreditManager.init();
	
	if($.browser.msie && $.browser.version == '7.0'){
		$('.field').append('<div class="clear"></div>')
	}
	
	
	
	if(DEV_ENVIRONMENT == 1 || DEV_ENVIRONMENT ==2 ){
		window.onbeforeunload = function (evt) {
		  if (typeof evt == 'undefined') {evt = window.event;}
		  if (evt) {evt.returnValue = TEXTE_QUITTER_PAGE;}
		  return TEXTE_QUITTER_PAGE;
		}
	}
	
	
	
	$(document).unbind('keydown').keydown(function(e) {
	    var doPrevent;
	    if (e.keyCode == 8) {
	        var d = e.srcElement || e.target;
	        if (d.tagName.toUpperCase() == 'INPUT' || d.tagName.toUpperCase() == 'TEXTAREA') {
	            doPrevent = d.readOnly || d.disabled;
	        }
	        else
	            doPrevent = true;
	    }
	    else
	        doPrevent = false;

	    if (doPrevent)
	        e.preventDefault();
	});
	
	
	
});




DemandeCreditManager = function() {
	
	//manager = this;
	var self = this;
	this.statut = 'vert';
	this.adresses = {};
	this.streets = {};
	this.montantMax = 0;
	this.documents = '';
	this.documents_c = '';
	this.activateValidation = activateValidation;
	this.data = null;
	this.preparedData = null;
	
	this.init = function(){
		this.manageEvents();
		this.loadEtapes();
		this.activateNav();

	};	
	
	this.loadEtapes = function(){
	
		$.ajax({
			url: "/"+shortlang+"/demande-credit.html",
			type: "POST",
			data: ({ajax:true, action:'getEtapes'}),
			dataType: "json",
			success: function(msg){
				if(msg.success){
					msg = msg.etapes;
					$('#etape2 .zoneContenu').html(msg.etape2+msg.etape2c);
					$('#etape3 .zoneContenu').html(msg.etape3);
					$('#etape4 .zoneContenu').html(msg.etape4+msg.etape4c);
					$('#etape5 .zoneContenu').html(msg.etape5+msg.etape5c);
					
					self.loadAdresses('suisse');
					self.loadAdresses('france');
					self.loadAdresses('france_short');
					$('.conjoint').hide();
					self.manageEvents();
					
					$('.infoBtn').hover(function(){
						$(this).parents('.field').find('.quartPart').fadeIn();
					},function(){
						$(this).parents('.field').find('.quartPart').fadeOut();
					});
					
					if($.browser.msie && $.browser.version == '7.0'){
						$('.field').append('<div class="clear"></div>')
					}
					
				}else{
					console.error('Problème de chargement des étapes');
				}				
			},
			error:function(msg){}
		   }
		);
	}
	
	
	this.disableNav = function(){
		$('#boutonContinuerEtape1, #boutonContinuerEtape2, #boutonContinuerEtape3, #boutonContinuerEtape4, #boutonContinuerEtape5, #boutonContinuerEtape6').unbind('click').addClass('disabled');
		$('.boutonEtapePrecedente').unbind('click').addClass('disabled');
		
		// $('#boutonContinuerEtape1, #boutonContinuerEtape2, #boutonContinuerEtape3, #boutonContinuerEtape4, #boutonContinuerEtape5, #boutonContinuerEtape6').addClass('disabled');
		// $('.boutonEtapePrecedente').addClass('disabled');
		
		this.navActivated = false;
	}
	
	
	this.activateNav = function(){
	
		/* suivant */
		$('#boutonContinuerEtape1, #boutonContinuerEtape2, #boutonContinuerEtape3, #boutonContinuerEtape4, #boutonContinuerEtape5').removeClass('disabled').unbind('click').click(function(e){
			var currentStepEl = $(this).parents('.etape');
			var currentStep = currentStepEl.attr('id');	
			this.step = currentStep.replace('etape', '');
				
			// si validation ok, on affiche l'étape suivante
			if( !self.activateValidation || (self.activateValidation && self.validateStep(currentStep, false)) ){
				currentStepEl.hide().next().fadeIn();
				var nextStep = currentStepEl.next().attr('id').replace('etape', '');
				$('.etapesEnonce li').removeClass('active');
				$('.enonceEtape'+nextStep).addClass('active');	
				if( DEV_ENVIRONMENT ==2 ){
					_gaq.push(['_trackPageview', '/'+shortlang+"/demande-credit.html?etape="+nextStep]);
					_gaq.push(['_trackPageview', "etapenl"+nextStep]);
				}
			}
		});
		
		/*  précédent */
		$('.etape .boutonEtapePrecedente').removeClass('disabled').unbind('click').click(function(e){
			
			var btn = $(this);
			var prevStepEl = btn.parents('.etape').hide().prev().fadeIn();
			$('.etapesEnonce li').removeClass('active');
			var prevStepEl = btn.parents('.etape').hide().prev().fadeIn();
			var prevStep = prevStepEl.attr('id').replace('etape', '');
			$('.enonceEtape'+prevStep).addClass('active');
			if( DEV_ENVIRONMENT ==2 ){
				_gaq.push(['_trackPageview', '/'+shortlang+"/demande-credit.html?etape="+prevStep]);
				_gaq.push(['_trackPageview', "etapenl"+prevStep]);
			}
		});	
		
		
		$('.etapesEnonce .boutonEtapePrecedente').unbind('click').click(function(){
			
			var btn = $(this);
			
			var actualStep = $('.etape:visible').attr('id').replace('etape', '');
			var wantedStep = btn.data('destination').replace('etape', '');
			
			if( wantedStep < actualStep){
			
				$('.etape').hide();
				$('#etape'+wantedStep).fadeIn();
			
				$('.etapesEnonce li').removeClass('active');
				$('.enonceEtape'+wantedStep).addClass('active');
				
				if( DEV_ENVIRONMENT ==2 ){
					_gaq.push(['_trackPageview', '/'+shortlang+"/demande-credit.html?etape="+wantedStep]);
					_gaq.push(['_trackPageview', "etapenl"+wantedStep]);
				}
				
			}
			
		});
		
		
		
		
		
		$('#boutonContinuerEtape6').removeClass('disabled').unbind('click').click(function(){
			if(  self.validateStep('etape5', false) ){
				self.submitForm();
			}
		});
		
	}
	
	

	
	

	this.manageEvents = function(){

		$('#demande-credit-formulaire').submit(function(e){
			e.preventDefault();
			return false;
		});
						
		this.manageSelect();	
		this.manageNumber();
		this.manageInputs();
		this.manageDates();
		this.manageDatesMois();
		this.manageEmail();
		this.manageRadio();
	}








	/* Date */
	this.manageDates = function(){
		
		$('.field.date .rightPart input').unbind('keyup').keydown(function(e){
			self.maximize($(this), e);
		});
		
		$('.field.date .rightPart input').unbind('keyup').keyup(function(e){
			self.formatDate($(this),e);
	 		if(e.keyCode == 13){$(this).blur();}
		});
		
		$('.field.date .rightPart input').unbind('blur').blur(function(e){
			self.formatDate($(this),e,{ignoreCaretPos : true});
			self.validateDate($(this), true); 
			self.updateForm($(this));
			self.validateForm();
		});

	};
	
	
	this.validateDate = function(element,hideMessage, hideError){
		var field = element.parents('.field');
				
		var required = this.requiredOK(element);
		if(required.error==true){
			if( !hideError){this.reportError(field, required.message,hideMessage );}
			return false;
		}else{
			
			if( element.val().length < 10 ){
				if( !hideError){self.reportError(field,VEUILLEZ_ENTRER_UNE_DATE_VALIDE ,hideMessage);}
				return false;
			}
		
			date = element.val();
			date = date.split('/');
		
			var d = new Date();
			if( date.length == 3 &&
				date[0].length == 2 && Number(date[0]) >=1 && Number(date[0]) <= 31 &&
				date[1].length == 2 && Number(date[1]) >=1 && Number(date[1]) <= 12 &&
				date[2].length == 4 && Number(date[2]) >=1900 && Number(date[2]) <= d.getFullYear()
				){
				
				if( !hideError){self.reportSuccess(field);}
				return true;
			}else{
				if( !hideError){self.reportError(field, VEUILLEZ_ENTRER_UNE_DATE_VALIDE,hideMessage );}
				return false;
			}	
		}	
	}

	

	this.formatDate = function(element, ev, params){
		if(ev.keyCode == 27 ||
			ev.keyCode >= 37 && ev.keyCode <= 40 ||
			ev.keyCode == 46 ||
			ev.keyCode == 8 ||
			ev.keyCode == 9 ||
			ev.keyCode == 16 ||
			ev.keyCode == 17 ||
			ev.keyCode == 91
			){
				return true;
		}
		
		var string = this.clean(element.val());
		var size = string.length;
		var caretPos = element.caret().start;
		
		
		var minimizeObj = this.minimize(element, string, '/');
		var caretPosOffset = minimizeObj['caretOffset'];
		string = minimizeObj['string'];	
		

		
		string = string.replace(/[a-zA-Z]|\+|\-|\*|\s|\/|\.|-/gi, '');
		if(size>=2 && size<5 ){
			string = string.substr(0,2) +"/"+ string.substring(2);
			element.prop('value', string);
		}else if(size >= 5){
			string = string.substr(0,2) +"/"+string.substr(2,2) +"/"+ string.substring(4);
			element.prop('value', string);
		}
		
		element.prop('value', element.val().substr(0, element.attr('maxlength') ));

		if( !params || !params.ignoreCaretPos || params.ignoreCaretPos!=true ){
			if(caretPos == 2 || caretPos == 5){
				element.caret(caretPos+1+caretPosOffset, caretPos+1+caretPosOffset);
			}else if(caretPos == 3 || caretPos == 6){
					element.caret(caretPos+2+caretPosOffset, caretPos+2+caretPosOffset);
			}else{
				element.caret(caretPos+caretPosOffset, caretPos+caretPosOffset);
			}
		}

		if(size >= element.attr('maxlength')){
			this.validateDate(element);
		}
	}
















	/* Date par mois */
	this.manageDatesMois = function(){
		
		$('.field.dateMois .rightPart input').unbind('keyup').keydown(function(e){
			self.maximize($(this), e);
		});
		
		$('.field.dateMois .rightPart input').unbind('keyup').keyup(function(e){
			self.formatDateMois($(this),e);
	 		if(e.keyCode == 13){$(this).blur();}
		});
		
		$('.field.dateMois .rightPart input').unbind('blur').blur(function(e){
			self.formatDateMois($(this),e,{ignoreCaretPos : true});
			self.validateDateMois($(this), true); 
			self.updateForm($(this));
			self.validateForm();
		});

	};
	
	
	this.validateDateMois = function(element,hideMessage, hideError){
		var field = element.parents('.field');
		var required = this.requiredOK(element);
		if(required.error==true){
			if( !hideError){this.reportError(field, required.message,hideMessage );}
			return false;
		}else{
			
			if( element.val().length < 7 ){
				if( !hideError){self.reportError(field,VEUILLEZ_ENTRER_UNE_DATE_VALIDE ,hideMessage);}
				return false;
			}
		
			date = element.val();
			date = date.split('/');
		
			var d = new Date();
			if( date.length == 2 &&
				date[0].length == 2 && Number(date[0]) >=1 && Number(date[0]) <= 12 &&
				date[1].length == 4 && Number(date[1]) >=1900 && Number(date[1]) <= d.getFullYear()
				){
				if( !hideError){self.reportSuccess(field);}
				return true;
			}else{
				if( !hideError){self.reportError(field, VEUILLEZ_ENTRER_UNE_DATE_VALIDE,hideMessage );}
				return false;
			}	
		}	
	}

	

	this.formatDateMois = function(element, ev, params){
		if(ev.keyCode == 27 ||
			ev.keyCode >= 37 && ev.keyCode <= 40 ||
			ev.keyCode == 46 ||
			ev.keyCode == 8 ||
			ev.keyCode == 9 ||
			ev.keyCode == 16 ||
			ev.keyCode == 17 ||
			ev.keyCode == 91
			){
				return true;
		}
		
		var string = this.clean(element.val());
		var size = string.length;
		var caretPos = element.caret().start;
		
		
		var minimizeObj = this.minimize(element, string, '/');
		var caretPosOffset = minimizeObj['caretOffset'];
		string = minimizeObj['string'];	

		string = string.replace(/[a-zA-Z]|\+|\-|\*|\s|\/|\.|-/gi, '');
		if(size >= 2 ){
			string = string.substr(0,2) +"/"+ string.substring(2);
			element.prop('value', string);
		}
		
		element.prop('value', element.val().substr(0, element.attr('maxlength') ));
		
		if( !params || !params.ignoreCaretPos || params.ignoreCaretPos!=true ){
			if(caretPos == 2 ){
				element.caret(caretPos+1+caretPosOffset, caretPos+1+caretPosOffset);
			}else if(caretPos == 3 ){
					element.caret(caretPos+2+caretPosOffset, caretPos+2+caretPosOffset);
			}else{
				element.caret(caretPos+caretPosOffset, caretPos+caretPosOffset);
			}
		}

		if(size >= element.attr('maxlength')){
			this.validateDateMois(element);
		}
	}

	
	
	
	
	
	
	
	
	
	
	
	/* Numbers */
	
	this.manageNumber = function(){
		$('.field.number input').unbind('keyup').keyup(function(e){
			self.formatNumber($(this),e);
	 		if(e.keyCode == 13){$(this).blur();}
		});
		
		$('.field.number input').unbind('blur').blur(function(e){
			self.formatNumber($(this),e,{ignoreCaretPos : true});
			self.validateNumber($(this), true); 
			self.updateForm($(this));
            self.validateForm();
		});
	};
	this.validateNumber = function(element, hideMessage, hideError){
		var field = element.parents('.field');
		var required = this.requiredOK(element);
		if(required.error==true){
			if( !hideError){this.reportError(field, required.message, hideMessage );}
			return false;
		}else{
			
			// if (!Modernizr.input.placeholder && element.val() == element.attr('placeholder')){
			// 	if( !hideError){self.reportSuccess(field);}
			// 	return true;
			// 		    }
		
			if( !isNaN(element.val())  ){
				
				var name = element.attr('id');
				if( Number(element.val()) < Number(field.data('min')) ){
					if( !hideError){self.reportError(field, LE_MIN_EST_DE+' '+field.data('min'),hideMessage );}
					return false;
				}

				if(Number(element.val()) > Number(field.data('max'))){
					if( !hideError){self.reportError(field, LE_MAX_EST_DE+' '+ field.data('max'),hideMessage);}
					return false;
				}		

				if( !hideError){self.reportSuccess(field);}
				return true;
			}else{	
				if( !hideError){self.reportError(field, PAS_UN_NOMBRE, hideMessage);}
				return false;
			}	
		}
	}


	this.formatNumber = function(element, ev,params){

		if(ev.keyCode == 27 ||
			ev.keyCode >= 37 && ev.keyCode <= 40 ||
			ev.keyCode == 46 ||
			ev.keyCode == 8 ||
			ev.keyCode == 9 ||
			ev.keyCode == 16 ||
			ev.keyCode == 17 ||
			ev.keyCode == 91
			){
				return true;
		}

		var string = this.clean(element.val());
		var size = string.length;
		var caretPos = element.caret().start;
		
		string = string.replace(/[a-zA-Z]|\+|\-|\*|\s|\/|\.|-/gi, '');
		element.prop('value', string);
		
		if( !params || !params.ignoreCaretPos || params.ignoreCaretPos!=true ){
			element.caret(caretPos, caretPos);
		}

		if(size >= element.attr('maxlength')){
			this.validateNumber(element);
		}
	}
	
	


	
	
	

	
	
	
	
	
	
	
	
	
	


	
	
	/* TELEPHONE SUISSE */	
	this.managePhoneCH = function(){
		
		$('.field.phoneCH .rightPart input').unbind('keydown').keydown(function(ev){
			self.maximize($(this), ev);
		});
		
		$('.field.phoneCH .rightPart input').unbind('keyup').keyup(function(e){
			self.formatPhoneCH($(this),e, null);
	 		if(e.keyCode == 13){$(this).blur();}
		});
		
		$('.field.phoneCH .rightPart input').unbind('blur').blur(function(e){
			self.formatPhoneCH($(this),e,{ignoreCaretPos : true});
			self.validatePhoneCH($(this), true); 
			self.updateForm($(this));
			self.validateForm();
		});

	};

	this.validatePhoneCH = function(element, hideMessage,  hideError){
		var field = element.parents('.field');
		
		var required = this.requiredOK(element);
		if(required.error==true){
			if( !hideError){this.reportError(field, required.message, hideMessage );}
			return false;
		}else{
			if(	element.val()=='' || /^0[0-9]{2}\s[0-9]{3}\s[0-9]{2}\s[0-9]{2}$/i.test(element.val())){
				if( !hideError){self.reportSuccess(field);}
				return true;
			}else{	
				if( !hideError){self.reportError(field, ENTREZ_UN_NUM_VALIDE, hideMessage);}
				return false
			}
		}
	};

	this.formatPhoneCH = function(element, ev,params){
		
		if(ev.keyCode == 27 ||
			ev.keyCode >= 37 && ev.keyCode <= 40 ||
			ev.keyCode == 46 ||
			ev.keyCode == 8 ||
			ev.keyCode == 9 ||
			ev.keyCode == 16 ||
			ev.keyCode == 17 ||
			ev.keyCode == 91
			){
				return true;
		}
		
		var caretPos = element.caret().start;
		var string = this.clean(element.val());
		var size = string.length;


		var minimizeObj = this.minimize(element, string, ' ');
		var caretPosOffset = minimizeObj['caretOffset'];
		string = minimizeObj['string'];
		
		string = string.replace(/[a-zA-Z]|\+|\-|\*|\s|\/|\.|-/gi, '');
		if(size>=3 && size <7){
			string = string.substr(0,3) +" "+ string.substring(3);
			element.prop('value', string);
			
		}else if(size >= 7 && size < 10 ){
			string = string.substr(0,3) +" "+string.substr(3,3) +" "+ string.substring(6);
			element.prop('value', string);
			
		}else if(size >= 10){
			string = string.substr(0,3) +" "+string.substr(3,3) +" "+string.substr(6,2) +" "+ string.substring(8);
			element.prop('value', string);
		}
		
		element.prop('value', element.val().substr(0,13));
		
		if( !params || !params.ignoreCaretPos || params.ignoreCaretPos!=true ){
			if(caretPos == 3 || caretPos == 7 || caretPos == 10){
				element.caret(caretPos+1+caretPosOffset, caretPos+1+caretPosOffset);
			}else if(caretPos == 4 || caretPos == 8 || caretPos == 11){
					element.caret(caretPos+2+caretPosOffset, caretPos+2+caretPosOffset);
			}else{
				element.caret(caretPos+caretPosOffset, caretPos+caretPosOffset);
			}
		}
		
		if(size >= element.attr('maxlength')){
			this.validatePhoneCH(element);
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/* TELEPHONE GENERAL */
	
	this.managePhone = function(){
			
		$('.field.phone .rightPart input').unbind('keydown').keydown(function(ev){
			self.maximize($(this), ev);
		});
				
		$('.field.phone .rightPart input').unbind('keyup').keyup(function(e){
			self.formatPhone($(this),e, null);
	 		if(e.keyCode == 13){$(this).blur();}
		});
		
		$('.field.phone .rightPart input').unbind('blur').blur(function(e){
			self.formatPhone($(this),e,{ignoreCaretPos : true});
			self.validatePhone($(this), true); 
			self.updateForm($(this));
			self.validateForm();
		});
		
	};
	this.validatePhone = function(element, hideMessage, hideError){
		
		var field = element.parents('.field');

		var required = this.requiredOK(element);
		if(required.error==true){
			if( !hideError){this.reportError(field, required.message, hideMessage );}
			return false;
		}else{

			if( element.val()=='' || /^[0-9]{2}\s[0-9]{2}\s[0-9]{2}\s[0-9]{2}\s[0-9]{2}$/i.test(element.val())){
				if( !hideError){self.reportSuccess(field);}
				return true;
			}else{	
				if( !hideError){self.reportError(field, ENTREZ_UN_NUM_VALIDE ,hideMessage);}
				return false
			}
		}
	}
	
	this.formatPhone = function(element, ev,params){
		
		if(ev.keyCode == 27 ||
			ev.keyCode >= 37 && ev.keyCode <= 40 ||
			ev.keyCode == 46 ||
			ev.keyCode == 8 ||
			ev.keyCode == 9 ||
			ev.keyCode == 16 ||
			ev.keyCode == 17 ||
			ev.keyCode == 91 
			){
				return true;
		}
		
		var caretPos = element.caret().start;
		var string = element.val();
		var string = this.clean(string);
		var size = string.length;


		var minimizeObj = this.minimize(element, string, ' ');
		var caretPosOffset = minimizeObj['caretOffset'];
		string = minimizeObj['string'];

		string = string.replace(/[a-zA-Z]|\+|\-|\*|\s|\/|\.|-/gi, '');
		if(size>=2 && size<5 ){
			string = string.substr(0,2) +" "+ string.substring(2);
			element.prop('value', string);
			
		}else if(size >= 5 && size <8 ){
			string = string.substr(0,2) +" "+string.substr(2,2) +" "+ string.substring(4);
			element.prop('value', string);
			
		}else if(size >= 8  && size<11){
			string = string.substr(0,2) +" "+string.substr(2,2) +" "+string.substr(4,2) +" "+  string.substring(6);
			element.prop('value', string);
			
		}else if(size >= 11){
			string = string.substr(0,2) +" "+string.substr(2,2) +" "+string.substr(4,2) +" "+ string.substr(6,2)+" "+ string.substring(8);
			element.prop('value', string);
		}else{
			element.prop('value', string);
		}
		
		
		element.prop('value', element.val().substr(0, 14 ));
				
		if( !params || !params.ignoreCaretPos || params.ignoreCaretPos!=true ){
			if(caretPos == 2 || caretPos == 5 || caretPos == 8 || caretPos == 11){
				element.caret(caretPos+1+caretPosOffset, caretPos+1+caretPosOffset);
			}else if(caretPos == 3 || caretPos == 6 || caretPos == 9 || caretPos == 12){
					element.caret(caretPos+2+caretPosOffset, caretPos+2+caretPosOffset);
			}else{
				element.caret(caretPos+caretPosOffset, caretPos+caretPosOffset);
			}
		}
				
		if(size >= element.attr('maxlength')){
			this.validatePhone(element);
		}
	}












	/* RADIO */
	
	this.manageRadio = function(){
		
		$('.field.radio input').change(function(ev){
			self.validateRadio($(this));
			self.updateForm($(this));
			self.validateForm();
		});

	};

	this.validateRadio = function(element, hideMessage, hideError, wantedValue, errorMgsIfNotWantedValueSetted){
		var field = element.parents('.field');
		var required = this.requiredOK(element);
		if(required.error==true){
			if( !hideError){this.reportError(field, required.message, hideMessage );}
			return false;
		}else{
			var group = element.attr('name');
			var val = $('input:radio[name='+group+']:checked').val() ;
			if( val){
				if( wantedValue != '' && wantedValue != undefined && wantedValue != null ){
					if( wantedValue == val ){
						if( !hideError ){self.reportSuccess(field);}
						return true;
					}else{
						if( !hideError ){self.reportError(field, errorMgsIfNotWantedValueSetted ,hideMessage);}
						return false;
					}
				}else{
					if( !hideError){self.reportSuccess(field);}
					return true;
				}

				return true;
			}else{	
				if( !hideError){self.reportSuccess(field);}
				return true;
				// if( !hideError){self.reportError(field, VEUILLEZ_CHOISIR_UNE_REPONSE ,hideMessage);}
				// return false
			}
		}
	}

















	/* EMAIL */
	
	this.manageEmail = function(){
		
		
		$('.field.email input').unbind('keyup').keyup(function(e){
	 		if(e.keyCode == 13){$(this).blur();}
		});
		
		
		$('.field.email input').unbind('blur').blur(function(e){
			self.validateEmail($(this)); 
			self.updateForm($(this));
			self.validateForm();
		});
	};
	this.validateEmail = function(element, hideMessage, hideError){

		var field = element.parents('.field');
		
		var required = this.requiredOK(element);
		if(required.error==true){
			if( !hideError){this.reportError(field, required.message,hideMessage );}
			return false;
		}else{
			
			if( element.val()=='' || /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i.test(element.val())){
				if( !hideError){self.reportSuccess(field);}
				return true;
			}else{	
				if( !hideError){self.reportError(field, VEUILLEZ_ENTRER_EMAIL_VALIDE ,hideMessage);}
				return false
			}
		}
		
	}	










	
	this.manageSelect = function(){

		$('.selectDiv').hover(function(e){
			$(this).addClass('hover');
		},function(e){
			$(this).removeClass('hover');
		});
	
	
		//activation de l'autocomplete
		$('.select.autocomplete input').unbind('focus').focus(function(e){
			$(this).parent().autocomplete(self);	
		});

		$('.visible_option').unbind('click').click(function(e){
			var selectDiv = $(this).parent();
			// si visible on cache
			if ( selectDiv.hasClass('show') && e.target.nodeName != 'INPUT') {
				selectDiv.removeClass('show');
				self.validateSelect( selectDiv );
				self.updateForm(selectDiv);
				self.validateForm();
			    return '';
			
			// on ouvre
			} else {
				
				//on ajoute l'evert pour fermer lorsqu'on clique à l'extérieur
 				self.closeOnOutClick(selectDiv, selectDiv.find('.options'), function(){
					selectDiv.removeClass('show');
					self.validateSelect( selectDiv , true );
					// if(selectDiv.find('input').length == 0){
					// 	//selectDiv.removeClass('show');
					// 	//self.validateSelect( selectDiv , true );
					// }
 				});
				selectDiv.addClass('show');
			}
		});

		$('.selectDiv .option:not(.selected_option)').unbind().hover(function(){
			$(this).toggleClass('hover');
		});


		$('.selectDiv .option').unbind('click').click(function(){
			var option = $(this);
			var select = option.parent().parent();
			var visible_option = select.find('.visible_option');

			if(visible_option[0].tagName.toUpperCase() == 'INPUT' ){
				visible_option.val( option.text() ) ;
			}else{
				visible_option.html(option.html() ) ;
			}
			
			//select.find('.selected_option_temp').removeClass('selected_option_temp');
			select.removeClass('show').find('.selected_option').removeClass('selected_option');
			option.addClass('selected_option');
			select.data('selected', option.attr('id'));
			select.find('input').val(option.text());
			self.validateSelect(select);
			self.updateForm(select);
			self.validateForm();
		});
		

		
	}
	
	
	this.validateSelect = function(select, hideMessage, hideError ){
		
		var field = select.parents('.field');
		if( field.hasClass('required') && select.data('selected') == ''){
			if( !hideError){ this.reportError(field, CE_CHAMP_EST_REQUIS+' !',hideMessage); }
			return false;
		}else{
			if( !hideError){ this.reportSuccess(field,hideMessage); }
			return true;
		}
		
	}

	this.emptySelect = function(selector){
		$(selector).data('selected', '');
		obj = $(selector+' .visible_option');
		
		if( obj[0].tagName.toUpperCase() == 'INPUT'){
			obj.val('');
		}else{
			obj.html( CHOISISSEZ_UNE_OPTION );
		}

		$(selector+' .options').empty();
	}
	
	this.unset = function(selector){
		$(selector).data('selected', '');
		obj = $(selector+' .visible_option');
		if( obj[0].tagName.toUpperCase() == 'INPUT'){
			obj.val('');
		}else{
			obj.html( CHOISISSEZ_UNE_OPTION );
		}

		$(selector+' .option').removeClass('selected_option');
	}













	this.manageInputs = function(){
		// if (!Modernizr.input.placeholder){
		// 	$('#form_demande_credit input[type=text]').each(function(){
		// 		self.placeholder($(this));
		// 	});
		// 	    }
		
		$('.field.text input').unbind('keyup').keyup(function(e){
	 		if(e.keyCode == 13){$(this).blur();}
		});
		
		$('.field.text input').unbind('blur').blur(function(e){
			self.validateInputText($(this),true);
			self.updateForm($(this));
			self.validateForm();
		});
		

	};
	
	this.validateInputText = function(element, hideMessage, hideError){

		var field = element.parents('.field');
		if( !element.hasClass('phone') &&
			!element.hasClass('number') &&
			!element.hasClass('phoneCH') &&
			!element.hasClass('date')
		){
			var required = this.requiredOK(element);
			if(required.error==true){
				if(!hideError){this.reportError(field, required.message,hideMessage );}
				return false;
			}else{
				if(!hideError){this.reportSuccess(field);}
				return true
			}
		}
	}

	
	
	


	
	this.manageTextarea = function(){
		$('.field.text input').unbind('blur').blur(function(e){
			self.validateTextarea($(this));
		});
	};
	this.validateTextarea = function(element,hideMessage, hideError){

		var field = element.parents('.field');
			
		var required = this.requiredOK(element);
		if(required.error==true){
			if(!hideError){this.reportError(field, required.message,hideMessage );}
			return false;
		}else{
			if(!hideError){this.reportSuccess(field);}
			return true;
		}

		
	}
	
	
	
	












	
	
	
	
	
	
	/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
	/* /////////////////////									MISE à JOUR DU FORMULAIRE						////////////////////// */
	/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */	

	this.updateForm = function(element){
		var field = element.parents('.field');
		var id = element.attr('id');
		if(element.attr('name')){ id= element.attr('name')}
		
						
		//état civil *******************
		if(id == 'etat_civil'){
			if( element.data('selected') == 'pacse' || element.data('selected') == 'marie' ){
				$('.conjoint').slideDown();
				// this.hide('#situation_familiale');
				this.hide('#autres_charges');
				this.hide('#autres_charges_c');
			}else if( element.data('selected') == 'separe' || element.data('selected') == 'divorce' ){
				$('.conjoint .field').removeClass('visible');
				$('.conjoint:hidden').hide();
				$('.conjoint:visible').slideUp();
				// this.show('#situation_familiale');
				this.show('#autres_charges');
				this.show('#autres_charges_c');
			}else{
				$('.conjoint .field').removeClass('visible');
				$('.conjoint:hidden').hide();
				$('.conjoint:visible').slideUp();
				// this.show('#situation_familiale');
				this.hide('#autres_charges');
				this.hide('#autres_charges_c');
			}
		}
		
		
		
		// pays *******************
		if(id == 'pays'){
			option = element.data('selected');

			if( option == 'france' ){
				this.emptySelect('#zip');
				this.emptySelect('#ville');
				this.unset('#region_france');
				this.hide('#zip');
				this.hide('#ville');
				this.hide('#numero');
				this.hide('#adresse_suisse');
				this.hide('#region_allemagne');
				this.hide('#region_italie');
				this.hide('#region_autriche');
				this.hide('#region_suisse');
				this.show('#region_france');


			}else if( option == 'suisse' ){
				this.emptySelect('#zip');
				this.emptySelect('#ville');
				this.unset('#region_suisse');
				this.hide('#zip');
				this.hide('#ville');
				this.hide('#numero');
				this.hide('#adresse');
				this.hide('#region_allemagne');
				this.hide('#region_france');
				this.hide('#region_italie');
				this.hide('#region_autriche');
				this.show('#region_suisse');
			
			}else if( option == 'allemagne' ){
				this.hide('#zip');
				this.hide('#ville');
				this.hide('#numero');
				this.hide('#adresse');	
				this.hide('#adresse_suisse');
				this.hide('#region_france');
				this.hide('#region_suisse');
				this.hide('#region_italie');
				this.hide('#region_autriche');
				this.show('#region_allemagne');
				
			}else if( option == 'autriche' ){	
				this.hide('#zip');
				this.hide('#ville');
				this.hide('#numero');
				this.hide('#adresse');		
				this.hide('#adresse_suisse');
				this.hide('#region_allemagne');
				this.hide('#region_france');
				this.hide('#region_italie');
				this.hide('#region_suisse');
				this.show('#region_autriche');
				
			}else if( option == 'italie' ){	
				this.hide('#zip');
				this.hide('#ville');	
				this.hide('#numero');	
				this.hide('#adresse');	
				this.hide('#adresse_suisse');	
				this.hide('#region_allemagne');
				this.hide('#region_france');
				this.hide('#region_autriche');
				this.hide('#region_suisse');
				this.show('#region_italie');
			}
			else if( option == 'liechtenstein' ){	
				this.hide('#zip');
				this.hide('#ville');	
				this.hide('#numero');
				this.show('#adresse');		
				this.hide('#adresse_suisse');
				this.hide('#region_allemagne');
				this.hide('#region_france');
				this.hide('#region_autriche');
				this.hide('#region_suisse');
				this.hide('#region_italie');
			}	
						
		}
		
		
	
		
		if(id=='region_france'){
			option = element.data('selected');
			if( option != '' ){
				this.show('#zip');
				this.emptySelect('#zip');
				this.emptySelect('#ville');
				this.hide('#ville');
				this.emptySelect('#adresse_suisse');
				$('#adresse').val('');
				this.hide('#adresse_suisse');
				this.hide('#adresse');
				this.hide('#numero');
				var option = element.data('selected');
				this.setOptions(this.adresses['france'][option], $('#zip .options'));
				this.manageSelect();
			}				
		}
		
		if(id=='region_suisse'){
			option = element.data('selected');
			if( option != '' ){
				this.show('#zip');
				this.emptySelect('#zip');
				this.emptySelect('#ville');
				this.hide('#ville');
				this.emptySelect('#adresse_suisse');
				$('#adresse').val('');
				this.hide('#adresse_suisse');
				this.hide('#adresse');
				this.hide('#numero');
				var option = element.data('selected');
				this.setOptions( this.adresses['suisse'][option], $('#zip .options') );	
				this.manageSelect();
			}
		}
		
		if(id=='region_allemagne' || id=='region_italie' || id=='region_autriche'){
			option = element.data('selected');
			if( option != '' ){
				this.show('#adresse');
				this.hide('#ville');
				$('#adresse').val('');
				this.hide('#adresse_suisse');
				this.hide('#numero');
			}
		}
		
		if(id=='zip'){
			var option = element.data('selected');		
			if( $('#pays').data('selected')=='france' ){
				this.setOptions( this.adresses['france'][$('#region_france').data('selected')][option], $('#ville .options'), 'value', 'id' );
			}else if( $('#pays').data('selected')=='suisse' ){
				this.setOptions( this.adresses['suisse'][$('#region_suisse').data('selected')][option], $('#ville .options'), 'value', 'id' );
				//$('#adresse_suisse .visible_option').val(LOADING+'...');
				this.loadStreets( option, function(){
					$('#adresse_suisse .visible_option').val('');
					var target = $('#adresse_suisse .options');
					var numOrdre = $('#ville').data('selected');
					for(var street in self.streets[numOrdre]){
						var optionDiv = $("<div class='option' id='"+self.streets[numOrdre][street]+"'>"+self.streets[numOrdre][street]+"</div>");
						target.append(optionDiv);
					}
					self.manageSelect();
				} );
			}
			
			this.show('#ville');
			this.unset('#ville');
			this.hide('#adresse_suisse');
			this.hide('#adresse');
			this.hide('#numero');
			this.manageSelect();
		}
		
		if(id=='ville'){
			var option = element.data('selected');
			if( $('#pays').data('selected') == 'suisse'){
				this.show('#adresse_suisse');
				
				var target = $('#adresse_suisse .options');
				target.empty();
				for(var street in this.streets[option]){
					var optionDiv = $("<div class='option' id='"+this.streets[option][street]+"'>"+this.streets[option][street]+"</div>");
					target.append(optionDiv);
				}
				this.manageSelect();
			}else{
				this.show('#adresse');
			}	
			this.hide('#numero');		
		}
				
				
				
				
		if(id=='adresse_suisse'){
			this.show('#numero');
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		// ADRESSE PRECEDENTE *******************
				
		if(id == 'adresse_depuis' && this.validateField(element, true) ){

			var date = element.val();
			var dateArray = date.split('/');
			
			date = new Date(dateArray[1],dateArray[0]-1,'01');
			dateNow = new Date();
			var nombreAnneesEcoulees = (dateNow.getTime()-date.getTime())/1000/60/60/24/365;
			
			if( (nombreAnneesEcoulees > 0 && nombreAnneesEcoulees < 3) ){
				$('#adressePrecedente').slideDown();
				this.showIfMarked('#region_france_prec');
				this.showIfMarked('#region_suisse_prec');
				this.showIfMarked('#zip_prec');
				this.showIfMarked('#ville_prec');
				this.showIfMarked('#adresse_prec');
				this.showIfMarked('#adresse_complete_prec');
				this.showIfMarked('#complement_adresse_prec');
			}else{
				$('#adressePrecedente').slideUp().find('.field').removeClass('visible');
				this.hide('#region_france_prec');
				this.hide('#region_suisse_prec');
				this.hide('#zip_prec');
				this.hide('#ville_prec');
				this.hide('#adresse_prec');
				this.hide('#adresse_complete_prec');
				this.hide('#complement_adresse_prec');
			}
		}
		

		if(id == 'pays_prec'){
			option = element.data('selected');

			if( option == 'france' ){
				this.emptySelect('#zip_prec');
				this.emptySelect('#ville_prec');
				this.unset('#region_france_prec');
				this.show('#region_france_prec');
				
				this.hide('#zip_prec');
				this.hide('#ville_prec');
				this.hide('#numero_prec');
				this.hide('#adresse_suisse_prec');
				this.hide('#region_allemagne_prec');
				this.hide('#region_italie_prec');
				this.hide('#region_autriche_prec');
				this.hide('#region_suisse_prec');
				this.hide('#adresse_complete_prec');

			}else if( option == 'suisse' ){
				this.emptySelect('#zip_prec');
				this.emptySelect('#ville_prec');
				this.unset('#region_suisse_prec');
				this.show('#region_suisse_prec');
				
				this.hide('#zip_prec');
				this.hide('#ville_prec');
				this.hide('#numero_prec');
				this.hide('#adresse_prec');
				this.hide('#region_allemagne_prec');
				this.hide('#region_france_prec');
				this.hide('#region_italie_prec');
				this.hide('#region_autriche_prec');

				this.hide('#adresse_complete_prec');
			
			}else{
				this.show('#adresse_complete_prec');
				
				this.hide('#zip_prec');
				this.hide('#ville_prec');
				this.hide('#numero_prec');
				this.hide('#adresse_prec');
				this.hide('#adresse_suisse_prec');
				this.hide('#region_france_prec');
				this.hide('#region_suisse_prec');
			}				
						
		}
		
		if(id=='region_france_prec'){
			option = element.data('selected');
			if( option != '' ){
				this.show('#zip_prec');
				this.emptySelect('#zip_prec');
				this.emptySelect('#ville_prec');
				var option = element.data('selected');
				this.setOptions(this.adresses['france'][option], $('#zip_prec .options'));
				this.manageSelect();
			}				
		}
		
		if(id=='region_suisse_prec'){
			option = element.data('selected');
			if( option != '' ){
				this.show('#zip_prec');
				this.emptySelect('#zip_prec');
				this.emptySelect('#ville_prec');
				var option = element.data('selected');
				this.setOptions( this.adresses['suisse'][option], $('#zip_prec .options') );	
				this.manageSelect();
			}
		}
		
		if(id=='zip_prec'){
			var option = element.data('selected');		
			if( $('#pays_prec').data('selected')=='france' ){
				this.setOptions( this.adresses['france'][$('#region_france_prec').data('selected')][option], $('#ville_prec .options'), 'value', 'id' );
			}else if( $('#pays_prec').data('selected')=='suisse' ){
				this.setOptions( this.adresses['suisse'][$('#region_suisse_prec').data('selected')][option], $('#ville_prec .options'), 'value', 'id' );
								
				$('#adresse_suisse_prec .visible_option').val(LOADING+'...');
				this.loadStreets( option, function(){
					$('#adresse_suisse_prec .visible_option').val('');
					var target = $('#adresse_suisse_prec .options');
					var numOrdre = $('#ville_prec').data('selected');
					for(var street in self.streets[numOrdre]){
						var optionDiv = $("<div class='option' id='"+self.streets[numOrdre][street]+"'>"+self.streets[numOrdre][street]+"</div>");
						target.append(optionDiv);
					}
					self.manageSelect();
				} );
				
			}
			
			this.show('#ville_prec');
			this.manageSelect();
		}
		
		if(id=='ville_prec'){
			var option = element.data('selected');
			if( $('#pays_prec').data('selected') == 'suisse'){
				this.show('#adresse_suisse_prec');
				
				var target = $('#adresse_suisse_prec .options');
				target.empty();
				for(var street in this.streets[option]){
					var optionDiv = $("<div class='option' id='"+this.streets[option][street]+"'>"+this.streets[option][street]+"</div>");
					target.append(optionDiv);
				}
				this.manageSelect();
			}else{
				this.show('#adresse_prec');
			}			
		}
				
		if(id=='adresse_suisse_prec'){
			this.show('#numero_prec');
		}


		
		
		
		
		
		
		
		
		
		
		
		
		

		
		


		
	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		// nationnalité *******************
		if(id == 'nationalite' || id=='nationalite_c'){	
			var option = element.data('selected');		
			var _c = '';
			if(id=='nationalite_c'){ _c = '_c'; }
			if( option == 'CH' || option == 'LI' ){
				this.hide('#permis_sejour'+_c);
				this.hide('#permis_sejour_depuis'+_c);
				this.hide('#lieu_de_travail'+_c);

			}else{
				this.show('#permis_sejour'+_c);
				this.hide('#permis_sejour_depuis'+_c);
				this.hide('#lieu_de_travail'+_c);
			}
			
		}
		
		
		//permis de séjour *******************
		if(id == 'permis_sejour' || id=='permis_sejour_c'){
			var option = element.data('selected');
			var _c = '';
			if(id=='permis_sejour_c'){ _c = '_c'; }
		
			if(	option == 'b' ||
				option == 'l' 
				){
				this.show('#permis_sejour_depuis'+_c);
				this.show('#situation_pro');
				this.hide('#lieu_de_travail'+_c);
				$('#pays').find('#suisse,#liechtenstein').show();
				
			}else if( option == 'c' ){
				this.hide('#permis_sejour_depuis'+_c);
				this.show('#situation_pro');
				this.hide('#lieu_de_travail'+_c);
				$('#pays').find('#suisse,#liechtenstein').show();
				
			}else if(	option == 'def' ){
				this.hide('#permis_sejour_depuis'+_c);
				this.hide('#lieu_de_travail'+_c);
				this.hide('#situation_pro');
				$('#pays').find('#suisse,#liechtenstein').show();
				
			}else if( option == 'g') {
				this.show('#permis_sejour_depuis'+_c);
				this.show('#duree_travail_dernier_employeur'+_c);
				this.show('#lieu_de_travail'+_c);
				this.show('#situation_pro');
				$('#pays').find('#suisse,#liechtenstein').hide();
				
			}else if( option != ''){
				this.hide('#permis_sejour_depuis'+_c);	
				this.hide('#duree_travail_dernier_employeur'+_c);
				this.hide('#lieu_de_travail'+_c);
				$('#pays').find('#suisse,#liechtenstein').show();
			}
		}
	
	
	
	
	
		// situation professionnelle *******************		
		if(id == 'situation_pro' || id=='situation_pro_c'){
			var option = element.data('selected');
			var _c = '';
			if(id=='situation_pro_c'){ _c = '_c'; }
						
			if(	option == 'employe_de_son_entreprise' ){
				this.show('#sa_sarl'+_c);
				this.show('#meme_situation_depuis'+_c);
				this.show('#revenu_annuel_imposable'+_c);
				this.hide('#nom_employeur'+_c);
				this.hide('#salaire_net_mensuel'+_c);
				this.hide('#nb_salaire_par_an'+_c);
				this.hide('#duree_travail_dernier_employeur'+_c);
				
			}else if( option == 'independant' ){
				this.show('#meme_situation_depuis'+_c);
				this.show('#revenu_annuel_imposable'+_c);
				this.hide('#sa_sarl'+_c);
				this.hide('#nom_employeur'+_c);
				this.hide('#salaire_net_mensuel'+_c);
				this.hide('#nb_salaire_par_an'+_c);
				this.hide('#duree_travail_dernier_employeur'+_c);
				
			}else if( option == 'rentier' || option == 'retraite'){
				this.show('#salaire_net_mensuel'+_c);
				this.show('#meme_situation_depuis'+_c);
				this.hide('#sa_sarl'+_c);
				this.hide('#nom_employeur'+_c);
				this.hide('#nb_salaire_par_an'+_c);
				this.hide('#revenu_annuel_imposable'+_c);
				this.hide('#duree_travail_dernier_employeur'+_c);
				
			}else if( option == 'temporaire'){
				this.show('#salaire_net_mensuel'+_c);
				this.hide('#sa_sarl'+_c);
				this.show('#meme_situation_depuis'+_c);
				this.hide('#nom_employeur'+_c);
				this.hide('#nb_salaire_par_an'+_c);
				this.hide('#revenu_annuel_imposable'+_c);
				this.hide('#duree_travail_dernier_employeur'+_c);

			}else if( option ==  'salarie'){
				this.show('#nom_employeur'+_c);
				this.show('#meme_situation_depuis'+_c);
				this.show('#salaire_net_mensuel'+_c);
				this.show('#nb_salaire_par_an'+_c);
				this.hide('#sa_sarl'+_c);
				this.hide('#revenu_annuel_imposable'+_c);
			
			}else if( option != ''){
				this.hide('#sa_sarl'+_c);
				this.hide('#nom_employeur'+_c);
				this.hide('#salaire_net_mensuel'+_c);
				this.hide('#nb_salaire_par_an'+_c);
				this.hide('#revenu_annuel_imposable'+_c);
				//this.hide('#permis_sejour_depuis'+_c);
			}
		}
		
		
		
			// type d'entreprise *******************
			if(id == 'sa_sarl' || id=='sa_sarl_c'){
				var _c = '';
				if(id=='sa_sarl_c'){ _c = '_c'; }
				
				if(	element.data('selected') == 'sarl'){
					this.show('#nombre_annees_activite'+_c);
					this.show('#revenu_annuel_imposable'+_c);
					
				}else if(element.data('selected') == 'independant'){
					this.show('#nombre_annees_activite'+_c);
					this.show('#revenu_annuel_imposable'+_c);
					
				}else if(element.data('selected') == 'sa'){
					this.show('#revenu_annuel_imposable'+_c);
					this.hide('#nombre_annees_activite'+_c);
				
				}else{
					this.hide('#nombre_annees_activite'+_c);
					this.hide('#sa_sarl'+_c);
					this.hide('#nombre_annees_activite'+_c);

					this.hide('#salaire_net_mensuel'+_c);
					this.hide('#revenu_annuel_imposable'+_c);
					
					this.hide('#nb_salaire_par_an'+_c);
					this.hide('#nom_employeur'+_c);
				}
			}
			
			
			// Poursuites *******************
			if(id == 'poursuites' || id=='poursuites_c'){

				var _c = '';
				if(id=='poursuites_c'){ _c = '_c'; }
				
				if(	$('input:radio[name=poursuites'+_c+']:checked').val() == 'oui'){
					this.show('#poursuites_montant'+_c);
				}else{
					this.hide('#poursuites_montant'+_c);
				}

			}		
		
		
		
		
		
		// Enfants à charge *******************
		if(id == 'enfants_a_charge' ){	
			if(	$('input:radio[name=enfants_a_charge]:checked').val() == 'oui'){
				this.show('#nb_enfants_moins_6');
				this.show('#nb_enfants_entre_6_et_12');
				this.show('#nb_enfants_plus_12');
			}else{
				this.hide('#nb_enfants_moins_6');
				this.hide('#nb_enfants_entre_6_et_12');
				this.hide('#nb_enfants_plus_12');	
			}
		}
		
		//zzz
		// Loyer *******************
		if(id == 'proprietaire' ){
			if(	$('input:radio[name=proprietaire]:checked').val() == 'oui'){
				this.show('#charges_hypothecaires_montant');
				this.hide('#loyer_montant');
			}else{
				this.show('#loyer_montant');
				this.hide('#charges_hypothecaires_montant');
			}
		}
		
		// Crédits en cours *******************
		if(id == 'credits' || id=='credits_c'){
			var _c = '';
			if(id=='credits_c'){ _c = '_c'; }
						
			if(	$('input:radio[name=credits'+_c+']:checked').val() == 'oui'){
				this.show('#credits_montant'+_c);	
				this.show('#credits_rachat'+_c);
				this.show('#credits_restants'+_c);	

			}else{
				this.hide('#credits_montant'+_c);	
				this.hide('#credits_rachat'+_c);
				this.hide('#credits_restants'+_c);	
			}
		}
		

		
		// Leasings en cours *******************
		if(id == 'leasings' || id=='leasings_c'){
			var _c = '';
			if(id=='leasings_c'){ _c = '_c'; }
			
			if(	$('input:radio[name=leasings'+_c+']:checked').val() == 'oui'){
				this.show('#leasings_montant'+_c);	
				this.show('#leasings_rachat'+_c);
				this.show('#leasings_restants'+_c);		
			}else{
				this.hide('#leasings_montant'+_c);	
				this.hide('#leasings_rachat'+_c);
				this.hide('#leasings_restants'+_c);		
			}
		}
		
		
		
		
		if((id == 'meme_situation_depuis' || id == 'meme_situation_depuis_c' ) && this.validateField(element, true) ){
			var _c = '';
			if(id=='meme_situation_depuis_c'){ _c = '_c'; }

			var date = element.val();
			var dateArray = date.split('/');
			
			date = new Date(dateArray[1],dateArray[0]-1,'01');
			dateNow = new Date();
			
			if($('#situation_pro'+_c).data('selected') == 'salarie' ){	
				var nombreAnneesEcoulees = (dateNow.getTime()-date.getTime())/1000/60/60/24/365;
				if((nombreAnneesEcoulees > 0 && nombreAnneesEcoulees < 3) ){
					this.show('#nom_employeur_prec'+_c);
					this.show('#chez_employeur_prec_depuis'+_c);
				}else{
					this.hide('#nom_employeur_prec'+_c);
					this.hide('#chez_employeur_prec_depuis'+_c);
				}
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		// Titre *******************
		if(id == 'titre' || id=='titre_c'){
			var option = element.data('selected');	
			var _c = '';
			if(id=='titre_c'){ _c = '_c'; }
									
			if(	option == 'mme'){
				this.show('#nom_jeune_fille'+_c);	
			}else{
				this.hide('#nom_jeune_fille'+_c);	
			}
		}



		// mobile
		if(id == 'type_telephone_mobile' || id=='type_telephone_mobile_c'){
			var option = element.data('selected');	
			var _c = '';
			if(id=='type_telephone_mobile_c'){ _c = '_c'; }
						
			if( option == '+41' ){
				this.show('#num_mobile'+_c);
				$('#num_mobile'+_c).parents('.field').removeClass('phone').addClass('phoneCH').find('.rightPart .info').text('000 000 00 00');
				if($('#num_mobile'+_c).val()!=''){this.validateField($('#num_mobile'+_c).parents('.field'),false);}
			}else if(option==''){
				this.hide('#num_mobile'+_c);
			}else{
				this.show('#num_mobile'+_c);
				$('#num_mobile'+_c).parents('.field').removeClass('phoneCH').addClass('phone').find('.rightPart .info').text('00 00 00 00 00');
				if($('#num_mobile'+_c).val()!=''){this.validateField($('#num_mobile'+_c).parents('.field'),false);}
			}			
		}
		
		// domicile
		if(id == 'type_telephone_domicile' || id=='type_telephone_domicile_c'){
			var option = element.data('selected');	
			var _c = '';
			if(id=='type_telephone_domicile_c'){ _c = '_c'; }
						
			if( option == '+41' ){
				this.show('#num_domicile'+_c);
				$('#num_domicile'+_c).parents('.field').removeClass('phone').addClass('phoneCH').find('.rightPart .info').text('000 000 00 00');
				if($('#num_domicile'+_c).val()!=''){this.validateField($('#num_mobile'+_c).parents('.field'),false);}
			}else if(option==''){
				this.hide('#num_domicile'+_c);
			}else{
				this.show('#num_domicile'+_c);
				$('#num_domicile'+_c).parents('.field').removeClass('phoneCH').addClass('phone').find('.rightPart .info').text('00 00 00 00 00');
				if($('#num_domicile'+_c).val()!=''){this.validateField($('#num_mobile'+_c).parents('.field'),false);}
			}			
		}
		
		
		// pro
		if(id == 'type_telephone_pro' || id=='type_telephone_pro_c'){
			var option = element.data('selected');	
			var _c = '';
			if(id=='type_telephone_pro_c'){ _c = '_c'; }
						
			if( option == '+41' ){
				this.show('#num_professionnel'+_c);
				$('#num_professionnel'+_c).parents('.field').removeClass('phone').addClass('phoneCH').find('.rightPart .info').text('000 000 00 00');
				if($('#num_professionnel'+_c).val()!=''){this.validateField($('#num_mobile'+_c).parents('.field'),false);}
			}else if(option==''){
				this.hide('#num_professionnel'+_c);
			}else{
				this.show('#num_professionnel'+_c);
				$('#num_professionnel'+_c).parents('.field').removeClass('phoneCH').addClass('phone').find('.rightPart .info').text('00 00 00 00 00');
				if($('#num_professionnel'+_c).val()!=''){this.validateField($('#num_mobile'+_c).parents('.field'),false);}
			}			
		}
		
		
		if( id=='compte_client'){
	
			if( $('input:radio[name=compte_client]:checked').val() == 'oui' ){
				this.show('#nom_utilisateur');
				this.show('#mot_de_passe');
				this.show('#mot_de_passe2');
			}else{
				this.hide('#nom_utilisateur');
				this.hide('#mot_de_passe');
				this.hide('#mot_de_passe2');
			}
				
		}
		

		
		if(	$('#pays').data('selected') != 'suisse' && $('#pays').data('selected') != '' ||
			$('#permis_sejour').data('selected') == 'l' ||	$('#permis_sejour').data('selected') == 'b' 
		){
			this.show('#impose_a_la_source');
		}else{
			this.hide('#impose_a_la_source');
		}
		
			

		$.wait( function(){
			self.managePhoneCH();
			self.managePhone();
		}, 455);		

	} // fin update form











	/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
	/* /////////////////////									VALIDATION FORMULAIRES							////////////////////// */
	/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */


	
	this.requiredOK = function(element){
		var field = element.parents('.field');
		if(field.hasClass('required') ){

			if( element.attr('type') == 'radio' && $('input:radio[name='+element.attr("name")+']:checked').length == 0 ){
				return { error:true, message:CE_CHAMP_EST_REQUIS+' !' }
				
			}else if(element.val() == ''){
				return { error:true, message:CE_CHAMP_EST_REQUIS+' !' }
				
			}else{
				return { success:true }	
			}
		}else{
			return { success:true }
		}
		
	}
	
	this.validateField = function(field, hideError){
		if(hideError == undefined || hideError == null){hideError == true}
		if( !field.hasClass('field') ){field = field.parents('.field');}
				
	 	if( field.hasClass('number') ){
			return this.validateNumber(field.find('input'), true, hideError);
			
		}else if (field.hasClass('email') ){
			return this.validateEmail(field.find('input'), true, hideError);
			
		}else if (field.hasClass('select') ){
			return this.validateSelect(field.find('.selectDiv'), true, hideError);
			
		}else if (field.hasClass('radio') ){
			return this.validateRadio(field.find('input:first'), true, hideError);
	
		}else if (field.hasClass('phone') ){
			return this.validatePhone(field.find('input'), true, hideError);
			
		}else if (field.hasClass('phoneCH') ){
			return this.validatePhoneCH(field.find('input'), true, hideError);
			
		}else if (field.hasClass('text') ){
			return this.validateInputText(field.find('input'), true, hideError);
			
		}else if (field.hasClass('textarea') ){
			return this.validateTextarea(field.find('textarea'), true, hideError);

		}else if (field.hasClass('date') ){				
			return this.validateDate(field.find('input'), true, hideError);
			
		}else if (field.hasClass('dateMois') ){				
			return this.validateDateMois(field.find('input'), true, hideError);
			
		}
				
	}
	
	
	this.allFieldStepValidated = function(step, hideErrors){
		if( hideErrors == undefined || hideErrors == null){hideErrors = true;}
		
		var allFieldStepValidated = true;
		$('.step'+step+' .field:visible').each(function(){
			if( !self.validateField( $(this), hideErrors )  ){
				allFieldStepValidated = false;
			}
		});
		return allFieldStepValidated;
	}

	
	
	/* VALIDATION DU FORMULAIRE */
	// valide automatiquement l'étape actuelle au moment de la mise à jour d'un champ
	this.validateForm = function(){
		// if(!activateValidation) {
		$.wait( function(){
			self.validateStep( $('#zoneForm .etape:visible').attr('id'), true);
		}, 455);		
	}	
	
	
	
	this.validateStep = function( step, hideErrors ){
		if(step == 'etape1'){ 		return this.validateStep1( hideErrors )}
		else if(step == 'etape2'){ 	return this.validateStep2( hideErrors )}
		else if(step == 'etape3'){ 	return this.validateStep3( hideErrors )}
		else if(step == 'etape4'){ 	return this.validateStep4( hideErrors )}
		else if(step == 'etape5'){ 	return this.validateStep5( hideErrors )}

	}
	
	
	this.validateStep1 = function( hideErrors ){
		if(hideErrors == undefined || hideErrors == null){hideErrors = true;}
		
		var valid = this.allFieldStepValidated(1,hideErrors);
		if(!valid && !hideErrors){$('#etape1 .contentErrors').show().effect("shake", { times:2,direction:'right',distance:10 }, 50);}
		else{$('#etape1 .contentErrors').hide()}
		return valid;
	}
	
	
	this.validateStep2 = function( hideErrors ){
		if(hideErrors == undefined || hideErrors == null){hideErrors = true;}
		var statut = false;
		
		var valid = this.allFieldStepValidated(2,hideErrors);
		if(!valid && !hideErrors){$('#etape2 .contentErrors').show().effect("shake", { times:2,direction:'right',distance:10 }, 50);}
		else if(valid){$('#etape2 .contentErrors').hide()}
		
		// gestion des enfants pour s'assurer qu'au moins une tranche d'age est renseignée si le champ est marqué sur oui
		if(	$('input[name=enfants_a_charge]:checked').val() == 'oui' && 
				( $('#nb_enfants_moins_6').data('selected') !='' || 
		  		  $('#nb_enfants_entre_6_et_12').data('selected') !='' || 
		  		  $('#nb_enfants_plus_12').data('selected') !='' 
				)){
			this.reportSuccess($('#nb_enfants_moins_6').parents('.field'), VEUILLEZ_REMPLIR_UNE_TRANCHE_DAGE);
			this.reportSuccess($('#nb_enfants_entre_6_et_12').parents('.field'), VEUILLEZ_REMPLIR_UNE_TRANCHE_DAGE);
			this.reportSuccess($('#nb_enfants_plus_12').parents('.field'), VEUILLEZ_REMPLIR_UNE_TRANCHE_DAGE);
		
		}else if( !hideErrors && $('input[name=enfants_a_charge]:checked').val() != 'non' && $('input[name=enfants_a_charge]:checked').val() != undefined ){
			this.reportError($('#nb_enfants_moins_6').parents('.field'),VEUILLEZ_REMPLIR_UNE_TRANCHE_DAGE,true);
			this.reportError($('#nb_enfants_entre_6_et_12').parents('.field'), VEUILLEZ_REMPLIR_UNE_TRANCHE_DAGE,true);
			this.reportError($('#nb_enfants_plus_12').parents('.field'), VEUILLEZ_REMPLIR_UNE_TRANCHE_DAGE,true);
			$('#etape2 .contentErrors').show().effect("shake", { times:2,direction:'right',distance:10 }, 50);;
			valid = false;
		}
		
		return valid;
	 }
	
	
	 this.validateStep3 = function(hideErrors){ 
		if(hideErrors == undefined || hideErrors == null){hideErrors = true;}

		var valid = this.allFieldStepValidated(3,hideErrors);
	
		// telephone
		var type_telephone_mobile          = $('#type_telephone_mobile').data('selected');
		var type_telephone_domicile        = $('#type_telephone_domicile').data('selected');
		var type_telephone_professionnel   = $('#type_telephone_professionnel').data('selected');
		
		var num_mobile          = $('#num_mobile');
		var num_domicile        = $('#num_domicile');
		var num_professionnel   = $('#num_professionnel');
		
		// Validation des numéros de téléphone :
		// Si l'un des types de téléphone n'est pas vide et que le numéro est correct
		// si le numéro est suisse et il est valide suisse, c'est bon
		// si le numéro n'est pas suisse et qu'il n'est pas suisse, c'est bon
		// on s'assure que si on change le langue du pays, le numéro n'est pas pris pour valide. P.ex pays suisse -> 079 123 12 12 puis on change pour pays -> france et on laisse le numéro qui reste au format suisse et est donc invalide.
		if( 
			type_telephone_mobile != '' && 		type_telephone_mobile != undefined && 
				( 	type_telephone_mobile != '+41' && this.validatePhone(num_mobile,false,true) || 
					type_telephone_mobile == '+41' && this.validatePhoneCH(num_mobile,false,true) ) ||
			type_telephone_domicile != '' && 		type_telephone_domicile != undefined &&   	 
				( 	type_telephone_domicile != '+41' && this.validatePhone(num_domicile,false,true) || 
					type_telephone_domicile == '+41' && this.validatePhoneCH(num_domicile,false,true) ) ||
			type_telephone_professionnel  != '' && type_telephone_professionnel  != undefined && 
				( 	type_telephone_professionnel != '+41' && this.validatePhone(num_professionnel,false,true) || 
					type_telephone_professionnel == '+41' && this.validatePhoneCH(num_professionnel,false,true) ) 
		){
			this.reportSuccess($('#type_telephone_mobile').parents('.field'));
			this.reportSuccess($('#type_telephone_domicile').parents('.field'));
			this.reportSuccess($('#type_telephone_pro').parents('.field'));
		}else{
		   	if(!hideErrors){
				this.reportError($('#type_telephone_mobile').parents('.field'), DEUX_TELEPHONES_NECESSAIRES,true);
		    	this.reportError($('#type_telephone_domicile').parents('.field'), DEUX_TELEPHONES_NECESSAIRES,true);
		    	this.reportError($('#type_telephone_pro').parents('.field'), DEUX_TELEPHONES_NECESSAIRES,true);
			}
			valid = false;	
		}

		if(!valid && !hideErrors){$('#etape3 .contentErrors').show().effect("shake", { times:2,direction:'right',distance:10 }, 50);}
		else if(valid){$('#etape3 .contentErrors').hide()}
		return valid;

		

 	}
	

	
	this.validateStep4 = function( hideErrors ){
		if(hideErrors == undefined || hideErrors == null){hideErrors = true;}
		
		var valid = this.allFieldStepValidated(4,hideErrors);
		if(!valid && !hideErrors){$('#etape4 .contentErrors').show().effect("shake", { times:2,direction:'right',distance:10 }, 50);}
		else{$('#etape4 .contentErrors').hide()}
		return valid;

	}
	
	
	// this.getVal = function(el, formatNumber){
	// 	if(formatNumber == undefined || formatNumber == null){hideErrors = false;}
	// 	var val = undefined;
	// 	
	// 	var field = $(el).parents('.field.visible');
	// 			
	// 	if(field && field.length >0){
	// 		if(field.hasClass('select')){
	// 			val= field.find('.selectDiv').data('selected');
	// 		}else{
	// 			val= field.find('input').val();
	// 		}
	// 	}else{
	// 		radio = $('input:radio[name='+el+']:checked');
	// 		var field = radio.parents('.field.visible');
	// 		if(field && field.length >0 ){
	// 			val = radio.val();
	// 		}else{
	// 			return '-----------------------------';
	// 		}
	// 	}
	// 
	// 	console.warn('   '+el+'   :   '+val);
	// 	
	// 	if(val==undefined) {
	// 		//console.info(0);
	// 		return 0;
	// 	}
	// 	else if( formatNumber ){
	// 		//console.info(Number(val));
	// 		return Number(val);	
	// 	} else{
	// 		//console.info(val);
	// 		return val;
	// 	}
	// }
	
	
	
	this.validateStep5 = function( hideErrors ){
		

		//console.warn('validate step 5, hideErrors : '+ hideErrors );
		if(hideErrors == undefined || hideErrors == null){hideErrors = true;}
		
		// validation des contraintes d'intégrité pour l'étape 5 seulement
		var valid = this.allFieldStepValidated(5,hideErrors);
		if( $('input[name=compte_client]:checked').val() == 'oui' && 
			$('#mot_de_passe').val() !='' &&  
			$('#mot_de_passe').val() == $('#mot_de_passe2').val() 
		){	
			this.reportSuccess($('#mot_de_passe').parents('.field'));
			this.reportSuccess($('#mot_de_passe2').parents('.field'));	
		}else if($('input[name=compte_client]:checked').val() == 'non' || $('input[name=compte_client]:checked').val() == undefined ){	
		}else if( !hideErrors  ){

			this.reportError($('#mot_de_passe').parents('.field'), MOTS_DE_PASSE_DIFFERENTS,true);
			this.reportError($('#mot_de_passe2').parents('.field'), MOTS_DE_PASSE_DIFFERENTS,true);
			valid = false;
		}
		

		if( $('input[name=compte_client]:checked').val() == 'oui' && $('#email').val() =='' ){
			if( !hideErrors ){console.info('invalid mail');;this.reportError($('#email').parents('.field'), EMAIL_OBLIGATOIRE_SI_COMPTE,true);}
			valid = false;
		}
		// else{
		// 			console.info('ok');
		// 			this.reportSuccess($('#email').parents('.field'));
		// 		}
		
		if( !this.validateRadio($('input[name=jaccepte]:checked'), false,hideErrors,'oui',ACCEPTATION_NECESSAIRE) ){
			valid = false;
		}
		

		// retourne false ou laisse le code s'exécuter pour définir le statut
		if(!valid && !hideErrors){
			$('#etape5 .contentErrors').show().effect("shake", { times:2,direction:'right',distance:10 }, 50);;
			return valid;
		}else if(!valid){
			return valid;
		}else{$('#etape5 .contentErrors').hide()}
		
		
		
		var statut = null;
		
		
		
		/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
		/* /////////////////////					RECOLTE DES INFOS												////////////////////// */
		/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
	
		this.getFormData();



		/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
		/* /////////////////////									TRAITEMENT DES INFOS							////////////////////// */
		/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
		
		dateNow = new Date();
		
		var meme_situation_mois = 0;
		var meme_situation_annees = 0;
		meme_situation_depuis = this.getValueFromPrepared('meme_situation_depuis');
		if( meme_situation_depuis != ''){
			var dateArray = meme_situation_depuis.split('/');
			date = new Date(dateArray[1],dateArray[0]-1,'01');
			var meme_situation_mois = (dateNow.getTime()-date.getTime())/1000/60/60/24/365.242198*12;
			var meme_situation_annees = (dateNow.getTime()-date.getTime())/1000/60/60/24/365.242198;
		}
		
		var age = 0;
		date_naissance = this.getValueFromPrepared('date_naissance');
		if(date_naissance != ''){
			var dateArray = date_naissance.split('/');
			date = new Date(dateArray[2],dateArray[1]-1,dateArray[0]);
			age = (dateNow.getTime()/1000-date.getTime()/1000)/60/60/24/365.242198;

		}
		
		
		
		// Initialisations
		var montant = 						this.getValueFromPrepared('montant', true);

		var duree = 						this.getValueFromPrepared('duree', true);
		                                                                    
		                       	
		//  Emprunteur                                                                  	
		var salaire_net_mensuel = 			this.getValueFromPrepared('salaire_net_mensuel', true);
		var autres_revenus_mensuels = 		this.getValueFromPrepared('autres_revenus', true);
		var revenu_annuel_imposable = 		this.getValueFromPrepared('revenu_annuel_imposable', true);
		var nb_enfants_moins_6 = 			this.getValueFromPrepared('nb_enfants_moins_6', true);
		var nb_enfants_entre_6_et_12 =		this.getValueFromPrepared('nb_enfants_entre_6_et_12', true);
		var nb_enfants_plus_12 = 			this.getValueFromPrepared('nb_enfants_plus_12', true);
		var mensualite_credit = 			this.getValueFromPrepared('credits_montant', true);
		var mensualite_leasing = 			this.getValueFromPrepared('leasings_montant', true);
		var loyer_montant = 				this.getValueFromPrepared('loyer_montant', true);
		var charges_hypothecaires_montant = this.getValueFromPrepared('charges_hypothecaires_montant', true);
		var autres_charges_mensuelles = 	this.getValueFromPrepared('autres_charges_mensuelles', true);
		var nb_salaire_par_an = 			this.getValueFromPrepared('nb_salaire_par_an', true);
		
		// conjoint
		var salaire_net_mensuel_c = 		this.getValueFromPrepared('salaire_net_mensuel_c', true);
		var autres_revenus_mensuels_c = 	this.getValueFromPrepared('autres_revenus_c', true);
		var revenu_annuel_imposable_c = 	this.getValueFromPrepared('revenu_annuel_imposable_c', true);
		var mensualite_credit_c = 			this.getValueFromPrepared('credits_montant_c', true);
		var mensualite_leasing_c = 			this.getValueFromPrepared('leasings_montant_c', true);
		var autres_charges_mensuelles_c = 	this.getValueFromPrepared('autres_charges_mensuelles_c', true);
		var nb_salaire_par_an_c = 			this.getValueFromPrepared('nb_salaire_par_an_c', true);
		
		var etat_civil = 					this.getValueFromPrepared('etat_civil');
		var rachat_credit = 				this.getValueFromPrepared('rachat_credit');	
		var rachat_leasing = 				this.getValueFromPrepared('rachat_leasing');
		var rachat_credit_c = 				this.getValueFromPrepared('rachat_credit_c');
		var rachat_leasing_c = 				this.getValueFromPrepared('rachat_leasing_c');
		var impose_a_la_source = 			this.getValueFromPrepared('impose_a_la_source');
		var impose_a_la_source_c = 			this.getValueFromPrepared('impose_a_la_source_c');
		

		var situation_pro = 				this.getValueFromPrepared('situation_pro');
		var pays = 							this.getValueFromPrepared('pays');
		var region_france = 				this.getValueFromPrepared('region_france');
		var region_allemagne = 				this.getValueFromPrepared('region_allemagne');
		var region_italie = 				this.getValueFromPrepared('region_italie');
		var region_autriche = 				this.getValueFromPrepared('region_autriche');
		var sa_sarl = 						this.getValueFromPrepared('sa_sarl');
		var permis_sejour = 				this.getValueFromPrepared('permis_sejour');
		var lieu_de_travail = 				this.getValueFromPrepared('lieu_de_travail');
		var permis_sejour_depuis = 			this.getValueFromPrepared('permis_sejour_depuis');
		var addb = 							this.getValueFromPrepared('addb');
		var poursuites = 					this.getValueFromPrepared('poursuites');

		

		
		
	
		// base
		var couple = false;
		if(etat_civil == 'marie' || etat_civil == 'pacse'){ couple = true;}	
		var base_adultes = 					(couple) ? BASE_COUPLE : BASE_CELIBATAIRE;
		var base_enfants = 					(BASE_ENFANTS_MOINS_6 * nb_enfants_moins_6) + (BASE_ENFANTS_ENTRE_6_ET_12 * nb_enfants_entre_6_et_12) + (BASE_ENFANTS_PLUS_12 * nb_enfants_plus_12);
		
		// revenus
		var revenus_mensuels_net_totaux = 	(salaire_net_mensuel *   nb_salaire_par_an +   autres_revenus_mensuels * 12 +revenu_annuel_imposable) /12;
		var revenus_mensuels_net_totaux_c = (salaire_net_mensuel_c * nb_salaire_par_an_c + autres_revenus_mensuels_c * 12 +revenu_annuel_imposable_c) / 12 ;
		
		// impots
		var impots_mensuels = revenus_mensuels_net_totaux * IMPOT/12;
		if(impose_a_la_source == 'oui'){impots_mensuels = 0;}
		var impots_mensuels_c = revenus_mensuels_net_totaux_c * IMPOT/12;
		if(impose_a_la_source_c == 'oui'){impots_mensuels_c = 0;}
		
		// rachat crédit / leasing
		if(rachat_credit=='oui'){ mensualite_credit = 0; }
		if(rachat_leasing=='oui'){ mensualite_leasing = 0; }
		if(rachat_credit_c=='oui'){mensualite_credit_c = 0;}
		if(rachat_leasing_c=='oui'){mensualite_leasing_c = 0;}
		
		// assurances
		var assurance_maladie = ASSURANCE_MALADIE_ADULTE;	
		if(couple){assurance_maladie += ASSURANCE_MALADIE_ADULTE;}
		var assurance_maladie_enfants = ASSURANCE_MALADIE_ENFANT * (nb_enfants_moins_6 + nb_enfants_entre_6_et_12 + nb_enfants_plus_12 );	
		
		// totaux
		var revenus_mensuels_totaux = Number(revenus_mensuels_net_totaux) + Number(revenus_mensuels_net_totaux_c);
		var charges_mensuelles_totales = (	Number(base_adultes) + 
											Number(base_enfants) + 
											Number(impots_mensuels)+
											Number(impots_mensuels_c)+
											Number(loyer_montant) + 
											Number(charges_hypothecaires_montant)/3+
											Number(assurance_maladie) + 
											Number(assurance_maladie_enfants) + 
											Number(mensualite_credit) + 
											Number(mensualite_leasing)+ 
											Number(mensualite_credit_c) + 
											Number(mensualite_leasing_c) + 
											Number(autres_charges_mensuelles) + 
											Number(autres_charges_mensuelles_c) );


		var part_revenu = 1;
		if(couple){ part_revenu = revenus_mensuels_net_totaux / (revenus_mensuels_net_totaux + revenus_mensuels_net_totaux_c);}
		var charges = part_revenu * charges_mensuelles_totales;
		var part_disponible = revenus_mensuels_net_totaux - charges;
		
		var t = Taux1/12/100;
		var d = 36;
		var m = part_disponible;
		
		var montantMax = Math.round( (1/t)* (m - m/Math.pow(1+t, d)),2 );
		var isLessThanMin = false;
		if(montantMax > EMPRUNT_MAX){ montantMax = EMPRUNT_MAX;}
		
		
		if((situation_pro == 'rentier' || situation_pro == 'retraite') && montantMax > 5*salaire_net_mensuel ){
			montantMax = 5*salaire_net_mensuel;
		}else if(permis_sejour_depuis == 'entre_6_12' && montantMax > MONTANT_MAX_PERMIS_SEJOUR_ENTRE_6_ET_12_MOIS){
			montantMax = MONTANT_MAX_PERMIS_SEJOUR_ENTRE_6_ET_12_MOIS;
		}
		

		/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
		/* /////////////////////									TEST DES CAS REFUSES							////////////////////// */
		/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
		
		
		self.statut = 'vert';
		
		if(	age < 18 || age >= 70 ||
			situation_pro == 'apprenti_etudiant' || 
			situation_pro == 'chomage' || 
			situation_pro == 'sans_revenu' || 
			situation_pro == 'service_sociaux' ||
			situation_pro == 'independant' && pays !='suisse'  ||
			permis_sejour == 'def' && pays !='suisse' ||
			addb == 'oui' ||
			permis_sejour_depuis == 'moins_6_mois'
		){
			self.statut = 'rouge';
		}
		

		if(	
			age > 65 && age < 70 ||
			poursuites == 'oui' ||
			permis_sejour_depuis == 'entre_6_12' ||
			situation_pro == 'employe_de_son_entreprise' && sa_sarl == 'sarl' && pays !='suisse' ||
			situation_pro == 'employe_de_son_entreprise' && sa_sarl == 'sarl' && meme_situation_annees < 3 ||
			situation_pro == 'temporaire' && meme_situation_annees < 1 ||
 			situation_pro == 'independant' && meme_situation_annees < 3 ||
			lieu_de_travail == 'geneve' && meme_situation_mois < 12 ||
			lieu_de_travail == 'autre'  && meme_situation_mois < 36
		){
			if(self.statut!='rouge'){self.statut = 'orange';}
		}


		// si montant autorisé défini
		if(	!isNaN(montantMax) ){	
			
			this.montantMax = montantMax;
			// si montant autorisé > que le minimum empruntable
			if( montantMax >= EMPRUNT_MIN ){
				// entre en jeu si l'utilisateur a déjà entré un montant à saisir
				// si le montant désiré est plus grand que le montant max, on lui dit que c'est trop
				if(montant > montantMax){
					if(self.statut != 'rouge'){ self.statut = 'orange'; }
				}
			// si montant autorisé < que le minimum empruntable, on lui dit qu'il n'y a pas droit.
			}else{
				self.statut = 'orange';
			}
		}
		
		
		
		
		/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
		/* /////////////////////									DOCUMENTS										////////////////////// */
		/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
		

		var sa_sarl = 			this.getValueFromPrepared('sa_sarl');
		var permis_sejour = 	this.getValueFromPrepared('permis_sejour');
		var nationnalite = 		this.getValueFromPrepared('nationalite');

		var documents = "<li>"+pieceIdentiteOuPasseportRecu+"</li>";
		var docs_array = ['pieceIdentiteOuPasseportRecu'];
		if( situation_pro == 'salarie' && pays == 'suisse' && nationnalite == 'CH'){

			documents = "<li>"+pieceIdentiteOuPasseportRecu+"</li>";
			documents+= "<li>"+troisFichesSalaire+"</li>";
			docs_array = ['pieceIdentiteOuPasseportRecu,troisFichesSalaire'];
			
		}else if( situation_pro == 'salarie' && pays == 'suisse' && nationnalite != 'CH' && nationnalite != ''){

			documents = "<li>"+pieceIdentiteOuPasseportRecu+"</li>";
			documents+= "<li>"+permisSejourBLCRecu+"</li>";
			documents+= "<li>"+troisFichesSalaire+"</li>";
			docs_array = ['pieceIdentiteOuPasseportRecu,permisSejourBLCRecu,troisFichesSalaire'];
			
		}else if( situation_pro == 'salarie' && pays != 'suisse' && pays != '' ){

			documents = "<li>"+pieceIdentiteOuPasseportRecu+"</li>";
			documents+= "<li>"+permisSejourBLCRecu+"</li>";
			documents+= "<li>"+troisFichesSalaire+"</li>";
			documents+= "<li>"+derniereFactureElectricite+"</li>";
			documents+= "<li>"+dernierReleveDeCompteBancaire+"</li>";
			docs_array = ['pieceIdentiteOuPasseportRecu,permisSejourBLCRecu,troisFichesSalaire,derniereFactureElectricite,dernierReleveDeCompteBancaire'];

		}else if( (situation_pro == 'employe_de_son_entreprise' || situation_pro == 'independant') && pays == 'suisse'){

			documents = "<li>"+pieceIdentiteOuPasseportRecu+"</li>";
			documents+= "<li>"+derniereTaxationFiscale+"</li>";
			docs_array = ['pieceIdentiteOuPasseportRecu,derniereTaxationFiscale'];
			
		}else if((situation_pro == 'employe_de_son_entreprise' || situation_pro == 'independant') && pays != 'suisse' && pays != ''){

			documents = "<li>"+pieceIdentiteOuPasseportRecu+"</li>";
			documents+= "<li>"+permisSejourBLCRecu+"</li>";
			documents+= "<li>"+derniereTaxationFiscale+"</li>";
			docs_array = ['pieceIdentiteOuPasseportRecu,permisSejourBLCRecu,derniereTaxationFiscale'];

		}else if( (situation_pro == 'rentier' || situation_pro == 'retraite') && pays == 'suisse'){

			documents = "<li>"+pieceIdentiteOuPasseportRecu+"</li>";
			documents+= "<li>"+decisionOfficielleRentes+"</li>";
			documents+= "<li>"+troisDerniersAvisEntreeDeRente+"</li>";
			docs_array = ['pieceIdentiteOuPasseportRecu,decisionOfficielleRentes,troisDerniersAvisEntreeDeRente'];
			
		}else if( (situation_pro == 'rentier' || situation_pro == 'retraite') && pays != 'suisse' && pays != ''){

			documents = "<li>"+pieceIdentiteOuPasseportRecu+"</li>";
			documents+= "<li>"+permisSejourBLCRecu+"</li>";
			documents+= "<li>"+decisionOfficielleRentes+"</li>";
			documents+= "<li>"+troisDerniersAvisEntreeDeRente+"</li>";
			docs_array = ['pieceIdentiteOuPasseportRecu,permisSejourBLCRecu,decisionOfficielleRentes,troisDerniersAvisEntreeDeRente'];
			
		}else if( permis_sejour == 'def' && pays == 'suisse'){

			documents = "<li>"+pieceIdentiteOuPasseportRecu+"</li>";
			documents+= "<li>"+carteLegitimationDEF+"</li>";
			documents+= "<li>"+troisFichesSalaire+"</li>";
			docs_array = ['pieceIdentiteOuPasseportRecu,carteLegitimationDEF,troisFichesSalaire'];
		}
		
		var docs_c = false;
		if(etat_civil == 'marie' || etat_civil == 'pacse'){
			var docs_c = true;				
			$('#demandeDocumentsConjoint').html(VEUILLEZ_JOINDRE_LES_DOCUMENTS_DE_VOTRE_CONJOINT);
		}else{
			var docs_c = false;
			$('#demandeDocumentsConjoint').empty();
		}
		
		self.documents = docs_array;
		self.documents_c = docs_c;

		
		
		// var date = new Date();
		// var debugCalcul  = "Date : "+date.toLocaleString();
		// debugCalcul 	+= "<br/><br/><strong>age : </strong>"+							age;
		// 
		// debugCalcul 	+= "<br/><br/><strong>Base adultes : </strong>"+				base_adultes;
		// debugCalcul 	+= "<br/><strong>Base enfants :</strong> "+						base_enfants;
		// debugCalcul 	+= "<br/><strong>Charges de domicile mensuelle :</strong> "+	Number(loyer_montant) + Number(charges_hypothecaires_montant)/3;
		// debugCalcul 	+= "<br/><strong>Assurance maladie adultes :</strong> "+		assurance_maladie;
		// debugCalcul 	+= "<br/><strong>Assurance maladie enfants :</strong> "+		assurance_maladie_enfants;
		// debugCalcul 	+= "<br/><strong>Crédits totaux :</strong> "+					(mensualite_credit + mensualite_credit_c);
		// debugCalcul 	+= "<br/><strong>Leasings totaux :</strong> "+					(mensualite_leasing+ mensualite_leasing_c);
		// debugCalcul 	+= '<br/><strong>Impots emprunteur :</strong> '+ 				impots_mensuels;
		// debugCalcul 	+= '<br/><strong>Impots conjoint :</strong> '+ 					impots_mensuels_c;
		// debugCalcul 	+= '<br/><strong>Impots totaux :</strong> '+ 					(impots_mensuels+impots_mensuels_c);
		// 
		// debugCalcul 	+= '<br/><br/><strong>Autres revenus emprunteur :</strong> '+ 	autres_revenus_mensuels;
		// debugCalcul 	+= '<br/><strong>Autres revenus conjoint :</strong> '+ 			autres_revenus_mensuels_c;
		// 
		// debugCalcul 	+= '<br/><br/><strong>nb salaires emprunteur :</strong> '+ 		nb_salaire_par_an+" - conjoint : "+nb_salaire_par_an_c;
		// 
		// debugCalcul 	+= '<br/><br/><strong>Revenus Totaux :</strong> '+ 				revenus_mensuels_totaux;
		// debugCalcul 	+= '<br/><strong>Total charges mensuelles :</strong> '+			charges_mensuelles_totales;
		// debugCalcul 	+= '<br/><strong>Part revenu emprunteur :</strong> '+			part_revenu;
		// debugCalcul 	+= "<br/><strong>Charges imputables à l'emprunteur :</strong> "+charges;
		// 
		// debugCalcul 	+= '<br/><br/><strong>Part dispo :</strong> '+					part_disponible;
		// debugCalcul 	+= '<br/><strong>Montant max :</strong> '+						montantMax;
		// debugCalcul 	+= '<br/><strong>Montant désiré  :</strong> '+ 					montant;
		// 
		// debugCalcul 	+= '<br/><br/><strong>Statut  :</strong> '+ 					self.statut;
		// $('#debugCalcul').html(debugCalcul);
		
		
		
		//console.warn('statut : '+self.statut);
		return valid;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
	/* /////////////////////									ENVOI DU FORMULAIRE										////////////////////// */
	/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
	
	
	this.submitForm = function(){
		//this.disableNav();
		$('#sending').show();
		var data = this.getFormData();
		var data = ({
						data:data, 
						ajax:true, 
						action:'enregistreDemande', 
						documents:self.documents, 
						documents_c:self.documents_c, 
						montantMax:self.montantMax, 
						statut:self.statut, 
						debug:navigator.userAgent
					});
		$.ajax({
			url: "/"+shortlang+"/demande-credit.html",
			type: "POST",
			data: data,
			dataType: "json",
			success: function(msg){
				$('#sending').hide();
				//self.activateNav();
				self.showValidationMessage(msg)},
			error:function(msg){self.activateNav();self.errorValidation(msg)}
		 });				
	}
	
	
	this.showValidationMessage = function(data){	
		//console.warn(data);
		try{
			if( data.status=='fail' && data.errors.length > 0 ){
				data = data.errors;

				for( var i=0; i < data.length; i++){
					var step = '';
					var closeEl = $('#'+data[i].id);
					if(closeEl.length == 0 ){
						closeEl = $('input[name='+data[i].id+']:first');
					}

					if( closeEl.hasClass('.field') ){
						var el = closeEl;
					}else{
						var el = closeEl.parents('.field');
					}
					this.reportError( el, data[i].m, true );
					
					el.parents('.etape').find('.contentErrors').show();
					$('#etape5 .contentErrors').show();
					$('#etape5 .contentErrors').html( PLUSIEURS_ERREURS.replace('%', data.length) );
				}
				
			}else if(data.status=='success'){
				window.onbeforeunload = null;
				
				if(DEV_ENVIRONMENT == 2){window.location = ADRESSE_VALIDATION_ENVOI+"?id="+data.id;}
				else{window.open(ADRESSE_VALIDATION_ENVOI+"?id="+data.id);}

			}
		}catch(e){}
	}
	
	this.errorValidation = function(data){
		console.error(data);
		alert("Votre demande a connu un problème d'envoi. Veuillez nous contacter.");
	}
	
	
	this.getFormData = function(){
		var data = [];
		
		var fields = $('.field.visible').each(function(){
			if($(this).is(':hidden')) $(this).show();
		});

		fields.each(function(){
			var obj = null;
			var el = $(this);
						
			/*
			* t : type, v : value, d : display, id : id
			*/
			if( el.hasClass('phone') ){
				obj = {
					't' : 'phone',
					'v' : el.find('input').val(),
					'id': el.find('input').attr('id')
				}
			}else if( el.hasClass('phoneCH')  ){
				obj = {
					't' : 'phoneCH',
					'v' : el.find('input').val(),
					'id': el.find('input').attr('id')
				}
			}else if( el.hasClass('date')  ){
				obj = {
					't' : 'date',
					'v' : el.find('input').val(),
					'id': el.find('input').attr('id')
				}
			}else if( el.hasClass('dateMois')  ){
				obj = {
					't' : 'date',
					'v' : '01/'+el.find('input').val(),
					'id': el.find('input').attr('id')
				}
			}else if( el.hasClass('text')  ){
				if(el.hasClass('pass')){
					
					var login = new Login();	
					login.init();
					obj = {
						't' : 'text',
						'v' : login.md5_encode(el.find('input').val()),
						'id': el.find('input').attr('id')
					}

				}else{
					obj = {
						't' : 'text',
						'v' : el.find('input').val(),
						'id': el.find('input').attr('id')
					}
				}
			}else if( el.hasClass('number')  ){
				obj = {
					't' : 'number',
					'v' : el.find('input').val(),
					'id': el.find('input').attr('id')
				}
			}else if( el.hasClass('email')  ){
				obj = {
					't' : 'email',
					'v' : el.find('input').val(),
					'id': el.find('input').attr('id')
				}
			}else if( el.hasClass('select') ){
				
				var selected = el.find('.selectDiv').data('selected');
				var id = el.find('.selectDiv').attr('id');
				
				var display = '' ;
				el.find('.option').each(function(){
					if($(this).attr('id') == selected){
						display = $(this).text();
						return;
					}
				});
				obj = {
					't' : 'selectDiv',
					'v' : selected,
					'id': id
					,'d' : display
				}
			}else if( el.hasClass('radio')  ){
				obj = {
					't' : 'radio',
					'v' : el.find('input[name='+el.find('input:first').attr('name')+']:checked').val(),
					'id': el.find('input:first').attr('name')
				}

			}else if( el.hasClass('textarea') ){
				obj = {
					't' : 'textarea',
					'v' : el.find('textarea').val(),
					'id': el.find('textarea').attr('id')
				}
			}
			// s = step
			obj.s = el.parents('.etape').attr('id');
			if(  el.hasClass('required') ){obj.r = true;}
			if( !el.hasClass('readonly') ){data.push(obj);}
			
		});
		
		this.prepareData(data);
		
		return data;
	}
	
	
	
	
	this.prepareData = function(fields){
		
		var data = {};
		for(var i =0; i< fields.length;i++){
			if(isNaN(fields[i]['v'])){
				data[fields[i]['id']] = fields[i]['v'];
			}else{
				data[fields[i]['id']] = Number(fields[i]['v']);
			}
		}
		this.preparedData = data;
		return data;
	}
	
	this.getValueFromPrepared = function(id, isNumber){
		if(this.preparedData[id]) {
			return this.preparedData[id];
			
		}else {
			if(isNumber){return 0;}
			else{return '';}
		} 
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
	/* /////////////////////									OUTILS										////////////////////// */
	/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
	
	
	this.loadAdresses = function(pays){
			
		$.ajax({
			url: "/fr/demande-credit.html",
			type: "POST",
			data: ({pays : pays, ajax : true, action:'getAdresses'}),
			dataType: "json",
			success: function(msg){self.fillAdresses(msg, pays)},
			error:function(msg){ console.error(msg);console.error(msg.responseText);}
		   }
		);
			
	}
		
	this.fillAdresses = function(data, pays){

		if(data.success){
			this.adresses[pays] = data.villes;
			
			if( pays == 'suisse'){
				var selectDiv = 'region_suisse';
				this.setOptions(this.adresses['suisse'], $('#region_suisse .options'));
				this.setOptions(this.adresses['suisse'], $('#region_suisse_prec .options'));
				
			}else if( pays == 'france_short'){
				this.setOptions(this.adresses['france_short'], $('#region_france .options'));
				 //$('#region_france .options').append($("<div class='option' id='autre'>Autre</div>"));
				
			}else if( pays == 'france'){
				this.setOptions(this.adresses['france'], $('#region_france_prec .options'));

			}
			
			this.manageSelect();
		}
	}
	
	
	
	this.loadStreets = function( npa, fn ){

		if( this.streets[npa] ){
			return;
		}
	
		$.ajax({
			url: "/fr/demande-credit.html",
			type: "POST",
			data: ({npa : npa, ajax : true, action:'getStreets'}),
			dataType: "json",
			success: function(msg){ self.fillStreet(msg);fn(); },
			error:function(msg){ console.error(msg);console.error(msg.responseText);}
		   }
		);
			
	}
	
	
	this.fillStreet = function( data ){
		if(data.success){		
			for(var npa in data.rues)
			{
				this.streets[npa] = data.rues[npa];
			}
		}
	}
	
	
	
	
	
	

	this.setOptions = function(options, target, display, index){
		// si display = key ou null, on affiche l'index du tableau associatif
		// si display est = value, il affiche la valeur du tableau associatif
		// si display est = value et qu'index est défini, celà indique que chaque objet de l'itération comporte un tableau et l'index représente la valeur de l'index choisi
		if(display == undefined || display==null){display='key';}
		target.empty();
		
		for(var option in options){
			if(display=='key'){
				var option = $("<div class='option' id='"+option+"'>"+option+"</div>");
			}else if(display=='value' && index!=''){
				var option = $("<div class='option' id='"+options[option][index]+"'>"+options[option]['ville']+"</div>");
			}else if(display=='value'){
				var option = $("<div class='option' id='"+options[option]+"'>"+options[option]+"</div>");
			}
			target.append(option);
		}
	}
	
	
	this.errorLoading = function(data){
		//console.info('adresses non chargées');
	}
	
	
	
	
	this.placeholder = function(input,default_string){
	
		if(!default_string){default_string = input.attr('placeholder')}

		if( input.val()=='' || input.val() == default_string ){
			input.addClass('empty') ;
			input.prop('value',default_string);
		}

		input.blur(function(){
			if( input.val()=='' ){
				 input.prop('value',default_string);
				 input.addClass('empty');
			}else{
			 	input.removeClass('empty');
			}
		});

		input.focus(function(){
			if( input.val() == default_string ){
			 	input.removeClass('empty');
				input.prop('value', '');
			}
		});
	}



	this.clean = function(string){
 		string = string.replace(/[ÁÂÃÄÅàáâãäå]/gi, 	'a');
 		string = string.replace(/[ÈÉÊËèéêë]/gi, 	'e');
 		string = string.replace(/[ÌÍÎÏìíîï]/gi, 	'i');
 		string = string.replace(/[ÒÓÔÕÖòóôõö]/gi, 	'o');
 		string = string.replace(/[ÙÚÛÜùúûü]/gi, 	'u');
 		string = string.replace(/[Çç]/gi, 			'c');
 		string = string.replace(/[Ýýÿ]/gi, 			'y');
 		string = string.replace(/[Ññ]/gi, 			'n');
		string = string.toLowerCase();
		return string;		
	}




	
	

	this.maximize = function(element, ev){

		
		var maxlength = Number(element.attr('maxlength'));

		if( element.val().length == maxlength &&
			element.caret().start < element.val().length &&
			element.data('maximized') != '1'
 		 ){
			if(	ev.keyCode == 27 ||
				ev.keyCode >= 37 && ev.keyCode <= 40 ||
				ev.keyCode == 46 ||
				ev.keyCode == 8 ||
				ev.keyCode == 9 ||
				ev.keyCode == 16 ||
				ev.keyCode == 17 ||
				ev.keyCode == 91 
				){
					return true;
			}else if(ev.keyCode == 13){
				element.blur();
			}
			element.data('maximized', '1');
			element.attr('maxlength', maxlength +1 );

		}
		

	}
	
	this.minimize = function(element, string, separator){
		var maxlength = Number(element.attr('maxlength'));
				
		var caretPosOffset = 0;
		if( element.data('maximized') == '1' ){

			if( string.charAt(element.caret().start) == separator ){
				string = string.replaceAt(element.caret().start+1, '');
				caretPosOffset = 1;
			}else{
				string = string.replaceAt(element.caret().start, '');
			}
			element.attr('maxlength', maxlength -1 );
			element.data('maximized', '0');
		}
		
		return {'string': string, 'caretOffset' : caretPosOffset }

	}



	
	
 	/* Visibilité */
	this.hide = function(selector){	
		var isField = false;
		var element = $(selector);
		if(element.hasClass('field')){isField = true;}
		if(element.length == 0){selector = "input[name="+selector.replace('#', '')+"]:first";}
		
		if(isField){
			this.slideUp( $(selector), function(){$(selector).parents('.field').removeClass('visible').hide();} );

		}else{
			this.slideUp( $(selector).parents('.field'), function(){ $(selector).parents('.field').removeClass('visible').hide();} );
			
		}
	}
		
	
	this.show = function( selector, markField ){
		
		var isField = false;
		var element = $(selector);
		if(element.hasClass('field')){isField = true;}
		if(element.length == 0){selector = "input[name="+selector.replace('#', '')+"]:first";}
		
		var selector = $(selector);
		
		if(isField){
			this.slideDown( selector.addClass('marked'), null,function(){
				if( selector.is(':visible')){ selector.addClass('visible') }
			});
		}else{
			this.slideDown( selector.parents('.field').addClass('marked'), null,function(){
				if( selector.parents('.field').is(':visible')){ selector.parents('.field').addClass('visible') }
			} );
		}
	
	}
	this.showIfMarked = function(selector){
		
		var isField = false;
		var element = $(selector);
		if(element.hasClass('field')){isField = true;}
		if(element.length == 0){selector = "input[name="+selector.replace('#', '')+"]:first";}
			
		if( isField ){
			$(selector+".marked").slideDown(function(){
				if( $(selector+".marked").is(':visible')){ $(selector+".marked").addClass('visible') }
			});
		}else{
			$(selector).parents('.field.marked').slideDown(function(){
				if( $(selector).parents('.field.marked').is(':visible')){ $(selector).parents('.field.marked').addClass('visible') }
			});
		}		
	}
	
	
	this.slideUp = function(el, duration, fn){
	
		if( !$.browser.msie ){
			if(!duration){el.slideUp(fn);}
			else{el.slideUp(duration,fn)}
		}else{
			el.hide();
			el.removeClass('visible');
		}
		
	}
	
	this.slideDown = function(el, duration, fn){
				
		if( !$.browser.msie ){
			if(!duration){el.slideDown(fn);}
			else{el.slideDown(duration,fn)}
		}else{
			el.show();
		}	
	}
	
	



	
	/* Report des erreurs */ 
	this.reportError = function(field,message,hideMessage){		
		field
			.addClass('error')
			.removeClass('success warning')
			.find('.leftContent')
			.effect("shake", { times:2,direction:'right',distance:10 }, 50);

		field.find('.message').remove();

		field
			.find('.thirdPart')
			.prepend("<div class='message'>"+message+"</div>");			
	}
	

	this.reportSuccess = function(field,message){

		field
			.addClass('success visible')
			.removeClass('error warning')
			.find('.message')
			.remove();
	}
	
	
	this.reportWarning = function(field,message, hideMessage){

		this.reportSuccess(field,message,hideMessage);
		// field
		// 	.addClass('warning success visible')
		// 	.removeClass('error')
		// 	.find('.leftContent')
		// 	.effect("shake", { times:2,direction:'right',distance:10 }, 50);
		// 	
		// field.find('.message').remove();
		// 
		// field
		// 	.find('.thirdPart')
		// 	.prepend("<div class='message'>"+message+"</div>");
	}
	
	
	this.addCommas = function(nStr)
	{
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + "'" + '$2');
		}
		return x1 + x2;
	}
	
	this.closeOnOutClick = function(el, elToHide, fn){
		if(elToHide == null || elToHide == undefined) elToHide = el;
		$(document).mouseup( function(e) {  
			var offset = el.offset();
			var mouse = self.getCursorPosition(e);
			var inHoriz = (mouse.x > offset.left) && (mouse.x < offset.left+el.outerWidth() );
			var inVertic = (mouse.y > offset.top)  && (mouse.y < offset.top+ el.outerHeight() );
			if( (!inHoriz || !inVertic) && e.target.nodeName !='OPTION'){
				if( !!(fn && fn.constructor && fn.call && fn.apply)  ){
					fn();
				}else{;
					elToHide.hide();
				}
				$(document).unbind();
			}
		});
	}
	
	this.getCursorPosition = function(e) {
	    e = e || window.event;
	    var cursor = {x:0, y:0};
	    if (e.pageX || e.pageY) {
	        cursor.x = e.pageX;
	        cursor.y = e.pageY;
	    }else {
	        var de = document.documentElement;
	        var b = document.body;
	        cursor.x = e.clientX + (de.scrollLeft || b.scrollLeft) - (de.clientLeft || 0);
	        cursor.y = e.clientY + (de.scrollTop || b.scrollTop) - (de.clientTop || 0);
	    }
	    return cursor;
	}
	
	

} // FIN OBJET


/* String */
String.prototype.toCharCode = function(){
    var str = this.split(''), len = str.length, work = new Array(len);
    for (var i = 0; i < len; ++i){
        work[i] = str[i].charCodeAt(0);
    }
    return work;//.join(',');

}

String.prototype.replaceAt=function(index, char) {
   return this.substr(0, index) + char + this.substr(index+char.length+1);
}



$.wait = function( callback, miliseconds){
   return window.setTimeout( callback, miliseconds );
}



