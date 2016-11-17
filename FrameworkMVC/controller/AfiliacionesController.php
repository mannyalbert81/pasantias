<?php
require_once 'config/global.php';

 
class AfiliacionesController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
public function index(){
	
				//Creamos el objeto usuario
	session_start();
	
	
	
			
		$paises=new PaisesModel();
		$resultPais = $paises->getAll("nombre_paises");
		
		$provincias=new ProvinciasModel();
		$resultProv = $provincias->getAll("nombre_provincias");
	    
		$cantones = new CantonesModel();
		$resultCan= $cantones->getAll("nombre_cantones");
		
		$carrera = new CarreraModel();
		$resultCar = $carrera->getAll("nombre_carrera");
		
		$jornada = new JornadaModel();
		$resultJor = $jornada->getAll("nombre_jornada");
		
		$semestre = new SemestreModel();
		$resultSem = $semestre->getAll("nombre_semestre");
		
		$rol=new RolesModel();
		$resultRol = $rol->getBy("nombre_rol='ESTUDIANTE' OR nombre_rol='DOCENTE' OR nombre_rol='EMPRESA'");
			
		$estado = new EstadoModel();
		$resultEst = $estado->getBy("nombre_estado='INACTIVO'");
		
		
		$afiliaciones = new UsuariosModel();

		$resultEdit = "";
			
		if (isset ($_GET["id_usuario"])   )
			{
				$_id_usuario = $_GET["id_usuario"];
				$where    = "rol.id_rol = usuarios.id_rol AND estado.id_estado = usuarios.id_estado AND usuarios.id_usuario = '$_id_usuario' "; 
				$resultEdit = $usuarios->getCondiciones($columnas ,$tablas ,$where, $id); 
			}
		$this->view("Afiliaciones",array(
				"resultSet"=>"", "resultPais"=>$resultPais, "resultProv" =>$resultProv, "resultCan" =>$resultCan, "resultEdit" =>$resultEdit,
				"resultCar" =>$resultCar, "resultJor" =>$resultJor, "resultSem" =>$resultSem, "resultRol" =>$resultRol, "resultEst" =>$resultEst
				
		));
		
	}
	
	public function InsertaAfiliados(){
		
			$afiliaciones = new UsuariosModel();
		
			session_start();
			
			
			///INSERTAMOS EL AFILIADO EN USUARIO
			if (isset($_POST["btn_guardar"]) )
			{
							
				$_nombres_usuario 	= strtoupper ( $_POST["nombres_usuario"] ); 
				$_apellidos_usuario  = strtoupper ( $_POST["apellidos_usuario"] );
				$_usuario_usuario   = $_POST["correo_usuario"];
				$_clave_usuario     = $_POST["clave_usuario"];
				$_id_pais           = $_POST["paises"];
				$_id_provincia      = $_POST["provincias"];
				$_telefono_usuario  = $_POST["telefono_usuario"];
				$_celular_usuario   = $_POST["celular_usuario"];
				$_correo_usuario    = $_POST["correo_usuario"];
				$_id_rol            = 3;   // afiliados
				$_id_estado         = 2; //sin activar
				$_clave_activacion_usuario = $afiliaciones->encrypt($_POST["correo_usuario"]);
				$_fecha_nacimiento = $_POST["fecha_nacimiento_usuario"];
				$_id_ocupaciones    = $_POST["ocupaciones"];
				$_extra_ocupaciones_usuario    = $_POST["extra_ocupaciones_usuario"];
				$funcion = "ins_usuarios";
				$parametros = " '$_nombres_usuario','$_apellidos_usuario', '$_usuario_usuario', '$_clave_usuario'
								 ,'$_id_pais', '$_id_provincia', '$_telefono_usuario', '$_celular_usuario'
								 ,'$_correo_usuario', '$_id_rol','$_id_estado', '$_clave_activacion_usuario'
								 , '$_fecha_nacimiento' , '$_id_ocupaciones' , '$_extra_ocupaciones_usuario'  ";
				$afiliaciones->setFuncion($funcion);
				$afiliaciones->setParametros($parametros);
				$resultado=$afiliaciones->Insert();
			
				$baseUrl = URLVADEMANO;
				$controladorAccion = "controller=Afiliaciones&action=ValidarAfiliado&clave_activacion=" . $_clave_activacion_usuario;
				$activacion = $baseUrl.$controladorAccion;
				
				
				
				
				$cabeceras = "MIME-Version: 1.0 \r\n";
				$cabeceras .= "Content-type: text/html; charset=utf-8 \r\n";
				$cabeceras.= "From: info@masoft.net \r\n";
				$destino="$_correo_usuario";
				$asunto="Afiliacion";
				$fecha=date("d/m/y");
				$hora=date("H:i:s");
				
				$resumen="
						
				<table rules='all'>
				<tr style='background:#7acb5a'><td WIDTH='1000' HEIGHT='50' align='center'><img src='https://jquery-file-upload.appspot.com/image%2Fpng/730648178/logo_vade.png'></td></tr>
				</tabla>
				<p><table rules='all'></p>
				<tr style='background: #FFFFFF;'><td  WIDTH='1000' align='center'><b> BIENVENIDO A VADEMANO </b></td></tr></p>
				<tr style='background: #FFFFFF;'><td  WIDTH='1000' align='justify'>Bienvenido a Vademano veterinario el portal digital que reúne toda la información  de relevancia relacionada con los productos  farmacéuticos de uso veterinario que se comercializan, busca proveer a médicos veterinarios, técnicos, especialistas y público en general  el más completo vademécum digital. 
                                      El Vademano Veterinario está diseñado como una herramienta web moderna, versátil y fácil de utilizar, que se ajusta a la versatilidad de los dispositivos de comunicación actual para que la búsqueda de información se convierta en una tarea sencilla que puede ser realizada a través de múltiples combinaciones de criterios: 
						              efecto terapéutico, forma farmacéutica, especies, etc.; asimismo dispondrá de la información de los productos en formato PDF, opción para imprimir, entre otras múltiples ventajas.</td></tr>
				</tabla>
				<p><table rules='all'></p>
				<tr style='background: #FFFFFF;'><td  WIDTH='1000' align='center'><b> ESTAS REGISTRADO EN VADEMANO</b></td></tr>
				<tr style='background: #FFFFFF;'><td WIDTH='1000'><b> Nombre: </b>$_nombres_usuario</td></tr>
				<tr style='background: #FFFFFF;'><td WIDTH='1000'><b> Apellido: </b>$_apellidos_usuario </td></tr>
				<tr style='background: #FFFFFF;'><td WIDTH='1000'></td></tr>
				</tabla>
				<p><table rules='all'></p>
				<tr style='background: #FFFFFF;'><td  WIDTH='1000' align='center'><b> TUS DATOS DE ACCESO SON: </b></td></tr>
				<tr style='background: #FFFFFF;'><td WIDTH='1000'><b> Usuario: </b>$_correo_usuario </td></tr>
				<tr style='background: #FFFFFF;'><td WIDTH='1000'><b> Clave: </b>$_clave_usuario </td></tr>
				<tr style='background: #FFFFFF;'><td WIDTH='1000'></td></tr>
				</tabla>
				<p><table rules='all'></p>
				<tr style='background: #FFFFFF;'><td WIDTH='1000' align='center'><b>  LINK DE ACTIVACION </b></td></tr>
				<tr style='background: #FFFFFF;'><td WIDTH='1000' align='center'><a href=$activacion>Activacion</A></td></tr>
				<tr style='background: #FFFFFF;'><td WIDTH='1000'></td></tr>
				</table>
				</tabla>
				<p><table rules='all'></p>
				<tr style='background:#1C1C1C'><td WIDTH='1000' HEIGHT='50' align='center'><font color='white'>Vademano. - Desarrollado por <a href='http://www.masoft.net'>www.masoft.net</a> - Copyright © 2016-</font></td></tr>
				</table>
				
				";
				
				
				
					
				if (mail("$destino","Afiliaciones","$resumen","$cabeceras"))
				{
					$this->view("Afiliaciones",array(
							"resultSet"=>"", "resultPais"=>"", "resultProv" =>"", "resultEdit" =>"", "resultado"=>"true"
					));
				
				
				}
				else
				{
					$this->view("Afiliaciones",array(
							"resultSet"=>"", "resultPais"=>"", "resultProv" =>"", "resultEdit" =>"", "resultado"=>"false"
					));
				
				
				
				}
				
			}
			
		
			
	}
	
}
?>
