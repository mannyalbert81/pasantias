<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Contabilidad - 2016</title>
   
        
         <style>
			body {
			
			    /* Ubicación de la imagen */
		 
		  background-image: url(view/images/);
		
		  /* Nos aseguramos que la imagen de fondo este centrada vertical y
		    horizontalmente en todo momento */
		  background-position: center center;
		
		  /* La imagen de fondo no se repite */
		  background-repeat: no-repeat;
		
		  /* La imagen de fondo está fija en el viewport, de modo que no se mueva cuando
		     la altura del contenido supere la altura de la imagen. */
		  background-attachment: fixed;
		
		  /* La imagen de fondo se reescala cuando se cambia el ancho de ventana
		     del navegador */
		  background-size: cover;
		
		  /* Fijamos un color de fondo para que se muestre mientras se está
		    cargando la imagen de fondo o si hay problemas para cargarla  */
		  background-color: #464646;
			}
			</style>
        
       
        </head>
    <body>
     
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu_nuevo.php"); ?>
       <?php include("view/modulos/slide.php"); ?>
   		 
   		 
   		 <div class="col-lg-12 col-md-6" style="padding-top:30px;"> 
		 <?php include("view/modulos/Contactos.php"); ?>
		 </div>     
       <footer class="col-lg-12">
           <?php include("view/modulos/footer.php"); ?>
        </footer>
    </body>
</html>