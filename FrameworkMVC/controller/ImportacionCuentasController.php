<?php

class ImportacionCuentasController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$entidades=new EntidadesModel();
     	$monedas = new MonedasModel();
     	$centro_costos= new CentroCostosModel();
     	$plan_cuentas = new PlanCuentasModel();
					//Conseguimos todos los usuarios
		$resultSet=array();
				
		$resultEdit = "";
		
		//arrays
		$resultMoneda=array();
		$resultEntidad=array();
		$resultCentroC=array();
		$resultCodigo_p_cuentas=array();
		$resultEntidades=array();

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			//Notificaciones
			
			$nombre_controladores = "ImportacionCuentas";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $entidades->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				$id_usuarios=$_SESSION['id_usuarios'];
				
				//todas las entidades
				$resultEntidades=$entidades->getAll("nombre_entidades");
				
				
				//consultar entidad por el usuario
				$resultEntidad=$entidades->getCondiciones("entidades.id_entidades,entidades.nombre_entidades","public.usuarios,public.entidades",
						"usuarios.id_entidades=entidades.id_entidades AND usuarios.id_usuarios='$id_usuarios'",
						"entidades.id_entidades");
				
				
				$columnas_p_cuentas=" plan_cuentas.id_plan_cuentas,plan_cuentas.codigo_plan_cuentas, 
									  plan_cuentas.nombre_plan_cuentas,monedas.nombre_monedas, 
									  plan_cuentas.n_plan_cuentas,plan_cuentas.t_plan_cuentas, 
									  centro_costos.nombre_centro_costos,plan_cuentas.nivel_plan_cuentas";
				
				$tablas_p_cuentas="public.plan_cuentas,public.usuarios,public.entidades,public.monedas,
								   public.centro_costos";
				
				$where_p_cuentas="entidades.id_entidades = plan_cuentas.id_entidades AND
								  entidades.id_entidades = usuarios.id_entidades AND
								  monedas.id_monedas = plan_cuentas.id_modenas AND
								  centro_costos.id_centro_costos = plan_cuentas.id_centro_costos AND
							      usuarios.id_usuarios='$id_usuarios'";
				
				$resultSet=$plan_cuentas->getCondiciones($columnas_p_cuentas, $tablas_p_cuentas, $where_p_cuentas, "plan_cuentas.codigo_plan_cuentas");
				
				if(isset($_POST['Buscar']))
				{
					$id_entidad_a_buscar=$_POST['id_entidad_a_importar'];
					
					
					$columnas_p_cuentas=" plan_cuentas.id_plan_cuentas,plan_cuentas.codigo_plan_cuentas,
									  plan_cuentas.nombre_plan_cuentas,monedas.nombre_monedas,
									  plan_cuentas.n_plan_cuentas,plan_cuentas.t_plan_cuentas,
									  centro_costos.nombre_centro_costos,plan_cuentas.nivel_plan_cuentas";
					
					$tablas_p_cuentas="public.plan_cuentas,public.entidades,public.monedas,
								   public.centro_costos";
					
					$where_p_cuentas="entidades.id_entidades = plan_cuentas.id_entidades AND
					monedas.id_monedas = plan_cuentas.id_modenas AND
					centro_costos.id_centro_costos = plan_cuentas.id_centro_costos AND
					entidades.id_entidades='$id_entidad_a_buscar'";
					
									
					$resultSet=$plan_cuentas->getCondiciones($columnas_p_cuentas, $tablas_p_cuentas, $where_p_cuentas, "plan_cuentas.codigo_plan_cuentas");
					
				}
				
				
				$this->view("ImportacionCuentas",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit,"resultMoneda"=>$resultMoneda,
						"resultEntidad"=>$resultEntidad,"resultCentroC"=>$resultCentroC,"resultEntidades"=>$resultEntidades
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Plan de Cuentas"
				
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
	
	public function ImportarPlanCuentas(){
			
		session_start();
		$plan_cuentas = new PlanCuentasModel();
		
		$nombre_controladores = "ImportacionCuentas";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $plan_cuentas->getPermisosEditar("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
		if (!empty($resultPer))
		{
			$resultado = null;
			
			
			//_nombre_categorias character varying, _path_categorias character varying
			if (isset ($_POST["Importar"]))				
			{
				    $_id_entidad_a_importar="";
				    if(isset($_POST["id_entidad"])){$_id_entidad_a_importar = $_POST["id_entidad"];}else{$_id_entidad_a_importar="";};
				    $_id_entidad_importada = $_POST["id_entidad_importada"];
				    
				    if(isset($_POST["saldos"])&&$_id_entidad_a_importar!="")
					{ 
						$_saldos = (int)$_POST["saldos"];
					    					    
					    if($_saldos==1)
					    {
					    	
					    	$funcion = "importacion_plan_cuentas";
					    	 
					    	$parametros = "'$_id_entidad_a_importar', '$_id_entidad_importada'";
					    	
					    	$plan_cuentas->setFuncion($funcion);
					    	 
					    	$plan_cuentas->setParametros($parametros);
					    	 
					    	$resultado=$plan_cuentas->Insert();
					    		
					    		
					    		
					    	$traza=new TrazasModel();
					    	$_nombre_controlador = "Plan_cuentas";
					    	$_accion_trazas  = "Importar";
					    	$_parametros_trazas = "De ". $_id_entidad_a_importar." a la entidad -> ".$_id_entidad_importada;
					    	$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					    	
					    }else if($_saldos==2)
					    {
					    	$funcion = "importacion_plan_cuentas_sin_saldos";
					    	
					    	$parametros = "'$_id_entidad_a_importar', '$_id_entidad_importada'";
					    	 
					    	$plan_cuentas->setFuncion($funcion);
					    	
					    	$plan_cuentas->setParametros($parametros);
					    	
					    	$resultado=$plan_cuentas->Insert();
					    	
					    	$traza=new TrazasModel();
					    	$_nombre_controlador = "Plan_cuentas";
					    	$_accion_trazas  = "Importar";
					    	$_parametros_trazas = "De ". $_id_entidad_a_importar." a la entidad -> ".$_id_entidad_importada;
					    	$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					    	 
					    }
				    }
					
			}else {
				
				$this->view("Error",array(
						"resultado"=>"No puede importar plan cuentas"
				));
				die();
					
			}
			
			$this->redirect("ImportacionCuentas", "index");

		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Insertar Plan de Cuentas"
		
			));
		
		
		}
		
	}
	
	
	
	
	
}
?>