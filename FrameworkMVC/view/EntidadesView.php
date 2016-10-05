<?php include("view/modulos/modal.php"); ?>
<?php include("view/modulos/head.php"); ?>
<!DOCTYPE HTML>
<html lang="es">
     <head>
         <meta charset="utf-8"/>
        <title>Entidades - Contabilidad 2016</title>
        
          <link rel="stylesheet" href="view/css/bootstrap.css">
          <script src="view/js/jquery.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		  <script src="view/js/ValidarEntidades.js"></script>
		
  
        
    </head>
    <body>
    
       
       <?php include("view/modulos/menu.php"); ?>
  
 	    <div class="container">
  		<div class="row" style="background-color: #FAFAFA;">
        <form id="form-entidades" action="<?php echo $helper->url("Entidades","InsertaEntidades"); ?>" method="post" enctype="multipart/form-data" class="col-lg-6">
            <br>
            
            <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	       
	        <div class="well">
	        <h4 style="color:#ec971f;">Registrar Entidades</h4>
            <hr/>
	        <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="ruc_entidades" class="control-label">Ruc</label>
                                  <input type="text" class="form-control" id="ruc_entidades" name="ruc_entidades" value="<?php echo $resEdit->ruc_entidades; ?>"  placeholder="Ruc">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="nombre_entidades" class="control-label">Nombre</label>
                                  <input type="text" class="form-control" id="nombre_entidades" name="nombre_entidades" value="<?php echo $resEdit->nombre_entidades; ?>"  placeholder="Nombre">
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
	         
	        <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="telefono_entidades" class="control-label">Teléfono</label>
                                  <input type="text" class="form-control" id="telefono_entidades" name="telefono_entidades" value="<?php echo $resEdit->telefono_entidades; ?>"  placeholder="Teléfono">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="direccion_entidades" class="control-label">Dirección</label>
                                  <input type="text" class="form-control" id="direccion_entidades" name="direccion_entidades" value="<?php echo $resEdit->direccion_entidades; ?>"  placeholder="Dirección">
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
	        
	        
	        <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="ciudad_entidades" class="control-label">Ciudad</label>
                                  <input type="text" class="form-control" id="ciudad_entidades" name="ciudad_entidades" value="<?php echo $resEdit->ciudad_entidades; ?>"  placeholder="Ciudad">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    </div>
	        </div>
	     	
	            	  
            
		     <?php } } else {?>
		    
		    <div class="well">
		    <h4 style="color:#ec971f;">Registrar Entidades</h4>
            <hr/>
		    <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="ruc_entidades" class="control-label">Ruc</label>
                                  <input type="text" class="form-control" id="ruc_entidades" name="ruc_entidades" value=""  placeholder="Ruc">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="nombre_entidades" class="control-label">Nombre</label>
                                  <input type="text" class="form-control" id="nombre_entidades" name="nombre_entidades" value=""  placeholder="Nombre">
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
	         
	        <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="telefono_entidades" class="control-label">Teléfono</label>
                                  <input type="text" class="form-control" id="telefono_entidades" name="telefono_entidades" value=""  placeholder="Teléfono">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="direccion_entidades" class="control-label">Dirección</label>
                                  <input type="text" class="form-control" id="direccion_entidades" name="direccion_entidades" value=""  placeholder="Dirección">
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
	        
	        
	        <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="ciudad_entidades" class="control-label">Ciudad</label>
                                  <input type="text" class="form-control" id="ciudad_entidades" name="ciudad_entidades" value=""  placeholder="Ciudad">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    </div>
		    </div>
		    
		     <?php } ?>
		     
		    <div class="row">
		    <div class="col-xs-12 col-md-12" style="text-align: center;">
		    <div class="form-group">
                                  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success btn-block">Guardar</button>
           
            </div>
		    </div>
		    </div>
            
            
            </form>
       
       
            
            <form action="<?php echo $helper->url("Entidades","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
     		<br>
     		<div class="well">  
            <h4 style="color:#ec971f;">Entidades Registradas</h4>
            
            <div class="row">
		    <div class="col-xs-2 col-md-4 col-lg-4">
		    <div class="form-group">
                                  
                                  <input type="text" class="form-control" id="contenido" name="contenido" value="">
                                  
            </div>
		    </div>
		    <div class="col-xs-2 col-md-4 col-lg-4">
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
       <section style="height:200px; overflow-y:scroll;">
       <table class="table table-hover ">
       
       <thead>
           <tr>
                    <th style="font-size:100%;">Id</th>
		    		<th style="font-size:100%;">Ruc</th>
		    		<th style="font-size:100%;">Nombre</th>
		    		<th style="font-size:100%;">Telefono</th>
		    		<th style="font-size:100%;">Direccion</th>
		    		<th style="font-size:100%;">Ciudad</th>
		    		<th></th>
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
	   					<td style="font-size:80%;"> <?php echo $res->id_entidades; ?>  </td>
		                <td style="font-size:80%;" > <?php echo $res->ruc_entidades; ?>     </td> 
		                <td style="font-size:80%;"> <?php echo $res->nombre_entidades; ?>     </td>
		                <td style="font-size:80%;"> <?php echo $res->telefono_entidades; ?>     </td>  
		                <td style="font-size:80%;"> <?php echo $res->direccion_entidades; ?>     </td> 
		                <td style="font-size:80%;"> <?php echo $res->ciudad_entidades; ?>     </td>
		                <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("Entidades","index"); ?>&id_entidades=<?php echo $res->id_entidades; ?>" class="btn btn-warning" onClick="notificacion()" style="font-size:65%;">Editar</a>
			                </div>
			            
			            </td>
			            <td>   
			               	<div class="right">
			                    <a href="<?php echo $helper->url("Entidades","borrarId"); ?>&id_entidades=<?php echo $res->id_entidades; ?>" class="btn btn-danger" onClick="Borrar()" style="font-size:65%;">Borrar</a>
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
        </form>
        </div>
        </div>
  
             <br>
			 <div class="col-lg-12 col-md-6"> 
			 <?php include("view/modulos/Contactos.php"); ?>
			 </div>
			 <br>
			 <br>
			 <br>
			 <br> 
  
       
             <footer class="col-lg-12">
			 <?php include("view/modulos/footer.php"); ?>
			 </footer>
        
    </body>  
    </html>          