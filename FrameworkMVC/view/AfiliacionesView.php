
<?php include("view/modulos/head.php"); ?>
   
<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Afiliaciones - Pasantias 2016</title>
   
   		  
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
		    $("#ocupaciones").click(function() {
				
               

               var id_ocupaciones = $(this).val();

				
               
               if(id_ocupaciones > 5)
               {
            	   $("#div_extra_ocupaciones_usuario").fadeIn("slow");
               }
            	
               else
               {
            	   $("#div_extra_ocupaciones_usuario").fadeOut("slow");
               }
               
		    });

		    $("#ocupaciones").change(function() {
				
	               

	               var id_ocupaciones = $(this).val();

					
	               
	               if(id_ocupaciones > 5)
	               {
	            	   $("#div_extra_ocupaciones_usuario").fadeIn("slow");
	               }
	            	
	               else
	               {
	            	   $("#div_extra_ocupaciones_usuario").fadeOut("slow");
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
 
    </head>
    <body class="cuerpo">
    	 
      <div class="container" style="margin-top: 20px">
      <div class="row" style="background-color: #FAFAFA;">
      <form id="form-Afiliaciones" action="<?php echo $helper->url("Afiliaciones","InsertaAfiliados"); ?>" method="post" class="col-lg-12">
            
            <div class="col-lg-6">
            <h4>Afiliación</h4>
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
           
           <div class="row">
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Email </p>
			  	<input type="email" name="correo_usuario" id="correo_usuario" value="<?php echo $resEdit->correo_usuario; ?>" class="form-control"/>
			  </div>
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Confirme Email </p>
			  	<input type="email" name="ccorreo_usuario" id="ccorreo_usuario" value="<?php echo $resEdit->correo_usuario; ?>" class="form-control"/>
			  </div>
			</div>
			
			<div class="row">
			  <div class="col-xs-6 col-md-4">
			  	<p  class="formulario-subtitulo" >Nombres</p>
			  	<input type="text" name="nombres_usuario" value="<?php echo $resEdit->nombres_usuario; ?>" class="form-control"/> 
			  </div>
			  <div class="col-xs-6 col-md-4">
			  	<p   class="formulario-subtitulo" >Apellidos </p>
			  	<input type="text" name="apellidos_usuario" value="<?php echo $resEdit->apellidos_usuario; ?>" class="form-control"/>
			  </div>
			   <div class="col-xs-12 col-md-4">
			  	<p  class="formulario-subtitulo" >Ocupacion</p>
			  	<select name="paises" id="paises"  class="form-control">
					<?php foreach($resultOcu as $resOcu) {?>
						<option value="<?php echo $resOcu->id_ocupaciones; ?>"  ><?php echo $resOcu->nombre_ocupaciones; ?> </option>
			        <?php } ?>
				</select> 
			  </div>
			</div>
			<div class="row">
			  <div class="col-xs-12 col-md-12" id="div_extra_ocupaciones_usuario" style="display: none;" >
			  	<p  class="formulario-subtitulo" >Especifique su Ocupacion</p>
			  	<input type="text" name="extra_ocupaciones_usuario" id="extra_ocupaciones_usuario"  value="<?php echo $resEdit->extra_ocupaciones_usuario; ?>" class="form-control"  /> 
			  </div>
			  
			</div>
			
			
			
			
           <div class="row">
			  <div class="col-xs-6 col-md-3">
			  	<p class="formulario-subtitulo" >Clave Usuario </p>
			  	<input type="password" name="clave_usuario" value="" class="form-control"/>
			 	</div>
			  <div class="col-xs-6 col-md-3">
			  	<p  class="formulario-subtitulo" >Confirme Clave </p>
			  	<input type="password" name="cclave_usuario" value="" class="form-control"/>
			  	
			  </div>
			  <div class="col-xs-6 col-md-3">
			  	<p  class="formulario-subtitulo" >Pais</p>
			  	<select name="paises" id="paises"  class="form-control" style="	width: 200px;">
					<?php foreach($resultPais as $resPais) {?>
						<option value="<?php echo $resPais->id_paises; ?>"  ><?php echo $resPais->nombre_paises; ?> </option>
			        <?php } ?>
				</select> 
			  </div>
			  <div class="col-xs-6 col-md-3">
			  	<p   class="formulario-subtitulo" >Provincia </p>
				<select name="id_provincias" id="id_provincias"  class="form-control" style="	width: 200px;">
					<option value="0"  > -- SIN ESPECIFICAR -- </option>
				</select>
		   	  </div>
			</div>
           
           <div class="row">
			  <div class="col-xs-4 col-md-4">
			  	<p class="formulario-subtitulo" >Fecha Nacimiento  </p>
			  	<input type="date" name="fecha_nacimiento_usuario" id="fecha_nacimiento_usuario" value="<?php $resEdit->fecha_nacimiento_usuario; ?>" class="form-control"/>
			  </div>
			  <div class="col-xs-4 col-md-4">
			  	<p  class="formulario-subtitulo" >Teléfono Usuario </p>
			  	<input type="text" name="telefono_usuario" value="<?php echo $resEdit->telefono_usuario; ?>" class="form-control"/>
			  </div>
			  <div class="col-xs-4 col-md-4">
			  	<p  class="formulario-subtitulo" >Celular  Usuario</p>
			  	<input type="text" name="celular_usuario" value="<?php echo $resEdit->celular_usuario; ?>" class="form-control"/> 
			  </div>
			</div>
           
            <hr>
		   <div class="row">
			  <div class="col-xs-12 col-md-12" style="text-align: center;" >
			  	<input type="submit" id="btn_guardar" name="btn_guardar" value="Guardar" class="btn btn-success"/>
			  </div>
			</div>     
           
             <?php } } else {?>
				   <div class="row">
					  <div class="col-xs-6 col-md-6">
					  	<p  class="formulario-subtitulo" >Email </p>
					  	<input type="email" name="correo_usuario" id="correo_usuario" value="" class="form-control"/>
					  	<div id="mensaje_correo" class="errores"></div>
					  </div>
					  <div class="col-xs-6 col-md-6">
					  	<p  class="formulario-subtitulo" >Confirme Email </p>
					  	<input type="email" name="ccorreo_usuario" id="ccorreo_usuario" value="" class="form-control"/>
					  	<div id="mensaje_ccorreo" class="errores"></div>
					  	
					  </div>
					</div>
			
				   <div class="row">
					  <div class="col-xs-6 col-md-4">
					  	<p  class="formulario-subtitulo" >Nombres</p>
					  	<input type="text" name="nombres_usuario" value="" class="form-control"/>
					  	<div id="mensaje_nombres" class="errores"></div> 
					  </div>
					  <div class="col-xs-6 col-md-4">
					  	<p   class="formulario-subtitulo" >Apellidos </p>
					  	<input type="text" name="apellidos_usuario" value="" class="form-control"/>
					  	<div id="mensaje_apellidos" class="errores"></div>
					  </div>
		    		  
							  
				</div>
			
			<div class="row"  id="div_extra_ocupaciones_usuario" style="display: none;">
			  <div class="col-xs-12 col-md-12">
			  	<p  class="formulario-subtitulo" >Especifique su Ocupacion</p>
			  	<input type="text" name="extra_ocupaciones_usuario" id="extra_ocupaciones_usuario"  value="" class="form-control"  /> 
			  </div>
			  
			</div>
			
           <div class="row">
			  <div class="col-xs-6 col-md-3">
			  	<p class="formulario-subtitulo" >Clave Usuario </p>
			  	<input type="password" name="clave_usuario" id="clave_usuario" value="" class="form-control"/>
			  	<div id="mensaje_clave" class="errores"></div>
			  </div>
			  <div class="col-xs-6 col-md-3">
			  	<p  class="formulario-subtitulo" >Confirme Clave </p>
			  	<input type="password" name="cclave_usuario" id="cclave_usuario" value="" class="form-control"/>
			  	<div id="mensaje_cclave" class="errores"></div>
			  </div>
			  <div class="col-xs-6 col-md-3">
			  	<p  class="formulario-subtitulo" >Pais</p>
			  	<select name="id_paises" id="id_paises"  class="form-control" >
					<?php foreach($resultPais as $resPais) {?>
						<option value="<?php echo $resPais->id_paises; ?>"  ><?php echo $resPais->nombre_paises; ?> </option>
			        <?php } ?>
				</select> 
				<div id="mensaje_paises" class="errores"></div>
			  </div>
			  <div class="col-xs-6 col-md-3">
			  	<p   class="formulario-subtitulo" >Provincia </p>
				<select name="provincias" id="provincias"  class="form-control" >
					<option value="0"  > -- SIN ESPECIFICAR -- </option>
				</select>
				<div id="mensaje_provincias" class="errores"></div>
		   	  </div>
			</div>
            <div class="row">
			  <div class="col-xs-4 col-md-4">
			  	<p class="formulario-subtitulo" >Fecha Nacimiento  </p>
			  	<input type="date" name="fecha_nacimiento_usuario" id="fecha_nacimiento_usuario" value="" class="form-control"/>
			  	<div id="mensaje_fecha_nacimiento" class="errores"></div>
			  </div>
			  <div class="col-xs-4 col-md-4">
			  	<p  class="formulario-subtitulo" >Teléfono Usuario </p>
			  	<input type="text" name="telefono_usuario" value="" class="form-control"/>
			  	<div id="mensaje_telefono" class="errores"></div>
			  </div>
			  <div class="col-xs-4 col-md-4">
			  	<p  class="formulario-subtitulo" >Celular  Usuario</p>
			  	<input type="text" name="celular_usuario" value="" class="form-control"/>
			  	<div id="mensaje_celular" class="errores"></div> 
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