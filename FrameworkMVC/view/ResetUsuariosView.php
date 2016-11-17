 <?php include("view/modulos/head.php"); ?>
 
 
<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Recuperar Cuenta - Pasantias 2016</title>
        <link rel="stylesheet" href="view/css/bootstrap.css">
    
		  <script src="view/js/jquery.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		  <script src="view/js/noty.js"></script>
		  <script src="view/js/ValidarRecuperarCuenta.js"></script>
   		 
		
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
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
      
       
  
    <div class="container" style="margin-top: 20px">
    <div class="row" style="background-color: #FAFAFA;">
    
    
      <form id="form-RecuperarCuenta" action="<?php echo $helper->url("Usuarios","Reset"); ?>" method="post" class="col-lg-12">
           <div class="col-lg-6">
            <h4>Recuperar Cuenta</h4>
            <hr/>
           <?php if (isset($resultSet)) {?>
			<?php if ($resultSet != "") {?>
		
				 <?php if ($error == TRUE) {?>
				 	<div class="alert alert-danger" role="alert"><?php echo $resultSet; ?></div>
				 <?php } else {?>			
				    <div class="alert alert-success" role="alert"><?php echo $resultSet; ?></div>
					<div class="alert alert-success" role="alert"><strong>Te redirecionaremos a la pagina de Login</strong></div>	
	  			 <?php sleep(5); ?>
     
     			 <?php }?>
			
	        <?php } ?>
	        <?php } ?>
            
             
             <div class="well">
             <div class="row" style="padding-top: 20px">
             <div class="col-lg-6 col-md-3" >
                     
                              <div class="form-group">
                                  <label for="reestablecer_usuario" class="control-label">Correo Electrónico</label>
                                  <input type="text" class="form-control" id="reestablecer_usuario" name="reestablecer_usuario" value=""  placeholder="Correo">
                                  <span class="help-block"></span>
                              </div>
                              <button type="submit" class="btn btn-success btn-block" >Recuperar Cuenta</button>
                       </div>
                     
                  
                		  <div class="col-lg-6 col-md-3">
		                      <p class="lead">Recuperar Cuenta<span class="text-success"></span></p>
		                      <ul class="list-unstyled" style="line-height: 2">
		                          <li><span class="fa fa-check text-success"></span> Introduzca el correo electrónico del usuario registrado en el sistema.</li>
		                         
		                      </ul>
		                  </div>
		                  </div>
		                  
                          
              </div>
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
      
      	
       <footer class="col-lg-12">
     	 	<?php include("view/modulos/footer.php"); ?>
    	 </footer> 
   
     </body>  
    </html>   