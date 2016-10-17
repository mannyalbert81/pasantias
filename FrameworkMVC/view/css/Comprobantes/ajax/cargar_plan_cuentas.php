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
		  
		  	$q =  pg_escape_string($conn,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		  
		  	if ( $_GET['q'] != "" )
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
			
			
			
			
			$count_query   = pg_query($conn,"SELECT count(*) AS numrows FROM plan_cuentas, entidades, usuarios WHERE entidades.id_entidades = plan_cuentas.id_entidades AND
            entidades.id_entidades = usuarios.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND nivel_plan_cuentas='5' AND (plan_cuentas.codigo_plan_cuentas LIKE '%".$q."%' OR plan_cuentas.nombre_plan_cuentas LIKE '%".$q."%')");
			
			if ($row= pg_fetch_array($count_query)){$numrows = $row['numrows'];}
			$total_pages = ceil($numrows/$per_page);
			$reload = 'index.php';
			//consulta principal para recuperar los datos
			$query = pg_query($conn,"SELECT * FROM plan_cuentas, entidades, usuarios WHERE entidades.id_entidades = plan_cuentas.id_entidades AND
            entidades.id_entidades = usuarios.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND nivel_plan_cuentas='5' AND (plan_cuentas.codigo_plan_cuentas LIKE '%".$q."%' OR plan_cuentas.nombre_plan_cuentas LIKE '%".$q."%') ORDER BY codigo_plan_cuentas LIMIT $per_page OFFSET $offset");
			
			
			if ($numrows>0){
				?>
				 <section style="height:425px; overflow-y:scroll;">
                  <table class="table table-hover">
					  <thead>
						<tr class="info">
						  <th>Código Cuenta</th>
						  <th>Nombre Cuenta</th>
						
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