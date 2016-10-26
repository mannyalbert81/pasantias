<?php

class RecalcularMayorController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}
	public function index(){
	
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$temp_comprobantes=new ComprobantesTemporalModel();
			$d_comprobantes = new DComprobantesModel();
			
			$tipo_comprobante=new TipoComprobantesModel();
			$resultTipCom = $tipo_comprobante->getBy("nombre_tipo_comprobantes='CONTABLE'");
			
		    $columnas_enc = "entidades.id_entidades, 
  							entidades.nombre_entidades,
		    		        consecutivos.numero_consecutivos";
		    $tablas_enc ="public.usuarios, 
						  public.entidades,
		    		      public.consecutivos";
		    $where_enc ="consecutivos.id_entidades = entidades.id_entidades AND entidades.id_entidades = usuarios.id_entidades AND consecutivos.nombre_consecutivos='CONTABLE' AND usuarios.id_usuarios='$_id_usuarios'";
		    $id_enc="entidades.nombre_entidades";
		    $resultSet=$d_comprobantes->getCondiciones($columnas_enc ,$tablas_enc ,$where_enc, $id_enc);
		    	
				
		    $permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "RecalcularMayor";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $permisos_rol->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
					
					$this->view("RecalcularMayor",array(
							
							"resultSet"=>$resultSet, "resultTipCom"=>$resultTipCom
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
	 
	
	
	
	
   public function ActualizarRecalcularMayor(){
   
   	session_start();
   
   	$resultado = null;
   	$permisos_rol=new PermisosRolesModel();
   
   	$forma_pago = new FormaPagoModel();
   	$consecutivos = new ConsecutivosModel();
    $ccomprobantes = new CComprobantesModel();
   	$dcomprobantes = new DComprobantesModel();
   	$tem_comprobantes = new ComprobantesTemporalModel();
   	$tipo_comprobantes = new TipoComprobantesModel();
   
   
   	$nombre_controladores = "RecalcularMayor";
   	$id_rol= $_SESSION['id_rol'];
   	$resultPer = $ccomprobantes->getPermisosEditar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
   
   	if (!empty($resultPer))
   	{
   		
   		if (isset ($_POST["id_entidades"]))
   		{
   
   			$_id_usuarios = $_SESSION['id_usuarios'];
   			
   			$where =  "id_usuario_registra= '$_id_usuarios' ";
   			$resultCom =  $tem_comprobantes->getBy($where);
   			
   			
   			$_id_entidades =$_POST['id_entidades'];
   			$_id_tipo_comprobantes =$_POST['id_tipo_comprobantes'];
   			
   			$resultConsecutivos = $consecutivos->getBy("nombre_consecutivos LIKE '%CONTABLE%' AND id_entidades='$_id_entidades' AND id_tipo_comprobantes='$_id_tipo_comprobantes'");
   			$_id_consecutivos=$resultConsecutivos[0]->id_consecutivos;
   			
   			$_numero_consecutivos=$resultConsecutivos[0]->numero_consecutivos;
   			$_update_numero_consecutivo=((int)$_numero_consecutivos)+1;
   			$_update_numero_consecutivo=str_pad($_update_numero_consecutivo,6,"0",STR_PAD_LEFT);
   			
   			$_ruc_ccomprobantes ="";
   			$_nombres_ccomprobantes ="";
   			$_retencion_ccomprobantes ="";
   			$_valor_ccomprobantes =$_POST['valor_ccomprobantes'];
   			$_concepto_ccomprobantes =$_POST['concepto_ccomprobantes'];
   			$_id_usuario_creador=$_SESSION['id_usuarios'];
   			$_valor_letras =$_POST['valor_letras'];
            $_fecha_ccomprobantes = $_POST['fecha_ccomprobantes']; 
            $_referencia_doc_ccomprobantes ="";
            $resultFormaPago = $forma_pago->getBy("nombre_forma_pago LIKE '%NINGUNA%'");
            $_id_forma_pago=$resultFormaPago[0]->id_forma_pago;
            $_numero_cuenta_banco_ccomprobantes="";
            $_numero_cheque_ccomprobantes="";
            $_observaciones_ccomprobantes="";
   			
   			
   			///PRIMERO INSERTAMOS LA CABEZA DEL COMPROBANTE
   			try
   			{
   					
   				$funcion = "ins_ccomprobantes";
   				$parametros = "'$_id_entidades','$_id_tipo_comprobantes', '$_numero_consecutivos','$_ruc_ccomprobantes','$_nombres_ccomprobantes' ,'$_retencion_ccomprobantes' ,'$_valor_ccomprobantes' ,'$_concepto_ccomprobantes', '$_id_usuario_creador', '$_valor_letras' , '$_fecha_ccomprobantes', '$_id_forma_pago', '$_referencia_doc_ccomprobantes', '$_numero_cuenta_banco_ccomprobantes', '$_numero_cheque_ccomprobantes', '$_observaciones_ccomprobantes' ";
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
   						
   						$resultSaldoIni = $plan_cuentas->getBy("id_plan_cuentas ='$_id_plan_cuentas' AND id_entidades ='$_id_entidades'");
   						$_saldo_ini=$resultSaldoIni[0]->saldo_fin_plan_cuentas;
   						
   						$_fecha_mayor = getdate();
   						$_fecha_año=$_fecha_mayor['year'];
   						$_fecha_mes=$_fecha_mayor['mon'];
   						$_fecha_dia=$_fecha_mayor['mday'];
   							
   						$_fecha_actual=$_fecha_año.'-'.$_fecha_mes.'-'.$_fecha_dia;
   							
   						////llamas a la funcion mayoriza();
   						$resul = $dcomprobantes->Mayoriza($_id_plan_cuentas, $_id_ccomprobantes, $_fecha_actual, $_debe_dcomprobantes, $_haber_dcomprobantes, $_saldo_ini);
   						$_cadena = $_id_plan_cuentas .'-'. $_id_ccomprobantes .'-'. $_fecha_actual .'-'. $_debe_dcomprobantes .'-'. $_haber_dcomprobantes .'-'. $_saldo_ini;
   							
   							
   						///LAS TRAZAS
   						$traza=new TrazasModel();
   						$_nombre_controlador = "ComprobanteContable";
   						$_accion_trazas  = "Guardar";
   						$_parametros_trazas = $_id_plan_cuentas;
   						$resulta = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
   							
   						
   						///borro de las solicitudes el carton
   						$where_del = "id_usuario_registra= '$_id_usuarios'";
   						$tem_comprobantes->deleteByWhere($where_del);
   							
   					   
   					} catch (Exception $e)
   					{
   						$this->view("Error",array(
   								"resultado"=>"Eror al Insertar Comprobante Contable ->". $id
   						));
   						exit();
   					}
   						
   				}					
   					
   					
   			}
   			catch (Exception $e)
   			{
   
   			}
   		
   
   		}	
   		
   		$this->redirect("RecalcularMayor","index")	;
   	}
   	else
   	{
   		$this->view("Error",array(
   				"resultado"=>"No tiene Permisos de Actualizar Recalcular Mayor"
   
   		));
   
   
   	}
   
   
   
   }
   
  	
	
	
}
?>