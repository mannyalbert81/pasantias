    <?php include("view/modulos/head.php");?> 
    <?php include("view/modulos/menu.php");?>  
    <?php include("view/modulos/modal.php");?>
    
<!DOCTYPE HTML>
<html lang="es">
     <head>
         <meta charset="utf-8"/>
         <title>Comprobantes - Contabilidad 2016</title>
          <link rel="stylesheet" href="view/css/bootstrap.css">
          <link rel="stylesheet" href="view/css/Comprobantes/bootstrap.min.css">
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	      <script src="view/css/Comprobantes/jquery-1.11.1.min.js"></script>
	      <script src="view/js/bootstrapValidator.min.js"></script>
		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
       
       
       
       <script type="text/javascript">
        var v=true;
        $("span.help-block").hide();

        function verificar(){

            var v1=0, v2=0, v3=0, v4=0, v5=0;
            
            v1=validacion('id_plan_cuentas');
            v2=validacion('nombre_plan_cuentas');
            v3=validacion('descripcion_dcomprobantes');
            v4=validacion('debe_dcomprobantes');
            v5=validacion('haber_dcomprobantes');
            if (v1===false || v2===false || v3===false || v4===false || v5===false) {
                 $("#exito").hide();
                 $("#error").show();
            }else{
                $("#error").hide();
                $("#exito").show();
            }
            } 

  

        
        function validacion(campo){
            var a=0;

            if (campo==='id_plan_cuentas')
            {
                codigo = document.getElementById(campo).value;
                if( codigo == null || codigo.length == 0 || /^\s+$/.test(codigo) ) {
                    $("#glypcn"+campo).remove();
                    $('#'+campo).parent().parent().attr("class", "form-group has-error has-feedback");
                    $('#'+campo).parent().children('span').text("Ingrese Codigo").show();
                    $('#'+campo).parent().append("<span id='glypcn"+campo+"' class='glyphicon glyphicon-remove form-control-feedback'></span>");
                    return false;
                   
                }
                else
                {
                    if(isNaN(codigo)) {

                        $("#glypcn"+campo).remove();
                        $('#'+campo).parent().parent().attr("class", "form-group has-success has-feedback");
                        $('#'+campo).parent().children('span').hide();
                        $('#'+campo).parent().append("<span id='glypcn"+campo+"' class='glyphicon glyphicon-ok form-control-feedback'></span>");

              
                        return false;
                    }
                    else{

                        $("#glypcn"+campo).remove();
                        $('#'+campo).parent().parent().attr("class", "form-group has-success has-feedback");
                        $('#'+campo).parent().children('span').hide();
                        $('#'+campo).parent().append("<span id='glypcn"+campo+"' class='glyphicon glyphicon-ok form-control-feedback'></span>");
             
                        return true;
                    }
                    
                    
                }
                
            }

            if (campo==='nombre_plan_cuentas'){
                apellido = document.getElementById(campo).value;
                if( apellido == null || apellido.length == 0 || /^\s+$/.test(apellido) ) {
                    
                    $("#glypcn"+campo).remove();
                    $('#'+campo).parent().parent().attr("class", "form-group has-error has-feedback");
                    $('#'+campo).parent().children('span').text("Ingrese Nombre").show();
                    $('#'+campo).parent().append("<span id='glypcn"+campo+"' class='glyphicon glyphicon-remove form-control-feedback'></span>");
                    return false;
                    
                }
                else{
                    $("#glypcn"+campo).remove();
                    $('#'+campo).parent().parent().attr("class", "form-group has-success has-feedback");
                    $('#'+campo).parent().children('span').hide();
                    $('#'+campo).parent().append("<span id='glypcn"+campo+"' class='glyphicon glyphicon-ok form-control-feedback'></span>");
                    return true;
                    
                } 
            }


            if (campo==='descripcion_dcomprobantes'){
                apellido = document.getElementById(campo).value;
                if( apellido == null || apellido.length == 0 || /^\s+$/.test(apellido) ) {
                    
                    $("#glypcn"+campo).remove();
                    $('#'+campo).parent().parent().attr("class", "form-group has-error has-feedback");
                    $('#'+campo).parent().children('span').text("Ingrese Descripción").show();
                    $('#'+campo).parent().append("<span id='glypcn"+campo+"' class='glyphicon glyphicon-remove form-control-feedback'></span>");
                    return false;
                    
                }
                else{
                    $("#glypcn"+campo).remove();
                    $('#'+campo).parent().parent().attr("class", "form-group has-success has-feedback");
                    $('#'+campo).parent().children('span').hide();
                    $('#'+campo).parent().append("<span id='glypcn"+campo+"' class='glyphicon glyphicon-ok form-control-feedback'></span>");
                    return true;
                    
                } 
            }
        }
    </script>
       
      
      
       
    
    <script >   
    function numeros(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
    especiales = [8,37,39,46];
 
    tecla_especial = false
    for(var i in especiales){
    if(key == especiales[i]){
     tecla_especial = true;
     break;
        } 
    }
 
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
        return false;
     }
    </script > 
 
      <script>
      function activar(){
    	     var cana1=document.getElementById("debe_comprobantes").disabled=true;
    	}
      </script>
        

	<script>
	       	$(document).ready(function(){ 	
				$( "#id_plan_cuentas" ).autocomplete({
      				source: "<?php echo $helper->url("Comprobantes","AutocompleteComprobantesCodigo"); ?>",
      				minLength: 1
    			});

				$("#id_plan_cuentas").focusout(function(){
    				$.ajax({
    					url:'<?php echo $helper->url("Comprobantes","AutocompleteComprobantesDevuelveNombre"); ?>',
    					type:'POST',
    					dataType:'json',
    					data:{codigo_plan_cuentas:$('#id_plan_cuentas').val()}
    				}).done(function(respuesta){

    					$('#nombre_plan_cuentas').val(respuesta.nombre_plan_cuentas);
    					$('#plan_cuentas').val(respuesta.id_plan_cuentas);
    				
        			});
    				 
    				
    			});   
				
    		});

			
     </script>


		<script>
			       	$(document).ready(function(){ 	
						$( "#nombre_plan_cuentas" ).autocomplete({
		      				source: "<?php echo $helper->url("Comprobantes","AutocompleteComprobantesNombre"); ?>",
		      				minLength: 1
		    			});
		
						$("#nombre_plan_cuentas").focusout(function(){
		    				$.ajax({
		    					url:'<?php echo $helper->url("Comprobantes","AutocompleteComprobantesDevuelveCodigo"); ?>',
		    					type:'POST',
		    					dataType:'json',
		    					data:{nombre_plan_cuentas:$('#nombre_plan_cuentas').val()}
		    				}).done(function(respuesta){
		
		    					$('#id_plan_cuentas').val(respuesta.codigo_plan_cuentas);
		    					$('#plan_cuentas').val(respuesta.id_plan_cuentas);
		    				
		        			});
		    				 
		    				
		    			});   
						
		    		});
		
					
		     </script>

	
		         
     </head>
      <body class="cuerpo">
       
       
       <?php   
       
       $array_get=urlencode(serialize($arrayGet));
       $sel_id_tipo_comprobantes = "";
       $sel_nombres_ccomprobantes = "";
       $sel_ruc_ccomprobantes="";
       $sel_retencion_ccomprobantes="";
       $sel_concepto_ccomprobantes="";
     //  $sel_valor_ccomprobantes="";
       
      
       
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       
       	//die('entro a pst');
       
       	$sel_id_tipo_comprobantes = $_POST['id_tipo_comprobantes'];
       	$sel_nombres_ccomprobantes = $_POST['nombres_ccomprobantes'];
       	$sel_ruc_ccomprobantes=$_POST['ruc_ccomprobantes'];
       	$sel_retencion_ccomprobantes=$_POST['retencion_ccomprobantes'];
        $sel_concepto_ccomprobantes=$_POST['concepto_ccomprobantes'];
       //	$sel_valor_ccomprobantes=$_POST['valor_ccomprobantes'];
      }
      //if(empty($array_get))
      	
      if($_SERVER['REQUEST_METHOD']=='GET')
      {
      
      	if(isset($_GET['arrayGet']))
      	{
      		$a=stripslashes($_GET['arrayGet']);
      
      		$_dato=urldecode($a);
      
      		$_dato=unserialize($a);
      
      		$sel_id_tipo_comprobantes = $_dato['array_id_tipo_comprobantes'];
      		$sel_nombres_ccomprobantes = $_dato['array_nombres_ccomprobantes'];
      		$sel_ruc_ccomprobantes=$_dato['array_ruc_ccomprobantes'];
      		$sel_retencion_ccomprobantes=$_dato['array_retencion_ccomprobantes'];
      		$sel_concepto_ccomprobantes=$_dato['array_concepto_ccomprobantes'];
      		
      	}
      
      } 
     
      
     
      ?>
        
       <?php 
                  
                   $sumador_debe_total=0;
                   $sumador_haber_total=0;
                  
                   foreach($resultRes as $res) 
					
                    {
	        	 	$suma_debe= $res->debe_temp_comprobantes; 
	                $suma_debe_f=number_format($suma_debe,2);
	                $suma_debe_r=str_replace(",","",$suma_debe_f);//Reemplazo las comas
	                $sumador_debe_total+=$suma_debe_r;//Sumador
	                
	                $suma_haber= $res->haber_temp_comprobantes;
	                $suma_haber_f=number_format($suma_haber,2);
	                $suma_haber_r=str_replace(",","",$suma_haber_f);//Reemplazo las comas
	                $sumador_haber_total+=$suma_haber_r;//Sumador
	                }	
	                
	                $subtotal_debe=number_format($sumador_debe_total,2,'.','');
	                $subtotal_haber=number_format($sumador_haber_total,2,'.','');
	                 
	                ?>
             
    	<div class="container">
        <div class="row" style="background-color: #FAFAFA;">
  
  
  	
        <form id="frm-comprobantes" action="<?php echo $helper->url("Comprobantes","index"); ?>" method="post" enctype="multipart/form-data" class="col-lg-12">
            <br>	
            
              
	         
	         <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	         <div class="col-lg-12">
	         <div class="col-lg-1">
	         </div>
	         <div class="col-lg-10">
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <div class="row">
	         <div class="form-group" style="margin-left: 20px">
				               <label for="nombres_ccomprobantes" class="control-label"><h4><i class='glyphicon glyphicon-edit'></i> Nuevo Comprobante de </h4></label>
				               <input type="hidden" class="form-control" id="id_entidades" name="id_entidades" value="<?php echo $res->id_entidades; ?>">
                                 
             <div class="col-md-3 col-lg-3 col-xs-4" style="margin-top: 5px">
					           <select name="id_tipo_comprobantes" id="id_tipo_comprobantes"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultTipCom as $res) {?>
										<option value="<?php echo $res->id_tipo_comprobantes; ?>" <?php if($sel_id_tipo_comprobantes==$res->id_tipo_comprobantes){echo "selected";}?>   ><?php echo $res->nombre_tipo_comprobantes; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>	
		     </div>
			 </div>
	         </div>
	         </div>
	         </div>
	         </div>
	         <div class="col-lg-1">
	         </div>
	         </div>
	         <?php } }else{ ?>
  			 <?php } ?>
  			 
  			 <div class="col-lg-12">
	         <div class="col-lg-1">
	         </div>
	         <div class="col-lg-10">
	         <div class="panel panel-info">
	         <div class="panel-body">
	         <div class="row">
  		     <div class="col-xs-5 col-md-5">
		     <div class="form-group">
                                  <label for="nombres_ccomprobantes" class="control-label">Nombre: </label>
                                  <input type="text" class="form-control" id="nombres_ccomprobantes" name="nombres_ccomprobantes" value="<?php echo $sel_nombres_ccomprobantes;?>"  placeholder="Nombre">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     <div class="col-xs-3 col-md-3">
		     <div class="form-group">
                                  <label for="ruc_ccomprobantes" class="control-label">Ruc: </label>
                                  <input type="text" class="form-control" id="ruc_ccomprobantes" name="ruc_ccomprobantes" value="<?php echo $sel_ruc_ccomprobantes;?>"  placeholder="Ruc">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     <div class="col-xs-3 col-md-3">
		     <div class="form-group">
                                  <label for="retencion_ccomprobantes" class="control-label">#Retención: </label>
                                  <input type="text" class="form-control" id="retencion_ccomprobantes" name="retencion_ccomprobantes" value="<?php echo $sel_retencion_ccomprobantes;?>"  placeholder="# Retención">
                                  <span class="help-block"></span>
             </div>
		     </div>
  		     </div>
  		     
  		     <div class="row">
  		     <div class="col-xs-5 col-md-5">
		     <div class="form-group">
                                  <label for="concepto_ccomprobantes" class="control-label">Concepto de: </label>
                                  <input type="text" class="form-control" id="concepto_ccomprobantes" name="concepto_ccomprobantes" value="<?php echo $sel_concepto_ccomprobantes;?>"  placeholder="Concepto">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     <div class="col-xs-6 col-md-6">
		     <div class="form-group">
                                  <label for="valor_letras" class="control-label">Valor de: </label>
                                  <input type="hidden" class="form-control" id="valor_ccomprobantes" name="valor_ccomprobantes" value="<?php echo $subtotal_debe?>">
                                  <input type="text" class="form-control" id="valor_letras" name="valor_letras" value="<?php echo $subtotal_debe ? numtoletras ($subtotal_debe) : ''; ?>" readonly>
                                  <span class="help-block"></span>
             </div>
		     </div>
		     </div>
  		     <div class="col-md-12">
					<div class="pull-right">
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
						 <span class="glyphicon glyphicon-search"></span> Buscar Cuentas
						</button>
						<button type="submit" class="btn btn-default">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
					</div>	
			 </div>		
		    
  		     
  		     </div>                    
			 </div>
			 </div>
  		     <div class="col-lg-1">
	         </div>
             </div>
         	
         	 
	         <div class="col-lg-12">
	         <div class="col-lg-12">
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Buscar Cuentas</h4>
	         </div>
	         <div class="panel-body">
  			 <div class="row">
  			 <div class="form-group" style="margin-top:13px">
             <div class="col-xs-2 col-md-2">
             
                                  <label for="id_plan_cuentas" class="control-label" >#Cuenta: </label>
                                  <input type="text" class="form-control" id="id_plan_cuentas" name="id_plan_cuentas" value="" onkeyup="validacion('id_plan_cuentas');" placeholder="Search">
                                  <input type="hidden" class="form-control" id="plan_cuentas" name="plan_cuentas" value=""  placeholder="Search">
                                  <span class="help-block"></span>
             </div>
             </div>
		     
		     <div class="form-group">
		     <div class="col-xs-3 col-md-3">                     
                                  <label for="nombre_plan_cuentas" class="control-label">Nombre: </label>
                                  <input type="text" class="form-control" id="nombre_plan_cuentas" name="nombre_plan_cuentas" value="" onkeyup="validacion('nombre_plan_cuentas');" placeholder="Search">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-3 col-md-3">
		                          <label for="descripcion_dcomprobantes" class="control-label">Descripción: </label>
                                  <input type="text" class="form-control" id="descripcion_dcomprobantes" name="descripcion_dcomprobantes" value="" onkeyup="validacion('descripcion_dcomprobantes');" placeholder="">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     <div class="form-group">
             <div class="col-xs-2 col-md-2">
		                          <label for="debe_dcomprobantes" class="control-label">Debe: </label>
                                  <input type="text" class="form-control" id="debe_dcomprobantes" name="debe_dcomprobantes" value="" onkeypress="return numeros(event)" onkeyup="validacion('debe_dcomprobantes');" placeholder=""  onclick="activar()" disabled="disabled>
                                  <span class="help-block"></span>
             </div>
		     </div>
		     <div class="form-group">
             <div class="col-xs-2 col-md-2">
		                          <label for="haber_dcomprobantes" class="control-label">Haber: </label>
                                  <input type="text" class="form-control" id="haber_dcomprobantes" name="haber_dcomprobantes" value="" onkeypress="return numeros(event)" onkeyup="validacion('haber_dcomprobantes');" placeholder=""  disabled="disabled>
                                  <span class="help-block"></span>
             </div>
		     </div>
		     </div>
		     
		    <div class="row">
		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;">
		    <div class="form-group">
                  <button type="button" id="Agregar" name="Agregar" onclick='verificar();' class="btn btn-info"><i class="glyphicon glyphicon-plus"></i></button>
            </div>
		    </div>
		    </div>
		    </div>
	        </div>
	        </div>
	        </div>
	         
	        							
	      <?php if(!empty($resultRes))  {?>
		            
	       <div class="col-lg-12">
	       <div class="col-lg-12">
	       <div class="datagrid3"> 
           <table class="table table-hover ">
           <thead>
           <tr>
                    <th style="font-size:100%;">Cuenta</th>
		    		<th style="font-size:100%;">Nombre de la Cuenta</th>
		    		<th style="font-size:100%;">Descripción</th>
		    		<th style="font-size:100%;">Debe</th>
		    		<th style="font-size:100%;">Haber</th>
		    		<th></th>
		    		
	  		</tr>
	        </thead>
	           
                <?php if (!empty($resultRes)) {  foreach($resultRes as $res) {?>
	        	
	        <tbody>
	   		<tr>
	   					<td style="font-size:80%;"> <?php echo $res->codigo_plan_cuentas; ?>  </td>
		                <td style="font-size:80%;" > <?php echo $res->nombre_plan_cuentas; ?>     </td> 
		                <td style="font-size:80%;"> <?php echo $res->observacion_temp_comprobantes; ?>     </td>
		                <td style="font-size:80%;"> <?php echo $res->debe_temp_comprobantes; ?>     </td>  
		                <td style="font-size:80%;"> <?php echo $res->haber_temp_comprobantes; ?>     </td>  
			           	<td>   
			               	<div class="right">
			                    <a href="<?php echo $helper->url("Comprobantes","index"); ?>&id_temp_comprobantes=<?php echo $res->id_temp_comprobantes; ?>&arrayGet=<?php echo  $array_get ;?>"><i class="glyphicon glyphicon-trash"></i></a>
			                </div>
			            </td>
	   		</tr>
	        </tbody>	
	        <?php } }else{ ?>
            <?php 
		    }
		    
		    ?>
             <tr>
				
				<td class='text-center' colspan=3>TOTAL $</td>
				<td class='text-left'><?php echo number_format($subtotal_debe,2);?></td>
				<td class='text-left'><?php echo number_format($subtotal_haber,2);?></td>
				
			</tr>
             
         	 </table>     
		     </div>
	         </div>
	         </div>
	         
	         
		  <?php } else {?>
		  <?php } ?>
		 
	     
		    <div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px" > 
            <div class="form-group">
            					  <input type="submit" id="Guardar" name="Guardar" onclick="this.form.action='<?php echo $helper->url("Comprobantes","InsertaComprobantes"); ?>'" value="Guardar" class="btn btn-success"/>
            </div>
            </div>
            </div>
            </form>
            
              
               
       
        </div>
        </div>
        <div class="footer" style="margin-top:50px">
        <?php include("view/modulos/footer.php"); ?>
        </div>
     </body>  
    </html>  
    
   
    <?php 
    function numtoletras($xcifra)
    {
    	$xarray = array(0 => "Cero",
    			1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
    			"DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
    			"VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
    			100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    	);
    	//
    	$xcifra = trim($xcifra);
    	$xlength = strlen($xcifra);
    	$xpos_punto = strpos($xcifra, ".");
    	$xaux_int = $xcifra;
    	$xdecimales = "00";
    	if (!($xpos_punto === false)) {
    		if ($xpos_punto == 0) {
    			$xcifra = "0" . $xcifra;
    			$xpos_punto = strpos($xcifra, ".");
    		}
    		$xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
    		$xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    	}
    
    	$XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    	$xcadena = "";
    	for ($xz = 0; $xz < 3; $xz++) {
    		$xaux = substr($XAUX, $xz * 6, 6);
    		$xi = 0;
    		$xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
    		$xexit = true; // bandera para controlar el ciclo del While
    		while ($xexit) {
    			if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
    				break; // termina el ciclo
    			}
    
    			$x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
    			$xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
    			for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
    				switch ($xy) {
    					case 1: // checa las centenas
    						if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
    
    						} else {
    							$key = (int) substr($xaux, 0, 3);
    							if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
    								$xseek = $xarray[$key];
    								$xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
    								if (substr($xaux, 0, 3) == 100)
    									$xcadena = " " . $xcadena . " CIEN " . $xsub;
    									else
    										$xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
    										$xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
    							}
    							else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
    								$key = (int) substr($xaux, 0, 1) * 100;
    								$xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
    								$xcadena = " " . $xcadena . " " . $xseek;
    							} // ENDIF ($xseek)
    						} // ENDIF (substr($xaux, 0, 3) < 100)
    						break;
    					case 2: // checa las decenas (con la misma lógica que las centenas)
    						if (substr($xaux, 1, 2) < 10) {
    
    						} else {
    							$key = (int) substr($xaux, 1, 2);
    							if (TRUE === array_key_exists($key, $xarray)) {
    								$xseek = $xarray[$key];
    								$xsub = subfijo($xaux);
    								if (substr($xaux, 1, 2) == 20)
    									$xcadena = " " . $xcadena . " VEINTE " . $xsub;
    									else
    										$xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
    										$xy = 3;
    							}
    							else {
    								$key = (int) substr($xaux, 1, 1) * 10;
    								$xseek = $xarray[$key];
    								if (20 == substr($xaux, 1, 1) * 10)
    									$xcadena = " " . $xcadena . " " . $xseek;
    									else
    										$xcadena = " " . $xcadena . " " . $xseek . " Y ";
    							} // ENDIF ($xseek)
    						} // ENDIF (substr($xaux, 1, 2) < 10)
    						break;
    					case 3: // checa las unidades
    						if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
    
    						} else {
    							$key = (int) substr($xaux, 2, 1);
    							$xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
    							$xsub = subfijo($xaux);
    							$xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
    						} // ENDIF (substr($xaux, 2, 1) < 1)
    						break;
    				} // END SWITCH
    			} // END FOR
    			$xi = $xi + 3;
    		} // ENDDO
    
    		if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
    			$xcadena.= " DE";
    
    			if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
    				$xcadena.= " DE";
    
    				// ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
    				if (trim($xaux) != "") {
    					switch ($xz) {
    						case 0:
    							if (trim(substr($XAUX, $xz * 6, 6)) == "1")
    								$xcadena.= "UN BILLON ";
    								else
    									$xcadena.= " BILLONES ";
    									break;
    						case 1:
    							if (trim(substr($XAUX, $xz * 6, 6)) == "1")
    								$xcadena.= "UN MILLON ";
    								else
    									$xcadena.= " MILLONES ";
    									break;
    						case 2:
    							if ($xcifra < 1) {
    								$xcadena = "CERO DOLARES $xdecimales/100********";
    							}
    							if ($xcifra >= 1 && $xcifra < 2) {
    								$xcadena = "UN DOLAR $xdecimales/100********";
    							}
    							if ($xcifra >= 2) {
    								$xcadena.= " DOLARES $xdecimales/100*******"; //
    							}
    							break;
    					} // endswitch ($xz)
    				} // ENDIF (trim($xaux) != "")
    				// ------------------      en este caso, para México se usa esta leyenda     ----------------
    				$xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
    				$xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
    				$xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
    				$xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
    				$xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
    				$xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
    				$xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    	} // ENDFOR ($xz)
    	return trim($xcadena);
    }
    
    // END FUNCTION
    
    function subfijo($xx)
    { // esta función regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
    	$xsub = "";
    	//
    	if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
    		$xsub = "MIL";
    		//
    		return $xsub;
    }
    ?>
            