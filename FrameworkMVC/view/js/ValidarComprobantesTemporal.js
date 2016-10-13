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
	        	id_tipo_comprobantes: {
	        		message: 'El nombre no es valido',
	                        validators: {
	                                notEmpty: {
	                                        message: 'El tipo es requerido.'
	                                }
	                             
	                        }
	                },
	                nombres_ccomprobantes: {
		        		message: 'El nombre no es valido',
		                        validators: {
		                                notEmpty: {
		                                        message: 'La descripción es requerida.'
		                                }
		                             
		                        }
		                },
		                ruc_ccomprobantes: {
			        		message: 'El nombre no es valido',
			                        validators: {
			                                notEmpty: {
			                                        message: 'El ruc es requerido.'
			                                },
			                                regexp: {
			                                	 
				               					 regexp: /^[0-9]+$/,
				                
				               					 message: 'Ingrese números'
				                
				               				 },
				            				 stringLength: {
				            					 
				            					 min: 13,
				            					 max: 13,
				             
				            					
				            				 }
			                             
			                        }
			                },
			                retencion_ccomprobantes: {
				        		message: 'El nombre no es valido',
				                        validators: {
				                                notEmpty: {
				                                        message: 'El campo es requerido.'
				                                }
				                             
				                        }
				                },
				                concepto_ccomprobantes: {
			        		message: 'El nombre no es valido',
			                        validators: {
			                                notEmpty: {
			                                        message: 'El campo es requerido.'
			                                }
			                             
			                        }
			                }   
	        }
	    });
	});
