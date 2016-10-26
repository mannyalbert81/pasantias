	
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
$numero_ccomprobantes=0;
$referencia_doc_ccomprobantes=0;
$fecha_desde=0;
$fecha_hasta=0;
$id_usuarios=0;
$sql="";
$detallesql="";

$id_tipo_comprobantes= $_GET['id_tipo_comprobantes'];

if($id_tipo_comprobantes=="INGRESOS"){

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
	
if ($_GET['numero_ccomprobantes']!="")
{
		
	$numero_ccomprobantes= $_GET['numero_ccomprobantes'];
	$detallesql=$detallesql." AND ccomprobantes.numero_ccomprobantes = '$numero_ccomprobantes'";
}
	
if ($_GET['referencia_doc_ccomprobantes']!="")
{
		
	$referencia_doc_ccomprobantes= $_GET['referencia_doc_ccomprobantes'];
	$detallesql=$detallesql." AND ccomprobantes.referencia_doc_ccomprobantes = '$referencia_doc_ccomprobantes'";
}
	
if ($_GET['fecha_desde']!="" && $_GET['fecha_hasta']!="")
{
	
	$fecha_desde= $_GET['fecha_desde'];
	$fecha_hasta= $_GET['fecha_hasta'];
	$detallesql=$detallesql." AND  ccomprobantes.fecha_ccomprobantes BETWEEN '$fecha_desde' AND '$fecha_hasta'";
}
	
if ($_GET['id_usuarios']!=0)
{

	$id_usuarios= $_GET['id_usuarios'];
	$detallesql=$detallesql." AND usuarios.id_usuarios = '$id_usuarios'";
}	
	
 $cabeceraSql="select           ccomprobantes.id_ccomprobantes, 
								  tipo_comprobantes.nombre_tipo_comprobantes, 
								  ccomprobantes.concepto_ccomprobantes, 
								  usuarios.nombre_usuarios, 
								  entidades.nombre_entidades, 
								  ccomprobantes.valor_letras, 
								  ccomprobantes.fecha_ccomprobantes, 
								  ccomprobantes.numero_ccomprobantes, 
								  ccomprobantes.ruc_ccomprobantes, 
								  ccomprobantes.nombres_ccomprobantes, 
								  ccomprobantes.retencion_ccomprobantes, 
								  ccomprobantes.valor_ccomprobantes, 
								  ccomprobantes.referencia_doc_ccomprobantes, 
								  ccomprobantes.numero_cuenta_banco_ccomprobantes, 
								  ccomprobantes.numero_cheque_ccomprobantes, 
								  ccomprobantes.observaciones_ccomprobantes, 
								  forma_pago.nombre_forma_pago

	from	                    public.ccomprobantes, 
							  public.entidades, 
							  public.usuarios, 
							  public.tipo_comprobantes, 
							  public.forma_pago

	where		    ccomprobantes.id_forma_pago = forma_pago.id_forma_pago AND
							  entidades.id_entidades = usuarios.id_entidades AND
							  usuarios.id_usuarios = ccomprobantes.id_usuarios AND
							  tipo_comprobantes.id_tipo_comprobantes = ccomprobantes.id_tipo_comprobantes ";

 
 
 
$sql=$cabeceraSql.$detallesql;



$PHPJasperXML = new PHPJasperXML("en","TCPDF");
$PHPJasperXML->debugsql=false;
//$PHPJasperXML->arrayParameter=array("_id_entidades"=>$id_entidades, "_id_tipo_operaciones"=>$id_tipo_operaciones, "_id_tipo_contenido_cartones"=>$id_tipo_contenido_cartones, "_numero_cartones"=>$numero_cartones);
$PHPJasperXML->arrayParameter=array("sql"=>$sql);
$PHPJasperXML->load_xml_file("ImprimirComprobanteIngresosReport.jrxml");

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
$PHPJasperXML->outpage("I");
}

if($id_tipo_comprobantes=="EGRESOS"){
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
	
	if ($_GET['numero_ccomprobantes']!="")
	{
	
		$numero_ccomprobantes= $_GET['numero_ccomprobantes'];
		$detallesql=$detallesql." AND ccomprobantes.numero_ccomprobantes = '$numero_ccomprobantes'";
	}
	
	if ($_GET['referencia_doc_ccomprobantes']!="")
	{
	
		$referencia_doc_ccomprobantes= $_GET['referencia_doc_ccomprobantes'];
		$detallesql=$detallesql." AND ccomprobantes.referencia_doc_ccomprobantes = '$referencia_doc_ccomprobantes'";
	}
	
	if ($_GET['fecha_desde']!="" && $_GET['fecha_hasta']!="")
	{
	
		$fecha_desde= $_GET['fecha_desde'];
		$fecha_hasta= $_GET['fecha_hasta'];
		$detallesql=$detallesql." AND  ccomprobantes.fecha_ccomprobantes BETWEEN '$fecha_desde' AND '$fecha_hasta'";
	}
	
	if ($_GET['id_usuarios']!=0)
	{
	
		$id_usuarios= $_GET['id_usuarios'];
		$detallesql=$detallesql." AND usuarios.id_usuarios = '$id_usuarios'";
	}
	
	$cabeceraSql="select           ccomprobantes.id_ccomprobantes,
								  tipo_comprobantes.nombre_tipo_comprobantes,
								  ccomprobantes.concepto_ccomprobantes,
								  usuarios.nombre_usuarios,
								  entidades.nombre_entidades,
								  ccomprobantes.valor_letras,
								  ccomprobantes.fecha_ccomprobantes,
								  ccomprobantes.numero_ccomprobantes,
								  ccomprobantes.ruc_ccomprobantes,
								  ccomprobantes.nombres_ccomprobantes,
								  ccomprobantes.retencion_ccomprobantes,
								  ccomprobantes.valor_ccomprobantes,
								  ccomprobantes.referencia_doc_ccomprobantes,
								  ccomprobantes.numero_cuenta_banco_ccomprobantes,
								  ccomprobantes.numero_cheque_ccomprobantes,
								  ccomprobantes.observaciones_ccomprobantes,
								  forma_pago.nombre_forma_pago
	
	from	                    public.ccomprobantes,
							  public.entidades,
							  public.usuarios,
							  public.tipo_comprobantes,
							  public.forma_pago
	
	where		    ccomprobantes.id_forma_pago = forma_pago.id_forma_pago AND
							  entidades.id_entidades = usuarios.id_entidades AND
							  usuarios.id_usuarios = ccomprobantes.id_usuarios AND
							  tipo_comprobantes.id_tipo_comprobantes = ccomprobantes.id_tipo_comprobantes ";
	
	
	
	
	$sql=$cabeceraSql.$detallesql;
	
	
	
	$PHPJasperXML = new PHPJasperXML("en","TCPDF");
	$PHPJasperXML->debugsql=false;
	//$PHPJasperXML->arrayParameter=array("_id_entidades"=>$id_entidades, "_id_tipo_operaciones"=>$id_tipo_operaciones, "_id_tipo_contenido_cartones"=>$id_tipo_contenido_cartones, "_numero_cartones"=>$numero_cartones);
	$PHPJasperXML->arrayParameter=array("sql"=>$sql);
	$PHPJasperXML->load_xml_file("ImprimirComprobanteEgresosReport.jrxml");
	
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
 	
 	if ($_GET['numero_ccomprobantes']!="")
 	{
 	
 		$numero_ccomprobantes= $_GET['numero_ccomprobantes'];
 		$detallesql=$detallesql." AND ccomprobantes.numero_ccomprobantes = '$numero_ccomprobantes'";
 	}
 	
 	if ($_GET['referencia_doc_ccomprobantes']!="")
 	{
 	
 		$referencia_doc_ccomprobantes= $_GET['referencia_doc_ccomprobantes'];
 		$detallesql=$detallesql." AND ccomprobantes.referencia_doc_ccomprobantes = '$referencia_doc_ccomprobantes'";
 	}
 	
 	if ($_GET['fecha_desde']!="" && $_GET['fecha_hasta']!="")
 	{
 	
 		$fecha_desde= $_GET['fecha_desde'];
 		$fecha_hasta= $_GET['fecha_hasta'];
 		$detallesql=$detallesql." AND  ccomprobantes.fecha_ccomprobantes BETWEEN '$fecha_desde' AND '$fecha_hasta'";
 	}
 	
 	if ($_GET['id_usuarios']!=0)
 	{
 	
 		$id_usuarios= $_GET['id_usuarios'];
 		$detallesql=$detallesql." AND usuarios.id_usuarios = '$id_usuarios'";
 	}
 	
 	$cabeceraSql="select           ccomprobantes.id_ccomprobantes,
								  tipo_comprobantes.nombre_tipo_comprobantes,
								  ccomprobantes.concepto_ccomprobantes,
								  usuarios.nombre_usuarios,
								  entidades.nombre_entidades,
								  ccomprobantes.valor_letras,
								  ccomprobantes.fecha_ccomprobantes,
								  ccomprobantes.numero_ccomprobantes,
								  ccomprobantes.ruc_ccomprobantes,
								  ccomprobantes.nombres_ccomprobantes,
								  ccomprobantes.retencion_ccomprobantes,
								  ccomprobantes.valor_ccomprobantes,
								  ccomprobantes.referencia_doc_ccomprobantes,
								  ccomprobantes.numero_cuenta_banco_ccomprobantes,
								  ccomprobantes.numero_cheque_ccomprobantes,
								  ccomprobantes.observaciones_ccomprobantes,
								  forma_pago.nombre_forma_pago
 	
	from	                    public.ccomprobantes,
							  public.entidades,
							  public.usuarios,
							  public.tipo_comprobantes,
							  public.forma_pago
 	
	where		    ccomprobantes.id_forma_pago = forma_pago.id_forma_pago AND
							  entidades.id_entidades = usuarios.id_entidades AND
							  usuarios.id_usuarios = ccomprobantes.id_usuarios AND
							  tipo_comprobantes.id_tipo_comprobantes = ccomprobantes.id_tipo_comprobantes ";
 	
 	
 	
 	
 	$sql=$cabeceraSql.$detallesql;
 	
 	
 	
 	$PHPJasperXML = new PHPJasperXML("en","TCPDF");
 	$PHPJasperXML->debugsql=false;
 	//$PHPJasperXML->arrayParameter=array("_id_entidades"=>$id_entidades, "_id_tipo_operaciones"=>$id_tipo_operaciones, "_id_tipo_contenido_cartones"=>$id_tipo_contenido_cartones, "_numero_cartones"=>$numero_cartones);
 	$PHPJasperXML->arrayParameter=array("sql"=>$sql);
 	$PHPJasperXML->load_xml_file("ImprimirComprobanteContableReport.jrxml");
 	
 	$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
 	$PHPJasperXML->outpage("I");
 	
 }

?>


