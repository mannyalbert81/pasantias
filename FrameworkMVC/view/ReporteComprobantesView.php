 <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Reporte Comprobantes - contabilidad 2016</title>
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		  			   
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		
		<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
 		
 		<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
		
		<script>
		    webshims.setOptions('forms-ext', {types: 'date'});
			webshims.polyfill('forms forms-ext');
		</script>
		
       <style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
                
            
        </style>
         
         	<script>
	$(document).ready(function(){
			$("#fecha_hasta").change(function(){
				 var startDate = new Date($('#fecha_desde').val());

                 var endDate = new Date($('#fecha_hasta').val());

                 if (startDate > endDate){
 
                    $("#mensaje_fecha_hasta").text("Fecha desde no debe ser mayor ");
		    		$("#mensaje_fecha_hasta").fadeIn("slow"); //Muestra mensaje de error  
		    		$("#fecha_hasta").val("");

                        }
				});

			 $( "#fecha_hasta" ).focus(function() {
				  $("#mensaje_fecha_hasta").fadeOut("slow");
			   });
			});
        </script>

    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       <?php
       
       $sel_id_entidades = "";
       $sel_id_tipo_comprobantes="";
       $sel_numero_ccomprobantes="";
       $sel_referencia_doc_ccomprobantes="";
       $sel_fecha_desde="";
       $sel_fecha_hasta="";
        
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       	$sel_id_entidades = $_POST['id_entidades'];
        $sel_id_tipo_comprobantes=$_POST['id_tipo_comprobantes'];
       	$sel_numero_ccomprobantes=$_POST['numero_ccomprobantes'];
       	$sel_referencia_doc_ccomprobantes=$_POST['referencia_doc_ccomprobantes'];
       	$sel_fecha_desde=$_POST['fecha_desde'];
       	$sel_fecha_hasta=$_POST['fecha_hasta'];
       
       }
       ?>
 
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("Comprobantes","ReporteComprobantes"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
         
         <!-- comienxza busqueda  -->
         <div class="col-lg-12" style="margin-top: 10px">
         
       	 <h4 style="color:#ec971f;">Reporte Comprobantes</h4>
       	 
       	 
       	 <div class="panel panel-default">
  			<div class="panel-body">
  			
  					
          <div class="col-xs-2">
			  	<p  class="formulario-subtitulo">Entidades:</p>
			  	<select name="id_entidades" id="id_entidades"  class="form-control" readonly>
			  		<?php foreach($resultEnt as $res) {?>
						<option value="<?php echo $res->id_entidades; ?>"<?php if($sel_id_entidades==$res->id_entidades){echo "selected";}?>><?php echo $res->nombre_entidades;  ?> </option>
			            <?php } ?>
				</select>
		 </div>
		 
		  <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo">Tipo Comprobantes:</p>
			  	<select name="id_tipo_comprobantes" id="id_tipo_comprobantes"  class="form-control" >
			  		<option value="0"><?php echo "--TODOS--";  ?> </option>
					<?php foreach($resultTipCom as $res) {?>
						<option value="<?php echo $res->id_tipo_comprobantes; ?>"<?php if($sel_id_tipo_comprobantes==$res->id_tipo_comprobantes){echo "selected";}?> ><?php echo $res->nombre_tipo_comprobantes;  ?> </option>
			            <?php } ?>
				</select>

         </div>
          <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Nº Comprobantes</p>
			  	<input type="text"  name="numero_ccomprobantes" id="numero_ccomprobantes" value="<?php echo $sel_numero_ccomprobantes;?>" class="form-control"/> 
          </div>
		
         <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Referencia Doc:</p>
			  	<input type="text"  name="referencia_doc_ccomprobantes" id="referencia_doc_ccomprobantes" value="<?php echo $sel_referencia_doc_ccomprobantes;?>" class="form-control"/> 
         </div>
         
         
         <div class="col-xs-2 ">
         		<p class="formulario-subtitulo" >Desde:</p>
			  	<input type="date"  name="fecha_desde" id="fecha_desde" value="<?php echo $sel_fecha_desde;?>" class="form-control "/> 
			    <div id="mensaje_fecha_desde" class="errores"></div>
		</div>
         
          <div class="col-xs-2 ">
          		<p class="formulario-subtitulo" >Hasta:</p>
			  	<input type="date"  name="fecha_hasta" id="fecha_hasta" value="<?php echo $sel_fecha_hasta;?>" class="form-control "/> 
			    <div id="mensaje_fecha_hasta" class="errores"></div>
		</div>
		 
  			</div>
  		
  		<div class="col-lg-12" style="text-align: center; margin-bottom: 20px">
  		    
		 <button type="submit" id="buscar" name="buscar" value="Buscar"   class="btn btn-info" style="margin-top: 10px;"/><i class="glyphicon glyphicon-search"></i></button>     
	  
	  <?php if(!empty($resultSet))  {?>
		 <a href="/contabilidad/FrameworkMVC/view/ireports/ContReporteComprobantesReport.php?id_entidades=<?php  echo $sel_id_entidades ?>&id_tipo_comprobantes=<?php  echo $sel_id_tipo_comprobantes?>&numero_ccomprobantes=<?php  echo $sel_numero_ccomprobantes?>&referencia_doc_ccomprobantes=<?php  echo $sel_referencia_doc_ccomprobantes?>&fecha_desde=<?php  echo $sel_fecha_desde?>&fecha_hasta=<?php  echo $sel_fecha_hasta?>&id_usuarios=<?php echo $_SESSION['id_usuarios'];?>" onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false" style="margin-top: 10px;" class="btn btn-success"><i class="glyphicon glyphicon-download-alt"></i></a>
	  <?php } else {?>
		  <?php } ?>
	
		  </div>
		 
		</div>
        	
		 </div>
		 
		 
		 <div class="col-lg-12">
		 
	      <div class="col-lg-12">
		 <div class="col-lg-10"></div>
		 <div class="col-lg-2">
		 <span class="form-control" style="margin-bottom:0px;"><strong>Registros:</strong><?php if(!empty($resultSet)) echo "  ".count($resultSet);?></span>
		 </div>
		 </div>
		 <div class="col-lg-12">
		
		 
		 
		 <section class="" style="height:300px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	            
	    		<th style="color:#456789;font-size:80%;">Tipo</th>
	    		<th style="color:#456789;font-size:80%;">Concepto</th>
	    		<th style="color:#456789;font-size:80%;">Entidad</th>
	    		<th style="color:#456789;font-size:80%;">Valor</th>
	    		<th style="color:#456789;font-size:80%;">Fecha</th>
	    		<th style="color:#456789;font-size:80%;">Numero de Comprobante</th>
	    		<th style="color:#456789;font-size:80%;">Forma de Pago</th>
	    	
	    		<th></th>
	    		<th></th>
	  		</tr>
	        
           <?php  $paginas =   0;  ?>
		    <?php  $registros = 0; ?>
	  		
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	        		
	 	               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_tipo_comprobantes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->concepto_ccomprobantes; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_entidades; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->valor_letras; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->fecha_ccomprobantes; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->numero_ccomprobantes; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_forma_pago; ?>  </td>
		               <td>
					   <a href="/contabilidad/FrameworkMVC/view/ireports/ContComprobanteContableReport.php?id_ccomprobantes=<?php echo $res->id_ccomprobantes; ?>"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false" ><i class="glyphicon glyphicon-print"></i></a>
					   </td>
	                   <?php  $registros = $registros + 1 ; ?>
		    		</tr>
		        <?php }   ?>
            
       	</table> 
       	
       	</section>
       	<!--       			<table class="table">
				<th class="text-center">
				    	<nav>
						  <ul id="pagina" name="pagina" class="pagination">
						    <?php if ($paginasTotales > 0) {?>
						    		<?php if ($ultima_pagina > 1 ) {?>
						    			<input type="submit" value="<?php echo "<<"; ?>" id="anterior_pagina"    name="anterior_pagina" class="btn btn-info"/>
						    		<?php }?>
						    <?php for ($i = $ultima_pagina; $i< $paginasTotales+1; $i++)  { ?>
						    		
						    		<?php if ($i  < $ultima_pagina + 5) {  ?>
						    			<input type="hidden" value="<?php echo $i+1; ?>" id="ultima_pagina"    name="ultima_pagina" class="btn btn-info"/>
						    			<input type="submit" value="<?php echo $i; ?>" id="pagina"  <?php if ($i == $pagina_actual ) { echo 'style="color: #1454a3 " '; }  ?>     name="pagina" class="btn btn-info"/>
						    			
						    		<?php } ?>
						    		<?php if ($paginasTotales  == $i) {  ?>
						    			<input type="submit" value="<?php echo ">>"; ?>" id="siguiente_pagina"    name="siguiente_pagina" class="btn btn-info"/>
						    		<?php } ?>
						    		
						    <?php    } }?>
						    
						  </ul>
						</nav>	   	   
			
				</th>
				<tr class="bg-primary">
						<p class="text-center"> <strong> Registros Cargados: <?php echo  $registros?> Registros Totales: <?php echo  $registrosTotales?> </strong>  </p>
	     		  	
				</tr>			
		</table>
		 	-->
 				<?php  }   else { ?>
		        <?php }  ?>    
		        
      
     
		 
		 </div>
		 
		 
		 </div>
		 
	
      
       </form>
     
      </div>
     
  </div>
      <!-- termina
       busqueda  -->
       
 
   </body>  

    </html>   
    
  
    