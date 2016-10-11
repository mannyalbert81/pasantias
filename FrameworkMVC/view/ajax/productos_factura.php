<?php
  session_start();
	
  
  
	
	
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
	
		
		
		$conn  = pg_connect("user=postgres port=5432 password=.Romina.2012 dbname=contabilidad host=186.4.241.148");
		
		if(!$conn)
		{
			die( "No se pudo conectar");
		}
		
		$id_usuarios=$_SESSION['id_usuarios'];
		
		
		$columnas ="plan_cuentas.id_plan_cuentas,
			  plan_cuentas.codigo_plan_cuentas,
			  plan_cuentas.nombre_plan_cuentas,
			  entidades.id_entidades,
			  entidades.nombre_entidades";
		
		$tablas =" public.usuarios,
			  public.plan_cuentas,
			  public.entidades";
		
		$where ="usuarios.id_entidades = plan_cuentas.id_entidades AND
		plan_cuentas.id_entidades = entidades.id_entidades AND usuarios.id_usuarios = '$id_usuarios'";
		
		$id ="plan_cuentas.id_plan_cuentas";
		
		
		$query=pg_query($conn, "SELECT $columnas FROM $tablas WHERE $where ORDER BY $id  ASC");
		
		$resultSet = array();
		
		while ($row = pg_fetch_object($query)) {
			$resultSet[]=$row;
		}
		
		//$q = $_REQUEST['q'];
		$q = pg_escape_string($conn,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
			
		$aColumns = array('codigo_plan_cuentas', 'nombre_plan_cuentas');//Columnas de busqueda
		$sTable = "plan_cuentas";
		$sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		
		
		include 'pagination.php'; //include pagination file
		
		
		
		
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 5; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = pg_query($conn, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= pg_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './index.php';
		
		
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset OFFSET $per_page";
		$query = pg_query($conn, $sql);
		
		
		//$query=pg_query($conn, "SELECT $columnas FROM $tablas WHERE $where LIMIT $offset offset $per_page");
		
		
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="warning">
					<th>Código</th>
					<th>Nombre</th>
					<th>Descripcion</th>
					<th>Debe</th>
					<th>Haber</th>
					<th class='text-center' style="width: 36px;">Agregar</th>
				</tr>
					<?php
					$id_plan_cuentas="";
					$codigo_plan_cuentas="";
					$nombre_plan_cuentas="";
					
					foreach($resultSet as $res) 
					{
						$id_plan_cuentas                               =$res->id_plan_cuentas;
						$codigo_plan_cuentas						   =$res->codigo_plan_cuentas;
						$nombre_plan_cuentas                           =$res->nombre_plan_cuentas;
						
						?>
											<tr>
												<td><?php echo $codigo_plan_cuentas; ?></td>
												<td><?php echo $nombre_plan_cuentas; ?></td>
												<td class='col-xs-6'>
												<input type="text" class="form-control" style="text-align:right" id="descripcion_<?php echo $id_plan_cuentas; ?>"  value="" >
												</td>
												<td class='col-xs-2'>
												<div class="pull-right">
												<input type="text" class="form-control" style="text-align:right" id="debe_<?php echo $id_plan_cuentas; ?>"  value="" >
												</div></td>
												<td class='col-xs-2'><div class="pull-right">
												<input type="text" class="form-control" style="text-align:right" id="haber_<?php echo $id_plan_cuentas; ?>"  value="" >
												</div></td>
												<td class='text-center'><a class='btn btn-info'href="#" onclick="agregar('<?php echo $id_plan_cuentas ?>')"><i class="glyphicon glyphicon-plus"></i></a></td>
											</tr>
											<?php
					}
					
					
					?>
				   <tr>
					<td colspan=5><span class="pull-right"><?
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
			}
			}
			pg_close($conn);
				
				
?>