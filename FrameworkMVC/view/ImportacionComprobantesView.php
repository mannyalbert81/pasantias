
<?php include("view/modulos/head.php"); ?>
<?php $n_plan_cuentas=array("A"=>'Acreedora',"D"=>'Deudora');
      $resultMenu = array("codigo"=>'Codigo',"nombre"=>'Nombre',"tipo"=>'Tipo',"naturaleza"=>'Naturaleza');?>

<?php $sel_id_entidad_importar="";
	  
 	if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       	$sel_id_entidad_importar=$_POST['id_entidad_a_importar'];
       }
?>

<!DOCTYPE HTML>
<html lang="es">
     <head>
         <meta charset="utf-8"/>
        <title>Importacion Cuentas Contabilidad 2016</title>
        
          <link rel="stylesheet" href="view/css/bootstrap.css">
          <script src="view/js/jquery.js"></script>
          <script src="view/js/jquery-ui.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		  <script src="view/js/ValidarPlanCuentas.js"></script>
		  
		  <style type="text/css">
			 .img{border-radius: 25px;}
			 .img:hover{
			 
			 	border-radius: 25px;
			 	-moz-box-shadow: 0 0 10px #ccc;
			 	 -webkit-box-shadow: 0 0 10px #ccc;
			 	 box-shadow: 0 0 10px #ccc;
			    -webkit-transform: scale(1.25);
			    -moz-transform: scale(1.25);
			    -o-transform: scale(1.25);
			    -ms-transform: scale(1.25);
			    transform: scale(1.25)
			}
			.textfail.form-control
			{
			border: 1px solid red;
			-moz-box-shadow: 0 0 10px red;
			-webkit-box-shadow: 0 0 10px red;
			box-shadow: 0 0 10px red;
			}
			.errores{
		    -webkit-boxshadow: 0 0 10px rgba(0, 0, 0, 0.3);
		    -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
		    -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
		    border-radius:10px;
		    -webkit-border-radius: 10px;
		    background: red;
		    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
		    color: #fff;
		    display: none;
		    font-size: 12px;
		    margin-top: -40px;
		    margin-left: 150px;
		    padding: 10px;
		    position: absolute;
		     z-index: 1;
		}
		.errores:before{ /* Este es un truco para crear una flechita */
		    content: '';
		    border-top: 8px solid transparent;
		    border-bottom: 8px solid transparent;
		    border-right: 8px solid #BC1010;
		    border-left: 8px solid transparent;
		    left: -16px;
		    position: absolute;
		    top: 5px;
		    
		}
		 </style>
		
		
		<script type="text/javascript">
		
		$(document).ready(function(){
			
			$("#Importar").click(function(){

				var respuesta=true;
				
					var id_entidad_importar=$("#id_entidad_a_importar").val();
					var id_entidad_importada = $("#id_entidad_importada").val();
					var saldos = $('input:radio[name=saldos]:checked').val();

					$("#id_entidad").val(id_entidad_importar);

					if(id_entidad_importar==id_entidad_importada)
						{

						$("#mensaje_entidad").text("La entidad debe ser diferente");
			    		$("#mensaje_entidad").fadeIn("slow");

			    		respuesta = false;
						
						}

					if(typeof(saldos) == "undefined")
					{
						
						$("#mensaje_saldos").text("selecione Una opcion");
			    		$("#mensaje_saldos").fadeIn("slow");

			    		respuesta = false;
						
					}

					
					return respuesta;
					

				});
			
			$("#id_entidad_importada" ).focus(function() {
				  $("#mensaje_entidad").fadeOut("slow");
			    });
			$("input:radio[name=saldos]" ).focus(function() {
				  $("#mensaje_saldos").fadeOut("slow");
			    });
		});
		
		</script>
		
		
    </head>
    <body>
   
       
       <?php include("view/modulos/menu.php"); ?>
       
       <?php $t_plan_cuentas=array("acreedora"=>'Acreedora',"deudora"=>'Deudora')?>
  
 	 <div class="container">
  		        
        
          <form id="form-plan_cuentas" action="<?php echo $helper->url("ImportacionComprobantes","ImportarComprobantes"); ?>" method="post" enctype="multipart/form-data" class="col-lg-6">
            <br>
            
            <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	        
	        <?php } } else {?>
		    
		    <div class="well">
		    <h4 style="color:#ec971f;">Importacion  De Comprobantes</h4>
            <hr/>
            
            <div class="row">
		    <div class="col-xs-12 col-md-12">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="id_entidad" class="control-label">Entidad A Importar</label>
                 <select name="id_entidad_importada" id="id_entidad_importada"  class="form-control" >
					 <?php foreach($resultEntidades as $res) {?>
					 <option value="<?php echo $res->id_entidades; ?>" ><?php echo $res->nombre_entidades; ?> </option>
					 <?php } ?>
			     </select>
			     <input type="hidden" value="" id="id_entidad" name="id_entidad">
			     <div id="mensaje_entidad" class="errores"></div> 
			    
            </div>
		    </div>
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="id_archivo_importar" class="control-label">Seleccione Archivo</label>
                    <input type="file" name="archivo_cuentas" id="archivo_cuentas" accept="txt" onKeyDown="return intro(event)" value="" class="form-control"/> 
			   	 <div id="mensaje_archivo" class="errores"></div>
                  <span class="help-block"></span>
            </div>
		   
		    </div>
		     
		   
			</div>
			</div>
		    
		  
		   
		    </div>
		    
		     <?php } ?>
		     
		    <div class="row">
		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;">
		    <div class="form-group">
                 <input type="submit" id="Importar" name="Importar" value="Importar" class="btn btn-success"/>
            
            </div>
		    </div>
		    </div>
		    
      </form>
           	
        
        </div>

  		
         
     </div>
            
  
             <br>
			 <br>
			 <br> 
		
		<!-- modaledita -->
        <div id="modal_edit_cuenta">
        
		</div>
	
		
			
  
       
             <footer class="col-lg-12">
             
			 <?php include("view/modulos/footer.php"); ?>
			 </footer>
			 
			 
        
    </body>  
    </html>  
   
   <?php include("view/modulos/modal.php"); ?>
   <?php
   $arbol = $resultSet;
   $html = "";
   $nivel1=array();
   $nivel2=array();
   $nivel3=array();
   $nivel4=array();
   $nivel5=array();
   //print_r($arbol);
   
   foreach ($arbol as $resarbol)
   {
   		
   }
   
   ?>        