
$(document).ready(function() {
	 
	//Validacion con BootstrapValidator
	fl = $('#form-RecuperarCuenta');
    fl.bootstrapValidator({ 
        message: 'El valor no es valido.',
        //fields: name de los inputs del formulario, la regla que debe cumplir y el mensaje que mostrara si no cumple la regla
        fields: {
        	
        	reestablecer_usuario: {
                validators: {
                	notEmpty: {
                        message: 'Este campo es requerido.'
                },
                emailAddress:{
                    message: 'El correo no es valido.'
                  }
                    
                }
            }
                
        }

       
    });
});

