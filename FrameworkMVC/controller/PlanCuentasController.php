<?php

class PlanCuentasController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$entidades=new EntidadesModel();
     	$monedas = new MonedasModel();
     	$centro_costos= new CentroCostosModel();
					//Conseguimos todos los usuarios
		$resultSet=array();
				
		$resultEdit = "";
		
		//arrays
		$resultMoneda=array();
		$resultEntidad=array();
		$resultCentroC=array();

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			//Notificaciones
			
			$nombre_controladores = "PlanCuentas";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $entidades->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				$id_usuarios=$_SESSION['id_usuarios'];
				
				//consultar  monedas
				$resultMoneda = $monedas->getAll("nombre_monedas");
				//consultar entidad por el usuario
				$resultEntidad=$entidades->getCondiciones("entidades.id_entidades,entidades.nombre_entidades","public.usuarios,public.entidades",
						"usuarios.id_entidades=entidades.id_entidades AND usuarios.id_usuarios='$id_usuarios'",
						"entidades.id_entidades");
				//consultar centro costos de acuerdo a la entidad y elk usuario
				$resultCentroC=$centro_costos->getCondiciones("centro_costos.id_centro_costos,centro_costos.nombre_centro_costos",
						"public.centro_costos, public.entidades, public.usuarios", 
						"entidades.id_entidades = centro_costos.id_entidades AND  entidades.id_entidades = usuarios.id_entidades AND
						 usuarios.id_usuarios='$id_usuarios'", "centro_costos.id_centro_costos");
				
				
				
				if (isset ($_GET["id_entidades"])   )
				{
                   if (!empty($resultPer))
					{
					
						$_id_entidades = $_GET["id_entidades"];
						$columnas = " id_entidades, ruc_entidades, nombre_entidades, telefono_entidades, direccion_entidades, ciudad_entidades ";
						$tablas   = "entidades";
						$where    = "id_entidades = '$_id_entidades' "; 
						$id       = "ruc_entidades";
							
						$resultEdit = $entidades->getCondiciones($columnas ,$tablas ,$where, $id);
						
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "Entidades";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_entidades;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);

					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Plan de Cuentas"
					
						));
					
					
					}
					
				}
		
				
				$this->view("PlanCuentas",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit,"resultMoneda"=>$resultMoneda,
						"resultEntidad"=>$resultEntidad,"resultCentroC"=>$resultCentroC
			
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
	
	public function InsertaPlanCuentas(){
			
		session_start();
		$entidades=new EntidadesModel();
		

		$nombre_controladores = "PlanCuentas";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $entidades->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$entidades=new EntidadesModel();
		
			//_nombre_categorias character varying, _path_categorias character varying
			if (isset ($_POST["ruc_entidades"])   )
				
			{
				
				$_ruc_entidades = $_POST["ruc_entidades"];
				$_nombre_entidades = $_POST["nombre_entidades"];
				$_telefono_entidades = $_POST["telefono_entidades"];
				$_direccion_entidades = $_POST["direccion_entidades"];
				$_ciudad_entidades = $_POST["ciudad_entidades"];
				
				$funcion = "ins_entidades";
				$parametros = "'$_ruc_entidades', '$_nombre_entidades', '$_telefono_entidades', '$_direccion_entidades', '$_ciudad_entidades'";
					
				$entidades->setFuncion($funcion);
		
				$entidades->setParametros($parametros);
		
		
				$resultado=$entidades->Insert();
		
				//$this->view("Error",array(
				//"resultado"=>"entro"
				//));
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Entidades";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_entidades;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			$this->redirect("PlanCuentas", "index");

		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Insertar Plan de Cuentas"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Roles";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_entidades"]))
			{
				$id_entidades=(int)$_GET["id_entidades"];
		
				$entidades=new EntidadesModel();
				
				$entidades->deleteBy(" id_entidades",$id_entidades);
				
				
				$traza=new TrazasModel();
				$_nombre_controlador = "PlanCuentas";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_entidades;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				
			}
			
			$this->redirect("PlanCuentas", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Plan de Cuentas"
			
			));
		}
				
	}
	
	
	public function AgregarGrupo()
	{
		
		session_start();
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$plan_cuentas= new PlanCuentasModel();
			
			$id_entidad_p_cuentas=$_POST['id_entidad_p_cuentas'];
			$nombre_p_cuentas=$_POST['nombre_p_cuentas'];
		    $codigo_p_cuentas=$_POST['codigo_p_cuentas'];
		    $id_moneda_p_cuentas=$_POST['id_moneda_p_cuentas'];
		    $n_p_cunetas=$_POST['n_p_cunetas'];
		    $t_p_cuentas=$_POST['t_p_cuentas'];
		    $id_centro_c_p_cuentas=$_POST['id_centro_c_p_cuentas'];
		    $nivel_p_cuentas=$_POST['nivel_p_cuentas'];
		    
		    
		    $funcion = "ins_plan_cuentas";
		    	
		    
		    $parametros = "'$id_entidad_p_cuentas', '$codigo_p_cuentas', '$nombre_p_cuentas', '$id_moneda_p_cuentas',
		    '$n_p_cunetas','$t_p_cuentas','$id_centro_c_p_cuentas','$nivel_p_cuentas'";
		    
		    $entidades->setFuncion($funcion);
		    	
		    $entidades->setParametros($parametros);
		    	
		    $resultado=$plan_cuentas->Insert();
		    
		    echo json_encode("1");
		    
		}else {
			echo json_encode("0");
		}
		
	}
	
	
	public function returnGrupo()
	{
		
		$id_grupo=(int)$_POST["idcuentas"];
		$id_entidades=(int)$_POST["identidades"];
		$codigo_plan_cuentas=$id_grupo.'%';
		
		$plan_cuentas = new PlanCuentasModel();
		
		$columnas = "id_plan_cuentas,nombre_plan_cuentas,nivel_plan_cuentas";
		$tablas="plan_cuentas";
		$id="id_plan_cuentas";		
		$where=" t_plan_cuentas='G'
				AND nivel_plan_cuentas=2
				AND id_entidades='$id_entidades'
				AND codigo_plan_cuentas like '$codigo_plan_cuentas'";
		
		$resultado=$plan_cuentas->getCondiciones($columnas ,$tablas , $where, $id);
		
		echo json_encode($resultado);
	
	}
	
	
	
}
?>