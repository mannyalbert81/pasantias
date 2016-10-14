<?php
  session_start();
  $_id_usuarios= $_SESSION['id_usuarios'];
  
    	$conn  = pg_connect("user=postgres port=5432 password=.Romina.2012 dbname=contabilidad host=186.4.241.148");
		
		if(!$conn)
		{
			die( "No se pudo conectar");
		}

		
		 $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
		  if($action == 'ajax'){
		  
		  	
			include 'pagination.php'; //incluir el archivo de paginación
			//las variables de paginación
			$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
			$per_page = 10; //la cantidad de registros que desea mostrar
			$adjacents  = 4; //brecha entre páginas después de varios adyacentes
			$offset = ($page - 1) * $per_page;
			//Cuenta el número total de filas de la tabla*/
			
			
			
			
			$count_query   = pg_query($conn,"SELECT count(*) AS numrows FROM plan_cuentas, entidades, usuarios WHERE entidades.id_entidades = plan_cuentas.id_entidades AND
            entidades.id_entidades = usuarios.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND plan_cuentas.nivel_plan_cuentas='5'");
			if ($row= pg_fetch_array($count_query)){$numrows = $row['numrows'];}
			$total_pages = ceil($numrows/$per_page);
			$reload = 'index.php';
			//consulta principal para recuperar los datos
			$query = pg_query($conn,"SELECT * FROM plan_cuentas, entidades, usuarios WHERE entidades.id_entidades = plan_cuentas.id_entidades AND
            entidades.id_entidades = usuarios.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND plan_cuentas.nivel_plan_cuentas='5' order by codigo_plan_cuentas");
		
			if ($numrows>0){
				?>
				 <section style="height:450px; overflow-y:scroll;">
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
				</section>
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