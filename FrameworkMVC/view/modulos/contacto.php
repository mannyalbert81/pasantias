<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Contacto - Vademano 2015</title>
   	
 		       <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		  <link rel="stylesheet" href="/resources/demos/style.css">
		
		<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
 
    
    
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

            	  if (id_pais = 66)
                   {
            		    $provincias.append("<option value= " +"0" +" > --SIN ESPECIFICAR--</option>");
            	           
                   }
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
	
			
    </head>
    <body>
    
   		 <form action="<?php echo $helper->url("Mensajes","Inserta"); ?>" method="post" class="col-lg-6">
            <h4 >Enviar Mensaje</h4>
            <hr/>
           
		    
            <div class="row">
            	<div class="col-xs-6 col-md-6">
            	  <p class="formulario-subtitulo">Nombres</p>
            	</div>
            	<div class="col-xs-6 col-md-6">
            	  <p class="formulario-subtitulo">Apellidos</p>
            	</div>
            </div>	
		    <div class="row">
            	<div class="col-xs-6 col-md-6">
            	  <input type="text" name="nombres_mensajes"  class="form-control"/>
            	</div>
            	<div class="col-xs-6 col-md-6">
            	  <input type="text" name="apellidos_mensajes"  class="form-control"/>
            	</div>
            </div>	
		    
		    <div class="row">
            	<div class="col-xs-6 col-md-6">
            	  <p class="formulario-subtitulo">Pais</p>
            	</div>
            	<div class="col-xs-6 col-md-6">
            	  <p class="formulario-subtitulo">Provincia</p>
            	</div>
            </div>		
	  		<div class="row">
            	<div class="col-xs-6 col-md-6">
            	  	<select name="paises" id="paises"  class="form-control" style="	width: 200px;">
						<?php foreach($resultPais as $resPais) {?>
							<option value="<?php echo $resPais->id_pais; ?>"  ><?php echo $resPais->nombre_pais; ?> </option>
			            <?php } ?>
					</select>
            	</div>
            	<div class="col-xs-6 col-md-6">
            	  	<select name="provincias" id="provincias"  class="form-control" style="	width: 200px;">
						
							<option value="0"  > -- SIN ESPECIFICAR -- </option>
			            
					</select>
            	</div>
            </div>		
	  		
	  		 <div class="row">
            	<div class="col-xs-6 col-md-6">
            	  <p class="formulario-subtitulo">Telefono</p>
            	</div>
            	<div class="col-xs-6 col-md-6">
            	  <p class="formulario-subtitulo">Celular</p>
            	</div>
            </div>    		
        	<div class="row">
            	<div class="col-xs-6 col-md-6">
            	  <input type="text" name="telefono_mensajes"  class="form-control"   />
            	</div>
            	<div class="col-xs-6 col-md-6">
            	  <input type="text" name="celular_mensajes"  class="form-control"   />
            	</div>
            </div>    		
        	 <div class="row">
            	<div class="col-xs-12 col-md-12">
            	  <p class="formulario-subtitulo">Email</p>
            	</div>
            	
            </div>
	  		 <div class="row">
            	<div class="col-xs-12 col-md-12">
            	  <input type="email" name="email_mensajes"  class="form-control"   />
            	</div>
            	
            </div>
	  		 <div class="row">
            	<div class="col-xs-12 col-md-12">
            	  <p class="formulario-subtitulo">Mensaje</p>
            	</div>
            	
            </div>
             <div class="row">
            	<div class="col-xs-12 col-md-12">
            	  <textarea rows="4" name="mensaje_mensajes" class="form-control" ></textarea>
            	</div>
            	
            </div>
	   		<div class="row">
            	<div class="col-xs-12 col-md-12" style="text-align: center;">
            	  <input type="submit" value="Enviar" class="btn btn-success"/>
            	</div>
            	
            </div>
		
       </form>
           
  
    
       
     
     </body>  
    </html>   