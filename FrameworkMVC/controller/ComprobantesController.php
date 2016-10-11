<?php

class ComprobantesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

//maycol

	public function index(){
	
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		$d_comprobantes = new DComprobantesModel();
		
		$columnas_res = " temp_comprobantes.id_temp_comprobantes,
				          plan_cuentas.id_plan_cuentas,
		    		      plan_cuentas.codigo_plan_cuentas,
						  plan_cuentas.nombre_plan_cuentas,
						  temp_comprobantes.observacion_temp_comprobantes,
						  temp_comprobantes.debe_temp_comprobantes,
						  temp_comprobantes.haber_temp_comprobantes";
		$tablas_res ="public.temp_comprobantes,
						  public.usuarios,
						  public.plan_cuentas,
						  public.entidades";
		$where_res ="temp_comprobantes.id_plan_cuentas = plan_cuentas.id_plan_cuentas AND
		usuarios.id_usuarios = temp_comprobantes.id_usuario_registra AND
		usuarios.id_entidades = entidades.id_entidades AND
		entidades.id_entidades = plan_cuentas.id_entidades AND usuarios.id_usuarios='$_id_usuarios'";
		$id_res="plan_cuentas.codigo_plan_cuentas";
		
		$resultRes=$d_comprobantes->getCondiciones($columnas_res ,$tablas_res ,$where_res, $id_res);
		
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			
			
		    $columnas_enc = "entidades.nombre_entidades, 
							  consecutivos.nombre_consecutivos, 
							  consecutivos.numero_consecutivos";
		    $tablas_enc ="public.consecutivos, 
						  public.usuarios, 
						  public.entidades";
		    $where_enc ="consecutivos.id_entidades = usuarios.id_entidades AND
  					entidades.id_entidades = consecutivos.id_entidades AND consecutivos.nombre_consecutivos='INGRESOS' AND usuarios.id_usuarios='$_id_usuarios'";
		    $id_enc="entidades.nombre_entidades";
		    $resultSet=$d_comprobantes->getCondiciones($columnas_enc ,$tablas_enc ,$where_enc, $id_enc);
		    	
				
		    
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Comprobantes";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $permisos_rol->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
					
					
					$this->view("Comprobantes",array(
							
							"resultSet"=>$resultSet, "resultRes"=>$resultRes
					));
			
			
			}else{
				
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Generar Comprobantes"
				
					
				));
				exit();
			}
			
			
		}
		else
		{
	
			$this->view("ErrorSesion",array(
					"resultSet"=>""
		
						));
		}
	
	}
	 
	
	
	
	public function InsertarTemporal(){
		
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		
		
		$temp_comprobantes=new ComprobantesTemporalModel();
		$nombre_controladores = "Comprobantes";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $temp_comprobantes->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		if (isset ($_POST["plan_cuentas"]) && isset ($_POST["descripcion_dcomprobantes"]) && isset ($_POST["debe_dcomprobantes"]) && isset($_POST["haber_dcomprobantes"])  )
		{
		
		
			$_id_plan_cuentas= $_POST["plan_cuentas"];
			$_descripcion_dcomprobantes= $_POST["descripcion_dcomprobantes"];
			$_debe_dcomprobantes= $_POST["debe_dcomprobantes"];
		
			if ($_debe_dcomprobantes=="")
			{
				$_debe_dcomprobantes=0;
					
			}
			$_haber_dcomprobantes= $_POST["haber_dcomprobantes"];
		
			if ($_haber_dcomprobantes=="")
			{
				$_haber_dcomprobantes=0;
		
			}
		
			$funcion = "ins_temp_comprobantes";
			$parametros = "'$_id_usuarios','$_id_plan_cuentas','$_descripcion_dcomprobantes','$_debe_dcomprobantes','$_haber_dcomprobantes'";
			$temp_comprobantes->setFuncion($funcion);
			$temp_comprobantes->setParametros($parametros);
			$resultado=$temp_comprobantes->Insert();
		
		}
		
		$this->redirect("Comprobantes","index");
		
		}
		else
		{
			$this->view("Error",array(
		
					"resultado"=>"No tiene Permisos de Insertar Ciudades"
		
			));
		}
		
			
			
   }
		
	
   
   public function borrarId()
   {
   
   	session_start();
   
   	$permisos_rol=new PermisosRolesModel();
   	$nombre_controladores = "Comprobantes";
   	$id_rol= $_SESSION['id_rol'];
   	$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
   		
   	if (!empty($resultPer))
   	{
   		if(isset($_GET["id_temp_comprobantes"]))
   		{
   			$id_temp_comprobantes=(int)$_GET["id_temp_comprobantes"];
   
   			$temp_comprobantes=new ComprobantesTemporalModel();
   			
   			$temp_comprobantes->deleteBy(" id_temp_comprobantes",$id_temp_comprobantes);
   
   			$traza=new TrazasModel();
   			$_nombre_controlador = "Comprobantes";
   			$_accion_trazas  = "Borrar";
   			$_parametros_trazas = $id_temp_comprobantes;
   			$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
   		}
   			
   		$this->redirect("Comprobantes", "index");
   			
   			
   	}
   	else
   	{
   		$this->view("Error",array(
   				"resultado"=>"No tiene Permisos de Borrar Comprobantes"
		
   		));
   	}
   
   }
   
    
   
   
   
		
	
	public function AutocompleteComprobantesCodigo(){
		
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		$plan_cuentas = new PlanCuentasModel();
	    $codigo_plan_cuentas = $_GET['term'];
	
	    //$resultSet=$plan_cuentas->getBy("codigo_plan_cuentas LIKE '$codigo_plan_cuentas%'");
	    
	    
	    
		$columnas ="plan_cuentas.codigo_plan_cuentas, 
				  plan_cuentas.nombre_plan_cuentas, 
				  plan_cuentas.id_plan_cuentas";
		$tablas =" public.usuarios, 
				  public.entidades, 
				  public.plan_cuentas";
		$where ="plan_cuentas.codigo_plan_cuentas LIKE '$codigo_plan_cuentas%' AND entidades.id_entidades = usuarios.id_entidades AND
 				 plan_cuentas.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND plan_cuentas.nivel_plan_cuentas='3'";
		$id ="plan_cuentas.codigo_plan_cuentas";
		
		
		$resultSet=$plan_cuentas->getCondiciones($columnas, $tablas, $where, $id);
	
	
		if(!empty($resultSet)){
				
			foreach ($resultSet as $res){
	
				$_codigo_plan_cuentas[] = $res->codigo_plan_cuentas;
			}
			echo json_encode($_codigo_plan_cuentas);
		}
	
	}
	
	
	
	
	public function AutocompleteComprobantesDevuelveNombre(){
	
		$plan_cuentas = new PlanCuentasModel();
		
		$codigo_plan_cuentas = $_POST['codigo_plan_cuentas'];
	
		$resultSet = $plan_cuentas->getBy("codigo_plan_cuentas='$codigo_plan_cuentas'");
	    
		$respuesta = new stdClass();
	
		if(!empty($resultSet)){
				
			$respuesta->nombre_plan_cuentas = $resultSet[0]->nombre_plan_cuentas;
			$respuesta->id_plan_cuentas = $resultSet[0]->id_plan_cuentas;
				
			echo json_encode($respuesta);
		}
	
	}
	
	
	
	
	public function AutocompleteComprobantesNombre(){
	
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		$plan_cuentas = new PlanCuentasModel();
		$nombre_plan_cuentas = strtoupper($_GET['term']);
	
		//$resultSet=$plan_cuentas->getBy("codigo_plan_cuentas LIKE '$codigo_plan_cuentas%'");
		 
		 
		 
		$columnas ="plan_cuentas.codigo_plan_cuentas,
				  plan_cuentas.nombre_plan_cuentas,
				  plan_cuentas.id_plan_cuentas";
		$tablas =" public.usuarios,
				  public.entidades,
				  public.plan_cuentas";
		$where ="plan_cuentas.nombre_plan_cuentas LIKE '$nombre_plan_cuentas%' AND entidades.id_entidades = usuarios.id_entidades AND
		plan_cuentas.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND plan_cuentas.nivel_plan_cuentas='3'";
		$id ="plan_cuentas.codigo_plan_cuentas";
	
	
		$resultSet=$plan_cuentas->getCondiciones($columnas, $tablas, $where, $id);
	
	
		if(!empty($resultSet)){
	
			foreach ($resultSet as $res){
	
				$_nombre_plan_cuentas[] = $res->nombre_plan_cuentas;
			}
			echo json_encode($_nombre_plan_cuentas);
		}
	
	}
	
	
	
	
	public function AutocompleteComprobantesDevuelveCodigo(){
	
		$plan_cuentas = new PlanCuentasModel();
	
		$nombre_plan_cuentas = $_POST['nombre_plan_cuentas'];
	
		$resultSet = $plan_cuentas->getBy("nombre_plan_cuentas='$nombre_plan_cuentas'");
	
	
		$respuesta = new stdClass();
	
		if(!empty($resultSet)){
	
			$respuesta->codigo_plan_cuentas = $resultSet[0]->codigo_plan_cuentas;
			$respuesta->id_plan_cuentas = $resultSet[0]->id_plan_cuentas;
	
			echo json_encode($respuesta);
		}
	
	}
	
	
	
	
}
?>