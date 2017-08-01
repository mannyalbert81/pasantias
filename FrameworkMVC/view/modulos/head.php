<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once 'config/global.php';?> 

  <title>Pasantias</title>
  <link rel="shortcut icon" href="favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script type="text/javascript">

        // <![CDATA[

        var colour="#64FE2E";

        var sparkles=25;


        /****************************

        * Tinkerbell Magic Sparkle *

        * http://www.mf2fm.com/rv *

        * NO EDITAR TEXTO MAS ABAJO *

        ****************************/

        var x=ox=400;

        var y=oy=300;

        var swide=800;

        var shigh=600;

        var sleft=sdown=0;

        var tiny=new Array();

        var star=new Array();

        var starv=new Array();

        var starx=new Array();

        var stary=new Array();

        var tinyx=new Array();

        var tinyy=new Array();

        var tinyv=new Array();


        window.onload=function() { if (document.getElementById) {

        var i, rats, rlef, rdow;

        for (var i=0; i<sparkles; i++) {

           var rats=createDiv(3, 3);

           rats.style.visibility="hidden";

           document.body.appendChild(tiny[i]=rats);

           starv[i]=0;

           tinyv[i]=0;

           var rats=createDiv(5, 5);

           rats.style.backgroundColor="transparent";

           rats.style.visibility="hidden";

           var rlef=createDiv(1, 5);

           var rdow=createDiv(5, 1);

           rats.appendChild(rlef);

           rats.appendChild(rdow);

           rlef.style.top="2px";

           rlef.style.left="0px";

           rdow.style.top="0px";

           rdow.style.left="2px";

           document.body.appendChild(star[i]=rats);

        }

        set_width();

        sparkle();

        }}


        function sparkle() {

        var c;

        if (x!=ox || y!=oy) {

           ox=x;

           oy=y;

           for (c=0; c<sparkles; c++) if (!starv[c]) {

             star[c].style.left=(starx[c]=x)+"px";

             star[c].style.top=(stary[c]=y)+"px";

             star[c].style.clip="rect(0px, 5px, 5px, 0px)";

             star[c].style.visibility="visible";

             starv[c]=50;

             break;

           }

        }

        for (c=0; c<sparkles; c++) {

           if (starv[c]) update_star(c);

           if (tinyv[c]) update_tiny(c);

        }

        setTimeout("sparkle()", 40);

        }


        function update_star(i) {

        if (--starv[i]==25) star[i].style.clip="rect(1px, 4px, 4px, 1px)";

        if (starv[i]) {

           stary[i]+=1+Math.random()*3;

           if (stary[i]<shigh+sdown) {

             star[i].style.top=stary[i]+"px";

             starx[i]+=(i%5-2)/5;

             star[i].style.left=starx[i]+"px";

           }

           else {

             star[i].style.visibility="hidden";

             starv[i]=0;

             return;

           }

        }

        else {

           tinyv[i]=50;

           tiny[i].style.top=(tinyy[i]=stary[i])+"px";

           tiny[i].style.left=(tinyx[i]=starx[i])+"px";

           tiny[i].style.width="2px";

           tiny[i].style.height="2px";

           star[i].style.visibility="hidden";

           tiny[i].style.visibility="visible"

        }

        }


        function update_tiny(i) {

        if (--tinyv[i]==25) {

           tiny[i].style.width="1px";

           tiny[i].style.height="1px";

        }

        if (tinyv[i]) {

           tinyy[i]+=1+Math.random()*3;

           if (tinyy[i]<shigh+sdown) {

             tiny[i].style.top=tinyy[i]+"px";

             tinyx[i]+=(i%5-2)/5;

             tiny[i].style.left=tinyx[i]+"px";

           }

           else {

             tiny[i].style.visibility="hidden";

             tinyv[i]=0;

             return;

           }

        }

        else tiny[i].style.visibility="hidden";

        }


        document.onmousemove=mouse;

        function mouse(e) {

        set_scroll();

        y=(e)?e.pageY:event.y+sdown;

        x=(e)?e.pageX:event.x+sleft;

        }


        function set_scroll() {

        if (typeof(self.pageYOffset)=="number") {

           sdown=self.pageYOffset;

           sleft=self.pageXOffset;

        }

        else if (document.body.scrollTop || document.body.scrollLeft) {

           sdown=document.body.scrollTop;

           sleft=document.body.scrollLeft;

        }

        else if (document.documentElement && (document.documentElement.scrollTop || document.documentElement.scrollLeft)) {

           sleft=document.documentElement.scrollLeft;

        sdown=document.documentElement.scrollTop;

        }

        else {

           sdown=0;

           sleft=0;

        }

        }


        window.onresize=set_width;

        function set_width() {

        if (typeof(self.innerWidth)=="number") {

           swide=self.innerWidth;

           shigh=self.innerHeight;

        }

        else if (document.documentElement && document.documentElement.clientWidth) {

           swide=document.documentElement.clientWidth;

           shigh=document.documentElement.clientHeight;

        }

        else if (document.body.clientWidth) {

           swide=document.body.clientWidth;

           shigh=document.body.clientHeight;

        }

        }


        function createDiv(height, width) {

        var div=document.createElement("div");

        div.style.position="absolute";

        div.style.height=height+"px";

        div.style.width=width+"px";

        div.style.overflow="hidden";

        div.style.backgroundColor=colour;

        return (div);

        }

        // ]]>

        </script>

     
        <link rel="stylesheet" href="view/css/estilos.css">
		 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
   		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>   
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<link rel="stylesheet" href="view/css/estilo.css">
		<link rel="stylesheet" href="view/css/estilos.css">
		<link rel="stylesheet" href="view/css/bootstrap.css">
		<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
			
	 <script>
		 $(document).ready(function() {
				

			$('#myCarousel').carousel({
				interval: 10000
			
			})
		    
		    $('#myCarousel').on('slid.bs.carousel', function() {
		    	alert("slid");
			});
		    
		    
		});
   </script>
	
	
	
	
</head>
<body>


<div class="container"  style=" -webkit-box-shadow: 0px 2px 2px 2px rgba(0,0,0,0.49);-moz-box-shadow: 0px 2px 2px 4px rgba(0,0,0,0.49); box-shadow: 0px 2px 2px 4px rgba(0,0,0,0.49);">
 	
 	<div class="row headhome">
 	<div class="pull-left" >
    	<img src="view/images/logo.png" class="img-responsive" alt="Vademano" width="350" height="350">
 	</div>
 	<div class="pull-right" style="margin-top:10px; padding-right: 10px">
    <?php if  (isset( $_SESSION['usuario_usuarios'] )){  ?> 
			 	   <input type="image" name="image" src="view/DevuelveImagen.php?id_valor=<?php echo $_SESSION['id_usuarios']; ?>&id_nombre=id_usuarios&tabla=usuarios&campo=imagen_usuarios"  alt="<?php echo $_SESSION['id_usuarios'];?>" width="80" height="80"  style="float:left;" >
 		         <?php } else { ?>	
			 	 <?php  }?>
 	</div>
 	<div class="pull-right" style="margin-top:30px; padding-right: 10px">
            	 
       <nav class="navbar navbar-default" style="height: 10px;" >
		  <div class="container-fluid"  >
		    <!-- Brand and toggle get grouped for better mobile display -->
			 <div class="navbar-header" >
		      <button type="button" class="navbar-toggle collapsed"  data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only"    >Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="nav navbar-brand" href="#"></a>
		    </div>
			
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav" >
		        <li  ><a href="index.php?controller=Usuarios&action=Home"><span class="glyphicon glyphicon-home" ><?php echo " Inicio" ;?></span> <span class="sr-only">(current)</span></a></li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-briefcase" ><?php echo " Nosotros" ;?></span> <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		        	<li><a href="index.php?controller=Usuarios&action=QuienesSomos">Quienes Somos</a>
				    </li>
					<li><a href="index.php?controller=Usuarios&action=PreguntasFrecuentes">Preguntas Frecuentes</a>
				    </li>
				  </ul>
		        </li>
		        <li  ><a href="index.php?controller=Afiliaciones&action=index"><span class="glyphicon glyphicon-folder-open" ><?php echo " Afiliarse" ;?></span> <span class="sr-only">(current)</span></a></li>  
		       	
		        <?php $status = session_status();  ?>
		        <?php if  (isset( $_SESSION['usuario_usuarios'] )){  ?> 
			 		<li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" ><?php echo " " . $_SESSION['usuario_usuarios'] ;?></span> <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			        	<li><a href="<?php echo $helper->url("Afiliaciones","VistaActualizarDatos"); ?>"><span class="glyphicon glyphicon-list-alt" ><?php echo " Actualizar Datos" ;?></span> </a>
					  	</li>
					  	<li><a href="<?php echo $helper->url("Usuarios","cerrar_sesion"); ?>"><span class="glyphicon glyphicon-lock" ><?php echo " Cerrar Sesion" ;?></span> </a>
					  	</li>
					  	
					  	
					  </ul>
			        </li>
			 	  
			 		
				 
			 	 <?php } else { ?>	
			 	
			 		   	<li><a href="<?php echo $helper->url("Usuarios","Loguear"); ?>"><span class="glyphicon glyphicon-lock" ><?php echo " Login" ;?></span> </a>
					  	</li>
				 
			 	 	
			 	 <?php  }?>
			 		
		   
		      </ul>
		 
		 	
		 	     
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
   		
   
   
 	
  
  </div>       
</div>
</div>

</body>
</html>

