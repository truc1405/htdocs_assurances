

jQuery.fn.extend({
	autocomplete: function(manager,options) {
		return this.each(function(i){
			jQuery.autocomplete.init( $(this) , manager, options);
		});
	}
});



jQuery.extend({
	autocomplete: {
		
		
		init:function(selectDiv, manager,  options){					

			var liste = selectDiv.find('.option');
			selectDiv.find('input').
				unbind('keyup').keyup(function(ev){
					jQuery.autocomplete.autocomplete( $(this) , ev, liste, selectDiv, manager);
				});
				
			manager.closeOnOutClick(selectDiv, selectDiv.find('.options'), function(){
				jQuery.autocomplete.validate( selectDiv, manager, selectDiv.find('input') );
				
			});

		},
		
		
		autocomplete:function(textField, ev, liste, selectDiv, manager){
			if(	ev.keyCode == 27 ||
				ev.keyCode == 37 ||
				ev.keyCode == 39 ||
				ev.keyCode == 46 ||
				ev.keyCode == 9  ||
				ev.keyCode == 16 ||
				ev.keyCode == 17 ||
				ev.keyCode == 91
				){
					return true;
			
			// }else if(ev.keyCode == 38){ // haut
			// 	this.goToPrevious(selectDiv);
			// 
			// }else if(ev.keyCode == 40){ // bas
			// 	this.goToNext(selectDiv);

			}else if(ev.keyCode == 13){ // enter
				this.validate(selectDiv, manager, textField);
				manager.updateForm(selectDiv);
				manager.validateForm();
		
			}else{ // si l'utilisateur tape des caractères
				selectDiv.addClass('show');
				this.autoCompleteList(textField, liste);
			}
		},
		
		
		autoCompleteList :function(txtField, list){	
			if(txtField.val() == ''){
				this.showAll(list);
				return;
			}
					
			var val = this.clean(txtField.val());
			list.each(function(){
				if( jQuery.autocomplete.clean( $(this).text() ).indexOf(val) != -1 ){
					$(this).show();
				}else{
					$(this).hide();
				}
				
			});
			//console.info(list);
		},
		
		
		
		// si la valeur saisie correspond à une option à l'identique
	
		validate:function(selectDiv, manager, textField){
			var visibles = selectDiv.find('.option:visible');
			var options = selectDiv.find('.option');
			var field = selectDiv.parents('.field');

			var compteur = 0;
			var lastOption = null;
			for( var i=0 ; i< options.length ; i++){


				// ce code n'est pas terminé, il permet d'inverser ce qui vien après la virgule et ce qui vient avant
				// ça a pour but de modifier la condition else if afin que la saisie "Rue Numa" retourne vrai quand l'option est "Numa-Droz, rue"
				
				// console.info( $(options[i]).text().indexOf(',') );
				// var partie1 = $(options[i]).text().substring(0, $(options[i]).text().indexOf(','));
				// var partie2 = $(options[i]).text().substring($(options[i]).text().indexOf(',')+2, $(options[i]).text().length-1);
				// console.info(partie1+" - "+partie2);
				// console.info(jQuery.autocomplete.clean( $(options[i]).text() ).indexOf( jQuery.autocomplete.clean(       partie2+partie1          ) ) != -1);
				
				
				// si on a tapé exactement pareil, on valide
				if( $(options[i]).attr('id') == textField.val() ){
					selectDiv.find('.option').removeClass('selected_option').show();
					var val1 = $(options[i]).addClass('selected_option').attr('id');
					var val2 = $(options[i]).text();

					selectDiv.find('input').val(val2);
					selectDiv.data('selected', val1);
					selectDiv.removeClass('show');

					manager.reportSuccess(field,false);
					return true;

				}else if( jQuery.autocomplete.clean( $(options[i]).text() ).indexOf( jQuery.autocomplete.clean( textField.val() ) ) != -1 ){
					compteur ++;
					lastOption = $(options[i]);
				}
			}
			
			
			if( field.hasClass('free') ){
				
				if( field.hasClass('displayWarn') ){
					selectDiv.find('.option').removeClass('selected_option').show();
					selectDiv.data('selected', textField.val() );
					selectDiv.removeClass('show');
					manager.reportWarning(field, WARNING_MESSAGE ,false);
					return true;
					
				}else{
					selectDiv.find('.option').removeClass('selected_option').show();
					var val1 = lastOption.addClass('selected_option').attr('id');
					var val2 = lastOption.text();
					selectDiv.find('input').val(val2);
					selectDiv.data('selected', val1);
					selectDiv.removeClass('show');
					manager.reportSuccess(field,false);
					return true;
				}
				
			}else{
				
				if( compteur == 1){
					selectDiv.find('.option').removeClass('selected_option').show();
					var val1 = lastOption.addClass('selected_option').attr('id');
					var val2 = lastOption.text();
					selectDiv.find('input').val(val2);
					selectDiv.data('selected', val1);
					selectDiv.removeClass('show');
					manager.reportSuccess(field,false);
					return true;
					
				}else{
					manager.reportError(field, SAISIE_ABSENTE_DES_PROPOSITIONS , false);
					selectDiv.removeClass('show').find('.option').show();
					
				}
				
				
			}
			


		
		},
	
	
		
		
		
		
		
		
		
		
		
		
		// validate:function(selectDiv, manager, textField){
		// 		var visibles = selectDiv.find('.option:visible');
		// 		var options = selectDiv.find('.option');
		// 		var field = selectDiv.parents('.field');
		// 		
		// 		var compteur = 0;
		// 		var lastOption = null;
		// 		
		// 		// si on ne contraint pas ce que tape le visiteur uniquement aux choix
		// 		if( field.hasClass('free') && field.hasClass('displayWarn') ){
		// 			
		// 			selectDiv.find('.option').removeClass('selected_option').show();
		// 			
		// 			selectDiv.data('selected', textField.val() );
		// 			selectDiv.removeClass('show');
		// 
		// 			manager.reportWarning(field,"Votre saisie n'existe pas parmi les propositions qui vous sont faites. Assurez-vous d'avoir orthographié votre réponse correctement. Le résultat est malgré tout validé.",false);
		// 			return true;
		// 		
		// 		
		// 		// si on ne contraint pas ce que tape le visiteur uniquement aux choix
		// 		}else if( field.hasClass('free') ){
		// 			selectDiv.find('.option').removeClass('selected_option').show();
		// 
		// 			selectDiv.data('selected', textField.val() );
		// 			selectDiv.removeClass('show');
		// 
		// 			manager.reportSuccess(field,false);
		// 			return true;
		// 			
		// 		// si le visiteur est obligé de choisir l'une des options proposées
		// 		}else{
		// 			
		// 			for( var i=0 ; i< options.length ; i++){
		// 
		// 				// si on a tapé exactement pareil, on valide
		// 				if( $(options[i]).attr('id') == textField.val() ){
		// 					selectDiv.find('.option').removeClass('selected_option').show();
		// 					var val1 = $(options[i]).addClass('selected_option').attr('id');
		// 					var val2 = $(options[i]).text();
		// 				
		// 					selectDiv.find('input').val(val2);
		// 					selectDiv.data('selected', val1);
		// 					selectDiv.removeClass('show');
		// 
		// 					manager.reportSuccess(field,false);
		// 					return true;
		// 				
		// 				}else if( jQuery.autocomplete.clean( $(options[i]).text() ).indexOf( jQuery.autocomplete.clean( textField.val() ) ) != -1){
		// 					compteur ++;
		// 					lastOption = $(options[i]);
		// 				}
		// 			}
		// 		
		// 			// s'il n'y a qu'une seule option visible option, on valide
		// 			if( compteur == 1){
		// 				selectDiv.find('.option').removeClass('selected_option').show();
		// 				var val1 = lastOption.addClass('selected_option').attr('id');
		// 				var val2 = lastOption.text();
		// 
		// 				selectDiv.find('input').val(val2);
		// 				selectDiv.data('selected', val1);
		// 				selectDiv.removeClass('show');
		// 
		// 				manager.reportSuccess(field,false);
		// 				return true;
		// 			}
		// 		}
		// 		
		// 		manager.reportError(field, "Votre saisie n'existe pas dans la liste des suggestions. Veuillez choisir une réponse valable !", false);
		// 		selectDiv.removeClass('show').find('.option').show();			
		// 	},
		
		goToPrevious : function(selectDiv){
			var selected = selectDiv.find('.option.selected_option_temp:visible');
			if(selected.length==0){
				var newSelected = selectDiv.find('.option:visible').eq(0);
				newSelected.addClass('selected_option_temp');
			}else{
				var visibles = selectDiv.find('.option:visible ');
				var prev = selected;
				for( var i=0; i< visibles.length; i++){
					if ( $(visibles[i]).attr('id') == selected.attr('id') ){
						prev = $(visibles[i-1]);
						break;
					}
				}
				selected.removeClass('selected_option_temp');
				next.addClass('selected_option_temp');
			}
		},
		
		goToNext : function(selectDiv){

			var selected = selectDiv.find('.option.selected_option_temp:visible');
			console.warn(selected);
			if(selected.length==0){
				var newSelected = selectDiv.find('.option:visible').eq(0);
				newSelected.addClass('selected_option_temp');
			}else{
				var visibles = selectDiv.find('.option:visible ');
				var next = selected;
				for( var i=0; i< visibles.length; i++){
					if ( $(visibles[i]).attr('id') == selected.attr('id') ){
						next = $(visibles[i+1]);
						break;
					}
				}
				selected.removeClass('selected_option_temp');
				next.addClass('selected_option_temp');
			}
			
		},
		
		showAll : function(list){
			list.each(function(){
				$(this).show();
			})
		},
		
		
		clean:function(string){
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
		

	}
});