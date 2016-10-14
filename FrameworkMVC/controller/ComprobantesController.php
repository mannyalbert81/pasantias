<?php

class ComprobantesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

//maycol

	public function index(){
	
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$arrayGet=array();
			$temp_comprobantes=new ComprobantesTemporalModel();
			$d_comprobantes = new DComprobantesModel();
			
			$tipo_comprobante=new TipoComprobantesModel();
			$resultTipCom = $tipo_comprobante->getAll("nombre_tipo_comprobantes");
			
			
		    $columnas_enc = "entidades.id_entidades, 
  							entidades.nombre_entidades";
		    $tablas_enc ="public.usuarios, 
						  public.entidades";
		    $where_enc ="entidades.id_entidades = usuarios.id_entidades AND usuarios.id_usuarios='$_id_usuarios'";
		    $id_enc="entidades.nombre_entidades";
		    $resultSet=$d_comprobantes->getCondiciones($columnas_enc ,$tablas_enc ,$where_enc, $id_enc);
		    	
				
		    $permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Comprobantes";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $permisos_rol->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
				
				if (isset($_POST['ruc_ccomprobantes'])){
					
				$_ruc_ccomprobantes =$_POST['ruc_ccomprobantes'];
				$_nombres_ccomprobantes =$_POST['nombres_ccomprobantes'];
				$_id_tipo_comprobantes =$_POST['id_tipo_comprobantes'];
				$_retencion_ccomprobantes =$_POST['retencion_ccomprobantes'];
				$_concepto_ccomprobantes =$_POST['concepto_ccomprobantes'];
				$resultTipoComprobantes = $tipo_comprobante->getBy("id_tipo_comprobantes='$_id_tipo_comprobantes'");
					
				$arrayGet['array_ruc_ccomprobantes']=$_ruc_ccomprobantes;
				$arrayGet['array_nombres_ccomprobantes']=$_nombres_ccomprobantes;
				//$arrayGet['array_nombre_tipo_comprobantes']=$resultTipoComprobantes[0]->nombre_tipo_comprobantes;
				$arrayGet['array_id_tipo_comprobantes']=$resultTipoComprobantes[0]->id_tipo_comprobantes;
				$arrayGet['array_retencion_ccomprobantes']=$_retencion_ccomprobantes;
				$arrayGet['array_concepto_ccomprobantes']=$_concepto_ccomprobantes;
				}
				
					
				if(isset($_GET["id_temp_comprobantes"]))
				{
					$_id_usuarios= $_SESSION['id_usuarios'];
					$id_temp_comprobantes=(int)$_GET["id_temp_comprobantes"];
						
					$where = "id_usuario_registra = '$_id_usuarios' AND id_temp_comprobantes = '$id_temp_comprobantes'  ";
					$resultado = $temp_comprobantes->deleteByWhere($where);
						
					//$temp_comprobantes->deleteBy(" id_temp_comprobantes",$id_temp_comprobantes);
				
					$traza=new TrazasModel();
					$_nombre_controlador = "Comprobantes";
					$_accion_trazas  = "Borrar";
					$_parametros_trazas = $id_temp_comprobantes;
					$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				}
				
				
				
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
				$id_res="temp_comprobantes.id_temp_comprobantes";
				
				$resultRes=$d_comprobantes->getCondiciones($columnas_res ,$tablas_res ,$where_res, $id_res);
				
				
				 
					
					$this->view("Comprobantes",array(
							
							"resultSet"=>$resultSet, "resultRes"=>$resultRes, "resultTipCom"=>$resultTipCom, "arrayGet"=>$arrayGet
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
	 
	
	
	/*
	public function InsertarTemporal(){
		
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		
		
		$temp_comprobantes=new ComprobantesTemporalModel();
		$nombre_controladores = "Comprobantes";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $temp_comprobantes->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		
		
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
	}
		
   */
	
   public function InsertaComprobantes(){
   
   	session_start();
   
   	$resultado = null;
   	$permisos_rol=new PermisosRolesModel();
   
   	
   	$consecutivos = new ConsecutivosModel();
    $ccomprobantes = new CComprobantesModel();
   	$dcomprobantes = new DComprobantesModel();
   	$tem_comprobantes = new ComprobantesTemporalModel();
   	$tipo_comprobantes = new TipoComprobantesModel();
   
   
   	$nombre_controladores = "Comprobantes";
   	$id_rol= $_SESSION['id_rol'];
   	$resultPer = $ccomprobantes->getPermisosEditar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
   
   	if (!empty($resultPer))
   	{
   		
   		if (isset ($_POST["id_entidades"]))
   		{
   
   			$_id_usuarios = $_SESSION['id_usuarios'];
   			
   			$where =  "id_usuario_registra= '$_id_usuarios' ";
   			$resultCom =  $tem_comprobantes->getBy($where);
   			
   			$_id_tipo_comprobantes =$_POST['id_tipo_comprobantes'];
   			$resultTip = $tipo_comprobantes->getBy("id_tipo_comprobantes='$_id_tipo_comprobantes'");
   			$_nombre_tipo_comprobantes=$resultTip[0]->nombre_tipo_comprobantes;
   			
   			
   		if ($_nombre_tipo_comprobantes == "INGRESOS")
   	 	{
   				
   				
   				
   			$_id_entidades =$_POST['id_entidades'];
   			$resultConsecutivos = $consecutivos->getBy("nombre_consecutivos LIKE '%INGRESOS%' AND id_entidades='$_id_entidades'");
   			$_id_consecutivos=$resultConsecutivos[0]->id_consecutivos;
   			
   			$_numero_consecutivos=$resultConsecutivos[0]->numero_consecutivos;
   			$_update_numero_consecutivo=((int)$_numero_consecutivos)+1;
   			$_update_numero_consecutivo=str_pad($_update_numero_consecutivo,6,"0",STR_PAD_LEFT);
   			
   			$_ruc_ccomprobantes =$_POST['ruc_ccomprobantes'];
   			$_nombres_ccomprobantes =$_POST['nombres_ccomprobantes'];
   			$_id_tipo_comprobantes =$_POST['id_tipo_comprobantes'];
   			$_retencion_ccomprobantes =$_POST['retencion_ccomprobantes'];
   			$_valor_ccomprobantes =$_POST['valor_ccomprobantes'];
   			$_concepto_ccomprobantes =$_POST['concepto_ccomprobantes'];
   			$_id_usuario_creador=$_SESSION['id_usuarios'];
   			$_valor_letras =$_POST['valor_letras'];
   			
   
   
   
   			///PRIMERO INSERTAMOS LA CABEZA DEL COMPROBANTE
   			try
   			{
   					
   				$funcion = "ins_ccomprobantes";
   				$parametros = "'$_id_entidades','$_id_tipo_comprobantes', '$_numero_consecutivos','$_ruc_ccomprobantes','$_nombres_ccomprobantes' ,'$_retencion_ccomprobantes' ,'$_valor_ccomprobantes' ,'$_concepto_ccomprobantes', '$_id_usuario_creador', '$_valor_letras'";
   				$ccomprobantes->setFuncion($funcion);
   				$ccomprobantes->setParametros($parametros);
   				$resultado=$ccomprobantes->Insert();
   				
   				
   				$resultConsecutivo=$consecutivos->UpdateBy("numero_consecutivos='$_update_numero_consecutivo'", "consecutivos", "id_consecutivos='$_id_consecutivos'");
   				
   				
   				//$print="'$_id_entidades','$_id_tipo_comprobantes', '$_numero_consecutivos','$_ruc_ccomprobantes','$_nombres_ccomprobantes' ,'$_retencion_ccomprobantes' ,'$_valor_ccomprobantes' ,'$_concepto_ccomprobantes', '$_id_usuario_creador'";
   				//$this->view("Error",array("resultado"=>$print));	
   				//die();
   
   				///INSERTAMOS DETALLE  DEL MOVIMIENTO
   					
   				foreach($resultCom as $res)
   				{
   
   					//busco si existe este nuevo id
   					try
   					{
   						$_id_plan_cuentas = $res->id_plan_cuentas;
   						$_descripcion_dcomprobantes = $res->observacion_temp_comprobantes;
   						$_debe_dcomprobantes = $res->debe_temp_comprobantes;
   						$_haber_dcomprobantes = $res->haber_temp_comprobantes;
   
   						$resultComprobantes = $ccomprobantes->getBy("numero_ccomprobantes ='$_numero_consecutivos' AND id_entidades ='$_id_entidades' AND id_tipo_comprobantes='$_id_tipo_comprobantes'");
   						$_id_ccomprobantes=$resultComprobantes[0]->id_ccomprobantes;
   						
   						
   						
   						$funcion = "ins_dcomprobantes";
   						$parametros = "'$_id_ccomprobantes','$_numero_consecutivos','$_id_plan_cuentas', '$_descripcion_dcomprobantes', '$_debe_dcomprobantes', '$_haber_dcomprobantes'";
   						$dcomprobantes->setFuncion($funcion);
   						$dcomprobantes->setParametros($parametros);
   						$resultado=$dcomprobantes->Insert();
   						
   						
   							
   						///LAS TRAZAS
   						$traza=new TrazasModel();
   						$_nombre_controlador = "Comprobantes";
   						$_accion_trazas  = "Guardar";
   						$_parametros_trazas = $_id_plan_cuentas;
   						$resulta = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
   							
   						
   						///borro de las solicitudes el carton
   						$where_del = "id_usuario_registra= '$_id_usuarios'";
   						$tem_comprobantes->deleteByWhere($where_del);
   							
   							
   							
   							
   
   					} catch (Exception $e)
   					{
   						$this->view("Error",array(
   								"resultado"=>"Eror al Insertar Comprobantes ->". $id
   						));
   						exit();
   					}
   						
   				}					
   					
   					
   			}
   			catch (Exception $e)
   			{
   
   					
   
   			}
   
   
   			
   		}
   		else{
   			
   			$_id_entidades =$_POST['id_entidades'];
   			$resultConsecutivos = $consecutivos->getBy("nombre_consecutivos LIKE '%EGRESOS%' AND id_entidades='$_id_entidades'");
   			$_id_consecutivos=$resultConsecutivos[0]->id_consecutivos;
   			
   			$_numero_consecutivos=$resultConsecutivos[0]->numero_consecutivos;
   			$_update_numero_consecutivo=((int)$_numero_consecutivos)+1;
   			$_update_numero_consecutivo=str_pad($_update_numero_consecutivo,6,"0",STR_PAD_LEFT);
   			
   			$_ruc_ccomprobantes =$_POST['ruc_ccomprobantes'];
   			$_nombres_ccomprobantes =$_POST['nombres_ccomprobantes'];
   			$_id_tipo_comprobantes =$_POST['id_tipo_comprobantes'];
   			$_retencion_ccomprobantes =$_POST['retencion_ccomprobantes'];
   			$_valor_ccomprobantes =$_POST['valor_ccomprobantes'];
   			$_concepto_ccomprobantes =$_POST['concepto_ccomprobantes'];
   			$_id_usuario_creador=$_SESSION['id_usuarios'];
   			$_valor_letras =$_POST['valor_letras'];
   			
   			 
   			 
   			 
   			///PRIMERO INSERTAMOS LA CABEZA DEL COMPROBANTE
   			try
   			{
   			
   				$funcion = "ins_ccomprobantes";
   				$parametros = "'$_id_entidades','$_id_tipo_comprobantes', '$_numero_consecutivos','$_ruc_ccomprobantes','$_nombres_ccomprobantes' ,'$_retencion_ccomprobantes' ,'$_valor_ccomprobantes' ,'$_concepto_ccomprobantes', '$_id_usuario_creador', '$_valor_letras'";
   				$ccomprobantes->setFuncion($funcion);
   				$ccomprobantes->setParametros($parametros);
   				$resultado=$ccomprobantes->Insert();
   				
   				$resultConsecutivo=$consecutivos->UpdateBy("numero_consecutivos='$_update_numero_consecutivo'", "consecutivos", "id_consecutivos='$_id_consecutivos'");
   					
   					
   				//$print="'$_id_entidades','$_id_tipo_comprobantes', '$_numero_consecutivos','$_ruc_ccomprobantes','$_nombres_ccomprobantes' ,'$_retencion_ccomprobantes' ,'$_valor_ccomprobantes' ,'$_concepto_ccomprobantes', '$_id_usuario_creador', '$_valor_letras'";
   				//$this->view("Error",array("resultado"=>$print));
   				//die();
   				 
   				///INSERTAMOS DETALLE  DEL MOVIMIENTO
   			
   				foreach($resultCom as $res)
   				{
   					 
   					//busco si existe este nuevo id
   					try
   					{
   						$_id_plan_cuentas = $res->id_plan_cuentas;
   						$_descripcion_dcomprobantes = $res->observacion_temp_comprobantes;
   						$_debe_dcomprobantes = $res->debe_temp_comprobantes;
   						$_haber_dcomprobantes = $res->haber_temp_comprobantes;
   						 
   						$resultComprobantes = $ccomprobantes->getBy("numero_ccomprobantes ='$_numero_consecutivos' AND id_entidades ='$_id_entidades' AND id_tipo_comprobantes='$_id_tipo_comprobantes'");
   						$_id_ccomprobantes=$resultComprobantes[0]->id_ccomprobantes;
   							
   							
   							
   						$funcion = "ins_dcomprobantes";
   						$parametros = "'$_id_ccomprobantes','$_numero_consecutivos','$_id_plan_cuentas', '$_descripcion_dcomprobantes', '$_debe_dcomprobantes', '$_haber_dcomprobantes'";
   						$dcomprobantes->setFuncion($funcion);
   						$dcomprobantes->setParametros($parametros);
   						$resultado=$dcomprobantes->Insert();
   			
   						$_fecha_mayor = getdate();
   						
   						////llamas a la funcion mayoriza();
   						$resul = $dcomprobantes->Mayoriza($_id_plan_cuentas, $_id_ccomprobantes, $_fecha_mayor, $_debe_dcomprobantes, $_haber_dcomprobantes);
   						$_cadena = $_id_plan_cuentas .'-'. $_id_ccomprobantes .'-'. $_fecha_mayor .'-'. $_debe_dcomprobantes .'-'. $_haber_dcomprobantes ; 
   						
   						///LAS TRAZAS
   						$traza=new TrazasModel();
   						$_nombre_controlador = "Comprobantes";
   						$_accion_trazas  = "Guardar";
   						$_parametros_trazas = $_id_plan_cuentas;
   						$resulta = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
   			
   							
   						$where_del = "id_usuario_registra= '$_id_usuarios'";
   						$tem_comprobantes->deleteByWhere($where_del);
   			
   			
   			
   			
   						 
   					} catch (Exception $e)
   					{
   						$this->view("Error",array(
   								"resultado"=>"Eror al Insertar Comprobantes ->". $id
   						));
   						exit();
   					}
   						
   				}
   			
   			
   			}
   			catch (Exception $e)
   			{
   				 
   			
   				 
   			}
   			 
   			
   			
   		}
   		
   		
   
   		}	
   		
   		$this->redirect("Comprobantes","index")	;
   	}
   	else
   	{
   		$this->view("Error",array(
   				"resultado"=>"No tiene Permisos de Guardar Comprobantes"
   
   		));
   
   
   	}
   
   
   
   }
   
    
   /*
   
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
   
    
   */
   
   
		
	
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
 				 plan_cuentas.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND plan_cuentas.nivel_plan_cuentas='4'";
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
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		
		
		$plan_cuentas = new PlanCuentasModel();
		$codigo_plan_cuentas = $_POST['codigo_plan_cuentas'];
		
		
		$columnas ="plan_cuentas.codigo_plan_cuentas,
				  plan_cuentas.nombre_plan_cuentas,
				  plan_cuentas.id_plan_cuentas";
		$tablas =" public.usuarios,
				  public.entidades,
				  public.plan_cuentas";
		$where ="plan_cuentas.codigo_plan_cuentas = '$codigo_plan_cuentas' AND entidades.id_entidades = usuarios.id_entidades AND
		plan_cuentas.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND plan_cuentas.nivel_plan_cuentas='4'";
		$id ="plan_cuentas.codigo_plan_cuentas";
		
		
		$resultSet=$plan_cuentas->getCondiciones($columnas, $tablas, $where, $id);
		
	
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
		plan_cuentas.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND plan_cuentas.nivel_plan_cuentas='4'";
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
	
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		
		$plan_cuentas = new PlanCuentasModel();
	
		$nombre_plan_cuentas = $_POST['nombre_plan_cuentas'];
	

		$columnas ="plan_cuentas.codigo_plan_cuentas,
				  plan_cuentas.nombre_plan_cuentas,
				  plan_cuentas.id_plan_cuentas";
		$tablas =" public.usuarios,
				  public.entidades,
				  public.plan_cuentas";
		$where ="plan_cuentas.nombre_plan_cuentas = '$nombre_plan_cuentas' AND entidades.id_entidades = usuarios.id_entidades AND
		plan_cuentas.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND plan_cuentas.nivel_plan_cuentas='4'";
		$id ="plan_cuentas.codigo_plan_cuentas";
		
		
		$resultSet=$plan_cuentas->getCondiciones($columnas, $tablas, $where, $id);
		
	
		$respuesta = new stdClass();
	
		if(!empty($resultSet)){
	
			$respuesta->codigo_plan_cuentas = $resultSet[0]->codigo_plan_cuentas;
			$respuesta->id_plan_cuentas = $resultSet[0]->id_plan_cuentas;
	
			echo json_encode($respuesta);
		}
	
	}
	
	
	
	
}
?>