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
		  <script src="view/js/ValidarCentroCostos.js"></script> 
		  
		 <script src="http://code.jquery.com/jquery-latest.js"></script>



    <script type="text/javascript">
    $(document).ready(function(){
        $("#add").click(function(){
            var tds=$("#tabla tr:first td").length;
            var trs=$("#tabla tr").length;
            var nuevaFila="<tr>";

            for(var i=0;i<tds;i++){
                nuevaFila+="<td>columna"+(i+1)+"</td>";
            }
            
                nuevaFila+="<td>"+"<input type='text' class='form-control' id='id_plan_cuentas' name='id_plan_cuentas' value=''  placeholder='Search' ></td>";
                nuevaFila+="<td>"+"<input type='text' class='form-control' id='nombre_plan_cuentas' name='nombre_plan_cuentas' value=''  placeholder='Search'></td>";
                nuevaFila+="<td>"+"<input type='text' class='form-control' id='descripcion_dcomprobantes' name='descripcion_dcomprobantes' value=''  placeholder='Descripción'></td>";
                nuevaFila+="<td>"+"<input type='text' class='form-control' id='debe_dcomprobantes' name='debe_dcomprobantes' value=''  placeholder='Monto'></td>";
                nuevaFila+="<td>"+"<input type='text' class='form-control' id='haber_dcomprobantes' name='haber_dcomprobantes' value=''  placeholder='Monto'></td>";


            
            nuevaFila+="</tr>";
            $("#tabla").append(nuevaFila);
        });
        $("#del").click(function(){
            var trs=$("#tabla tr").length;
            if(trs>1)
            {
                $("#tabla tr:last").remove();
            }
        });
    });
    </script>
	
	<style>
    #add, #del  {cursor:pointer;text-decoration:underline;color:#00f;}
    </style>  
		         
     </head>
      <body class="cuerpo">
    
       <?php include("view/modulos/menu.php"); ?>
  
    	<div class="container">
        <div class="row" style="background-color: #FAFAFA;">
  
  
            <form id="form-comprobantes" action="<?php echo $helper->url("Comprobantes","InsertaComprobantes"); ?>" method="post" class="col-lg-12">
            <br>	
            
             <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	        
	         <?php } } else {?>
	         
	         
	         <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	         <div class="col-lg-12">
	         <div class="col-lg-1">
	         </div>
	         <div class="col-lg-10">
	         <div class="panel panel-default">
  			 <div class="panel-body">
	         <div class="row">
	         <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;" > 
             <div class="form-group"> 
	          						 <p for="numero_comprobantes" class="control-label"><b>COMPROBANTE DE EGRESOS N°: <?php echo $res->numero_comprobantes; ?></b></p>
                   
             </div>                 
			 </div>
  		     </div>
  		     
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
                                  <label for="retencion_ccomprobantes" class="control-label">N° Retención: </label>
                                  <input type="text" class="form-control" id="retencion_ccomprobantes" name="retencion_ccomprobantes" value=""  placeholder="# Retención">
                                  <span class="help-block"></span>
             </div>
		     </div>
  		     </div>
  		     <div class="row">
  		     <div class="col-xs-6 col-md-6" >
  		     					<p for="cantidad" class="control-label"><b>La Cantidad de: </b>Seiscientos setenta con 00/100***********</p>
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
	         <div class="datagrid1"> 
	         <table>
	         <tbody>
	   		 <tr>
	   					<td style="font-size:80%;">
	   					          <label for="concepto_ccomprobantes" class="control-label">CONCEPTO: </label>
	   					          <textarea  class="form-control" id="concepto_ccomprobantes" name="concepto_ccomprobantes" wrap="physical" rows="1"></textarea>
	          	                  <span class="help-block"></span>
                        </td>
	   					<td>
	   					<input type="button" id="add" class="btn btn-success" value="Agregar">
                        <input type="button" id="del" class="btn btn-danger" value="Quitar">
	                    </td>
	   					
                      
	   		</tr>
	        </tbody>
	        </table>
            </div>
            </div>
	        <div class="col-lg-1">
	        </div>
	        </div>
	        
	        
	        
	        
	         <div class="col-lg-12">
	         <div class="col-lg-1">
	         </div>
	         <div class="col-lg-10">
	         <div class="datagrid1"> 
	         <section style="height:200px; overflow-y:scroll;">
             <table id="tabla">
             <thead>
             <tr>
                    <th style="font-size:100%;">Cuenta</th>
		    		<th style="font-size:100%;">Nombre de la Cuenta</th>
		    		<th style="font-size:100%;">Descripción</th>
		    		<th style="font-size:100%;">Debe</th>
		    		<th style="font-size:100%;">Haber</th>
		     </tr>
	         </thead>
         
	         <tbody>
	   		 <tr>
	   					<td style="font-size:80%;">
	   					          <input type="text" class="form-control" id="id_plan_cuentas" name="id_plan_cuentas" value=""  placeholder="Search">
                                  <span class="help-block"></span>
	   					</td>
	   					<td style="font-size:80%;">
	   					          <input type="text" class="form-control" id="nombre_plan_cuentas" name="nombre_plan_cuentas" value=""  placeholder="Search">
                                  <span class="help-block"></span>
	   					</td>
	   					<td style="font-size:80%;">
	   					          <input type="text" class="form-control" id="descripcion_dcomprobantes" name="descripcion_dcomprobantes" value=""  placeholder="Descripción">
                                  <span class="help-block"></span>
	   					</td>
	   					<td style="font-size:80%;">
	   					          <input type="text" class="form-control" id="debe_dcomprobantes" name="debe_dcomprobantes" value=""  placeholder="Monto">
                                  <span class="help-block"></span>
	   					</td>
	   					<td style="font-size:80%;">
	   					          <input type="text" class="form-control" id="haber_dcomprobantes" name="haber_dcomprobantes" value=""  placeholder="Monto">
                                  <span class="help-block"></span>
	   					</td>
		                
	   		 </tr>
	         </tbody>	
	         </table>     
	    	 </section>
             </div>
	        
	        
	         
	         <div class="row">
  		     <div class="col-xs-8 col-md-8" style="text-align: center;">
		     <div class="form-group" >
                                  <p>TOTAL: </p>
                                  
             </div>
		     </div>
		     <div class="col-xs-2 col-md-2" style="text-align: center;">
		     <div class="form-group">
                                  <p>660.00</p>
                                  
             </div>
		     </div>
		     <div class="col-xs-2 col-md-2" style="text-align: center;">
		     <div class="form-group">
                                  <p>660.00</p>
             </div>
		     </div>
		     </div>
  		     
  		     
	         <div class="datagrid1"> 
	         <table>
	         <?php if (!empty($resultSet)) {  foreach($resultSet as $res2) {?>
             <tbody>
	   		 <tr>
	   					<td style="font-size:80%; text-aling:center;">Elaborado por:<p><?php echo $res2->nombre_usuarios; ?></p></td>
	   					<td style="font-size:80%; text-aling:center;">Es Conforme:<p>CONTADOR</p></td>
	   					<td style="font-size:80%; text-aling:center;">Visto Bueno:<p>GERENTE</p></td>
	   					<td style="font-size:80%; text-aling:center;">Firma: ________________________<p>C.I: __________________________</p></td>
	   					
                      
	   		 </tr>
	        </tbody>
	        <?php } }else{ ?>
            <?php }?>
	        </table>
            </div>
             
             
	         </div>
  		     <div class="col-lg-1">
	         </div>
             </div>
	        
	         </br>
	         </br>
	        
		     <?php } ?>
		     
		    <div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;" > 
            <div class="form-group">
            					  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">Guardar</button>
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