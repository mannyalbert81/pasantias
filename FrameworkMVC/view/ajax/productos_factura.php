<?php
  session_start();
	
  
		$conn  = pg_connect("user=postgres port=5432 password=.Romina.2012 dbname=contabilidad host=186.4.241.148");
		
		if(!$conn)
		{
			die( "No se pudo conectar");
		}
	
	
		$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
		if($action == 'ajax'){
			
			
			include 'pagination.php'; 
			
			
			$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
			$per_page = 10; 
			$adjacents  = 4;
			$offset = ($page - 1) * $per_page;
			
			
			$count_query   = pg_query($conn,"SELECT count(*) AS numrows FROM plan_cuentas ");
			if ($row= pg_fetch_array($count_query)){$numrows = $row['numrows'];}
			$total_pages = ceil($numrows/$per_page);
			$reload = 'index.php';
			
			$query = pg_query($con,"SELECT * FROM plan_cuentas  order by codigo_plan_cuentas LIMIT $offset,$per_page");
		
			if ($numrows>0){
				?>
				<table class="table table-bordered">
					  <thead>
						<tr>
						  <th>Código</th>
						  <th>Nombre</th>
						</tr>
					</thead>
					<tbody>
					<?php
					
					while($row = pg_fetch_array($query)){
						?>
						<tr>
							<td><?php echo $row['codigo_plan_cuentas'];?></td>
							<td><?php echo $row['nombre_plan_cuentas'];?></td>
							
						</tr>
						<?php
					}
					?>
					</tbody>
				</table>
				<div class="table-pagination pull-right">
					<?php echo paginate($reload, $page, $total_pages, $adjacents);?>
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