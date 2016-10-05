<?php

class CentroCostosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//tomamos id usuario
     	$entidades=new EntidadesModel();
     	$centro_costos= new CentroCostosModel();
     	
		
		$resultEntidad=array();
		
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$id_usuarios=$_SESSION['id_usuarios'];			
			
			$columas_c_c="
	     	centro_costos.id_centro_costos,
			centro_costos.nombre_centro_costos,
	     	centro_costos.codigo_centro_costos,
	     	centro_costos.nivel_centro_costos,
			entidades.id_entidades,
			entidades.nombre_entidades";
			$tablas_c_c="
	     	public.centro_costos,
	     	public.entidades,
	     	public.usuarios";
			$where_c_c="
			entidades.id_entidades = centro_costos.id_entidades AND
			entidades.id_entidades = usuarios.id_entidades
			AND usuarios.id_usuarios='$id_usuarios'";
			
			//obtener tabla de centro de costos
			$resultSet=$centro_costos->getCondiciones($columas_c_c, $tablas_c_c, $where_c_c, "centro_costos.id_centro_costos");
			
			$nombre_controladores = "CentroCostos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $entidades->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				$resultEntidad=$entidades->getCondiciones("entidades.id_entidades,entidades.nombre_entidades","public.usuarios,public.entidades",
															"usuarios.id_entidades=entidades.id_entidades AND usuarios.id_usuarios='$id_usuarios'",
															"entidades.id_entidades");
				if (isset ($_GET["id_entidades"])   )
				{

					$nombre_controladores = "CentroCostos";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $entidades->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_centro_costos = $_GET["id_centro_costos"];
						
						$columnas = " centro_costos.id_centro_costos,centro_costos.codigo_centro_costos, centro_costos.nivel_centro_costos, entidades.id_entidades, entidades.nombre_entidades";
						$tablas   = " public.centro_costos, public.entidades";
						$where    = " entidades.id_entidades = centro_costos.id_entidades AND centro_costos.id_centro_costos = '$_id_centro_costos' "; 
						$id       = "centro_costos.id_centro_costos";
							
						$resultEdit = $entidades->getCondiciones($columnas ,$tablas ,$where, $id);
						
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "CentroCostos";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_entidades;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);

					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Centro Costos"
					
						));
					
					
					}
					
				}
		
				
				$this->view("CentroCostos",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit ,"resultEntidad"=>$resultEntidad
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Centro Costos"
				
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
	
	public function InsertaCentroCostos(){
			
		session_start();
		$centro_costos= new CentroCostosModel();

		$nombre_controladores = "CentroCostos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $centro_costos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
		if (!empty($resultPer))
		{
			$resultado = null;
			
			//_nombre_categorias character varying, _path_categorias character varying
			if (isset ($_POST["id_entidad"])   )
				
			{
				
				$_id_entidades_centro_costos = $_POST["id_entidad"];
				$_nombre_centro_costos = $_POST["nombre_centro_costos"];
				$_codigo_centro_costos = $_POST["codigo_centro_costos"];
				$_nivel_centro_costos = $_POST["nivel_centro_costos"];
				
				$funcion = "ins_centro_costos";
				
				//parametros
								
				$parametros = "'$_codigo_centro_costos', '$_nombre_centro_costos', '$_id_entidades_centro_costos',
								'$_nivel_centro_costos'";
					
				$centro_costos->setFuncion($funcion);
		
				$centro_costos->setParametros($parametros);
				
				$resultado=$centro_costos->Insert();
		
				/*$this->view("Error",array(
				"resultado"=>print_r($resultado)
				));
				die();*/
				
				$traza=new TrazasModel();
				$_nombre_controlador = "CentroCostos";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_entidades;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("CentroCostos", "index");

		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Insertar Centro Costos"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "CentroCostos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_centro_costos"]))
			{
				$id_centro_costos=(int)$_GET["id_centro_costos"];
		
				$centro_costos=new CentroCostosModel();
				
				$centro_costos->deleteBy(" id_centro_costos",$id_centro_costos);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "CentroCostos";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_centro_costos;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				
			}
			
			$this->redirect("CentroCostos", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Centro Costos"
			
			));
		}
				
	}
	
	
	
}
?>