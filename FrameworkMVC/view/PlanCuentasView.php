<?php include("view/modulos/modal.php"); ?>
<?php include("view/modulos/head.php"); ?>
<!DOCTYPE HTML>
<html lang="es">
     <head>
         <meta charset="utf-8"/>
        <title>Plan de Cuentas - Contabilidad 2016</title>
        
          <link rel="stylesheet" href="view/css/bootstrap.css">
          <script src="view/js/jquery.js"></script>
          <script src="view/js/jquery-ui.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		  <script src="view/js/ValidarEntidades.js"></script>
		
		<script type="text/javascript">
		$(function(){
		    
		    var u = document.location.href.split("/");
		    var n = u.length;
		    var _url = "http:";
		    var i=0;
		    n=n-3;

		    for(i=0;i<=n;i++){
		        _url+="/"+u[i+1];
		    }
		        _url+="/guardar"    

		    $('#agregar_grupo').click(function(){
			    //alert('hola');
			    //opciones para dialosg no usados position:'center',
			        $('#modal').dialog({
		                            autoOpen: false,
		                            modal: true,
		                            height: 500,
		                            width: 250,
		                            buttons: {
		                "Aceptar": function() {
		                    var checking = $('#check').jserialize();
		                    loading('#cargando','Cargando');
		                    $.ajax({
		                           url:"<?php echo $helper->url("PlanCuentas","AgregarGrupo");?>"
		                           ,type : "POST"
		                           ,async: true
		                           ,data : checking
		                           ,success: function(msg){
		                                $('#modal').dialog('close');
		                                loading();
		                           }
		                    });                    
		   
		                },
		                "Cancelar": function(){
		                    $('#modal').dialog('close');
		                }
		            }    

		        }); 

		        var  html = " <br><br><br>";
		        html+="<div class = 'ui-state-highlight  ui-corner-all'>";
		        html+="<div class = 'ui-icon ui-icon-info '></div>";
		        html+="<center>¿Seguro que quiere Guardar los Datos ? </center></div><br><br><br>";




		        $('#modal').html (html);  

		        $('#modal').dialog('open');


		        });    
		   
		    
		});
		
		</script>
		
		<script type="text/javascript">
		$(function(){
		    
		    var u = document.location.href.split("/");
		    var n = u.length;
		    var _url = "http:";
		    var i=0;
		    n=n-3;

		    for(i=0;i<=n;i++){
		        _url+="/"+u[i+1];
		    }
		        _url+="/guardar"    

		    $('#agregar_subgrupo').click(function(){
			    //alert('hola');
			    //opciones para dialosg no usados position:'center',
			        $('#modal').dialog({
		                            autoOpen: false,
		                            modal: true,
		                            height: 500,
		                            width: 250,
		                            buttons: {
		                "Aceptar": function() {
		                    var checking = $('#check').jserialize();
		                    loading('#cargando','Cargando');
		                    $.ajax({
		                           url:"<?php echo $helper->url("PlanCuentas","AgregarGrupo");?>"
		                           ,type : "POST"
		                           ,async: true
		                           ,data : checking
		                           ,success: function(msg){
		                                $('#modal').dialog('close');
		                                loading();
		                           }
		                    });                    
		   
		                },
		                "Cancelar": function(){
		                    $('#modal').dialog('close');
		                }
		            }    

		        }); 

		        var  html = " <br><br><br>";
		        html+="<div class = 'ui-state-highlight  ui-corner-all'>";
		        html+="<div class = 'ui-icon ui-icon-info '></div>";
		        html+="<center>¿Seguro que quiere Guardar los Datos ? </center></div><br><br><br>";




		        $('#modal').html (html);  

		        $('#modal').dialog('open');


		        });    
		   
		    
		});
		
		</script>
        
    </head>
    <body>
    
       
       <?php include("view/modulos/menu.php"); ?>
       
       <?php $t_plan_cuentas=array("acreedora"=>'Acreedora',"deudora"=>'Deudora')?>
  
 	    <div class="container">
  		<div class="row" style="background-color: #FAFAFA;">
        <form id="form-entidades" action="<?php echo $helper->url("PlanCuentas","InsertaPlanCuentas"); ?>" method="post" enctype="multipart/form-data" class="col-lg-6">
            <br>
            
            <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	       
	        <div class="well">
	        <h4 style="color:#ec971f;">Registrar Plan de Cuentas</h4>
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
		    <h4 style="color:#ec971f;">Registrar Plan de Cuentas</h4>
            <hr/>
            
            <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="id_entidad" class="control-label">Entidad</label>
                 <select name="id_entidad" id="id_entidad"  class="form-control" >
					 <?php foreach($resultEntidad as $res) {?>
					 <option value="<?php echo $res->id_entidades; ?>" ><?php echo $res->nombre_entidades; ?> </option>
					 <?php } ?>
			     </select> 
			     <span class="help-block"></span>
            </div>
		    </div>
		   
			</div>
			
			<div class="row">
		    <div class="col-xs-4 col-md-4">
		    <div class="form-group">
                 <label for="activo" class="control-label">Activo &nbsp; &nbsp;  &nbsp; &nbsp;</label>
                 <input type="radio" name="cuentas" id="activo" value="activo" />
  			     <span class="help-block"></span>
            </div>
		    </div>
		     <div class="col-xs-4 col-md-4">
		    <div class="form-group">
                 <label for="pasivo" class="control-label">Pasivo  &nbsp; &nbsp; &nbsp; </label>
                 <input type="radio" name="cuentas" id="pasivo" value="pasivo" />
  			     <span class="help-block"></span>
            </div>
		    </div>
		     <div class="col-xs-4 col-md-4">
		    <div class="form-group">
                 <label for="patrimonio" class="control-label">Patrimonio  &nbsp; &nbsp;</label>
                 <input type="radio" name="cuentas" id="patrimonio" value="patrimonio" />
  			     <span class="help-block"></span>
            </div>
		    </div>
		     <div class="col-xs-4 col-md-4">
		    <div class="form-group">
                 <label for="ingresos" class="control-label">Ingresos  &nbsp; &nbsp;</label>
                 <input type="radio" name="cuentas" id="ingresos" value="activo" />
  			     <span class="help-block"></span>
            </div>
		    </div>
		     <div class="col-xs-4 col-md-4">
		    <div class="form-group">
                 <label for="egresos" class="control-label">Egresos  &nbsp; &nbsp;</label>
                 <input type="radio" name="cuentas" id="egresos" value="egresos" />
  			     <span class="help-block"></span>
            </div>
		    </div>
			</div>
            
            <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="id_grupo" class="control-label">Grupo</label>
                 <select name="id_grupo" id="id_grupo"  class="form-control" >
					 <?php if(!empty($resultGrupo)){ foreach($resultGrupo as $res) {?>
					 <option value="<?php echo $res->id_entidades; ?>" ><?php echo $res->nombre_entidades; ?> </option>
					 <?php } }else{?>
					 <option value="-1" >Sin Grupos</option>
					 <?php }?>
			     </select> 
			     <span class="help-block"></span> 
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                  <label for="agregar_grupo" class="control-label">Agregar Grupo</label>
                  <button type="button" class="form-control btn btn-success" id="agregar_grupo"><span class="glyphicon glyphicon-plus"></span> Agregar</button>
                  <span class="help-block"></span>
            </div>
            </div>
            <div id="modal"></div>
			</div>
			
			<div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="id_subgrupo" class="control-label">SubGrupo</label>
                 <select name="id_subgrupo" id="id_subgrupo"  class="form-control" >
					 <?php if(!empty($resultSubGrupo)){ foreach($resultSubGrupo as $res) {?>
					 <option value="<?php echo $res->id_entidades; ?>" ><?php echo $res->nombre_entidades; ?> </option>
					 <?php } }else{?>
					 <option value="-1" >Sin Grupos</option>
					 <?php }?>
			     </select> 
			    <span class="help-block"></span>
            </div>
		    </div>
		    
		     <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                  <label for="agregar_subgrupo" class="control-label">Agregar SubGrupo</label>
                  <button type="button" class="form-control btn btn-success" id="agregar_subgrupo"><span class="glyphicon glyphicon-plus"></span> Agregar</button>
                  <span class="help-block"></span>
            </div>
            </div>
			</div>
            
		    <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="" class="control-label">Codigo</label><br>
                 <div class="row">
	                 <div class="col-xs-8 col-md-8">
	                 <input type="text" class="form-control " id="codigo1" name="codigo1" value="" >
	                 </div>
	                 <div class="col-xs-4 col-md-4">
	                 <input type="text" class="form-control" id="codigo2" name="codigo1" value="" >
	                 </div>
                 </div>
                 <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="nombre_cuentas" class="control-label">Nombre Cuenta</label>
                 <input type="text" class="form-control" id="nombre_cuentas" name="nombre_cuentas" value=""  placeholder="Nombre">
                 <span class="help-block"></span>
            </div>
            </div>
			</div>
	         
	        <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="id_moneda" class="control-label">Moneda</label>
                 <select name="id_moneda" id="id_moneda"  class="form-control" >
					 <?php if(!empty($resultMoneda)){ foreach($resultMoneda as $res) {?>
					 <option value="<?php echo $res->id_monedas; ?>" ><?php echo $res->nombre_monedas; ?> </option>
					 <?php } }else{?>
					 <option value="-1" >Sin Moneda</option>
					 <?php }?>
			     </select> 
			     <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="id_tipo" class="control-label">Tipo</label>
                 <select name="id_tipo" id="id_tipo"  class="form-control" >
					 <?php if(!empty($t_plan_cuentas)){ foreach($t_plan_cuentas as $res=>$val) {?>
					 <option value="<?php echo $res;?>" ><?php echo $val; ?> </option>
					 <?php } }else{?>
					 <option value="-1" >Sin Tipo</option>
					 <?php }?>
			     </select> 
			    <span class="help-block"></span>
            </div>
            </div>
			</div>
	        
	        
	        <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="s/d" class="control-label">s/d</label>
                 <input type="text" class="form-control" id="s/d" name="s/d" value=""  placeholder="Ciudad">
                 <span class="help-block"></span>
            </div>
		    </div>
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="nivel" class="control-label">Nivel</label>
                 <input type="text" class="form-control" id="nivel" name="nivel" value=""  placeholder="Ciudad">
                 <span class="help-block"></span>
            </div>
		    </div>
		    </div>
		    </div>
		    
		     <?php } ?>
		     
		    <div class="row">
		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;">
		    <div class="form-group">
                 <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">Guardar</button>
           
            </div>
		    </div>
		    </div>
            
            
            </form>
       
       
            
            <form action="<?php echo $helper->url("PlanCuentas","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
     		<br>
     		<div class="well">  
            <h4 style="color:#ec971f;">Plan de Cuentas Registrados</h4>
            
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
			                    <a href="<?php echo $helper->url("PlanCuentas","index"); ?>&id_entidades=<?php echo $res->id_entidades; ?>" class="btn btn-warning" onClick="notificacion()" style="font-size:65%;">Editar</a>
			                </div>
			            
			            </td>
			            <td>   
			               	<div class="right">
			                    <a href="<?php echo $helper->url("PlanCuentas","borrarId"); ?>&id_entidades=<?php echo $res->id_entidades; ?>" class="btn btn-danger" onClick="Borrar()" style="font-size:65%;">Borrar</a>
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
			 <br>
			 <br> 
  
       
             <footer class="col-lg-12">
			 <?php include("view/modulos/footer.php"); ?>
			 </footer>
        
    </body>  
    </html>          