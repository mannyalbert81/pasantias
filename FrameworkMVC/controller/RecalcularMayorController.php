<?php

class RecalcularMayorController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}
	
	public function index(){
					
					$this->view("RecalcularMayor",array(
							
							"resultSet"=>"", "resultTipCom"=>""
					));
	
	}
	 
	
	
	
	
   public function ActualizarRecalcularMayor(){
   
   	session_start();
   
   	$resultado = null;
   	$permisos_rol=new PermisosRolesModel();
   
   	$mayor = new MayorModel();
   	$plan_cuentas = new PlanCuentasModel();
    
   
   	$nombre_controladores = "RecalcularMayor";
   	$id_rol= $_SESSION['id_rol'];
   	$resultPer = $ccomprobantes->getPermisosEditar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
   
   	if (!empty($resultPer))
   	{
   		
   		if (isset ($_POST["id_entidades"]))
   		{
   			$_id_plan_cuentas = 0;
   			$_n_plan_cuentas = '';
   			$_id_mayor = 0;
   			$_debe_mayor = 0;
   			$_haber_mayor = 0;
   			$_saldo_mayor = 0;
   			$_saldo_ini_mayor = 0;
   			
   			$resultMayor = $mayor->getBy(" id_mayor > 0  ORDER BY creado ");
   			foreach($resultMayor as $res)
   			{
   				$_id_mayor = $res->id_mayor;
   				$_id_plan_cuentas = $res->id_plan_cuentas;
   				$_debe_mayor = $res->debe_mayor;
   				$_haber_mayor = $res->haber_mayor;
   				$_saldo_mayor = $res->saldo_mayor;
   				
   				///busco naturaleza
   				$resulPlan = $plan_cuentas->getCondiciones(" n_plan_cuentas", "plan_cuentas", " id_plan_cuentas = '$_id_plan_cuentas'  ", "id_plan_cuentas");	
   				foreach($resultPlan as $res)
   				{
   					$_n_plan_cuentas = $res->n_plan_cuentas;
   				}
   				
   				if ($_n_plan_cuentas == "D")
   				{
   					$_saldo_ini_mayor = $_saldo_mayor - $_debe_mayor + $_haber_mayor; 
   					
   				}
   				if ($_n_plan_cuentas == "A")
   				{
   				
   					$_saldo_ini_mayor = $_saldo_mayor + $_debe_mayor - $_haber_mayor;
   				}
   				
   				$res = $mayor->UpdateBy(" saldo_ini_mayor = '$_saldo_ini_mayor' ", "mayor", " id_mayor = '$_id_mayor' "  );
   				
   			}
   			
   			
   			
   			
   			
   			
   			
   					
   		$this->redirect("RecalcularMayor","index")	;
   	}
   
   
   
   
   }
   
  	
   }
}
	

?>