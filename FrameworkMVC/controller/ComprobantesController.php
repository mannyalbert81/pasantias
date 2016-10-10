<?php

class ComprobantesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		session_start();
     	$resultEntidad=array();
		$resultEdit = "";
        
		$ccomprobantes= new CComprobantesModel();
		
	    if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$id_usuarios=$_SESSION['id_usuarios'];			
			
			$columas_c_c="
	     	  entidades.id_entidades, 
			  entidades.ruc_entidades, 
			  entidades.nombre_entidades, 
			  entidades.telefono_entidades, 
			  entidades.direccion_entidades, 
			  entidades.ciudad_entidades, 
			  consecutivos.numero_comprobantes, 
			  usuarios.id_usuarios,
			  usuarios.nombre_usuarios";
			$tablas_c_c="
		      public.usuarios, 
			  public.entidades, 
			  public.consecutivos";
			$where_c_c="
			 entidades.id_entidades = usuarios.id_entidades AND
             consecutivos.id_entidades = entidades.id_entidades
			 AND usuarios.id_usuarios='$id_usuarios'";
			
			$id_c_c="entidades.nombre_entidades";
		    
			$resultSet=$ccomprobantes->getCondiciones($columas_c_c, $tablas_c_c, $where_c_c, $id_c_c);
			
			$nombre_controladores = "Comprobantes";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $ccomprobantes->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
						
				
				$this->view("Comprobantes",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Comprobantes"
				
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
	
	public function InsertaComprobantes(){
			
		session_start();
		$centro_costos= new CentroCostosModel();

		$nombre_controladores = "Comprobantes";
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
				$_nombre_controlador = "Comprobantes";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_entidades;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("Comprobantes", "index");

		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Insertar Comprobantes"
		
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
			if(isset($_GET["id_centro_costos"]))
			{
				$id_centro_costos=(int)$_GET["id_centro_costos"];
		
				$centro_costos=new CentroCostosModel();
				
				$centro_costos->deleteBy(" id_centro_costos",$id_centro_costos);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Comprobantes";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_centro_costos;
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
	
	
	
}
?>