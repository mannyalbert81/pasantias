$(document).ready(function() {
		//Validacion con BootstrapValidator
		fl = $('#form-centro-costos');
	    fl.bootstrapValidator({ 
	        message: 'El valor no es valido.',
	        //fields: name de los inputs del formulario, la regla que debe cumplir y el mensaje que mostrara si no cumple la regla
	        feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
	        fields: {
	        	id_entidad: {
	                        validators: {
	                                notEmpty: {
	                                        message: 'Este campo es requerido.'
	                                }
	                        }
	                },
	                

	                nombre_centro_costos: {
	                    validators: {
	                    	notEmpty: {
	                            message: 'Este campo es requerido.'
	                    }
	                        
	                    }
	                },
	                
	                codigo_centro_costos: {
	                        validators: {
	                                notEmpty: {
	                                        message: 'Este campo es requerido.'
	                                }
	                        }
	                },
	                nivel_centro_costos: {
                        validators: {
                                notEmpty: {
                                        message: 'Este campo es requerido.'
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
