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
	         
	         <div class="panel panel-default">
  			 <div class="panel-body">
	         <div class="row">
	         <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;" > 
             <div class="form-group"> 
	          						<p for="nombre_entidades" class="control-label"><b><?php echo $res->nombre_entidades; ?></b></p>
                   
             </div>                 
			 </div>
  		     </div>
  		     
  		     <div class="row">
  		     <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;" > 
			 <div class="form-group"> 
			  						<p for="direccion_entidades" class="control-label"><b><?php echo $res->direccion_entidades; ?></b></p>
                   
             </div>                    
			 </div>
  		     </div>
  		     
  		     <div class="row">
  		     <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;" > 
			 <div class="form-group"> 
			  						<p for="numero_comprobantes" class="control-label"><b>COMPROBANTE DE EGRESOS N°: <?php echo $res->numero_comprobantes; ?></b></p>
                   
             </div>                    
			 </div>
  		     </div>
  		     
  		     <div class="row">
  		     <div class="col-xs-4 col-md-4 col-lg-4" style="text-align: center;">
			 <div class="form-group"> 
			  						<p for="ruc_entidades" class="control-label"><b>Ruc: </b><?php echo $res->ruc_entidades; ?></p>
                   
             </div>                    
			 </div>
			 <div class="col-xs-4 col-md-4 col-lg-4" style="text-align: center;">
			 <div class="form-group"> 
			  						<p for="telefono_entidades" class="control-label"><b>Telf: </b><?php echo $res->telefono_entidades; ?></p>
                   
             </div>                    
			 </div>
			 <div class="col-xs-4 col-md-4 col-lg-4" style="text-align: center;">
			 <div class="form-group"> 
			  						<p for="fecha_comprobantes" class="control-label"><b>Fecha: </b><?php $sdate=date("d")."/".date("m")."/".date("Y"); $stime=date("h").":".date("i"); echo "$sdate";?></p>
                   
             </div>                    
			 </div>
  		     </div>
  		     
  		     </div>                    
			 </div>
  		 
  		     
         
         				
		     <?php } }else{ ?>
             <?php } ?>
	         
	        <div class="well">
            <h4 style="color:#ec971f;">Registrar Comprobantes</h4>
            <hr/>
	        <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="id_entidad" class="control-label">Entidad</label>
                                  <select name="id_entidad" id="id_entidad"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultEntidad as $res) {?>
										<option value="<?php echo $res->id_entidades; ?>" ><?php echo $res->nombre_entidades; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
            <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="nombre_centro_costos" class="control-label">Nombre</label>
                                  <input type="text" class="form-control" id="nombre_centro_costos" name="nombre_centro_costos" value=""  placeholder="Nombre">
                                  <span class="help-block"></span>
            </div>
		    </div>
            </div>
	        
		    <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="codigo_centro_costos" class="control-label">Codigo</label>
                                  <input type="text" class="form-control" id="codigo_centro_costos" name="codigo_centro_costos" value=""  placeholder="Codigo">
                                  <span class="help-block"></span>
            </div>
            </div>
            <div class="col-xs-6 col-md-6">
            <div class="form-group">
                                  <label for="nivel_centro_costos" class="control-label">Nivel</label>
                                  <input type="text" class="form-control" id="nivel_centro_costos" name="nivel_centro_costos" value=""  placeholder="Nivel">
                                  <span class="help-block"></span>
            </div>
		    </div>
			</div>
			</div>
			
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
  
       
       <?php include("view/modulos/footer.php"); ?>
        
     </body>  
    </html>          