$(document).ready(function() {
		//Validacion con BootstrapValidator
		fl = $('#form-comprobantes');
	    fl.bootstrapValidator({ 
	        message: 'El valor no es valido.',
	        //fields: name de los inputs del formulario, la regla que debe cumplir y el mensaje que mostrara si no cumple la regla
	        feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
	        fields: {
	        	    
		                descripcion_dcomprobantes: {
			        		message: 'El nombre no es valido',
			                        validators: {
			                                notEmpty: {
			                                        message: 'La descripción es requerida.'
			                                }
			                             
			                        }
			                }
		                
		              
	        }
	        //Cuando el formulario se lleno correctamente y se envia, se ejecuta esta funcion
	    
	    });
	});
