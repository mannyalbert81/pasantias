<?php include("view/modulos/modal.php"); ?>
<?php include("view/modulos/head.php"); ?>
      
<!DOCTYPE HTML>
<html lang="es">
     <head>
         <meta charset="utf-8"/>
         <title>Comprobantes - Contabilidad 2016</title>
        
          <link rel="stylesheet" href="view/css/bootstrap.css">
           <script src="view/js/jquery.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		   
            
		  
		  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


        
    	
	<script>
	       	$(document).ready(function(){ 	
				$( "#id_plan_cuentas" ).autocomplete({
      				source: "<?php echo $helper->url("Comprobantes","AutocompleteComprobantesCodigo"); ?>",
      				minLength: 1
    			});

				$("#id_plan_cuentas").focusout(function(){
    				$.ajax({
    					url:'<?php echo $helper->url("Comprobantes","AutocompleteComprobantesDevuelveNombre"); ?>',
    					type:'POST',
    					dataType:'json',
    					data:{codigo_plan_cuentas:$('#id_plan_cuentas').val()}
    				}).done(function(respuesta){

    					$('#nombre_plan_cuentas').val(respuesta.nombre_plan_cuentas);
    					$('#plan_cuentas').val(respuesta.id_plan_cuentas);
    				
        			});
    				 
    				
    			});   
				
    		});

			
     </script>


		<script>
			       	$(document).ready(function(){ 	
						$( "#nombre_plan_cuentas" ).autocomplete({
		      				source: "<?php echo $helper->url("Comprobantes","AutocompleteComprobantesNombre"); ?>",
		      				minLength: 1
		    			});
		
						$("#nombre_plan_cuentas").focusout(function(){
		    				$.ajax({
		    					url:'<?php echo $helper->url("Comprobantes","AutocompleteComprobantesDevuelveCodigo"); ?>',
		    					type:'POST',
		    					dataType:'json',
		    					data:{nombre_plan_cuentas:$('#nombre_plan_cuentas').val()}
		    				}).done(function(respuesta){
		
		    					$('#id_plan_cuentas').val(respuesta.codigo_plan_cuentas);
		    					$('#plan_cuentas').val(respuesta.id_plan_cuentas);
		    				
		        			});
		    				 
		    				
		    			});   
						
		    		});
		
					
		     </script>

	
		         
     </head>
      <body class="cuerpo">
       
       <?php include("view/modulos/menu.php"); ?>
         
        
         
    	<div class="container">
        <div class="row" style="background-color: #FAFAFA;">
  
  
            <form id="form-comprobantes" action="<?php echo $helper->url("Comprobantes","InsertarTemporal"); ?>" method="post" class="col-lg-12">
            <br>	
            
              
	         
	         <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	         <div class="col-lg-12">
	         <div class="col-lg-1">
	         </div>
	         <div class="col-lg-10">
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <div class="row">
	         <div class="form-group" style="margin-left: 20px">
				               <label for="nombres_ccomprobantes" class="control-label"><h4><i class='glyphicon glyphicon-edit'></i> Nuevo Comprobante de </h4></label>
				               <input type="hidden" class="form-control" id="id_entidades" name="id_entidades" value="<?php echo $res->id_entidades; ?>">
                                 
             <div class="col-md-3 col-lg-3 col-xs-4" style="margin-top: 5px">
					           <select name="id_tipo_comprobantes" id="id_tipo_comprobantes"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultTipCom as $res) {?>
										<option value="<?php echo $res->id_tipo_comprobantes; ?>"  ><?php echo $res->nombre_tipo_comprobantes; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>	
		     </div>
			 </div>
	         </div>
	         </div>
	         </div>
	         </div>
	         <div class="col-lg-1">
	         </div>
	         </div>
	         <?php } }else{ ?>
  			 <?php } ?>
  			 
  			 <div class="col-lg-12">
	         <div class="col-lg-1">
	         </div>
	         <div class="col-lg-10">
	         <div class="panel panel-info">
	         <div class="panel-body">
	         <div class="row">
  		     <div class="col-xs-5 col-md-5">
		     <div class="form-group">
                                  <label for="nombres_ccomprobantes" class="control-label">Nombre: </label>
                                  <input type="text" class="form-control" id="nombres_ccomprobantes" name="nombres_ccomprobantes" value=""  placeholder="Nombre">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     <div class="col-xs-3 col-md-3">
		     <div class="form-group">
                                  <label for="ruc_ccomprobantes" class="control-label">Ruc: </label>
                                  <input type="text" class="form-control" id="ruc_ccomprobantes" name="ruc_ccomprobantes" value=""  placeholder="Ruc">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     <div class="col-xs-3 col-md-3">
		     <div class="form-group">
                                  <label for="retencion_ccomprobantes" class="control-label">#Retención: </label>
                                  <input type="text" class="form-control" id="retencion_ccomprobantes" name="retencion_ccomprobantes" value=""  placeholder="# Retención">
                                  <span class="help-block"></span>
             </div>
		     </div>
  		     </div>
  		     
  		     <div class="row">
  		     <div class="col-xs-5 col-md-5">
		     <div class="form-group">
                                  <label for="concepto_ccomprobantes" class="control-label">Concepto de: </label>
                                  <input type="text" class="form-control" id="concepto_ccomprobantes" name="concepto_ccomprobantes" value=""  placeholder="Concepto">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     <div class="col-xs-3 col-md-3">
		     <div class="form-group">
                                  <label for="valor_ccomprobantes" class="control-label">Valor de: </label>
                                  <input type="text" class="form-control" id="valor_ccomprobantes" name="valor_ccomprobantes" value=""  placeholder="Valor">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     </div>
  		     
  		     
  		     </div>                    
			 </div>
			 </div>
  		     <div class="col-lg-1">
	         </div>
             </div>
         				
		     
		     
		     
		     
		     
             
	        
	         
	         
	         <div class="col-lg-12">
	         <div class="col-lg-12">
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Buscar Cuentas</h4>
	         </div>
	         <div class="panel-body">
  			 <div class="row">
  		     <div class="col-xs-2 col-md-2">
		     <div class="form-group">
                                  <label for="id_plan_cuentas" class="control-label">#Cuenta </label>
                                  <input type="text" class="form-control" id="id_plan_cuentas" name="id_plan_cuentas" value=""  placeholder="Search">
                                  <input type="hidden" class="form-control" id="plan_cuentas" name="plan_cuentas" value=""  placeholder="Search">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     <div class="col-xs-3 col-md-3">
		     <div class="form-group">
                                  <label for="nombre_plan_cuentas" class="control-label">Nombre: </label>
                                  <input type="text" class="form-control" id="nombre_plan_cuentas" name="nombre_plan_cuentas" value=""  placeholder="Search">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     <div class="col-xs-3 col-md-3">
		     <div class="form-group">
                                  <label for="descripcion_dcomprobantes" class="control-label">Descripción: </label>
                                  <input type="text" class="form-control" id="descripcion_dcomprobantes" name="descripcion_dcomprobantes" value=""  placeholder="">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     <div class="col-xs-2 col-md-2">
		     <div class="form-group">
                                  <label for="debe_dcomprobantes" class="control-label">Debe: </label>
                                  <input type="text" class="form-control" id="debe_dcomprobantes" name="debe_dcomprobantes" value=""  placeholder="">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     <div class="col-xs-2 col-md-2">
		     <div class="form-group">
                                  <label for="haber_dcomprobantes" class="control-label">Haber: </label>
                                  <input type="text" class="form-control" id="haber_dcomprobantes" name="haber_dcomprobantes" value=""  placeholder="">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     </div>
		     
		    <div class="row">
		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;">
		    <div class="form-group">
                                  <button type="submit" id="Agregar" name="Agregar" class="btn btn-info"><i class="glyphicon glyphicon-plus"></i></button>
            </div>
		    </div>
		    </div>
		     </div>
	         </div>
	         </div>
	         </div>
	         
	        							
	         
	          
	         <div class="col-lg-12">
	         <div class="col-lg-12">
	         
  			  <div class="datagrid3"> 
       <table class="table table-hover ">
       <thead>
           <tr>
                    <th style="font-size:100%;">Cuenta</th>
		    		<th style="font-size:100%;">Nombre de la Cuenta</th>
		    		<th style="font-size:100%;">Descripción</th>
		    		<th style="font-size:100%;">Debe</th>
		    		<th style="font-size:100%;">Haber</th>
		    		<th></th>
		    		
	  		</tr>
	   </thead>
                <?php if (!empty($resultRes)) {  foreach($resultRes as $res) {?>
	        	 
               
	   <tbody>
	   		<tr>
	   					<td style="font-size:80%;"> <?php echo $res->codigo_plan_cuentas; ?>  </td>
		                <td style="font-size:80%;" > <?php echo $res->nombre_plan_cuentas; ?>     </td> 
		                <td style="font-size:80%;"> <?php echo $res->observacion_temp_comprobantes; ?>     </td>
		                <td style="font-size:80%;"> <?php echo $res->debe_temp_comprobantes; ?>     </td>  
		                <td style="font-size:80%;"> <?php echo $res->haber_temp_comprobantes; ?>     </td>  
			           	<td>   
			               	<div class="right">
			                    <a href="<?php echo $helper->url("Comprobantes","borrarId"); ?>&id_temp_comprobantes=<?php echo $res->id_temp_comprobantes; ?>"><i class="glyphicon glyphicon-trash"></i></a>
			                </div>
			            </td>
	   		</tr>
	   
	   </tbody>	
	        		
		        <?php } }else{ ?>
              <?php 
		}
            
            ?>
            
       	</table>     
		     
		     </div>
	         </div>
	         </div>
	         
	         
	         
	         
	         
	             
		    
		     
		    <div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px" > 
            <div class="form-group">
            					  <input type="submit" id="Guardar" name="Guardar" onclick="this.form.action='<?php echo $helper->url("Comprobantes","InsertaComprobantes"); ?>'" value="Guardar" class="btn btn-success"/>
            </div>
            </div>
            </div>
            </form>
            
              
               
       
        </div>
        </div>
        </br>
        </br>
        </br>
        </br>
       <?php include("view/modulos/footer.php"); ?>
        
     </body>  
    </html>          