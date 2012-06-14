if (!window.console) console = {log: function() {},info: function() {},warn: function() {},error: function() {}};


$(document).ready(function() {
	manageMenu();
	manageCalculateur();	
	manageAdmin();


	$('#zone11 #openZone11, #zone11 #closeZone11').click(function(){
		$(this).parent().toggleClass('closed');
	});
	
	
	$('#demande_courrier').hover(function(){
		$(this).find('#demande_courrier_corps').show();
	}, function(){
		$(this).find('#demande_courrier_corps').hide();
	});
	
	
	
	$('#accueil_courrier_fax').click(function(e){
		$('#accueil_img #demande_courrier_corps').toggle();
		e.preventDefault();
	});
	


	
		
});


function manageMenu(){
	$('.menu li').hover(function(){
		$(this).addClass('hover').find('ul:first').addClass('show');
	}, function(){
		$(this).removeClass('hover').find('ul:first').removeClass('show');
	});

}



function manageCalculateur(){
	
	if($('#calculateur').length > 0){
		$( "#sliderMontantDesire" ).slider({
			min:Number(EMPRUNT_MIN),
			max:Number(EMPRUNT_MAX),
			step:1000,
			value:montantInitial,
			slide:function(e,ui){
				$('#calculateurMontantTotal').text(ui.value);
				calculeTotalCalculateur();
			}
		});
	
		$( "#sliderDureeDesiree" ).slider({
			min:Number(DUREE_MIN),
			max:Number(DUREE_MAX),
			value:dureeInitiale,
			step:6,
			slide:function(e,ui){
				$('#calculateurDureeTotal').text(ui.value);
				calculeTotalCalculateur();
			}
		});
		var montant = $('#calculateurMontantTotal').text(montantInitial);
		var duree = $('#calculateurDureeTotal').text(dureeInitiale);
		calculeTotalCalculateur();
	}
}


function calculeTotalCalculateur(){
	
  	var TauxMens1 = Taux1/12/100;
  	var TauxMens2 = Taux2/12/100;
  	var Mens1 = 0;
  	var Mens2 = 0;

	var montant = $('#calculateurMontantTotal').text();
	var duree = $('#calculateurDureeTotal').text();
	
  	Mens1 = (100*montant*(TauxMens1/(1-(1/Math.pow((1+TauxMens1),duree)))))/100;
  	Mens1 = Math.round(Mens1, 2);
  	Mens2 = (100*montant*(TauxMens2/(1-(1/Math.pow((1+TauxMens2),duree)))))/100;
  	Mens2 = Math.round(Mens2, 2);
	
	var calculateurTotalMin = 0;
	var calculateurTotalMax = 0;
	
	$('#calculateurTotalMin').text(Mens1);
	$('#calculateurTotalMax').text(Mens2);
	
	$('#boutonValidationCalculateur').attr('href', '/'+shortlang+'/'+urlFormulaireDemande+'?demande&montant='+montant+'&duree='+duree);
			
}



function manageAdmin(){
	if($('.admin').length == 1){
	
		// gère l'activation ou désactivation d'une valeur
		$('.prix.filtre li').click(function(){
			$(this).toggleClass(function() {
			  	if ($(this).is('.show')) return 'hide';
			  	else return 'show';
			  	
			});
		})
		
		
		$('#applyFilter').click(function(){
			
			$('.listing tr').show();
			
			$('.filtre .hide').each(function(){
				$('.listing .'+$(this).data('info')).hide();
			});
			
			
		});


	
	}
}











