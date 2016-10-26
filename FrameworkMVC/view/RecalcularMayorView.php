<?php include("view/modulos/modal.php"); ?>
<?php include("view/modulos/head.php"); ?>
      
<!DOCTYPE HTML>
<html lang="es">
     <head>
         <meta charset="utf-8"/>
        <title>RecalcularMayor - Contabilidad 2016</title>
        
          <link rel="stylesheet" href="view/css/bootstrap.css">
          <script src="view/js/jquery.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		  <script src="view/js/ValidarCentroCostos.js"></script>        
     </head>
      <body class="cuerpo">
    
       <?php include("view/modulos/menu.php"); ?>
  
    	<div class="container">
        <div class="row" style="background-color: #FAFAFA;">
  
  
            <form id="form-centro-costos" action="<?php echo $helper->url("RecalcularMayor","ActualizarRecalcularMayor"); ?>" method="post" class="col-lg-6">
            <br>	
            
             <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	        
	         <?php } } else {?>
	         
	        <div class="well">
            <h4 style="color:#ec971f;">Recalcular Mayor</h4>
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
            
            <div class="clo-lg-6">
            <br>
     		<div class="well">  
            <h4 style="color:#ec971f;">Cuentas Registrados</h4>
            
            <div class="row">
		    <div class="col-xs-4 col-md-4 col-lg-4">
		    <div class="form-group">
                                  
                                  <input type="text" class="form-control" id="contenido" name="contenido" value="">
                                  
            </div>
		    </div>
		    <div class="col-xs-4 col-md-4 col-lg-4">
		    <div class="form-group">
                                  
                                  <select name="criterio" id="criterio"  class="form-control">
                                    <?php foreach($resultMenu as $val=>$desc) {?>
                                         <option value="<?php echo $val ?>" ><?php echo $desc ?> </option>
                                    <?php } ?>
                                  </select>
            </div>
		    </div>
		    <div class="col-xs-4 col-md-4 col-lg-4">
		    <div class="form-group">
                                  
                                  <button type="submit" id="Buscar" name="Buscar" class="btn btn-info">Buscar</button>
            </div>
		    </div>
			</div>  
             
       
       <div class="datagrid"> 
       <section style="height:380px; overflow-y:scroll;">
       <table class="table table-hover ">
       
       <thead>
           <tr>
                    <th style="font-size:100%;">Id</th>
		    		<th style="font-size:100%;">Nombre</th>
		    		<th style="font-size:100%;">Codigo</th>
		    		<th style="font-size:100%;">Nivel</th>
		    		<th style="font-size:100%;">Entidad</th>
		    		<th></th>
		    		<th></th>
		    		
	  		</tr>
	   </thead>
       <tfoot>
       		<tr>
					<td colspan="10">
						<div id="paging">
							<ul>
								<li>
									<a href="#">
						<span>Previous</span>
									</a>
								</li>
								<li>
									<a href="#" class="active">
						<span>1</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>2</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>3</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>4</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>5</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>Next</span>
									</a>
								</li>
								</ul>
						</div>
					
			</tr>
       				
       </tfoot>
       
                <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        	 
               
	   <tbody>
	   		<tr>
	   				   <td style="font-size:80%;"> <?php echo $res->id_centro_costos; ?>       </td>
	                   <td style="font-size:80%;"> <?php echo $res->nombre_centro_costos; ?>   </td>
		               <td style="font-size:80%;" > <?php echo $res->codigo_centro_costos; ?>  </td> 
		               <td style="font-size:80%;"> <?php echo $res->nivel_centro_costos; ?>    </td>
		               <td style="font-size:80%;"> <?php echo $res->nombre_entidades; ?>    </td>
		               
		               <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("CentroCostos","index"); ?>&id_centro_costos=<?php echo $res->id_centro_costos; ?>" class="btn btn-warning" style="font-size:65%;">Editar</a>
			                </div>
			            
			           </td>
			           <td>   
			               	<div class="right">
			                    <a href="<?php echo $helper->url("CentroCostos","borrarId"); ?>&id_centro_costos=<?php echo $res->id_centro_costos; ?>" class="btn btn-danger" style="font-size:65%;">Borrar</a>
			                </div>
			           </td>
	   		</tr>
	   
	   </tbody>	
	        		
		        <?php } }else{ ?>
            <tr>
            <td></td>
            <td></td>
	                   <td colspan="5" style="color:#ec971f;font-size:8;"> <?php echo '<span id="snResult">No existen resultados</span>' ?></td>
	        <td></td>
		               
		    </tr>
            <?php 
		}
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
		</section>
        </div>
        </div>
        </div>
        
        
        </div>
        </div>
  
       
       <?php include("view/modulos/footer.php"); ?>
        
     </body>  
    </html>          