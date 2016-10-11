$(document).ready(function() {
		//Validacion con BootstrapValidator
	    fl = $('#form-plan_cuentas');
	    
	    fl.bootstrapValidator({ 
	        message: 'El valor no es valido.',
	        //fields: name de los inputs del formulario, la regla que debe cumplir y el mensaje que mostrara si no cumple la regla
	        feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
	        fields: {
	        	modal_subgrupo_nombre: {
	        		message: 'Nombre no valido',
	                        validators: {
	                                notEmpty: {
	                                        message: 'nombre requerido'
	                                },
	                                regexp: {
	                                	 
	               					 regexp: /^[0-9]+$/,
	                
	               					 message: 'Ingrese números'
	                
	               				 }
	            				 
	                        }
	                } 
	        }
	        //Cuando el formulario se lleno correctamente y se envia, se ejecuta esta funcion
	    
	    });
	    
		
	});

$(function(){
	$('#modal_id_subgrupo').click(function(){
		
		var _nombre = $('#modal_subgrupo_nombre');
		
        _this.attr('style', 'background:white');
        
		if(_nombre.indexOf(' ') >= 0){
			_this.attr('style', 'background:#FF4A4A');
		}

		if(_nombre.indexOf("'") >= 0){
			_this.attr('style', 'background:#FF4A4A');
		}

		if(_nombre.val() == ''){
			_this.attr('style', 'background:#FF4A4A');
		}
		
		
	});
});
