
$(document).ready(function() {
	//Validacion con BootstrapValidator
	fl = $('#form-login');
    fl.bootstrapValidator({ 
        message: 'El valor no es valido.',
        //fields: name de los inputs del formulario, la regla que debe cumplir y el mensaje que mostrara si no cumple la regla
        fields: {
                usuarios: {
                        validators: {
                                notEmpty: {
                                        message: 'Este campo es requerido.'
                                }
                        }
                },
                clave: {
                        validators: {
                                notEmpty: {
                                        message: 'Este campo es requerido.'
                                }
                        }
                }
                
        }
        //Cuando el formulario se lleno correctamente y se envia, se ejecuta esta funcion
    
    });
});

function nota(op,msg,time){
    if(time == undefined)time = 5000;
    var n = noty({text:msg,maxVisible: 1,type:op,killer:true,timeout:time,layout: 'top'});
}
