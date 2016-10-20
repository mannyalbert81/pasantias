<?php 

$controladores=$_SESSION['controladores'];

 function getcontrolador($controlador,$controladores){
 	$display="display:none";
 	
 	if (!empty($controladores))
 	{
 	foreach ($controladores as $res)
 	{
 		if($res->nombre_controladores==$controlador)
 		{
 			$display= "display:block";
 			break;
 			
 		}
 	}
 	}
 	
 	return $display;
 }

?>


<div class="container" style="margin-top: 15px; " >
<div class="row">
<div class="col-xs-12">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>	
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown"  style="<?php echo getcontrolador("MenuAdministracion",$controladores) ?>">
        
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" ><?php echo " Administración" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          
        	<li style="<?php echo getcontrolador("Usuarios",$controladores) ?>">
        	<a href="index.php?controller=Usuarios&action=index"><span class="glyphicon glyphicon-user" aria-hidden="true"> Usuarios</span> </a>
		    </li>
			<li style="<?php echo getcontrolador("Roles",$controladores) ?>">
			<a href="index.php?controller=Roles&action=index"> <span class=" glyphicon glyphicon-asterisk" aria-hidden="true"> Roles de Usuario</span> </a>
			</li>
			<li style="<?php echo getcontrolador("PermisosRoles",$controladores) ?>">
			<a href="index.php?controller=PermisosRoles&action=index"><span class="glyphicon glyphicon-plus" aria-hidden="true"> Permisos Roles</span> </a>
			</li>
			<li style="<?php echo getcontrolador("Controladores",$controladores) ?>">
			<a href="index.php?controller=Controladores&action=index"><span class="glyphicon glyphicon-inbox" aria-hidden="true"> Controladores</span> </a>
			</li>
			<li style="<?php echo getcontrolador("Repositorio",$controladores) ?>">
			<a href="index.php?controller=Repositorio&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Gestion Repositorios</span> </a>
			</li>
			<li style="<?php echo getcontrolador("Entidades",$controladores) ?>">
			<a href="index.php?controller=Entidades&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Entidades</span> </a>
			</li>
			<li style="<?php echo getcontrolador("PlanCuentas",$controladores) ?>">
			<a href="index.php?controller=PlanCuentas&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Plan de Cuentas</span> </a>
			</li>

            <li style="<?php echo getcontrolador("TipoComprobantes",$controladores) ?>">
			<a href="index.php?controller=TipoComprobantes&action=index"> <span class=" glyphicon glyphicon-asterisk" aria-hidden="true"> Tipo de Comprobantes</span> </a>
			</li>

</ul>
</li>

        <li class="dropdown" style="<?php echo getcontrolador("MenuComprobantes",$controladores) ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Comprobantes" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          	<li style="<?php echo getcontrolador("Comprobantes",$controladores) ?>">
			<a href="index.php?controller=Comprobantes&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Comprobantes Ingreso / Egreso</span> </a>
			</li>
			
			<li style="<?php echo getcontrolador("ComprobanteContable",$controladores) ?>">
			<a href="index.php?controller=ComprobanteContable&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Comprobante Contable</span> </a>
			</li>
			
</ul>
</li>
        

          <li class="dropdown" style="<?php echo getcontrolador("MenuPlanCuentas",$controladores) ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Plan de Cuentas" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          <li style="<?php echo getcontrolador("PlanCuentas",$controladores) ?>">
		  <a href="index.php?controller=PlanCuentas&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Cuentas</span> </a>
		  </li>
		  
          <li style="<?php echo getcontrolador("CentroCostos",$controladores) ?>">
		  <a href="index.php?controller=CentroCostos&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Centro Costos</span> </a>
		  </li>
			
          <li style="<?php echo getcontrolador("ImportacionCuentas",$controladores) ?>">
		  <a href="index.php?controller=ImportacionCuentas&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Importación Cuentas</span> </a>
		  </li>
          
         
</ul>
</li>

          <li class="dropdown" style="<?php echo getcontrolador("MenuJuicios",$controladores) ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Juicios" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          <li style="<?php echo getcontrolador("JuicioMixto",$controladores) ?>">
          <a href="index.php?controller=Juicio&action=consulta_seguimiento_juicio"><span class="glyphicon glyphicon-sort" aria-hidden="true"> Seguimiento Juicio</span> </a>
          </li>
          <li style="<?php echo getcontrolador("AutoPagos",$controladores) ?>">
          <a href="index.php?controller=AutoPagos&action=index"><span class="glyphicon glyphicon-filter" aria-hidden="true"> Generar Auto Pago</span> </a>
          </li>
          <li style="<?php echo getcontrolador("AprobacionAutoPago",$controladores) ?>">
          <a href="index.php?controller=AprobacionAutoPago&action=index"><span class="glyphicon glyphicon-tasks" aria-hidden="true"> Aprobacion Auto Pagos</span> </a>
          </li>
    	  <li style="<?php echo getcontrolador("ImpresionAutoPago",$controladores) ?>">
    	  <a href="index.php?controller=ImpresionAutoPago&action=index"><span class=" glyphicon glyphicon-triangle-bottom" aria-hidden="true"> Impresion Auto Pagos</span> </a>
          </li>
          <li style="<?php echo getcontrolador("EtapasJuicios",$controladores) ?>">
    	  <a href="index.php?controller=EtapasJuicios&action=consulta_juicios"><span class=" glyphicon glyphicon-triangle-bottom" aria-hidden="true"> Actualizar Juicios</span> </a>
          </li>
          <li style="<?php echo getcontrolador("FichaJuicio",$controladores) ?>">
          <a href="index.php?controller=FichaJuicio&action=index"><span class="glyphicon glyphicon-hourglass" aria-hidden="true"> Ficha Juicio</span> </a>
          </li>
</ul>
</li>

<li class="dropdown" style="<?php echo getcontrolador("MenuOficios",$controladores) ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Oficios" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          <li style="<?php echo getcontrolador("Oficios",$controladores) ?>">
          <a href="index.php?controller=Oficios&action=index"><span class="glyphicon glyphicon-leaf" aria-hidden="true"> Generar Oficios</span> </a>
          </li>
          

</ul>
</li>


<li class="dropdown" style="<?php echo getcontrolador("MenuCitaciones",$controladores) ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Citaciones" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          <li style="<?php echo getcontrolador("Citaciones",$controladores) ?>">
          <a href="index.php?controller=Citaciones&action=index"><span class=" glyphicon glyphicon-usd" aria-hidden="true"> Generar Citaciones</span> </a>
          </li>
          
</ul>
</li>
      
      
<li class="dropdown" style="<?php echo getcontrolador("MenuDocumentos",$controladores) ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Documentos" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li style="<?php echo getcontrolador("Documentos",$controladores) ?>">
          <a href="index.php?controller=Documentos&action=index"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Emisón de Providencias</span> </a>
          </li>   
          <li style="<?php echo getcontrolador("Avoco",$controladores) ?>">
          <a href="index.php?controller=AvocoConocimiento&action=index"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Avoco Conocimiento</span> </a>           
          </li>
          
         
         
</ul>
</li>


<li class="dropdown" style="<?php echo getcontrolador("MenuFirmar",$controladores) ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Firmar Electronicamente" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
         
          <li style="<?php echo getcontrolador("FirmarOficios",$controladores) ?>">
          <a href="index.php?controller=FirmarOficios&action=consulta_oficios_secretarios"><span class="glyphicon glyphicon-leaf" aria-hidden="true"> Oficios</span> </a>
          </li>
          <li style="<?php echo getcontrolador("ConsultaDocumentosImpulsores",$controladores) ?>">
          <a href="index.php?controller=ConsultaDocumentosImpulsores&action=consulta_impulsores"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Providencias</span> </a>
          </li>
          <li style="<?php echo getcontrolador("ConsultaDocumentosSecretarios",$controladores) ?>">
          <a href="index.php?controller=ConsultaDocumentosSecretarios&action=consulta_secretarios"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Providencias</span> </a>           
          </li>
          
          <li style="<?php echo getcontrolador("ConsultaAvocoImpulsores",$controladores) ?>">
          <a href="index.php?controller=ConsultaAvocoImpulsores&action=consulta_impulsores_avoco"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Avoco Conocimiento</span> </a>
          </li>
          <li style="<?php echo getcontrolador("ConsultaAvocoSecretarios",$controladores) ?>">
          <a href="index.php?controller=ConsultaAvocoSecretarios&action=consulta_secretarios_avoco"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Avoco Conocimiento</span> </a>           
          </li>
          <li style="<?php echo getcontrolador("Citaciones",$controladores) ?>">
          <a href="index.php?controller=Citaciones&action=consulta_firmar"><span class="glyphicon glyphicon-link" aria-hidden="true"> Citaciones</span> </a>
          </li>
</ul>
</li>


</ul>
    </div>
  </div>
</nav>
</div>
</div>
</div>