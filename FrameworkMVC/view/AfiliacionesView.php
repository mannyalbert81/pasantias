
<?php include("view/modulos/head.php"); ?>
   
<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Afiliaciones - Pasantias 2016</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
          <link rel="stylesheet" href="view/css/bootstrap.css">
          <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>  
          <script src="view/js/jquery.js"></script>
		  
	      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
          
         
   		  
 		<script >
		$(document).ready(function(){

		    // cada vez que se cambia el valor del combo
		    $("#paises").change(function() {
				
               // 
                var $provincias = $("#provincias");

               // lo vaciamos
               
				///obtengo el id seleccionado
				

               var id_pais = $(this).val();


               $provincias.empty();

               
               if(id_pais > 0)
               {
            	   
            	   var datos = {
            			   id_pais : $(this).val()
                   };

                  $provincias.append("<option value= " +"0" +" > --SIN ESPECIFICAR--</option>");
            	           
                   
                  
            	   $.post("<?php echo $helper->url("Provincias","devuelveProvincias"); ?>", datos, function(resultProv) {

            		 		$.each(resultProv, function(index, value) {
            		 		$provincias.append("<option value= " +value.id_provincia +" >" + value.nombre_provincia  + "</option>");	
                       		 });

            		 		 	 		   
            		  }, 'json');


               }
               else
               {
            	  
               }
               
		    });


		   
		   
		    
		}); 

	</script>

	
 		<script >
		$(document).ready(function(){

		    // cada vez que se cambia el valor del combo
		    $("#rol").click(function() {
				
               

               var id_rol = $(this).val();

				
               //para estudiante
               if(id_rol == 3)
               {
            	   $("#div_estudiantes").fadeIn("slow");
               }
            	
               else
               {
            	   $("#div_estudiantes").fadeOut("slow");
               }
                //
               
               //para docente
                if(id_rol == 2)
               {
            	   $("#div_docente").fadeIn("slow");
               }
            	
               else
               {
            	   $("#div_docente").fadeOut("slow");
               }
                //
               
		    });

		    $("#rol").change(function() {
				
	               

	               var id_rol = $(this).val();

					
	               
	               if(id_rol == 3)
	               {
	            	   $("#div_estudiantes").fadeIn("slow");
	               }
	            	
	               else
	               {
	            	   $("#div_estudiantes").fadeOut("slow");
	               }
	               
	               if(id_rol == 2)
	               {
	            	   $("#div_docente").fadeIn("slow");
	               }
	            	
	               else
	               {
	            	   $("#div_docente").fadeOut("slow");
	               }
	               
			    });
				
		   
		   
		    
		}); 

	</script>
	
	  <script>
    var imagenes=new Array(

        'view/images/publicidad/1.jpg',
        'view/images/publicidad/2.jpg',
        'view/images/publicidad/3.jpg',
        'view/images/publicidad/4.jpg',
        'view/images/publicidad/5.jpg',
        'view/images/publicidad/6.jpg',
        'view/images/publicidad/7.jpg',
        'view/images/publicidad/8.jpg'

    );

    function rotarImagenes()
    {
        var index=Math.floor((Math.random()*imagenes.length));
        document.getElementById("imagen").src=imagenes[index];
    }

    onload=function()
    {
        rotarImagenes();
        setInterval(rotarImagenes,3000);
    }
    </script>
    
     <script type="text/javascript">
		jQuery(function($){
			$.datepicker.regional['es'] = {
				closeText: 'Cerrar',
				prevText: '&#x3c;Ant',
				nextText: 'Sig&#x3e;',
				currentText: 'Hoy',
				monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
				'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
				monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
				'Jul','Ago','Sep','Oct','Nov','Dic'],
				dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
				dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
				dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
				weekHeader: 'Sm',
				dateFormat: 'dd-mm-yy',
				firstDay: 1,
				isRTL: false,
				showMonthAfterYear: false,
				yearSuffix: ''};
			$.datepicker.setDefaults($.datepicker.regional['es']);
		});    
		 
		$(document).ready(function() {
		   $("#fecha_nacimiento_estudiantes").datepicker();
		 });
		</script>
    </head>
    <body class="cuerpo">
    	 
      <div class="container" style="margin-top: 20px">
      <div class="row" style="background-color: #FAFAFA;">
      <form id="form-Afiliaciones" action="<?php echo $helper->url("Afiliaciones","InsertaAfiliados"); ?>" method="post" class="col-lg-12">
            
            <div class="col-lg-6">
            <h4>Datos para Afiliación</h4>
            <hr/>
           <?php if (isset($resultado)) {?>
        	<?php if ($resultado == "true") {?>
        	
	        	<div class="alert alert-success" role="alert">
				  <div class="alert alert-success" role="alert">Tu afiliacion se realizo <strong> correctamente </strong>, Enviamos a tu emil la informacion necesaria para el acceso al sistema</div>
				</div>
			<?php }else {?>
				<div class="alert alert-success" role="alert">
				  <div class="alert alert-danger" role="alert">Ocurrio un error al realizar su afiliacion</div>
				</div>
			<?php } ?>
	        
           <?php } else { ?>
		     
            <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
           
             <?php } } else {?>
            
            <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group ">
		                          <label for="correo_usuarios" class="control-label">Email</label>
                                  <input type="text" class="form-control" id="correo_usuarios" name="correo_usuarios" value=""  placeholder="Email">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="ccorreo_usuarios" class="control-label">Confirme Email</label>
                                  <input type="text" class="form-control" id="ccorreo_usuarios" name="ccorreo_usuarios" value=""  placeholder="Confirme Email">
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
             
            <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group ">
		                          <label for="id_rol" class="control-label">Rol</label>
                                  <select name="rol" id="rol"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultRol as $res) {?>
										<option value="<?php echo $res->id_rol; ?>"  ><?php echo $res->nombre_rol; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="id_estado" class="control-label">Estado</label>
                                  <select name="id_estado" id="id_estado"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultEst as $res) {?>
										<option value="<?php echo $res->id_estado; ?>"  ><?php echo $res->nombre_estado; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
             
            <div class="row">
		    <div class="col-xs-6 col-md-12">
		    <div class="form-group">
                                  <label for="imagen_usuarios" class="control-label">Fotografía</label>
                                  <input type="file" class="form-control" id="imagen_usuarios" name="imagen_usuarios" value="">
                                  <span class="help-block"></span>
            </div>
		    </div>
			</div>
			
			
			<div  id="div_estudiantes" style="display: none;">
            <h4>Datos Personales Estudiante</h4>
            <hr/>
				   
			<div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group ">
		                          <label for="cedula_estudiantes" class="control-label">Cedula</label>
                                  <input type="text" class="form-control" id="cedula_estudiantes" name="cedula_estudiantes" value=""  placeholder="Cedula">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    <div class="col-xs-6 col-md-6">
		                          <label for="cedula_estudiantes" class="control-label">Fecha Nacimiento</label><br>
		                          <div class="input-group date" id="datetimePicker">
		                          <input type="text" class="form-control" id="fecha_nacimiento_estudiantes" name="fecha_nacimiento_estudiantes" data-date-format="DD-MM-YYYY" value="" placeholder="Fecha Nacimiento">
                                  <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                                  </span>
                                  </div>
            
		    </div>
		    </div>
			
			<div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group ">
		                          <label for="nombre_estudiantes" class="control-label">Nombres</label>
                                  <input type="text" class="form-control" id="nombre_estudiantes" name="nombre_estudiantes" value=""  placeholder="Nombres">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="apellido_estudiantes" class="control-label">Apellidos</label>
                                  <input type="text" class="form-control" id="apellido_estudiantes" name="apellido_estudiantes" value=""  placeholder="Apellidos">
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
			
			<div class="row">
		    <div class="col-xs-4 col-md-4">
		    <div class="form-group ">
		                           <label for="id_paises" class="control-label">Pais</label>
                                  <select name="id_paises" id="id_paises"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultPais as $res) {?>
										<option value="<?php echo $res->id_paises; ?>"  ><?php echo $res->nombre_paises; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-4 col-md-4">
		    <div class="form-group">
                                   <label for="id_provincias" class="control-label">Provincia</label>
                                  <select name="id_provincias" id="id_provincias"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultProv as $res) {?>
										<option value="<?php echo $res->id_provincias; ?>"  ><?php echo $res->nombre_provincias; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
            <div class="col-xs-4 col-md-4">
		    <div class="form-group">
                                   <label for="id_cantones" class="control-label">Cantón</label>
                                  <select name="id_cantones" id="id_cantones"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultCan as $res) {?>
										<option value="<?php echo $res->id_cantones; ?>"  ><?php echo $res->nombre_cantones; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
			
			<div class="row">
		    <div class="col-xs-6 col-md-12">
		    <div class="form-group ">
		                          <label for="domicilio_estudiantes" class="control-label">Dirección Domicilio</label>
                                  <input type="text" class="form-control" id="domicilio_estudiantes" name="domicilio_estudiantes" value=""  placeholder="Domicilio">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    </div>	

            <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group ">
		                          <label for="telefono_estudiantes" class="control-label">Teléfono</label>
                                  <input type="text" class="form-control" id="telefono_estudiantes" name="telefono_estudiantes" value=""  placeholder="Teléfono">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group ">
		                          <label for="celular_estudiantes" class="control-label">Celular</label>
                                  <input type="text" class="form-control" id="celular_estudiantes" name="celular_estudiantes" value=""  placeholder="Celular">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    </div>  
			
			<h4>Formación Academica Estudiante</h4>
            <hr/>
			
			<div class="row">
		    <div class="col-xs-4 col-md-4">
		    <div class="form-group ">
		                           <label for="id_carrera" class="control-label">Carrera</label>
                                  <select name="id_carrera" id="id_carrera"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultCar as $res) {?>
										<option value="<?php echo $res->id_carrera; ?>"  ><?php echo $res->nombre_carrera; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-4 col-md-4">
		    <div class="form-group">
                                   <label for="id_semestre" class="control-label">Semestre</label>
                                  <select name="id_semestre" id="id_semestre"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultSem as $res) {?>
										<option value="<?php echo $res->id_semestre; ?>"  ><?php echo $res->nombre_semestre; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
            <div class="col-xs-4 col-md-4">
		    <div class="form-group">
                                   <label for="id_jornada" class="control-label">Jornada</label>
                                  <select name="id_jornada" id="id_jornada"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultJor as $res) {?>
										<option value="<?php echo $res->id_jornada; ?>"  ><?php echo $res->nombre_jornada; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
			</div>
			
			
			
			
			<div  id="div_docente" style="display: none;">
			<h4>Datos Personales Docente</h4>
            <hr/>
				   
			<div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group ">
		                          <label for="cedula_docente" class="control-label">Cedula</label>
                                  <input type="text" class="form-control" id="cedula_docente" name="cedula_docente" value=""  placeholder="Cedula">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    <div class="col-xs-6 col-md-6">
		                          <label for="fecha_nacimiento_docente" class="control-label">Fecha Nacimiento</label><br>
		                          <div class="input-group date" id="datetimePicker">
		                          <input type="text" class="form-control" id="fecha_nacimiento_docente" name="fecha_nacimiento_docente" data-date-format="DD-MM-YYYY" value="" placeholder="Fecha Nacimiento">
                                  <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                                  </span>
                                  </div>
            
		    </div>
		    </div>
			
			<div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group ">
		                          <label for="nombre_docente" class="control-label">Nombres</label>
                                  <input type="text" class="form-control" id="nombre_docente" name="nombre_docente" value=""  placeholder="Nombres">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="apellido_docente" class="control-label">Apellidos</label>
                                  <input type="text" class="form-control" id="apellido_docente" name="apellido_docente" value=""  placeholder="Apellidos">
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
			
			<div class="row">
		    <div class="col-xs-4 col-md-4">
		    <div class="form-group ">
		                           <label for="id_paises" class="control-label">Pais</label>
                                  <select name="id_paises" id="id_paises"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultPais as $res) {?>
										<option value="<?php echo $res->id_paises; ?>"  ><?php echo $res->nombre_paises; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-4 col-md-4">
		    <div class="form-group">
                                   <label for="id_provincias" class="control-label">Provincia</label>
                                  <select name="id_provincias" id="id_provincias"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultProv as $res) {?>
										<option value="<?php echo $res->id_provincias; ?>"  ><?php echo $res->nombre_provincias; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
            <div class="col-xs-4 col-md-4">
		    <div class="form-group">
                                   <label for="id_cantones" class="control-label">Cantón</label>
                                  <select name="id_cantones" id="id_cantones"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultCan as $res) {?>
										<option value="<?php echo $res->id_cantones; ?>"  ><?php echo $res->nombre_cantones; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
			
			<div class="row">
		    <div class="col-xs-6 col-md-12">
		    <div class="form-group ">
		                          <label for="domicilio_docente" class="control-label">Dirección Domicilio</label>
                                  <input type="text" class="form-control" id="domicilio_docente" name="domicilio_docente" value=""  placeholder="Domicilio">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    </div>	

            <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group ">
		                          <label for="telefono_docente" class="control-label">Teléfono</label>
                                  <input type="text" class="form-control" id="telefono_docente" name="telefono_docente" value=""  placeholder="Teléfono">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group ">
		                          <label for="celular_docente" class="control-label">Celular</label>
                                  <input type="text" class="form-control" id="celular_docente" name="celular_docente" value=""  placeholder="Celular">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    </div> 
		    <h4>Formación Academica Docente</h4>
            <hr/>
			
			<div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group ">
		                           <label for="id_carrera" class="control-label">Carrera</label>
                                  <select name="id_carrera" id="id_carrera"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultCar as $res) {?>
										<option value="<?php echo $res->id_carrera; ?>"  ><?php echo $res->nombre_carrera; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
		    </div>
		    </div>
			</div>
			
			
          
		
		 <hr>
		   <div class="row">
			  <div class="col-xs-12 col-md-12" style="text-align: center;" >
			  	<input type="submit" id="btn_guardar" name="btn_guardar" value="Guardar" class="btn btn-success"/>
			  </div>
			</div>     
           
		<?php }?>    
	               	
		     <?php } ?>
		  
          </div>
          
          
          <div class="col-lg-6">
            <h4>Informate</h4>
            <hr/>
           <img src="" id="imagen" width="540" height="420">
            </div>
            	
          </form>
           </br>
       </br>
       </br>
       </br>
       </div>
       </div>
       

   	 	<div>
   	 	 
    	 <footer class="col-lg-12" >
     	 	<?php include("view/modulos/footer.php"); ?>
    	 </footer>     
    	</div>
     </body>  
    </html>   