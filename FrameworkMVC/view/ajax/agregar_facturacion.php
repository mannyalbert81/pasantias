<?php
$session_id= session_start();

$id_usuarios=$_SESSION['id_usuarios'];

if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['descripcion'])){$descripcion=$_POST['descripcion'];}
if (isset($_POST['debe'])){$debe=$_POST['debe'];}
if (isset($_POST['haber'])){$haber=$_POST['haber'];}




$conn  = pg_connect("user=postgres port=5432 password=.Romina.2012 dbname=contabilidad host=186.4.241.148");

if(!$conn)
{
	die( "No se pudo conectar");
}


if (!empty($id))
{
	//print_r($id_usuarios.' '.$id.','.$descripcion.','.$debe.','.$haber.'');
$insert_tmp = pg_query($conn, "INSERT INTO temp_comprobantes (id_usuario_registra, id_plan_cuentas, observacion_temp_comprobantes, debe_temp_comprobantes, haber_temp_comprobantes) VALUES ('$id_usuarios','$id','$descripcion','$debe','$haber')");

}
if (isset($_GET['id']))//codigo elimina un elemento del array
{
$id_tmp=intval($_GET['id']);	
$delete=pg_query($conn, "DELETE FROM temp_comprobantes WHERE id_temp_comprobantes='".$id_tmp."'");
}

?>
<table class="table">
<tr>
	<th class='text-center'>CUENTA</th>
	<th class='text-center'>NOMBRE</th>
	<th>DESCRIPCION</th>
	<th class='text-right'>DEBE</th>
	<th class='text-right'>HABER</th>
	<th></th>
</tr>

<?php
$resultSet = array();
$sumador_total=0;
$id_usuarios=$_SESSION['id_usuarios'];
$columnas ="temp_comprobantes.id_temp_comprobantes,
  plan_cuentas.id_plan_cuentas, 
  plan_cuentas.codigo_plan_cuentas, 
  plan_cuentas.nombre_plan_cuentas, 
  temp_comprobantes.observacion_temp_comprobantes, 
  temp_comprobantes.debe_temp_comprobantes, 
  temp_comprobantes.haber_temp_comprobantes";

$tablas ="public.usuarios, 
  public.temp_comprobantes, 
  public.plan_cuentas";

$where ="temp_comprobantes.id_usuario_registra = usuarios.id_usuarios AND
  plan_cuentas.id_plan_cuentas = temp_comprobantes.id_plan_cuentas AND temp_comprobantes.id_usuario_registra = '$id_usuarios'";

$id ="plan_cuentas.id_plan_cuentas";


$query=pg_query($conn, "SELECT $columnas FROM $tablas WHERE $where ORDER BY $id  ASC");



$id_temp_comprobantes ="";
$id_plan_cuentas ="";                          
$codigo_plan_cuentas="";						   
$nombre_plan_cuentas    ="";                       
$observacion_temp_comprobantes="";					
$debe_temp_comprobantes           ="";              
$haber_temp_comprobantes              ="";          


while ($row = pg_fetch_object($query)) {
	$resultSet[]=$row;
}


foreach($resultSet as $res)
{
	$id_temp_comprobantes                          =$res->id_temp_comprobantes;
	$id_plan_cuentas                               =$res->id_plan_cuentas;
	$codigo_plan_cuentas						   =$res->codigo_plan_cuentas;
	$nombre_plan_cuentas                           =$res->nombre_plan_cuentas;
	$observacion_temp_comprobantes						   =$res->observacion_temp_comprobantes;
	$debe_temp_comprobantes                           =$res->debe_temp_comprobantes;
	$haber_temp_comprobantes                           =$res->haber_temp_comprobantes;

	?>
	<tr>
	<td class='text-center'><?php echo $codigo_plan_cuentas;?></td>
				<td class='text-center'><?php echo $nombre_plan_cuentas;?></td>
				<td><?php echo $observacion_temp_comprobantes;?></td>
				<td class='text-right'><?php echo $debe_temp_comprobantes;?></td>
				<td class='text-right'><?php echo $haber_temp_comprobantes;?></td>
				<td class='text-center'><a href="#" onclick="eliminar('<?php echo $id_temp_comprobantes ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
			</tr>
	<?php 
	
}

?>
		

</table>
