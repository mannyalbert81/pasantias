<?php include("view/modulos/modal.php"); ?>
<?php include("view/modulos/head.php"); ?>
      
<!DOCTYPE HTML>
<html lang="es">
     <head>
         <meta charset="utf-8"/>
        <title>RecalcularMayor - Contabilidad 2016</title>
        
          <link rel="stylesheet" href="view/css/bootstrap.css">
          <script src="view/js/jquery.js"></script>
		  
		    
     </head>
      <body class="cuerpo">
    
       <?php include("view/modulos/menu.php"); ?>
  
    	<div class="container">
        <div class="row" style="background-color: #FAFAFA;">
  
  
            <form action="<?php echo $helper->url("RecalcularMayor","ActualizarRecalcularMayor"); ?>" method="post" class="col-lg-6">
    	     
		    <div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;" > 
            <div class="form-group">
            					  <input type="submit" id="Guardar" name="Guardar" value="ACTUALIZAR" class="btn btn-success">
            </div>
            </div>
            </div>
            </form>
            
            
        
        
        </div>
        </div>
  
       
       <?php include("view/modulos/footer.php"); ?>
        
     </body>  
    </html>          