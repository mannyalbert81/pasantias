 <?php include("view/modulos/head.php"); ?>
  
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Login Pasantias</title>
	<link rel="stylesheet" href="view/css/bootstrap.css">
    
  <script src="view/js/jquery.js"></script>
  <script src="view/js/bootstrapValidator.min.js"></script>
  <script src="view/js/noty.js"></script>
  <script src="view/js/ValidarLogin.js"></script>
	
	<script>
   function verificar(){
	   usuario = $('#usuarios').val();
       pass = $('#clave').val();

       //Comparamos si el usuario y la contraseña son correctos
       if(usuario == "" || pass == ""){
       	 nota("error","Los Datos Son Incorrectos.");
       }

        else{
          
        	
       }
       function nota(op,msg,time){
   	    if(time == undefined)time = 1000;
   	    var n = noty({text:msg,maxVisible: 1,type:op,killer:true,timeout:time,layout: 'inline'});
   	  }
        }
   	
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

</head >

<body class="cuerpo">

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
   <div class="container" style="margin-top: 20px">
    <div class="row" style="background-color: #FAFAFA;">
  		
   <form id="form-login"  action="<?php echo $helper->url("Usuarios","Loguear"); ?>" method="post" enctype="multipart/form-data" class="col-lg-12" >
  
   <div class="col-lg-6">
   <h4>Login</h4>
            <hr/>
           <?php if (isset($resultado)) {?>
        	<?php if ($resultado == "true") {?>
        	
	        	
				  <div class="alert alert-success" role="alert">Ok<strong> correctamente </strong>, Enviamos a tu emil la informacion necesaria para el acceso al sistema</div>
				
			<?php }if ($resultado == "false") {?>
				
				  <div class="alert alert-danger" role="alert">Su cuenta o clave son incorrectos</div>
				
				<?php } ?>
	        <?php } ?>
	        
     
                 
        <div class="row" style="padding-top: 30px">
    
               <div class="col-lg-6 col-md-3" >
                      <div class="well">
                              <div class="form-group">
                                  <label for="usuarios" class="control-label">Usuario</label>
                                  <input type="text" class="form-control" id="usuarios" name="usuarios" value=""  placeholder="Usuario">
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="clave" class="control-label">Password</label>
                                  <input type="password" class="form-control" id="clave" name="clave" value="" placeholder="Password">
                                  <span class="help-block"></span>
                              </div>
                             
                              
                              <button type="submit" class="btn btn-success btn-block" onclick="verificar()" >Login</button>
                               
                      </div>
                       
                             
                  </div>
                  
                		  <div class="col-lg-6 col-md-3">
		                      <p class="lead">Consejos de Seguridad <span class="text-success"></span></p>
		                      <ul class="list-unstyled" style="line-height: 2">
		                          <li><span class="fa fa-check text-success"></span> Recuerda tu usuario y tu clave.</li>
		                          <li><span class="fa fa-check text-success"></span> No enseñes a nadie tu clave.</li>
		                          <li><span class="fa fa-check text-success"></span> La clave es personal.</li>
		                          <li><span class="fa fa-check text-success"></span> Cuidala.</li>
		                          <p><a href="<?php echo $helper->url("Usuarios","Reset"); ?>" >Olvidaste tu Cuenta</a> </p>
		                      </ul>
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