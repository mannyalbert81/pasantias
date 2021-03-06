<?php
ini_set('memory_limit','128M');
ini_set('display_errors',1);
ini_set('display_startup_erros',1);


//include_once('class/phpjasperxml/class/tcpdf/tcpdf.php');
//include_once("class/phpjasperxml/class/PHPJasperXML.inc.php");

//include_once ('class/phpjasperxml/setting.php');



//include_once('setting.php');//no se puede enviar nada mas que el reporte, NINGUN espacio o caracter previo al repote

class UsuariosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    //maycol
public function index(){
	
		session_start();
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			$usuarios=new UsuariosModel();
			//Notificaciones
			
			
			//creacion menu busqueda
			//$resultMenu=array("1"=>Nombre,"2"=>Usuario,"3"=>Correo,"4"=>Rol);
			$resultMenu=array(0=>'--Seleccione--',1=>'Nombre', 2=>'Usuario', 3=>'Correo', 4=>'Rol', 5=>'Ciudad');
			
			
				//Creamos el objeto usuario
			$rol=new RolesModel();
			$resultRol = $rol->getAll("nombre_rol");
			
			
			$estado = new EstadoModel();
			$resultEst = $estado->getAll("nombre_estado");
			
			
			$ciudad = new CiudadModel();
			$resultCiu = $ciudad->getAll("nombre_ciudad");
			
			$entidad = new EntidadesModel();
			$resultEntidad = $entidad->getAll('nombre_entidades');
	
			$usuarios = new UsuariosModel();

			$nombre_controladores = "Usuarios";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $usuarios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			     	$columnas = " usuarios.id_usuarios,  usuarios.nombre_usuarios, usuarios.usuario_usuarios ,  usuarios.telefono_usuarios, usuarios.celular_usuarios, usuarios.correo_usuarios, rol.nombre_rol, estado.nombre_estado, rol.id_rol, estado.id_estado, usuarios.cedula_usuarios, ciudad.id_ciudad, ciudad.nombre_ciudad, entidades.id_entidades, entidades.nombre_entidades";
					$tablas   = "public.rol,  public.usuarios, public.estado, public.ciudad, public.entidades";
					$where    = "rol.id_rol = usuarios.id_rol AND estado.id_estado = usuarios.id_estado AND ciudad.id_ciudad = usuarios.id_ciudad AND entidades.id_entidades = usuarios.id_entidades";
					$id       = "usuarios.nombre_usuarios"; 
			
					
					//Conseguimos todos los usuarios
					$resultSet=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
					
					$resultEdit = "";
			
					if (isset ($_GET["id_usuarios"])   )
					{
						$_id_usuario = $_GET["id_usuarios"];
						
						$columnas1 = "usuarios.id_usuarios, 
									  usuarios.nombre_usuarios, 
									  usuarios.telefono_usuarios, 
									  usuarios.celular_usuarios, 
									  usuarios.correo_usuarios, 
									  rol.id_rol, 
									  rol.nombre_rol, 
									  estado.id_estado, 
									  estado.nombre_estado, 
									  usuarios.usuario_usuarios, 
									  usuarios.cedula_usuarios, 
									  ciudad.id_ciudad, 
									  ciudad.codigo_ciudad, 
									  entidades.id_entidades, 
									  entidades.nombre_entidades";
						
						$tablas1   = " public.usuarios, 
									  public.rol, 
									  public.estado, 
									  public.ciudad, 
									  public.entidades";
						$where1    = "rol.id_rol = usuarios.id_rol AND
									  estado.id_estado = usuarios.id_estado AND
									  ciudad.id_ciudad = usuarios.id_ciudad AND
									  entidades.id_entidades = usuarios.id_entidades AND usuarios.id_usuarios= '$_id_usuario' "; 
						$id1       = "usuarios.id_usuarios";
						$resultEdit = $usuarios->getCondiciones($columnas1 ,$tablas1 ,$where1, $id1); 
				
					
						$traza=new TrazasModel();
						$_nombre_controlador = "Usuarios";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_usuario;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					
					
					}
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Usuarios"
			
				));
				exit();
			
			
			}
			
			
			///si tiene permiso de ver
			//$resultPerVer = $usuarios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			$resultPerVer= $usuarios->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPerVer))
			{
				if (isset ($_POST["criterio"])  && isset ($_POST["contenido"])  )
				{
						
					
					/*	
					$columnas = "documentos_legal.id_documentos_legal,  documentos_legal.fecha_documentos_legal, categorias.nombre_categorias, subcategorias.nombre_subcategorias, tipo_documentos.nombre_tipo_documentos, cliente_proveedor.nombre_cliente_proveedor, carton_documentos.numero_carton_documentos, documentos_legal.paginas_documentos_legal, documentos_legal.fecha_desde_documentos_legal, documentos_legal.fecha_hasta_documentos_legal, documentos_legal.ramo_documentos_legal, documentos_legal.numero_poliza_documentos_legal, documentos_legal.ciudad_emision_documentos_legal, soat.cierre_ventas_soat,   documentos_legal.creado  ";
					$tablas   = "public.documentos_legal, public.categorias, public.subcategorias, public.tipo_documentos, public.carton_documentos, public.cliente_proveedor, public.soat";
					$where    = "categorias.id_categorias = subcategorias.id_categorias AND subcategorias.id_subcategorias = documentos_legal.id_subcategorias AND tipo_documentos.id_tipo_documentos = documentos_legal.id_tipo_documentos AND carton_documentos.id_carton_documentos = documentos_legal.id_carton_documentos AND cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor   AND documentos_legal.id_soat = soat.id_soat ";
					$id       = "documentos_legal.fecha_documentos_legal, carton_documentos.numero_carton_documentos";
					*/	
					
					
					
					$columnas = " usuarios.id_usuarios,  usuarios.nombre_usuarios, usuarios.usuario_usuarios ,  usuarios.telefono_usuarios, usuarios.celular_usuarios, usuarios.correo_usuarios, rol.nombre_rol, estado.nombre_estado, rol.id_rol, estado.id_estado, usuarios.cedula_usuarios, ciudad.id_ciudad, ciudad.nombre_ciudad, entidades.id_entidades, entidades.nombre_entidades";
					$tablas   = "public.rol,  public.usuarios, public.estado, public.ciudad, public.entidades";
					$where    = "rol.id_rol = usuarios.id_rol AND estado.id_estado = usuarios.id_estado AND ciudad.id_ciudad = usuarios.id_ciudad AND entidades.id_entidades = usuarios.id_entidades";
					$id       = "usuarios.nombre_usuarios";
					

					$criterio = $_POST["criterio"];
					$contenido = $_POST["contenido"];
						
					
					//$resultSet=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
						
					if ($contenido !="")
					{
							
						$where_0 = "";
						$where_1 = "";
						$where_2 = "";
						$where_3 = "";
						$where_4 = "";
						$where_5 = "";
							
						switch ($criterio) {
							case 0:
								$where_0 = "OR  usuarios.nombre_usuarios LIKE '$contenido'   OR usuarios.usuario_usuarios LIKE '$contenido'  OR  usuarios.correo_usuarios LIKE '$contenido'  OR rol.nombre_rol LIKE '$contenido' OR ciudad.nombre_ciudad LIKE '$contenido'";
								break;
							case 1:
								//Ruc Cliente/Proveedor
								$where_1 = " AND  usuarios.nombre_usuarios LIKE '$contenido'  ";
								break;
							case 2:
								//Nombre Cliente/Proveedor
								$where_2 = " AND usuarios.usuario_usuarios LIKE '$contenido'  ";
								break;
							case 3:
								//Número Carton
								$where_3 = " AND usuarios.correo_usuarios LIKE '$contenido' ";
								break;
							case 4:
								//Número Poliza
								$where_4 = " AND rol.nombre_rol LIKE '$contenido' ";
								break;
							case 5:
									//Número Poliza
									$where_5 = " AND ciudad.nombre_ciudad LIKE '$contenido' ";
									break;
						}
							
							
							
						$where_to  = $where .  $where_0 . $where_1 . $where_2 . $where_3 . $where_4 . $where_5;
							
							
						$resul = $where_to;
						
						//Conseguimos todos los usuarios con filtros
						$resultSet=$usuarios->getCondiciones($columnas ,$tablas ,$where_to, $id);
							
							
							
							
					}
				}
				
				if (isset ($_POST["Imprimir"])   )
     			{
     					
     				 
     				
     				//ContUsuariosReport.php
				   $this->ireport("ContUsuarios", "");
				   
				   exit();
				   
					
				}	
				
			}
			
			
			$this->view("Usuarios",array(
					"resultSet"=>$resultSet, "resultRol"=>$resultRol, "resultEdit" =>$resultEdit, "resultEst"=>$resultEst,"resultMenu"=>$resultMenu,
					"resultCiu"=>$resultCiu, "resultEntidad"=>$resultEntidad
			
			));
			
			
			
			
			
			
		
		}
		else 
		{
			$this->view("ErrorSesion",array(
					"resultSet"=>""
		
			));
			
			
			
		}
		
	}
	
	public function InsertaUsuarios(){
		
		
		$resultado = null;
		$usuarios=new UsuariosModel();
	
	
		
		//_nombre_categorias character varying, _path_categorias character varying
		if (isset ($_POST["usuario_usuarios"]) && isset ($_POST["nombre_usuarios"]) && isset ($_POST["clave_usuarios"]) && isset($_POST["id_rol"])  )
		{

			
			$_nombre_usuario     = $_POST["nombre_usuarios"];
			$_clave_usuario      = $usuarios->encriptar($_POST["clave_usuarios"]);
			$_telefono_usuario   = $_POST["telefono_usuarios"];
			$_celular_usuario    = $_POST["celular_usuarios"];
			$_correo_usuario     = $_POST["correo_usuarios"];
		    $_id_rol             = $_POST["id_rol"];
		    $_id_estado          = $_POST["estados"];
		    $_usuario_usuario     = $_POST["usuario_usuarios"];
		    $_cedula_usuarios    = $_POST["cedula_usuarios"];
		    $_id_ciudad          = $_POST["id_ciudad"];
		    $_id_entidad         = $_POST["id_entidad"];
	
		    
		    if ($_FILES['imagen_usuarios']['tmp_name']!="")
		    {
		    
		    	//para la foto
		    	 
		    	$directorio = $_SERVER['DOCUMENT_ROOT'].'/pasantias/fotos/';
		    	 
		    	$nombre = $_FILES['imagen_usuarios']['name'];
		    	$tipo = $_FILES['imagen_usuarios']['type'];
		    	$tamano = $_FILES['imagen_usuarios']['size'];
		    	 
		    	// temporal al directorio definitivo
		    	 
		    	move_uploaded_file($_FILES['imagen_usuarios']['tmp_name'],$directorio.$nombre);
		    	 
		    	$data = file_get_contents($directorio.$nombre);
		    	 
		    	$imagen_usuarios = pg_escape_bytea($data);
		    
		    
	
			$funcion = "ins_usuarios";
			
			$parametros = " '$_nombre_usuario' ,'$_clave_usuario' , '$_telefono_usuario', '$_celular_usuario', '$_correo_usuario' , '$_id_rol', '$_id_estado' , '$_usuario_usuario', '$_cedula_usuarios', '$_id_ciudad', '$imagen_usuarios','$_id_entidad'";
			$usuarios->setFuncion($funcion);
	
			$usuarios->setParametros($parametros);
	        $resultado=$usuarios->Insert();
		    
		    }
			
		    else
		    {
		    
		    	$colval = " nombre_usuarios = '$_nombre_usuario',  clave_usuarios = '$_clave_usuario', telefono_usuarios = '$_telefono_usuario', celular_usuarios = '$_celular_usuario', correo_usuarios = '$_correo_usuario', id_rol = '$_id_rol', id_estado = '$_id_estado', usuario_usuarios = '$_usuario_usuario', id_ciudad = '$_id_ciudad' , id_entidades = '$_id_entidad'  ";
		    	$tabla = "usuarios";
		    	$where = "cedula_usuarios = '$_cedula_usuarios'    ";
		    
		    	$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
		    	 
		    }
			
	
		}
		$this->redirect("Usuarios", "index");
		
		
	}
	
	public function borrarId()
	{
		
		if(isset($_GET["id_usuarios"]))
		{
			$id_usuario=(int)$_GET["id_usuarios"];
	
			$usuarios=new UsuariosModel();
				
			$usuarios->deleteBy(" id_usuarios",$id_usuario);
				
			$traza=new TrazasModel();
			$_nombre_controlador = "Usuarios";
			$_accion_trazas  = "Borrar";
			$_parametros_trazas = $id_usuario;
			$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
		}
	
		$this->redirect("Usuarios", "index");
	}
	
    
    
    public function Login(){
    
    	//Creamos el objeto usuario
    	$usuarios=new UsuariosModel();
    
    	//Conseguimos todos los usuarios
    	$allusers=$usuarios->getLogin();
    	 
    	//Cargamos la vista index y l e pasamos valores
    	$this->view("Login",array(
    			"allusers"=>$allusers
    	));
    }
    public function Bienvenida(){
    
    	//Creamos el objeto usuario
    	$usuarios=new UsuariosModel();
    	
    	//Conseguimos todos los usuarios
    	$allusers=$usuarios->getLogin();
    	
    	//Cargamos la vista index y l e pasamos valores
    	$this->view("Bienvenida",array(
    			"allusers"=>$allusers
    	));
    }
    
    
    
    
    public function Loguear()
    {
    	if (isset ($_POST["usuarios"]) && ($_POST["clave"] ) )
    	
    	{
    		$usuarios=new UsuariosModel();
    		$_usuario = $_POST["usuarios"];
    		$_clave =   $usuarios->encriptar($_POST["clave"]);
    		 
    		
    		$where = "  usuario_usuarios = '$_usuario' AND  clave_usuarios ='$_clave' ";
    	
    		$result=$usuarios->getBy($where);

    		$usuario_usuarios = "";
    		$id_rol  = "";
    		$nombre_usuarios = "";
    		$correo_usuarios = "";
    		$ip_usuario = "";
    		
    		if ( !empty($result) )
    		{ 
    			foreach($result as $res) 
    			{
    				$id_usuario  = $res->id_usuarios;
    				$usuario_usuario  = $res->usuario_usuarios;
	    			$id_rol           = $res->id_rol;
	    			$correo_usuario   = $res->correo_usuarios;
	    			
    			}	
    			//obtengo ip
    			$ip_usuario = $usuarios->getRealIP();
    			
    			
    			///registro sesion
    			$usuarios->registrarSesion($id_usuario, $usuario_usuario, $id_rol, $correo_usuario, $ip_usuario);
    			
    			//inserto en la tabla
    			$_id_usuario = $_SESSION['id_usuarios'];
    			$_ip_usuario = $_SESSION['ip_usuarios'];
    			
    			
    			$_id_rol=$_SESSION['id_rol'];
    			$usuarios->MenuDinamico($_id_rol);
    			
    			$sesiones = new SesionesModel();

    			$funcion = "ins_sesiones";
    			
    			$parametros = " '$_id_usuario' ,'$_ip_usuario' ";
    			$sesiones->setFuncion($funcion);
    			
    			$sesiones->setParametros($parametros);
    			
    			
    			$resultado=$sesiones->Insert();
    			
    		    $this->view("Bienvenida",array(
    				"allusers"=>$_usuario
	    		));
    		}
    		else
    		{
    			
	    		$this->view("Login",array(
	    				"allusers"=>""
	    		));
    		}
    		
    	} 
    	else
    	{
    		$this->view("Login",array(
    				"allusers"=>""
    		));
    		
    	}
    	
    }
    
	public function  cerrar_sesion ()
	{
		session_start();
		session_destroy();
		$this->redirect("Usuarios", "Loguear");
	}
	
	
	public function Actualiza ()
	{
		session_start();
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			//Creamos el objeto usuario
			$usuarios = new UsuariosModel();
			$ciudad = new CiudadModel();
		
						
					
				$resultEdit = "";
					
				$_id_usuario = $_SESSION['id_usuarios'];
				$where    = " usuarios.id_usuarios = '$_id_usuario' ";
				$resultEdit = $usuarios->getBy($where);
				
				$resultCiu = $ciudad->getAll("nombre_ciudad");
				

				if ( isset($_POST["Guardar"]) )
				{

					$_nombre_usuario    = $_POST["nombre_usuarios"];
					$_clave_usuario      =$usuarios->encriptar( $_POST["clave_usuarios"]);
					$_telefono_usuario  = $_POST["telefono_usuarios"];
					$_celular_usuario    = $_POST["celular_usuarios"];
					$_correo_usuario     = $_POST["correo_usuarios"];
					$_usuario_usuario     = $_POST["usuario_usuarios"];
					$_cedula_usuarios     = $_POST["cedula_usuarios"];
					$_id_ciudad           = $_POST["id_ciudad"];
				
					
					
					
					if ($_FILES['imagen_usuarios']['tmp_name']!="")
					{
					
						//para la foto
					
						$directorio = $_SERVER['DOCUMENT_ROOT'].'/pasantias/fotos/';
					
						$nombre = $_FILES['imagen_usuarios']['name'];
						$tipo = $_FILES['imagen_usuarios']['type'];
						$tamano = $_FILES['imagen_usuarios']['size'];
					
						// temporal al directorio definitivo
					
						move_uploaded_file($_FILES['imagen_usuarios']['tmp_name'],$directorio.$nombre);
					
						$data = file_get_contents($directorio.$nombre);
					
						$imagen_usuarios = pg_escape_bytea($data);
					
					
					
				    $colval   = " nombre_usuarios = '$_nombre_usuario' , clave_usuarios = '$_clave_usuario'   , telefono_usuarios = '$_telefono_usuario' ,  celular_usuarios = '$_celular_usuario' , correo_usuarios = '$_correo_usuario' , usuario_usuarios = '$_usuario_usuario', cedula_usuarios = '$_cedula_usuarios', id_ciudad = '$_id_ciudad', imagen_usuarios = '$imagen_usuarios'  ";
					$tabla    = "usuarios";
					$where    = " id_usuarios = '$_id_usuario' ";
					
					$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
					}
						
					else
					{
					
					$colval   = " nombre_usuarios = '$_nombre_usuario' , clave_usuarios = '$_clave_usuario'   , telefono_usuarios = '$_telefono_usuario' ,  celular_usuarios = '$_celular_usuario' , correo_usuarios = '$_correo_usuario' , usuario_usuarios = '$_usuario_usuario', cedula_usuarios = '$_cedula_usuarios', id_ciudad = '$_id_ciudad' ";
					$tabla    = "usuarios";
					$where    = " id_usuarios = '$_id_usuario' ";
					
					$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
				
					
					}
												
					$this->view("Login",array(
							"allusers"=>""
					));
					
					
				}
				else
				{
					$this->view("ActualizarUsuario",array(
							"resultEdit" =>$resultEdit,
							"resultCiu" =>$resultCiu
					));
					
				}
				
				
					
				
			
		
		}
		else
		{
			$this->view("ErrorSesion",array(
			"resultSet"=>""
			));
					
		}
		
	}
	
	
	public function Home()
	{
		session_start();
		$resultado = "";
	
		$this->view("Index",array(
				"resultado"=>$resultado
	
		));
	
	
	}
	
	
	public function Reset()
	{
		session_start();
		$_usuario_usuario = "";
		$_clave_usuario = "";
		$usuarios = new UsuariosModel();
		$error = FALSE;
	
	
		$mensaje = "";
	
		if (isset($_POST['reestablecer_usuario']))
		{
			$_usuario_usuario = $_POST['reestablecer_usuario'];
	
			$where = "usuario_usuarios = '$_usuario_usuario'   ";
			$resultUsu = $usuarios->getBy($where);
			foreach($resultUsu as $res)
			{
				$_clave_usuario =  mt_rand(1000, 9999);
	
			}
			$_encryp_pass = $usuarios->encrypt($_clave_usuario);
				
			$usuarios->UpdateBy("clave_usuarios = '$_encryp_pass' ", "usuarios", "usuario_usuarios = '$_usuario_usuario'  ");
				
			if ($_clave_usuario == "")
			{
				$mensaje = "Este Usuario no existe en nuestro sistema";
	
				$error = TRUE;
	
	
			}
			else
			{
	
				$cabeceras = "MIME-Version: 1.0 \r\n";
				$cabeceras .= "Content-type: text/html; charset=utf-8 \r\n";
				$cabeceras.= "From: info@masoft.net \r\n";
				$destino="$_usuario_usuario";
				$asunto="Claves de Acceso";
				$fecha=date("d/m/y");
				$hora=date("H:i:s");
	
				//
				$resumen="
				<table rules='all'>
				<tr style='background:#7acb5a'><td WIDTH='1000' HEIGHT='50' align='center'><img src='https://jquery-file-upload.appspot.com/image%2Fpng/730648178/logo_vade.png'></td></tr>
				</tabla>
				<p><table rules='all'></p>
				<tr style='background: #FFFFFF;'><td  WIDTH='1000' align='center'><b> BIENVENIDO A SISTEMA PASANTIAS </b></td></tr></p>
				<tr style='background: #FFFFFF;'><td  WIDTH='1000' align='justify'>Bienvenido a Vademano veterinario el portal digital que reúne toda la información  de relevancia relacionada con los productos  farmacéuticos de uso veterinario que se comercializan, busca proveer a médicos veterinarios, técnicos, especialistas y público en general  el más completo vademécum digital.
				El Vademano Veterinario está diseñado como una herramienta web moderna, versátil y fácil de utilizar, que se ajusta a la versatilidad de los dispositivos de comunicación actual para que la búsqueda de información se convierta en una tarea sencilla que puede ser realizada a través de múltiples combinaciones de criterios:
				efecto terapéutico, forma farmacéutica, especies, etc.; asimismo dispondrá de la información de los productos en formato PDF, opción para imprimir, entre otras múltiples ventajas.</td></tr>
				</tabla>
				<p><table rules='all'></p>
				<tr style='background: #FFFFFF'><td WIDTH='1000' align='center'><b> CLAVES DE ACCESO </b></td></tr>
				<tr style='background: #FFFFFF;'><td WIDTH='1000' > <b>Correo:</b> $_usuario_usuario</td></tr>
				<tr style='background: #FFFFFF;'><td WIDTH='1000' > <b>Clave Temporal:</b> $_clave_usuario </td></tr>
				</tabla>
				<p><table rules='all'></p>
				<tr style='background:#1C1C1C'><td WIDTH='1000' HEIGHT='50' align='center'><font color='white'>Vademano. - Desarrollado por <a href='http://www.masoft.net'>www.masoft.net</a> - Copyright © 2016-</font></td></tr>
				</table>
	
	
				";
	
	
				if(mail("$destino","Claves de Acceso","$resumen","$cabeceras"))
				{
					$mensaje = "Hemos enviado un correo electronico con sus datos de acceso";
	
					$this->view("Login",array(
							"allusers"=>""
					));
					exit();
	
	
				}else{
					$mensaje = "No se pudo enviar el correo con la informacion. Intentelo nuevamente";
					$error = TRUE;
	
				}
					
			}
				
		}
	
	
	
		$this->view("ResetUsuarios",array(
				"resultSet"=>$mensaje , "error"=>$error
		));
	
	
	
	}
	
	public function QuienesSomos()
	{
		session_start();
		$resultado = "";
	
		
	
		$this->view("QuienesSomos",array(
				"resultado"=>$resultado
	
		));
	
	
	}
	public function PreguntasFrecuentes()
	{
		session_start();
		$resultado = "";
	
	
		$this->view("PreguntasFrecuentes",array(
				"resultado"=>$resultado
	
	
	
		));
	
	
	}
	
}
?>
