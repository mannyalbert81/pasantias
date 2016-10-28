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
		  
		  	$e =  pg_escape_string($conn,(strip_tags($_REQUEST['e'], ENT_QUOTES)));
		  
		  	if ( $_GET['e'] != "" )
		  	{
		  	
		  	//$q = "codigo_plan_cuentas LIKE '%".$q."%'";
		  	//$q = "nombre_plan_cuentas LIKE '%".$q."%'";
		  	}
		  	
		  
		  	
		  	/*
		  	$q =  pg_escape_string($conn,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		  	$aColumns = array('codigo_plan_cuentas', 'nombre_plan_cuentas');//Columnas de busqueda
		  	$sTable = "plan_cuentas";
		  	$sWhere = "";
		  	
		  	if ( $_GET['q'] != "" )
		  	{
		  		
		  		
		  		$sWhere= "WHERE(";
		  		
		  		$sWhere = " WHERE (";
		  		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		  		{
		  			$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
		  		}
		  		$sWhere = substr_replace( $sWhere, "", -3 );
		  		$sWhere .= ')';
		  		
		  	}
		  	
		  	*/
			include 'pagination.php'; 
			//las variables de paginación
			
			
			$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
			$per_page = 10; //la cantidad de registros que desea mostrar
			$adjacents  = 4; //brecha entre páginas después de varios adyacentes
			$offset = ($page - 1) * $per_page;
			
			
			
			
			$count_query   = pg_query($conn,"SELECT count(*) AS numrows FROM public.ccomprobantes, public.usuarios, public.tipo_comprobantes, public.entidades WHERE ccomprobantes.id_usuarios = usuarios.id_usuarios AND
            ccomprobantes.id_entidades = entidades.id_entidades AND tipo_comprobantes.id_tipo_comprobantes = ccomprobantes.id_tipo_comprobantes AND entidades.id_entidades = usuarios.id_entidades AND nombre_tipo_comprobantes='EGRESOS' AND usuarios.id_usuarios='$_id_usuarios'  AND (ccomprobantes.ruc_ccomprobantes LIKE '%".$e."%' OR ccomprobantes.nombres_ccomprobantes LIKE '%".$e."%' OR ccomprobantes.numero_ccomprobantes LIKE '%".$e."%')");
			
			if ($row= pg_fetch_array($count_query)){$numrows = $row['numrows'];}
			$total_pages = ceil($numrows/$per_page);
			$reload = 'index.php';
			//consulta principal para recuperar los datos
			$query = pg_query($conn,"SELECT * FROM public.ccomprobantes, public.usuarios, public.tipo_comprobantes, public.entidades WHERE ccomprobantes.id_usuarios = usuarios.id_usuarios AND
            ccomprobantes.id_entidades = entidades.id_entidades AND tipo_comprobantes.id_tipo_comprobantes = ccomprobantes.id_tipo_comprobantes AND entidades.id_entidades = usuarios.id_entidades AND nombre_tipo_comprobantes='EGRESOS' AND usuarios.id_usuarios='$_id_usuarios'  AND (ccomprobantes.ruc_ccomprobantes LIKE '%".$e."%' OR ccomprobantes.nombres_ccomprobantes LIKE '%".$e."%' OR ccomprobantes.numero_ccomprobantes LIKE '%".$e."%') ORDER BY ccomprobantes.numero_ccomprobantes LIMIT $per_page OFFSET $offset");
			
			
			if ($numrows>0){
				?>
				 <section style="height:425px; overflow-y:scroll;">
                  <table class="table table-hover">
					  <thead>
						<tr class="info">
						  <th>Ruc</th>
						  <th>Nombre</th>
						  <th># Comprobante</th>
						  <th>Concepto</th>
						   <th class='text-center' colspan=2>Monto</th>
						  <th>Fecha</th>
						  <th></th>
						
						</tr>
					</thead>
					<tbody>
					<?php
					while($row = pg_fetch_array($query)){
						$id_ccomprobantes=$row['id_ccomprobantes'];
							
						?>
						<tr>
							<td><?php echo $row['ruc_ccomprobantes'];?></td>
							<td><?php echo $row['nombres_ccomprobantes'];?></td>
							<td><?php echo $row['numero_ccomprobantes'];?></td>
							<td><?php echo $row['concepto_ccomprobantes'];?></td>
							<td><?php echo $row['valor_ccomprobantes'];?></td>
							<td><?php echo $row['valor_letras'];?></td>
							<td><?php echo $row['fecha_ccomprobantes'];?></td>
							<td>
							<span class="pull-right">
							<a href="/contabilidad/FrameworkMVC/view/ireports/ContComprobanteEgresosReport.php?id_ccomprobantes=<?php echo $id_ccomprobantes; ?>"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"><i class="glyphicon glyphicon-print"></i></a>
							</span>
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