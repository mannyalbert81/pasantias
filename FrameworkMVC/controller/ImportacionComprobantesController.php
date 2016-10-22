<?php

class ImportacionComprobantesController extends ControladorBase{

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
			
			$nombre_controladores = "ImportacionComprobantes";
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
				
				
				$this->view("ImportacionComprobantes",array(
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
	
	public function ImportarComprobantes(){
			
		
		if (isset ($_POST["Importar"]))
		{
			$_id_entidad_a_importar="";
			if(isset($_POST["id_entidad"])){$_id_entidad_a_importar = $_POST["id_entidad"];}else{$_id_entidad_a_importar="";};
			$_id_entidad_importada = $_POST["id_entidad_importada"];
		
			$_archivo_cuenta='';
		
				
		
			$_archivo_cuenta=(isset($_FILES['archivo_cuentas']))? $_FILES['archivo_cuentas']['name']:'';
		
				
			if(isset($_POST["saldos"])&&$_id_entidad_a_importar!=""&&$_archivo_cuenta=='')
			{
				echo 'entro';
				die();
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
		
			if (isset ($_POST["Importar"])  &&   isset ($_FILES["archivo_comprobantes"])   )
			{
				 
				 
				 
				$directorio = $_SERVER['DOCUMENT_ROOT'].'/importar/';
		
				$nombre = $_FILES['archivo_comprobantes']['name'];
				$tipo = $_FILES['archivo_comprobantes']['type'];
				$tamano = $_FILES['archivo_comprobantes']['size'];
				move_uploaded_file($_FILES['archivo_comprobantes']['tmp_name'],$directorio.$nombre);
		
		
				$contador = 0;
				$contador_linea = 0;
				//$encabezado_linea = "";
				$contenido_linea = "";
		
				$lectura_linea = "";
				 
				$error_linea="";
		
				$file = fopen($directorio.$nombre, "r") or exit("Unable to open file!");
		
				$nuevo_comprobante = true;
				
				while(!feof($file))
				{
					$contador = $contador + 1;
		
					if ($contador > 1) ///salto EL ENCABEZADO
					{
						$lectura_linea =  fgets($file) ;
						//$encabezado_linea = fgets($file) ;
						 
						$tipo_doc='';
						$numero_doc='';
						$fecha_doc='';
						$codigo_cuenta='';
						$numero_cuenta='';
						$nombre_cuenta='';
						$debe_cuenta='';
						$haber_cuenta='';
						$descripcion_cuenta='';
						
						
						if((string)$lectura_linea!="")
						{
							$array_linea=explode(";", $lectura_linea);
		
							$tipo_doc=                trim($array_linea[0]);
							$numero_doc=              trim($array_linea[1]);  
							$fecha_doc=               trim($array_linea[4]);
							$codigo_cuenta=           trim($array_linea[5]);
							$numero_cuenta=           trim($array_linea[6]);
							$nombre_cuenta=           $array_linea[7];
							$debe_cuenta=             trim($array_linea[8]);
							$haber_cuenta=            trim($array_linea[9]);
							$descripcion_cuenta=       $array_linea[10];
							
							
							
							
						}
					    
					    
					    if ($numero_cuenta == 1)   ///cambia de comprobante
					    {
					    	$nuevo_comprobante = true;
					    }
					    else
					    {
					    	$nuevo_comprobante = false;
					    }
					    
					    
					    if ($nuevo_comprobante)
					    {
					     ///cambio consecutivo de comprobante	
					    	
					    }
					    else
					    {
					    	///sigo con el mismo
					    	
					    }
					    
					    
						if ($numero_cuenta == 1)
						{
							//nuevo consecutivo
							$actual_doc = $numero_doc; 
						}
							
						
						///primero inserto el temporal 
						
						
					}
		
				}
		
				fclose ($file);
			}
		
		
				
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/////termino
		
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
				    
				    $_archivo_cuenta='';
				    
				   
				    
				    $_archivo_cuenta=(isset($_FILES['archivo_cuentas']))? $_FILES['archivo_cuentas']['name']:'';
				    
				   				    
				    if(isset($_POST["saldos"])&&$_id_entidad_a_importar!=""&&$_archivo_cuenta=='')
					{ 
						echo 'entro';
						die();
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
				    
				    if (isset ($_POST["Importar"])  &&   isset ($_FILES["archivo_cuentas"])   )
				    {
				    	
				    	
				    	$id_entidad=isset($_POST["id_entidad_importada"])?$_POST["id_entidad_importada"]:0;
				    	
				    	$moneda = new MonedasModel();
				    	$resultMoneda=$moneda->getBy("nombre_monedas='DOLARES'");
				    	$id_moneda=$resultMoneda[0]->id_monedas;
				    	
				    	
				    	$directorio = $_SERVER['DOCUMENT_ROOT'].'/importar/';
				    
				    	$nombre = $_FILES['archivo_cuentas']['name'];
				    	$tipo = $_FILES['archivo_cuentas']['type'];
				    	$tamano = $_FILES['archivo_cuentas']['size'];
				    	move_uploaded_file($_FILES['archivo_cuentas']['tmp_name'],$directorio.$nombre);
				    
				    		
				    	$contador = 0;
				    	$contador_linea = 0;
				    	//$encabezado_linea = "";
				    	$contenido_linea = "";
				    
				    	$lectura_linea = "";
				    	
				    	$error_linea="";
				    		
				    	$file = fopen($directorio.$nombre, "r") or exit("Unable to open file!");
				    
				    	while(!feof($file))
				    	{
				    		$contador = $contador + 1;
				    
				    		if ($contador > 0) ///INSERTO EL ENCABEZADO
				    		{
				    			$lectura_linea =  fgets($file) ;
				    			//$encabezado_linea = fgets($file) ;
				    			
				    			$cuenta='';
				    			$num_cuenta=0;
				    			$nivel_cuenta=0;
				    			$t_cuenta='';
				    			$n_cuenta='';
				    			
				    			if((string)$lectura_linea!="")
				    			{
					    			$array_linea=explode(";", $lectura_linea);
					    			
					    			$codigo_cuenta=trim($array_linea[0]);
					    			$nombre_cuenta= utf8_decode( trim($array_linea[1]));
					    			
					    			$num_cuenta=substr($codigo_cuenta,0,1);
					    			
					    			if($num_cuenta==1)
					    			{
					    				$n_cuenta='D';
					    			}else if($num_cuenta==2)
					    			{
					    				$n_cuenta='A';
					    			}
					    							    			
					    			$longitud_str=strlen($codigo_cuenta);
					    			
					    			if($longitud_str>0)
					    			{
					    				switch ($longitud_str)
					    				{
					    					case 2 :
					    						$nivel_cuenta=1;
					    						$t_cuenta='G';
					    					break;
					    					case 4 :
					    						$nivel_cuenta=2;
					    						$t_cuenta='G';
					    					break;
					    					case 6 :
					    						$nivel_cuenta=3;
					    						$t_cuenta='G';
					    					break;
					    					case 8 :
					    						$nivel_cuenta=4;
					    						$t_cuenta='C';
					    					break;
					    					case 9 :
					    						$nivel_cuenta=5;
					    						$t_cuenta='S';
					    					break;
					    					case 10 :
					    						$nivel_cuenta=5;
					    						$t_cuenta='S';
					    					break;
					    				}
					    				
					    			}
				    				
					    		$funcion = "ins_plan_cuentas";
							
								$parametros = "'$id_entidad', '$codigo_cuenta', '$nombre_cuenta', '$id_moneda',
								'$n_cuenta','$t_cuenta','$nivel_cuenta'";
									
								$plan_cuentas->setFuncion($funcion);
						
								$plan_cuentas->setParametros($parametros);
						
									try {
					    
					    					$resultado=$plan_cuentas->Insert();
					    					
					    					echo 'linea --> '.$contador;
					    					echo '<br>';
					    					echo 'resultado -->'.$resultado.'<br><br>';
					    										
					    					
					    
					    
					    				} catch (Exception $e) {
					    
					    					$error_linea.=$contador.',';
					    				}
				    				
				    			}
				    							    
				    		}
				    
				    	}
				    
				    	fclose ($file);
				    }
				    
				    
					
			}else {
				
				$this->view("Error",array(
						"resultado"=>"No puede importar plan cuentas"
				));
				die();
					
			}
			
			die();
			
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