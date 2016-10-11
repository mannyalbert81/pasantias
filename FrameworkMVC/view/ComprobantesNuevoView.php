<?php include("view/modulos/modal.php"); ?>
<?php include("view/modulos/head.php"); ?>
      
<!DOCTYPE HTML>
<html lang="es">
     <head>
         <meta charset="utf-8"/>
        <title>Comprobantes - Contabilidad 2016</title>
        
         <script type="text/javascript" src="view/css/Comprobantes/VentanaCentrada.js"></script>
	     <script type="text/javascript" src="view/css/Comprobantes/nueva_factura.js"></script>
	     <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
         <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	 
		
	
	
		         
     </head>
      <body>
    
       <?php include("view/modulos/menu.php"); 
             include("view/modal/buscar_productos.php");
       	
       ?>
  
    	
    	<form class="form-horizontal" role="form" id="datos_factura">
    	
    	
    	
    	<div class="container">
	    <div class="panel panel-info">
		
		<?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	        
	         <?php } } else {?>
	         
	         
	         <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	 <div class="panel-heading">
	  <h4><i class='glyphicon glyphicon-edit'></i> Nuevo Comprobante N° <?php echo $res->numero_comprobantes; ?></h4>
	</div>
	 
		    <?php } }else{ ?>
            <?php } ?>
	        
	 
	 <div class="panel-body">
	 <div class="form-group row">
				               <label for="nombres_ccomprobantes" class="col-md-1 control-label">Cliente</label>
            <div class="col-md-3">
					           <input type="text" class="form-control" id="nombres_ccomprobantes" placeholder="Seleccione un Cliente">
					           <span class="help-block"></span>	
		    </div>
							  <label for="ruc_ccomprobantes" class="col-md-1 control-label">Ruc</label>
			<div class="col-md-2">
		     				  <input type="text" class="form-control" id="ruc_ccomprobantes" placeholder="Ruc">
		     				  <span class="help-block"></span>
			</div>
					          <label for="retencion_ccomprobantes" class="col-md-1 control-label">#Retención</label>
			<div class="col-md-3">
							  <input type="text" class="form-control" id="retencion_ccomprobantes" placeholder="# Retención">
							  <span class="help-block"></span>
			</div>
	 </div>
	 
	 <div class="form-group row">
				               <label for="valor_ccomprobantes" class="col-md-1 control-label">Cantidad</label>
            <div class="col-md-6">
					           <input type="text" class="form-control" id="valor_ccomprobantes" value="SEISCIENTOS SETENTA CON 00/100*******">
					           <span class="help-block"></span>	
		    </div>
							  
	 </div>
	 </div>
				
	            
	        
	        
	        <?php } ?>
				
				
				<div class="col-md-12">
					<div class="pull-right">
						
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
						 <span class="glyphicon glyphicon-search"></span> Agregar Cuenta
						</button>
						<button type="submit" class="btn btn-default">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
					</div>	
				</div>
			</form>	
			
		<div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->			
		</div>
	    </div>		
		<div class="row-fluid">
		<div class="col-md-12">
			

			</div>	
		 </div>
	</div>
	
	
		
    	
    	
    	
       <?php include("view/modulos/footer.php"); ?>
        
     </body>  
    </html>          