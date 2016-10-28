<?php

class MayorGeneralController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}


	public function MayorGeneral(){
	
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		//Creamos el objeto usuario
		$resultSet="";
		$registrosTotales = 0;
		$arraySel = "";
		
		$ccomprobantes = new CComprobantesModel();
		$dcomprobantes = new DComprobantesModel();
		$tipo_comprobantes = new TipoComprobantesModel();
		$entidades = new EntidadesModel();
		
		
		$tipo_comprobante=new TipoComprobantesModel();
		$resultTipCom = $tipo_comprobante->getAll("nombre_tipo_comprobantes");
		
		
		$columnas_enc = "entidades.id_entidades,
  							entidades.nombre_entidades";
		$tablas_enc ="public.usuarios,
						  public.entidades";
		$where_enc ="entidades.id_entidades = usuarios.id_entidades AND usuarios.id_usuarios='$_id_usuarios'";
		$id_enc="entidades.nombre_entidades";
		$resultEnt=$entidades->getCondiciones($columnas_enc ,$tablas_enc ,$where_enc, $id_enc);
		
		
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "MayorGeneral";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $ccomprobantes->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
				if(isset($_POST["id_entidades"])){
	
	
					$id_entidades=$_POST['id_entidades'];
					$id_tipo_comprobantes=$_POST['id_tipo_comprobantes'];
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];
										
					$columnas = " mayor.id_mayor, 
								  ccomprobantes.id_ccomprobantes, 
								  usuarios.nombre_usuarios, 
								  tipo_comprobantes.nombre_tipo_comprobantes, 
								  entidades.nombre_entidades, 
							      entidades.ruc_entidades, 
								  entidades.telefono_entidades, 
								  entidades.direccion_entidades, 
								  entidades.ciudad_entidades,
								  ccomprobantes.numero_ccomprobantes, 
								  ccomprobantes.ruc_ccomprobantes, 
								  ccomprobantes.nombres_ccomprobantes, 
								  ccomprobantes.retencion_ccomprobantes, 
								  ccomprobantes.valor_ccomprobantes, 
								  ccomprobantes.concepto_ccomprobantes, 
								  ccomprobantes.valor_letras, 
								  ccomprobantes.fecha_ccomprobantes, 
								  ccomprobantes.referencia_doc_ccomprobantes, 
								  ccomprobantes.numero_cuenta_banco_ccomprobantes, 
								  ccomprobantes.numero_cheque_ccomprobantes, 
								  ccomprobantes.observaciones_ccomprobantes, 
							      plan_cuentas.id_plan_cuentas,
								  plan_cuentas.codigo_plan_cuentas, 
								  plan_cuentas.nombre_plan_cuentas, 
								  plan_cuentas.saldo_fin_plan_cuentas, 
								  mayor.fecha_mayor, 
								  mayor.debe_mayor, 
								  mayor.haber_mayor, 
								  mayor.saldo_mayor, 
								  mayor.saldo_ini_mayor, 
								  mayor.creado, 
								  ccomprobantes.creado";
	
	
	
					$tablas=" public.ccomprobantes, 
							  public.mayor, 
							  public.plan_cuentas, 
							  public.tipo_comprobantes, 
							  public.usuarios, 
							  public.entidades";
								
					$where=" ccomprobantes.id_usuarios = usuarios.id_usuarios AND
							  mayor.id_ccomprobantes = ccomprobantes.id_ccomprobantes AND
							  plan_cuentas.id_plan_cuentas = mayor.id_plan_cuentas AND
							  tipo_comprobantes.id_tipo_comprobantes = ccomprobantes.id_tipo_comprobantes AND
							  entidades.id_entidades = ccomprobantes.id_entidades AND usuarios.id_usuarios='$_id_usuarios'";
	
					$id="plan_cuentas.codigo_plan_cuentas, ccomprobantes.creado";
	
	
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					
					if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
	
					if($id_tipo_comprobantes!=0){$where_1=" AND tipo_comprobantes.id_tipo_comprobantes='$id_tipo_comprobantes'";}
	
					if($fechadesde!="" && $fechahasta!=""){$where_2=" AND  mayor.fecha_mayor BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2;
	
	
					$resultSet=$ccomprobantes->getCondiciones($columnas ,$tablas , $where_to, $id);
	
	
					
					/*
					foreach($resultSet as $res)
					{
						$registrosTotales = $registrosTotales + 1 ;
					}
	
	
				}
				else{
						
						
					$registrosTotales = 0;
					$hojasTotales = 0;
	
	
					$arraySel = "";
					$resultSet = "";
						
				}
				///aqui va la paginacion  ///
				$articulosTotales = 0;
				$paginasTotales = 0;
				$paginaActual = 0;
				$ultima_pagina = 1;
					
				if(isset($_POST["pagina"])){
	
					// en caso que haya datos, los casteamos a int
					$paginaActual = (int)$_POST["pagina"];
					$ultima_pagina = (int)$_POST["ultima_pagina"] - 5;
				}
	
				if(isset($_POST["siguiente_pagina"])){
	
					// en caso que haya datos, los casteamos a int
					$ultima_pagina = (int)$_POST["ultima_pagina"];
				}
	
					
				if(isset($_POST["anterior_pagina"])){
	
	
					$ultima_pagina = (int)$_POST["ultima_pagina"] - 10;
	
	
				}
	
	
				if ($resultSet != "")
				{
	
					foreach($resultSet as $res)
					{
						$articulosTotales = $articulosTotales + 1;
					}
	
	
					$articulosPorPagina = 50;
	
					$paginasTotales = ceil($articulosTotales / $articulosPorPagina);
	
	
					// el número de la página actual no puede ser menor a 0
					if($paginaActual < 1){
						$paginaActual = 1;
					}
					else if($paginaActual > $paginasTotales){ // tampoco mayor la cantidad de páginas totales
						$paginaActual = $paginasTotales;
					}
	
					// obtenemos cuál es el artículo inicial para la consulta
					$articuloInicial = ($paginaActual - 1) * $articulosPorPagina;
	
					//agregamos el limit
					$limit = " LIMIT   '$articulosPorPagina' OFFSET '$articuloInicial'";
	
					//volvemos a pedir el resultset con la pginacion
	
					$resultSet=$ccomprobantes->getCondicionesPag($columnas ,$tablas ,$where_to,  $id, $limit );
	
	*/
	
				}
	
	
	
	/*		$this->view("ReporteComprobantes",array(
						"resultSet"=>$resultSet, "resultTipCom"=> $resultTipCom,
						"resultEnt"=>$resultEnt,
						"arraySel"=>$arraySel, "paginasTotales"=>$paginasTotales,
						"registrosTotales"=> $registrosTotales,"pagina_actual"=>$paginaActual, "ultima_pagina"=>$ultima_pagina
							
							
				));
	
				*/
				
				$this->view("MayorGeneral",array(
						"resultSet"=>$resultSet, "resultTipCom"=> $resultTipCom,
						"resultEnt"=>$resultEnt
						
							
							
				));
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso Mayor General"
	
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
	
    
	
	
}
?>