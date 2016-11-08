	
<?php 
#<?php 
#Importas la librer�a PhpJasperLibrary
ob_end_clean(); //add this line here

include_once('PhpJasperLibrary/class/tcpdf/tcpdf.php');
include_once("PhpJasperLibrary/class/PHPJasperXML.inc.php");

include_once ('conexion.php');

#Conectas a la base de datos 
$server  = server;
$user    = user;
$pass    = pass;
$db      = db;
$driver  = driver;
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
$PHPJasperXML->debugsql=false;


$id_entidades=0;
$id_tipo_comprobantes=0;
$reporte=0;
$fecha_desde=0;
$fecha_hasta=0;
$id_usuarios=0;
$sql="";
$detallesql="";


$reporte=$_GET['reporte'];

if($reporte=="detallado")
	
{

if ($_GET['id_entidades']!=0)
{
	$id_entidades=$_GET['id_entidades'];
	$detallesql=$detallesql." AND entidades.id_entidades = '$id_entidades'";
}
	
	
if ($_GET['id_tipo_comprobantes']!=0)
{

	$id_tipo_comprobantes= $_GET['id_tipo_comprobantes'];
	$detallesql=$detallesql." AND tipo_comprobantes.id_tipo_comprobantes = '$id_tipo_comprobantes'";
}
	

	
if ($_GET['fecha_desde']!="" && $_GET['fecha_hasta']!="")
{
	
	$fecha_desde= $_GET['fecha_desde'];
	$fecha_hasta= $_GET['fecha_hasta'];
	$detallesql=$detallesql." AND  mayor.fecha_mayor BETWEEN '$fecha_desde' AND '$fecha_hasta'";
}
	
if ($_GET['id_usuarios']!=0)
{

	$id_usuarios= $_GET['id_usuarios'];
	$detallesql=$detallesql." AND usuarios.id_usuarios = '$id_usuarios' ORDER BY  plan_cuentas.codigo_plan_cuentas, ccomprobantes.creado";
}	
	
 $cabeceraSql="select             mayor.id_mayor, 
								  ccomprobantes.id_ccomprobantes, 
								  usuarios.nombre_usuarios, 
								  tipo_comprobantes.nombre_tipo_comprobantes, 
								  entidades.nombre_entidades, 
 		                          entidades.ruc_entidades, 
								  entidades.telefono_entidades, 
								  entidades.direccion_entidades, 
								  entidades.ciudad_entidades,
 		                          ccomprobantes.concepto_ccomprobantes,
								  ccomprobantes.numero_ccomprobantes,
 		                          ccomprobantes.ruc_ccomprobantes, 
								  ccomprobantes.nombres_ccomprobantes, 
								  ccomprobantes.retencion_ccomprobantes, 
								  ccomprobantes.valor_ccomprobantes, 
								  ccomprobantes.valor_letras, 
								  ccomprobantes.fecha_ccomprobantes, 
								  ccomprobantes.referencia_doc_ccomprobantes, 
								  ccomprobantes.numero_cuenta_banco_ccomprobantes, 
								  ccomprobantes.numero_cheque_ccomprobantes, 
								  ccomprobantes.observaciones_ccomprobantes,  
								  plan_cuentas.id_plan_cuentas,
								  plan_cuentas.codigo_plan_cuentas, 
								  plan_cuentas.nombre_plan_cuentas, 
								  plan_cuentas.saldo_fin_plan_cuentas, 
								  mayor.fecha_mayor, 
								  mayor.debe_mayor, 
								  mayor.haber_mayor, 
								  mayor.saldo_mayor, 
								  mayor.saldo_ini_mayor, 
								  mayor.creado, 
								  ccomprobantes.creado

	from	                  public.ccomprobantes, 
							  public.mayor, 
							  public.plan_cuentas, 
							  public.tipo_comprobantes, 
							  public.usuarios, 
							  public.entidades

	where		    ccomprobantes.id_usuarios = usuarios.id_usuarios AND
							  mayor.id_ccomprobantes = ccomprobantes.id_ccomprobantes AND
							  plan_cuentas.id_plan_cuentas = mayor.id_plan_cuentas AND
							  tipo_comprobantes.id_tipo_comprobantes = ccomprobantes.id_tipo_comprobantes AND
							  entidades.id_entidades = ccomprobantes.id_entidades";

 
 
 
$sql=$cabeceraSql.$detallesql;

$PHPJasperXML = new PHPJasperXML("en","TCPDF");
$PHPJasperXML->debugsql=false;
//$PHPJasperXML->arrayParameter=array("_id_entidades"=>$id_entidades, "_id_tipo_operaciones"=>$id_tipo_operaciones, "_id_tipo_contenido_cartones"=>$id_tipo_contenido_cartones, "_numero_cartones"=>$numero_cartones);
$PHPJasperXML->arrayParameter=array("sql"=>$sql);
$PHPJasperXML->load_xml_file("MayorDetalladoReport.jrxml");

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
$PHPJasperXML->outpage("I");

}

else{

	if ($_GET['id_entidades']!=0)
	{
		$id_entidades=$_GET['id_entidades'];
		$detallesql=$detallesql." AND entidades.id_entidades = '$id_entidades'";
	}
	
	
	if ($_GET['id_tipo_comprobantes']!=0)
	{
	
		$id_tipo_comprobantes= $_GET['id_tipo_comprobantes'];
		$detallesql=$detallesql." AND tipo_comprobantes.id_tipo_comprobantes = '$id_tipo_comprobantes'";
	}
	
	
	
	if ($_GET['fecha_desde']!="" && $_GET['fecha_hasta']!="")
	{
	
		$fecha_desde= $_GET['fecha_desde'];
		$fecha_hasta= $_GET['fecha_hasta'];
		$detallesql=$detallesql." AND  mayor.fecha_mayor BETWEEN '$fecha_desde' AND '$fecha_hasta'";
	}
	
	if ($_GET['id_usuarios']!=0)
	{
	
		$id_usuarios= $_GET['id_usuarios'];
		$detallesql=$detallesql." AND usuarios.id_usuarios = '$id_usuarios'";
	}
	
	$cabeceraSql="select          mayor.id_mayor,
								  ccomprobantes.id_ccomprobantes,
								  usuarios.nombre_usuarios,
								  tipo_comprobantes.nombre_tipo_comprobantes,
								  entidades.nombre_entidades,
			                      entidades.ruc_entidades, 
								  entidades.telefono_entidades, 
								  entidades.direccion_entidades, 
								  entidades.ciudad_entidades,
								  ccomprobantes.numero_ccomprobantes,
								  ccomprobantes.concepto_ccomprobantes,
			                      ccomprobantes.ruc_ccomprobantes, 
								  ccomprobantes.nombres_ccomprobantes, 
								  ccomprobantes.retencion_ccomprobantes, 
								  ccomprobantes.valor_ccomprobantes, 
								  ccomprobantes.valor_letras, 
								  ccomprobantes.fecha_ccomprobantes, 
								  ccomprobantes.referencia_doc_ccomprobantes, 
								  ccomprobantes.numero_cuenta_banco_ccomprobantes, 
								  ccomprobantes.numero_cheque_ccomprobantes, 
								  ccomprobantes.observaciones_ccomprobantes, 
								  plan_cuentas.id_plan_cuentas,
								  plan_cuentas.codigo_plan_cuentas,
								  plan_cuentas.nombre_plan_cuentas,
								  plan_cuentas.saldo_fin_plan_cuentas,
								  mayor.fecha_mayor,
								  mayor.debe_mayor,
								  mayor.haber_mayor,
								  mayor.saldo_mayor,
								  mayor.saldo_ini_mayor,
								  mayor.creado,
								  ccomprobantes.creado
	
	from	                  public.ccomprobantes,
							  public.mayor,
							  public.plan_cuentas,
							  public.tipo_comprobantes,
							  public.usuarios,
							  public.entidades
	
	where		    ccomprobantes.id_usuarios = usuarios.id_usuarios AND
							  mayor.id_ccomprobantes = ccomprobantes.id_ccomprobantes AND
							  plan_cuentas.id_plan_cuentas = mayor.id_plan_cuentas AND
							  tipo_comprobantes.id_tipo_comprobantes = ccomprobantes.id_tipo_comprobantes AND
							  entidades.id_entidades = ccomprobantes.id_entidades";
	
	
	
	
	$sql=$cabeceraSql.$detallesql;
	
	$PHPJasperXML = new PHPJasperXML("en","TCPDF");
	$PHPJasperXML->debugsql=false;
	//$PHPJasperXML->arrayParameter=array("_id_entidades"=>$id_entidades, "_id_tipo_operaciones"=>$id_tipo_operaciones, "_id_tipo_contenido_cartones"=>$id_tipo_contenido_cartones, "_numero_cartones"=>$numero_cartones);
	$PHPJasperXML->arrayParameter=array("sql"=>$sql);
	$PHPJasperXML->load_xml_file("MayorSimplificadoReport.jrxml");
	
	$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
	$PHPJasperXML->outpage("I");
	
}

?>


