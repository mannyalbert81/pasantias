<?php
  session_start();
  $_id_usuarios= $_SESSION['id_usuarios'];
  
    	$conn  = pg_connect("user=postgres port=5432 password=.Romina.2012 dbname=contabilidad_des host=186.4.241.148");
		
		if(!$conn)
		{
			die( "No se pudo conectar");
		}

		
		 $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
		  if($action == 'ajax'){
		  
		  	$c =  pg_escape_string($conn,(strip_tags($_REQUEST['c'], ENT_QUOTES)));
		  
		  	if ( $_GET['c'] != "" )
		  	{
		  	
		  	//$q = "codigo_plan_cuentas LIKE '%".$q."%'";
		  	//$q = "nombre_plan_cuentas LIKE '%".$q."%'";
		  	}
		  	
		  
			include 'pagination.php'; 
			//las variables de paginación
			
			
			$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
			$per_page = 10; //la cantidad de registros que desea mostrar
			$adjacents  = 4; //brecha entre páginas después de varios adyacentes
			$offset = ($page - 1) * $per_page;
			
			
			
			
			$count_query   = pg_query($conn,"SELECT count(*) AS numrows FROM public.ccomprobantes, public.usuarios, public.tipo_comprobantes, public.entidades WHERE ccomprobantes.id_usuarios = usuarios.id_usuarios AND
            ccomprobantes.id_entidades = entidades.id_entidades AND tipo_comprobantes.id_tipo_comprobantes = ccomprobantes.id_tipo_comprobantes AND entidades.id_entidades = usuarios.id_entidades AND nombre_tipo_comprobantes='CONTABLE' AND usuarios.id_usuarios='$_id_usuarios'  ");
			
			if ($row= pg_fetch_array($count_query)){$numrows = $row['numrows'];}
			$total_pages = ceil($numrows/$per_page);
			$reload = 'index.php';
			//consulta principal para recuperar los datos
			
			$query = pg_query($conn,"SELECT * FROM public.ccomprobantes, public.usuarios, public.tipo_comprobantes, public.entidades WHERE ccomprobantes.id_usuarios = usuarios.id_usuarios AND
            ccomprobantes.id_entidades = entidades.id_entidades AND tipo_comprobantes.id_tipo_comprobantes = ccomprobantes.id_tipo_comprobantes AND entidades.id_entidades = usuarios.id_entidades AND nombre_tipo_comprobantes='CONTABLE' AND usuarios.id_usuarios='$_id_usuarios'  AND (ccomprobantes.concepto_ccomprobantes LIKE '%".$c."%' OR ccomprobantes.numero_ccomprobantes LIKE '%".$c."%') ORDER BY ccomprobantes.numero_ccomprobantes LIMIT $per_page OFFSET $offset");
			
			if ($numrows>0){
				?>
				 <section style="height:425px; overflow-y:scroll;">
                  <table class="table table-hover">
					  <thead>
						<tr class="info">
						  <th># Comprobante</th>
						  <th>Concepto</th>
						  <th>Valor</th>
						  <th>Acciones</th>
						</tr>
					</thead>
					<tbody>
					<?php
					while($row = pg_fetch_array($query)){
						
						$id_ccomprobantes=$row['id_ccomprobantes'];
						?>
						<tr>
							<td><?php echo $row['numero_ccomprobantes'];?></td>
							<td><?php echo $row['concepto_ccomprobantes'];?></td>
							<td><?php echo $row['valor_letras'];?></td>
							<td>
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#editar" data-id="<?php echo $row['id_ccomprobantes']?>" data-ruc="<?php echo $row['ruc_ccomprobantes']?>" data-nombres="<?php echo $row['nombres_ccomprobantes']?>" data-retencion="<?php echo $row['retencion_ccomprobantes']?>" data-concepto="<?php echo $row['concepto_ccomprobantes']?>" data-fecha="<?php echo $row['fecha_ccomprobantes']?>"><i class='glyphicon glyphicon-edit'>Editar</i></button>
					        <a href="/contabilidad/FrameworkMVC/view/ireports/ContComprobanteContableReport.php?id_ccomprobantes=<?php echo $id_ccomprobantes; ?>"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false" ><i class="glyphicon glyphicon-print"></i></a>
							</td>
					
						</tr>
						<?php
					}
					?>
					</tbody>
				</table>
				</section>
				
				<div class="table-pagination pull-right">
					<?php echo paginate($reload, $page, $total_pages, $adjacents);?>
				</div>
				<div class="col-md-3 col-lg-3 pull-left" style="margin-bottom:0px;">
				<span><strong>Registros: </strong><?php echo $numrows;?></span>
				</div>
		
				
					<?php
					
				} else {
					?>
					<div class="alert alert-warning alert-dismissable">
		              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		              <h4>Aviso!!!</h4> No hay datos para mostrar
		              
		            </div>
					<?php
				}
			}
					
?>