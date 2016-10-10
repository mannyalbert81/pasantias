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
     	$plan_cuentas = new PlanCuentasModel();
					//Conseguimos todos los usuarios
		$resultSet=array();
				
		$resultEdit = "";
		
		//arrays
		$resultMoneda=array();
		$resultEntidad=array();
		$resultCentroC=array();
		$resultCodigo_p_cuentas=array();

		
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
				
								
				//array con codigo y subcodigo 
				if(!empty($resultSet)){foreach ($resultSet as $linea=>$val ){
					
					$subcodigo=0;
					
					if($val->nivel_plan_cuentas=='2'){
						$subcodigo=substr($val->codigo_plan_cuentas,2,1);}
					if($val->nivel_plan_cuentas=='3'){
						$subcodigo=substr($val->codigo_plan_cuentas,4,1);}
					
					$resultCodigo_p_cuentas[$linea]['id_p_cuentas']=$val->id_plan_cuentas;
					$resultCodigo_p_cuentas[$linea]['codigo_p_cuentas']=$val->codigo_plan_cuentas;
					$resultCodigo_p_cuentas[$linea]['nivel_p_cuentas']=$val->nivel_plan_cuentas;
					$resultCodigo_p_cuentas[$linea]['subcodigo_p_cuentas']=$subcodigo;
				}}
				
				
				$this->view("PlanCuentas",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit,"resultMoneda"=>$resultMoneda,
						"resultEntidad"=>$resultEntidad,"resultCentroC"=>$resultCentroC,
						"resultCodigo_p_cuentas"=>$resultCodigo_p_cuentas
			
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
		$respuesta="0";
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
		    
		    $plan_cuentas->setFuncion($funcion);
		    	
		    $plan_cuentas->setParametros($parametros);
		    	
		    $resultado=$plan_cuentas->Insert();
		    
		    if($resultado)
		    {
		    	$respuesta="1";
		    }else {
		    	$respuesta="0";
		    }    
		    
		    
		}else {
			
			$respuesta="0";
		}
		
		echo json_encode($respuesta);
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
	
	public function returnSubGrupo()
	{
	
		$id_grupo=(int)$_POST["idcuentas"];
		$id_entidades=(int)$_POST["identidades"];
		$codigo_plan_cuentas=$id_grupo.'%';
	
		$plan_cuentas = new PlanCuentasModel();
	
		$columnas = "id_plan_cuentas,nombre_plan_cuentas,nivel_plan_cuentas";
		$tablas="plan_cuentas";
		$id="id_plan_cuentas";
		$where=" t_plan_cuentas='G'
		AND nivel_plan_cuentas=3
		AND id_entidades='$id_entidades'
		AND codigo_plan_cuentas like '$codigo_plan_cuentas'";
	
		$resultado=$plan_cuentas->getCondiciones($columnas ,$tablas , $where, $id);
	
		echo json_encode($resultado);
	
	}
	
	
	public function returnCodGrupo()
	{
	
		$id_grupo=(int)$_POST["idcuentas"];
		$id_entidades=(int)$_POST["identidades"];
		$codigo_plan_cuentas=$id_grupo.'%';
	
		$plan_cuentas = new PlanCuentasModel();
	
		$columnas = "id_plan_cuentas,codigo_plan_cuentas,substring(codigo_plan_cuentas,3,1) as subcodigo";
		
		$tablas="plan_cuentas";
				
	    $id="subcodigo";
				
		$where=" t_plan_cuentas='G'
				AND nivel_plan_cuentas=2
				AND id_entidades='$id_entidades'
				AND codigo_plan_cuentas like '$codigo_plan_cuentas'";
				
		$resultado=$plan_cuentas->getCondicionesDesc($columnas ,$tablas , $where, $id);
		$respuesta=1;
		
		if(!empty($resultado)){$respuesta=$resultado[0]->subcodigo;	$respuesta=$respuesta+1;}
	
		echo json_encode($respuesta);
	
	}
	
	public function returnCodSubGrupo()
	{
	
		
		$id_cuenta=(int)$_POST["idcuentas"];
		$id_entidades=(int)$_POST["identidades"];
		$id_grupo=(int)$_POST["idgrupo"];
		
	
		$plan_cuentas = new PlanCuentasModel();
		
		$resultGrupo=$plan_cuentas->getBy("id_plan_cuentas='$id_grupo'");
		
		//print_r($resultGrupo);
		
		$respuesta=0;
		
		if(!empty($resultGrupo)){
		
		$codigoGrupo_l2=$resultGrupo[0]->codigo_plan_cuentas;
		
		$codigo_plan_cuentas=$codigoGrupo_l2.'%';
	
		$columnas = "id_plan_cuentas,codigo_plan_cuentas,substring(codigo_plan_cuentas,5,1) as subcodigo";
	
		$tablas="plan_cuentas";
	
		$id="subcodigo";
	
		$where=" t_plan_cuentas='G'
		AND nivel_plan_cuentas=3
		AND id_entidades='$id_entidades'
		AND codigo_plan_cuentas like '$codigo_plan_cuentas'";
	
		$resultado=$plan_cuentas->getCondicionesDesc($columnas ,$tablas , $where, $id);
		
		$respuesta=$codigoGrupo_l2.'1';
	
		if(!empty($resultado)){	$temp=$resultado[0]->subcodigo; $temp=$temp+1; $respuesta=(string)$codigoGrupo_l2.$temp;}
		
		}
		
		echo json_encode($respuesta);
	
	}
	
	
}
?>