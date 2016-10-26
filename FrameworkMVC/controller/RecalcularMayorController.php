<?php

class RecalcularMayorController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}
	
	public function index(){
					
		session_start();
					$this->view("RecalcularMayor",array(
							
							"resultSet"=>"", "resultTipCom"=>""
					));
	
	}
	 
	
	
	
	
   public function ActualizarRecalcularMayor(){
   
   	session_start();
   
   	$mayor = new MayorModel();
   	$plan_cuentas = new PlanCuentasModel();
    
   
   	$nombre_controladores = "RecalcularMayor";
   
   	
   	
   		if (isset ($_POST["Guardar"]))
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
   				$resultPlan = $plan_cuentas->getCondiciones(" n_plan_cuentas", "plan_cuentas", " id_plan_cuentas = '$_id_plan_cuentas'  ", "id_plan_cuentas");	
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
   			
   					
   		
   	}else{
   		
   	}
   
  
   
   
   }
   
  	
   
}
	

?>