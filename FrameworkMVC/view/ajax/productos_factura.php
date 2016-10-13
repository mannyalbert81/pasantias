<?php
  session_start();
	
  
  
	
	
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
	
		
		
		$conn  = pg_connect("user=postgres port=5432 password=.Romina.2012 dbname=contabilidad host=186.4.241.148");
		
		if(!$conn)
		{
			die( "No se pudo conectar");
		}
		/*
		$resultSet = array();
		
		$id_usuarios=$_SESSION['id_usuarios'];
		
		
		$columnas ="plan_cuentas.id_plan_cuentas,
				    plan_cuentas.codigo_plan_cuentas, 
                    plan_cuentas.nombre_plan_cuentas";
		
		$tablas ="public.entidades, 
				  public.plan_cuentas, 
				  public.usuarios";
		
		$where ="entidades.id_entidades = usuarios.id_entidades AND
                 entidades.id_entidades = plan_cuentas.id_entidades AND usuarios.id_usuarios = '$id_usuarios' AND plan_cuentas.nivel_plan_cuentas='3'";
		
		$id ="plan_cuentas.id_plan_cuentas";
		
		
		$query=pg_query($conn, "SELECT $columnas FROM $tablas WHERE $where ORDER BY $id  ASC");
		
		
		
		while ($row = pg_fetch_object($query)) {
			$resultSet[]=$row;
		}
		*/
		//$q = $_REQUEST['q'];
		$q = pg_escape_string($conn,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
			
		$aColumns = array('codigo_plan_cuentas', 'nombre_plan_cuentas');//Columnas de busqueda
		$sTable = "plan_cuentas";
		$sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$buscador=$_GET['q'];
			$sWhere = " WHERE (codigo_plan_cuentas LIKE '$buscador%' OR nombre_plan_cuentas LIKE '$buscador%')";
			
		}
		
		//include('pagination.php');
		
		$numrows=1;
		$sql="SELECT * FROM  $sTable $sWhere";
		$query = pg_query($conn, $sql);
		
		while ($row = pg_fetch_object($query)) {
			$resultSet[]=$row;
		}
		
		
		//$query=pg_query($conn, "SELECT $columnas FROM $tablas WHERE $where LIMIT $offset offset $per_page");
		
		
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="warning">
					<th>Código</th>
					<th>Nombre</th>
					
				</tr>
					<?php
					$id_plan_cuentas="";
					$codigo_plan_cuentas="";
					$nombre_plan_cuentas="";
					
					foreach($resultSet as $res) 
					{
						$codigo_plan_cuentas						   =$res->codigo_plan_cuentas;
						$nombre_plan_cuentas                           =$res->nombre_plan_cuentas;
						
						?>
											<tr>
												<td><?php echo $codigo_plan_cuentas; ?></td>
												<td><?php echo $nombre_plan_cuentas; ?></td>
										   </tr>
											<?php
					}
					
					
					?>
				   <tr>
					<td colspan=1><span class="pull-right"><?
					// echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
			}
			}
			pg_close($conn);
				
				
?>