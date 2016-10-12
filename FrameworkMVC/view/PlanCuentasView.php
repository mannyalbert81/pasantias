<?php include("view/modulos/modal.php"); ?>
<?php include("view/modulos/head.php"); ?>
<?php $n_plan_cuentas=array("A"=>'Acreedora',"D"=>'Deudora')?>

<?php //print_r($resultCodigo_p_cuentas);				?>

<!DOCTYPE HTML>
<html lang="es">
     <head>
         <meta charset="utf-8"/>
        <title>Plan de Cuentas - Contabilidad 2016</title>
        
          <link rel="stylesheet" href="view/css/bootstrap.css">
          <script src="view/js/jquery.js"></script>
          <script src="view/js/jquery-ui.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		  <script src="view/js/ValidarPlanCuentas.js"></script>
		  <style type="text/css">
			 .img{border-radius: 25px;}
			 .img:hover{
			 
			 	border-radius: 25px;
			 	-moz-box-shadow: 0 0 10px #ccc;
			 	 -webkit-box-shadow: 0 0 10px #ccc;
			 	 box-shadow: 0 0 10px #ccc;
			    -webkit-transform: scale(1.25);
			    -moz-transform: scale(1.25);
			    -o-transform: scale(1.25);
			    -ms-transform: scale(1.25);
			    transform: scale(1.25)
			}
			.textfail.form-control
			{
			border: 1px solid red;
			-moz-box-shadow: 0 0 10px red;
			-webkit-box-shadow: 0 0 10px red;
			box-shadow: 0 0 10px red;
			}
		 </style>
		
		<script type="text/javascript">
		$(function(){

		        $('#agregar_grupo').click(function(){

		        	var  valCuentas = $("#val_radio_cuentas").text();
		        	var  valCodigo = $("#val_codigo").text();
		        	
		        	
		        	if(valCuentas>0)
				    {
		        		//alert('hola');
					    //opcion para dialosg no usados position:'center',
					        $('#modal_grupo').dialog({
				                            autoOpen: false,
				                            modal: true,
				                            height: 550,
				                            width: 500,
				                            buttons: {
				                "Aceptar": function() {
					                //code origin
					                //var checking = $('#check').jserialize();
				                    //loading('#cargando','Cargando');
				                    

					                var datos = { 
							                id_entidad_p_cuentas:$('#id_entidad').val(),
			                    	 		nombre_p_cuentas:$('#modal_grupo_nombre').val(),
			                    	 		codigo_p_cuentas:$('#modal_grupo_codigo').val(),
			                    	 		id_moneda_p_cuentas:$('#modal_grupo_id_moneda').val(),
			                    	 		n_p_cunetas:$('#modal_grupo_naturaleza').val(),
			                    	 		t_p_cuentas:$('#modal_grupo_tipo').val(),
			                    	 		id_centro_c_p_cuentas:$('#modal_grupo_id_centro_c').val(),
			                    	 		nivel_p_cuentas:$('#modal_grupo_nivel').val()
			                    	 	 };
				                     //alert(datos['id_entidad_p_cuentas']);
				                     
				                 var nombreSubgrupo= $('#modal_grupo_nombre').val();
			                    
			                     if(nombreSubgrupo!='')
			                     {
					                $.ajax({
				                           url:"<?php echo $helper->url("PlanCuentas","AgregarGrupo");?>"
				                           ,type : "POST"
				                           ,async: true
				                           ,data : datos
				                           ,success: function(msg){

				                        	   var res = msg.split('"');
				                        	   
					                           if(res[1]=='1' || res[1]==1)
					                           {
				                                $('#modal_grupo').dialog('close');
				                                //loading();
					                           }else
					                           {
					                        	   $('#modal_respuesta_grupo').html ("<span style='color:red'>!sus datos no se registraron..</span>"); 
							                     
					                           }
				                           }
				                   });
				                     
			                     }else
			                     {
			                    	 textFail("modal_grupo_nombre");
			                         $('#modal_respuesta_grupo').html ("<span style='color:red'>!Existen campos vacios..</span>"); 
			                           
			                     }                      
				   
				                },
				                "Cancelar": function(){
				                    $('#modal_grupo').dialog('close');
				                }
				            }    

				        }); 

						var codigoC=valCuentas+'.'+valCodigo+'.';

				        var  html = "";
				        html+="<h4 style='color:#ec971f;'>Registrar Nuevo Grupo </h4><hr/>"
			            html+="<div class = 'col-xs-12 col-md-6'>";
				        html+="<div class='form-group'>";
				        html+="<label for='modal_grupo_nombre' class='control-label'>Nombre</label><br>";
				        html+="<input type='text' class='form-control' style='text-transform:uppercase;' id='modal_grupo_nombre' name='modal_grupo_nombre' value='' onfocus='textSucces(this)' >";
				        html+="</div>";
				        html+="</div>";
				        html+="<div class = 'col-xs-12 col-md-6'>";
				        html+="<div class='form-group'>";
				        html+="<label for='modal_grupo_codigo' class='control-label'>Codigo</label><br>";
				        html+="<input type='text' class='form-control' id='modal_grupo_codigo' name='modal_grupo_codigo' value='"+codigoC+"' >";
				        html+="</div>";
				        html+="</div>";
				        html+="<div class = 'col-xs-12 col-md-6'>";
				        html+="<div class='form-group'>";
				        html+="<label for='modal_grupo_tipo' class='control-label'>Tipo</label><br>";
				        html+="<input type='text' class='form-control' id='modal_grupo_tipo' name='modal_grupo_tipo' value='G' >";
				        html+="</div>";
				        html+="</div>";
				        html+="<div class = 'col-xs-12 col-md-6'>";
				        html+="<div class='form-group'>";
				        html+="<label for='modal_grupo_nivel' class='control-label'>Nivel</label><br>";
				        html+="<input type='text' class='form-control' id='modal_grupo_nivel' name='modal_grupo_nivel' value='2' >";
				        html+="</div>";
				        html+="</div>";
				        html+="<div class='col-xs-12 col-md-6'>";
				        html+="<div class='form-group'>";
				        html+="<label for='modal_grupo_naturaleza' class='control-label'>Naturaleza</label>";
				        html+="<select name='modal_grupo_naturaleza' id='modal_grupo_naturaleza'  class='form-control' >";
				        html+="<?php if(!empty($n_plan_cuentas)){ foreach($n_plan_cuentas as $res=>$valor) {?>";
				        html+="<option value='<?php echo $res; ?>' ><?php echo $valor; ?> </option>";
						html+="<?php } }else{?>";
						html+="<option value='-1' >Sin registros</option>";
						html+="<?php }?>";
					    html+="</select>"; 
					    html+="<span class='help-block'></span>"; 
					    html+="</div>";
					    html+="</div>";
				        html+="<div class='col-xs-12 col-md-6'>";
				        html+="<div class='form-group'>";
				        html+="<label for='modal_grupo_id_centro_c' class='control-label'>Centro Costos</label>";
				        html+="<select name='modal_grupo_id_centro_c' id='modal_grupo_id_centro_c'  class='form-control' >";
				        html+="<?php if(!empty($resultCentroC)){ foreach($resultCentroC as $res) {?>";
				        html+="<option value='<?php echo $res->id_centro_costos; ?>' ><?php echo $res->nombre_centro_costos; ?> </option>";
						html+="<?php } }else{?>";
						html+="<option value='-1' >Sin registros</option>";
						html+="<?php }?>";
					    html+="</select>"; 
					    html+="<span class='help-block'></span>"; 
					    html+="</div>";
					    html+="</div>";
					    html+="<div class='col-xs-12 col-md-6'>";
				        html+="<div class='form-group'>";
				        html+="<label for='modal_grupo_id_moneda' class='control-label'>Moneda</label>";
				        html+="<select name='modal_grupo_id_moneda' id='modal_grupo_id_moneda'  class='form-control' >";
				        html+="<?php if(!empty($resultMoneda)){ foreach($resultMoneda as $res) {?>";
				        html+="<option value='<?php echo $res->id_monedas; ?>' ><?php echo $res->nombre_monedas; ?> </option>";
						html+="<?php } }else{?>";
						html+="<option value='-1' >Sin Grupos</option>";
						html+="<?php }?>";
					    html+="</select>"; 
					    html+="<span class='help-block'></span>"; 
					    html+="</div>";
					    html+="</div>";
					    html+="<div class='col-xs-12 col-md-12' id='modal_respuesta_grupo'></div><br>";

					    				       
				        $('#modal_grupo').html (html);  
				       

				        $('#modal_grupo').dialog('open');
						
				    }
				    else{

					    alert('Seleccione una cuenta')
					    
				    }


		        });

		    
		});
		
		</script>
		
		<script type="text/javascript">
		$(function(){
			
			$('#agregar_subgrupo').click(function(){

	        	var   valCuentas = $("#val_radio_cuentas").text();
	        	var valGrupo = $("#id_grupo").val();
	        	var subgrupo = $("#val_grupo").text();

	        	if(valCuentas>0&&(valGrupo!=null||valGrupo<0))
			    {
	        		
				        $('#modal_subgrupo').dialog({
			                            autoOpen: false,
			                            modal: true,
			                            height: 550,
			                            width: 500,
			                            buttons: {
			                "Aceptar": {
				                id:'modal_id_subgrupo',
				                text:'Aceptar',
				                click:function() {
				                
				                var datos = { 
						                id_entidad_p_cuentas:$('#id_entidad').val(),
		                    	 		nombre_p_cuentas:$('#modal_subgrupo_nombre').val(),
		                    	 		codigo_p_cuentas:$('#modal_subgrupo_codigo').val(),
		                    	 		id_moneda_p_cuentas:$('#modal_subgrupo_id_moneda').val(),
		                    	 		n_p_cunetas:$('#modal_subgrupo_naturaleza').val(),
		                    	 		t_p_cuentas:$('#modal_subgrupo_tipo').val(),
		                    	 		id_centro_c_p_cuentas:$('#modal_subgrupo_id_centro_c').val(),
		                    	 		nivel_p_cuentas:$('#modal_subgrupo_nivel').val()
		                    	 	 };
			                     //alert(datos['id_entidad_p_cuentas']);
			                    var nombreSubgrupo= $('#modal_subgrupo_nombre').val();
			                    
			                     if(nombreSubgrupo!='')
			                     {
				                	$.ajax({
			                           url:"<?php echo $helper->url("PlanCuentas","AgregarSubGrupo");?>"
			                           ,type : "POST"
			                           ,async: true
			                           ,data : datos
			                           ,success: function(msg){

			                        	   var res = msg.split('"');
			                        	   
				                           if(res[1]=='1' || res[1]==1)
				                           {
			                                $('#modal_subgrupo').dialog('close');
			                                
				                           }else
				                           {  
				                        	 $('#modal_respuesta_subgrupo').html ("<span> sus datos no se registraron</span>"); 
				                           }
			                           }
			                   		});
			                     }else
			                     {
			                    	 textFail("modal_subgrupo_nombre");
			                         $('#modal_respuesta_subgrupo').html ("<span style='color:red'>!Existen campos vacios..</span>"); 
			                           
				                  }
			                     
			                	}
			                },
			                "Cancelar": function(){
			                    $('#modal_subgrupo').dialog('close');
			                }
			            }    

			        }); 

			        var  html = "";
			        html+="<h4 style='color:#ec971f;'>Registrar Nuevo SubGrupo </h4><hr/>"
		            html+="<div class = 'col-xs-12 col-md-6'>";
			        html+="<div class='form-group'>";
			        html+="<label for='modal_subgrupo_nombre' class='control-label'>Nombre</label><br>";
			        html+="<input type='text' class='form-control' style='text-transform:uppercase;' id='modal_subgrupo_nombre' name='modal_subgrupo_nombre' value='' onfocus='textSucces(this)'>";
			        html+="<span class='help-block'></span>"; 
			        html+="</div>";
			        html+="</div>";
			        html+="<div class = 'col-xs-12 col-md-6'>";
			        html+="<div class='form-group'>";
			        html+="<label for='modal_subgrupo_codigo' class='control-label'>Codigo</label><br>";
			        html+="<input type='text' class='form-control' id='modal_subgrupo_codigo' name='modal_subgrupo_codigo' value='"+subgrupo+"' >";
			        html+="</div>";
			        html+="</div>";
			        html+="<div class = 'col-xs-12 col-md-6'>";
			        html+="<div class='form-group'>";
			        html+="<label for='modal_subgrupo_tipo' class='control-label'>Tipo</label><br>";
			        html+="<input type='text' class='form-control' id='modal_subgrupo_tipo' name='modal_subgrupo_tipo' value='G' >";
			        html+="</div>";
			        html+="</div>";
			        html+="<div class = 'col-xs-12 col-md-6'>";
			        html+="<div class='form-group'>";
			        html+="<label for='modal_subgrupo_nivel' class='control-label'>Nivel</label><br>";
			        html+="<input type='text' class='form-control' id='modal_subgrupo_nivel' name='modal_subgrupo_nivel' value='3' >";
			        html+="</div>";
			        html+="</div>";
			        html+="<div class='col-xs-12 col-md-6'>";
			        html+="<div class='form-group'>";
			        html+="<label for='modal_subgrupo_naturaleza' class='control-label'>Naturaleza</label>";
			        html+="<select name='modal_subgrupo_naturaleza' id='modal_subgrupo_naturaleza'  class='form-control' >";
			        html+="<?php if(!empty($n_plan_cuentas)){ foreach($n_plan_cuentas as $res=>$valor) {?>";
			        html+="<option value='<?php echo $res; ?>' ><?php echo $valor; ?> </option>";
					html+="<?php } }else{?>";
					html+="<option value='-1' >Sin registros</option>";
					html+="<?php }?>";
				    html+="</select>"; 
				    html+="<span class='help-block'></span>"; 
				    html+="</div>";
				    html+="</div>";
			        html+="<div class='col-xs-12 col-md-6'>";
			        html+="<div class='form-group'>";
			        html+="<label for='modal_subgrupo_id_centro_c' class='control-label'>Centro Costos</label>";
			        html+="<select name='modal_subgrupo_id_centro_c' id='modal_subgrupo_id_centro_c'  class='form-control' >";
			        html+="<?php if(!empty($resultCentroC)){ foreach($resultCentroC as $res) {?>";
			        html+="<option value='<?php echo $res->id_centro_costos; ?>' ><?php echo $res->nombre_centro_costos; ?> </option>";
					html+="<?php } }else{?>";
					html+="<option value='-1' >Sin registros</option>";
					html+="<?php }?>";
				    html+="</select>"; 
				    html+="<span class='help-block'></span>"; 
				    html+="</div>";
				    html+="</div>";
				    html+="<div class='col-xs-12 col-md-6'>";
			        html+="<div class='form-group'>";
			        html+="<label for='modal_subgrupo_id_moneda' class='control-label'>Moneda</label>";
			        html+="<select name='modal_subgrupo_id_moneda' id='modal_subgrupo_id_moneda'  class='form-control' >";
			        html+="<?php if(!empty($resultMoneda)){ foreach($resultMoneda as $res) {?>";
			        html+="<option value='<?php echo $res->id_monedas; ?>' ><?php echo $res->nombre_monedas; ?> </option>";
					html+="<?php } }else{?>";
					html+="<option value='-1' >Sin Grupos</option>";
					html+="<?php }?>";
				    html+="</select>"; 
				    html+="<span class='help-block'></span>"; 
				    html+="</div>";
				    html+="</div>";
				    html+="<div class='col-xs-12 col-md-12' id='modal_respuesta_subgrupo'></div><br>";
			       
			       
			        $('#modal_subgrupo').html (html);  
			       

			        $('#modal_subgrupo').dialog('open');
					
			    }
			    else{

				    alert('Seleccione una cuenta \n o \n aun no a gregado un grupo ')
				    
			    }


	        });
		    
			       
		   
		    
		});
		
		</script>
		
		<!-- funcion para llenar los grupos al selecionas las cuentas (Pasivo,Activo,Patrimonio,Egresos,Ingresos) -->
		<script type="text/javascript">

		$(document).ready(function(){

			$("input:radio[name='cuentas']").change(function() {

				// identificamos al ddl a cambiar
		           var grupo = $("#id_grupo");
		           var subgrupo = $("#id_subgrupo");
		           
		        // tomamos parametros -> idgrupo,entidades
		           var cuentas = $(this).val();
		           var entidades = $("#id_entidad").val();

		        //tomar valor de radio buton en la pagina
		        $("#val_radio_cuentas").text(cuentas);

		        //vaciamos el ddl a cambiar
		           //grupo.empty();
		           //grupo.append("<option value='-1' >Sin Registros</option>");

		          
		            if(cuentas != 0)
		            {
			            var datos = {  
			            		 	idcuentas: cuentas,
			            		 	identidades: entidades 
		                    	 	 };

				        //alert(datos['idcuentas']+'\n'+datos['identidades']);
		            	
		         	   	$.post("<?php echo $helper->url("PlanCuentas","returnGrupo"); ?>", datos, function(resultado) {
		         	   	grupo.empty();

		         		 		$.each(resultado, function(index, value) {
		         		 			
		         		 			grupo.append("<option value= " +value.id_plan_cuentas +" >" + value.nombre_plan_cuentas  + "</option>");	
		                    		 });

		         		 		 	 		   
		         		  }, 'json');

	            	
	         	   	$.post("<?php echo $helper->url("PlanCuentas","returnSubGrupo"); ?>", datos, function(resultado) {
	         	   	subgrupo.empty();

	         		 		$.each(resultado, function(index, value) {
	         		 			
	         		 			subgrupo.append("<option value= " +value.id_plan_cuentas +" >" + value.nombre_plan_cuentas  + "</option>");	
	                    		 });

	         		 		 	 		   
	         		  }, 'json');


	         	 //para traer el ultimo codigo 
		        	$.ajax({
				            url:"<?php echo $helper->url("PlanCuentas","returnCodGrupo");?>"
				            ,type : "POST"
				            ,async: true
				            ,data : {idcuentas:cuentas,identidades:entidades}
				            ,success: function(msg){
					            
					            if(msg!='')
					               {
					            	$("#val_codigo").text(parseInt(msg));
					               }
				            }
		            });
	                //fin codigo anterior

		         		  


		            }
		            else
		            {
		            	grupo.empty();
		            	grupo.append("<option value='-1' >Sin Registros</option>");
		            	subgrupo.empty();
		            	subgrupo.append("<option value='-1' >Sin Registros</option>");
		            	//alert('vacio');

		            }
			  });

			});
		
		</script>
		
		<script type="text/javascript">
		$(document).ready(function(){

			$('#id_grupo').bind('click', function(){
				
				var numElementos=$('#id_grupo option').size(); 

				if(numElementos==1)
				{
					call_returnCodSubGrupo();
					call_returnSubGrupo();
					
				}else if(numElementos>1)
				{
					$("#id_grupo").change(function() {		
						call_returnCodSubGrupo();
						call_returnSubGrupo();
						
												
					});
					
					
				}
				
			 });

			
		});
		</script>
		
		<!-- funciones con conexion a bd -->
		
		<script type="text/javascript">
		function call_returnCodSubGrupo()
		{
			var cuentas = $("#val_radio_cuentas").text();
        	var valGrupo = $("#id_grupo").val();
        	var entidades = $("#id_entidad").val();

			$.ajax({
	            url:"<?php echo $helper->url("PlanCuentas","returnCodSubGrupo");?>"
	            ,type : "POST"
	            ,async: true
	            ,data : {idcuentas:cuentas,identidades:entidades,idgrupo:valGrupo}
	            ,success: function(msg){
		            //alert(msg);
		            if(msg!='')
		               {
		            	
		            	 var res = msg.split('"');
		            	$("#val_grupo").text(String(res[1]));
		               }
	               }
        		});

			
    		
		}

		function call_returnSubGrupo()
		{
			var cuentas = $("#val_radio_cuentas").text();
        	var valGrupo = $("#id_grupo").val();
        	var entidades = $("#id_entidad").val();
        	var subgrupo=$("#id_subgrupo");

        	

        	$.post("<?php echo $helper->url("PlanCuentas","returnSubGrupo1"); ?>", {identidades:entidades,idgrupo:valGrupo}, function(resultado) {
         	   	subgrupo.empty();

         	   console.log(resultado);

         		 		$.each(resultado, function(index, value) {
         		 			subgrupo.append("<option value= " +value.id_plan_cuentas +" data-codigo_plan_cuentas="+value.codigo_plan_cuentas+" >" + value.nombre_plan_cuentas  + "</option>");	
         		 			    		 });

         		 		 	 		   
         		  }, 'json');

		}

		function call_returnSubGrupo2()
		{
			var cuentas = $("#val_radio_cuentas").text();
        	var valGrupo = $("#id_grupo").val();
        	var entidades = $("#id_entidad").val();
        	var subgrupo=$("#id_subgrupo");

        	

        	$.post("<?php echo $helper->url("PlanCuentas","returnSubGrupo1"); ?>", {identidades:entidades,idgrupo:valGrupo}, function(resultado) {
         	   	subgrupo.empty();

         	   

         		 		$.each(resultado, function(index, value) {
         		 			subgrupo.append("<option value= " +value.id_plan_cuentas +" >" + value.nombre_plan_cuentas  + "</option>");	
                    		 });

         		 		 	 		   
         		  }, 'json');

		}
			
		</script>
		
		<script type="text/javascript">
		function textFail(field)
		{
			
			
			$("#"+field).removeClass("form-control");
			$("#"+field).addClass("textfail form-control");
		}

		function textSucces(field)
		{
			var id_campo = field.id
			$("#"+id_campo).removeClass("textfail form-control");
			$("#"+id_campo).addClass("form-control");
			$('#modal_respuesta_subgrupo').html ("");
		}

		
		
		
		</script>
		
		
		
		
		
        
    </head>
    <body>
   
       
       <?php include("view/modulos/menu.php"); ?>
       
       <?php $t_plan_cuentas=array("acreedora"=>'Acreedora',"deudora"=>'Deudora')?>
  
 	    <div class="container">
  		<div class="row" style="background-color: #FAFAFA;">
        <form id="form-plan_cuentas" action="<?php echo $helper->url("PlanCuentas","InsertaPlanCuentas"); ?>" method="post" enctype="multipart/form-data" class="col-lg-6">
            <br>
            
            <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	       
	        <div class="well">
	        <h4 style="color:#ec971f;">Registrar Plan de Cuentas</h4>
            <hr/>
	        <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="ruc_entidades" class="control-label">Ruc</label>
                                  <input type="text" class="form-control" id="ruc_entidades" name="ruc_entidades" value="<?php echo $resEdit->ruc_entidades; ?>"  placeholder="Ruc">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="nombre_entidades" class="control-label">Nombre</label>
                                  <input type="text" class="form-control" id="nombre_entidades" name="nombre_entidades" value="<?php echo $resEdit->nombre_entidades; ?>"  placeholder="Nombre">
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
	         
	        <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="telefono_entidades" class="control-label">Teléfono</label>
                                  <input type="text" class="form-control" id="telefono_entidades" name="telefono_entidades" value="<?php echo $resEdit->telefono_entidades; ?>"  placeholder="Teléfono">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="direccion_entidades" class="control-label">Dirección</label>
                                  <input type="text" class="form-control" id="direccion_entidades" name="direccion_entidades" value="<?php echo $resEdit->direccion_entidades; ?>"  placeholder="Dirección">
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
	        
	        
	        <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="ciudad_entidades" class="control-label">Ciudad</label>
                                  <input type="text" class="form-control" id="ciudad_entidades" name="ciudad_entidades" value="<?php echo $resEdit->ciudad_entidades; ?>"  placeholder="Ciudad">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    </div>
	        </div>
	     	
	            	  
            
		     <?php } } else {?>
		    
		    <div class="well">
		    <h4 style="color:#ec971f;">Registrar Plan de Cuentas</h4>
            <hr/>
            
            <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="id_entidad" class="control-label">Entidad</label>
                 <select name="id_entidad" id="id_entidad"  class="form-control" >
					 <?php foreach($resultEntidad as $res) {?>
					 <option value="<?php echo $res->id_entidades; ?>" ><?php echo $res->nombre_entidades; ?> </option>
					 <?php } ?>
			     </select> 
			     <span class="help-block"></span>
            </div>
		    </div>
		   
			</div>
			
			<div class="row">
		    <div class="col-xs-4 col-md-4">
		    <div class="form-group">
                 <label for="activo" class="control-label">Activo &nbsp; &nbsp;  &nbsp; &nbsp;</label>
                 <input type="radio" name="cuentas" id="activo" value="1" />
  			     <span class="help-block"></span>
            </div>
		    </div>
		     <div class="col-xs-4 col-md-4">
		    <div class="form-group">
                 <label for="pasivo" class="control-label">Pasivo  &nbsp; &nbsp; &nbsp; </label>
                 <input type="radio" name="cuentas" id="pasivo" value="2" />
  			     <span class="help-block"></span>
            </div>
		    </div>
		     <div class="col-xs-4 col-md-4">
		    <div class="form-group">
                 <label for="patrimonio" class="control-label">Patrimonio  &nbsp; &nbsp;</label>
                 <input type="radio" name="cuentas" id="patrimonio" value="3" />
  			     <span class="help-block"></span>
            </div>
		    </div>
		     <div class="col-xs-4 col-md-4">
		    <div class="form-group">
                 <label for="ingresos" class="control-label">Ingresos  &nbsp; &nbsp;</label>
                 <input type="radio" name="cuentas" id="ingresos" value="4" />
  			     <span class="help-block"></span>
            </div>
		    </div>
		     <div class="col-xs-4 col-md-4">
		    <div class="form-group">
                 <label for="egresos" class="control-label">Egresos  &nbsp; &nbsp;</label>
                 <input type="radio" name="cuentas" id="egresos" value="5" />
  			     <span class="help-block"></span>
            </div>
		    </div>
			</div>
            
            <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="id_grupo" class="control-label">Grupo</label>
                 <select name="id_grupo" id="id_grupo"  class="form-control" >
					 <?php if(!empty($resultGrupo)){ foreach($resultGrupo as $res) {?>
					 <option value="<?php echo $res->id_entidades; ?>" ><?php echo $res->nombre_entidades; ?> </option>
					 <?php } }else{?>
					 <option value="-1" >Sin Grupos</option>
					 <?php }?>
			     </select> 
			     <span class="help-block"></span> 
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                  <label for="agregar_grupo" class="control-label">Agregar Grupo</label>
                  <button type="button" class="form-control btn btn-success" id="agregar_grupo"><span class="glyphicon glyphicon-plus"></span> Agregar</button>
                  <span class="help-block"></span>
            </div>
            </div>
            <div id="modal_grupo"></div>
			</div>
			
			<div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="id_subgrupo" class="control-label">SubGrupo</label>
                 <select name="id_subgrupo" id="id_subgrupo"  class="form-control" >
					 <?php if(!empty($resultSubGrupo)){ foreach($resultSubGrupo as $res) {?>
					 <option value="<?php echo $res->id_entidades; ?>" ><?php echo $res->nombre_entidades; ?> </option>
					 <?php } }else{?>
					 <option value="-1" >Sin Grupos</option>
					 <?php }?>
			     </select> 
			    <span class="help-block"></span>
            </div>
		    </div>
		    
		     <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                  <label for="agregar_subgrupo" class="control-label">Agregar SubGrupo</label>
                  <button type="button" class="form-control btn btn-success" id="agregar_subgrupo"><span class="glyphicon glyphicon-plus"></span> Agregar</button>
                  <span class="help-block"></span>
            </div>
            </div>
            <div id="modal_subgrupo"></div>
			</div>
			
			<!-- Para agregar la cuenta -->
            <h4 style="color:#ec971f;">Agregar Cuenta</h4>
            <hr/>
		    <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="" class="control-label">Codigo</label><br>
                 <div class="row">
	                 <div class="col-xs-8 col-md-8">
	                 <input type="text" class="form-control " id="codigo1_cuenta" name="codigo1_cuenta" value="" >
	                 </div>
	                 <div class="col-xs-4 col-md-4">
	                 <input type="text" class="form-control" id="codigo2_cuenta" name="codigo2_cuenta" value="" >
	                 </div>
                 </div>
                 <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="nombre_cuenta" class="control-label">Nombre Cuenta</label>
                 <input type="text" class="form-control" id="nombre_cuenta" name="nombre_cuenta" value=""  placeholder="Nombre">
                 <span class="help-block"></span>
            </div>
            </div>
			</div>
	         
	        <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="id_moneda_cuenta" class="control-label">Moneda</label>
                 <select name="id_moneda_cuenta" id="id_moneda_cuenta"  class="form-control" >
					 <?php if(!empty($resultMoneda)){ foreach($resultMoneda as $res) {?>
					 <option value="<?php echo $res->id_monedas; ?>" ><?php echo $res->nombre_monedas; ?> </option>
					 <?php } }else{?>
					 <option value="-1" >Sin Moneda</option>
					 <?php }?>
			     </select> 
			     <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="id_naturaleza_cuenta" class="control-label">Naturaleza</label>
                 <select name="id_naturaleza_cuenta" id="id_naturaleza_cuenta"  class="form-control" >
					 <?php if(!empty($n_plan_cuentas)){ foreach($n_plan_cuentas as $res=>$val) {?>
					 <option value="<?php echo $res;?>" ><?php echo $val; ?> </option>
					 <?php } }else{?>
					 <option value="-1" >Sin Tipo</option>
					 <?php }?>
			     </select> 
			    <span class="help-block"></span>
            </div>
            </div>
			</div>
	        
	        
	        <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="tipo_cuenta" class="control-label">Tipo</label>
                 <input type="text" class="form-control" id="tipo_cuenta" name="tipo_cuenta" value="C"  >
                 <span class="help-block"></span>
            </div>
		    </div>
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="nivel_cuenta" class="control-label">Nivel</label>
                 <input type="text" class="form-control" id="nivel_cuenta" name="nivel_cuenta" value="4"  >
                 <span class="help-block"></span>
            </div>
		    </div>
		    </div>
		   
		   <!-- Para agregar la subcuenta -->
		   <script type="text/javascript">
		   function mostrarSubcuenta(){
			   
			   if( $("#subcuenta").is(":hidden") ){
				   $("#subcuenta").show();
				}else{
				   $("#subcuenta").hide();
				}
			   
		   }
		   </script>
		   <h4 style="color:#ec971f; float: left;">Agregar SubCuenta</h4>
		   <div class="div-img" style="float: left; padding-left: 20px;" >
           <img  onclick="mostrarSubcuenta();"  class="img" src="view/images/add.jpg" title="agregar" alt="agregar" height="40px">
           </div>
		   <br>
		   <hr/>
            <div id="subcuenta" class ="clase_subcuenta" style="display:none;">
		    <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="" class="control-label">Codigo Subcuenta</label><br>
                 <div class="row">
	                 <div class="col-xs-8 col-md-8">
	                 <input type="text" class="form-control " id="codigo1_subcuenta" name="codigo1_subcuenta" value="" >
	                 </div>
	                 <div class="col-xs-4 col-md-4">
	                 <input type="text" class="form-control" id="codigo2_subcuenta" name="codigo2_subcuenta" value="" >
	                 </div>
                 </div>
                 <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="nombre_subcuenta" class="control-label">Nombre SubCuenta</label>
                 <input type="text" class="form-control" id="nombre_subcuenta" name="nombre_subcuenta" value=""  placeholder="Nombre">
                 <span class="help-block"></span>
            </div>
            </div>
			</div>
	         
	        <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="id_moneda_subcuenta" class="control-label">Moneda</label>
                 <select name="id_moneda_subcuenta" id="id_moneda_subcuenta"  class="form-control" >
					 <?php if(!empty($resultMoneda)){ foreach($resultMoneda as $res) {?>
					 <option value="<?php echo $res->id_monedas; ?>" ><?php echo $res->nombre_monedas; ?> </option>
					 <?php } }else{?>
					 <option value="-1" >Sin Moneda</option>
					 <?php }?>
			     </select> 
			     <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="id_naturaleza_subcuenta" class="control-label">Naturaleza</label>
                 <select name="id_naturaleza_subcuenta" id="id_naturaleza_subcuenta"  class="form-control" >
					 <?php if(!empty($n_plan_cuentas)){ foreach($n_plan_cuentas as $res=>$val) {?>
					 <option value="<?php echo $res;?>" ><?php echo $val; ?> </option>
					 <?php } }else{?>
					 <option value="-1" >Sin Tipo</option>
					 <?php }?>
			     </select> 
			    <span class="help-block"></span>
            </div>
            </div>
			</div>
	        
	        
	        <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="tipo_subcuenta" class="control-label">Tipo</label>
                 <input type="text" class="form-control" id="tipo_subcuenta" name="tipo_subcuenta" value="S" >
                 <span class="help-block"></span>
            </div>
		    </div>
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="nivel_subcuenta" class="control-label">Nivel</label>
                 <input type="text" class="form-control" id="nivel_subcuenta" name="nivel_subcuenta" value="5"  >
                 <span class="help-block"></span>
            </div>
		    </div>
		    </div>
		    </div>
		   
		   
		    </div>
		    
		     <?php } ?>
		     
		    <div class="row">
		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;">
		    <div class="form-group">
                 <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">Guardar</button>
           
            </div>
		    </div>
		    </div>
            
            
            </form>
       
       
            
            <form action="<?php echo $helper->url("PlanCuentas","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
     		<br>
     		<div class="well">  
            <h4 style="color:#ec971f;">Plan de Cuentas Registrados</h4>
            
            <div class="row">
		    <div class="col-xs-4 col-md-4 col-lg-4">
		    <div class="form-group">
                                  
                                  <input type="text" class="form-control" id="contenido" name="contenido" value="">
                                  
            </div>
		    </div>
		    <div class="col-xs-4 col-md-4 col-lg-4">
		    <div class="form-group">
                                  
                                  <select name="criterio" id="criterio"  class="form-control">
                                    <?php foreach($resultMenu as $val=>$desc) {?>
                                         <option value="<?php echo $val ?>" ><?php echo $desc ?> </option>
                                    <?php } ?>
                                  </select>
            </div>
		    </div>
		    <div class="col-xs-4 col-md-4 col-lg-4">
		    <div class="form-group">
                                  
                                  <button type="submit" id="Buscar" name="Buscar" class="btn btn-info">Buscar</button>
            </div>
		    </div>
			</div>  
             
       
       <div class="datagrid"> 
       <section style="height:380px; overflow-y:scroll;">
       <table class="table table-hover ">
       
       <thead>
           <tr>
                    <th style="font-size:100%;">Id</th>
		    		<th style="font-size:100%;">Codigo</th>
		    		<th style="font-size:100%;">Nombre</th>
		    		<th style="font-size:100%;">Moneda</th>
		    		<th style="font-size:100%;">Naturaleza</th>
		    		<th style="font-size:100%;">Tipo</th>
		    		<th style="font-size:100%;">Centro Costo</th>
		    		<th style="font-size:100%;">Nivel</th>
		    		<th></th>
		    		<th></th>
		    		<th></th>
	  		</tr>
	   </thead>
       <tfoot>
       		<tr>
					<td colspan="10">
						<div id="paging">
							<ul>
								<li>
									<a href="#">
						<span>Previous</span>
									</a>
								</li>
								<li>
									<a href="#" class="active">
						<span>1</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>2</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>3</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>4</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>5</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>Next</span>
									</a>
								</li>
								</ul>
						</div>
					
			</tr>
       				
       </tfoot>
       
                <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        	 
               
	   <tbody>
	   		<tr>
	   					<td style="font-size:80%;"> <?php echo $res->id_plan_cuentas; ?>  </td>
		                <td style="font-size:80%;" > <?php echo $res->codigo_plan_cuentas; ?>     </td> 
		                <td style="font-size:80%;"> <?php echo $res->nombre_plan_cuentas; ?>     </td>
		                <td style="font-size:80%;"> <?php echo $res->nombre_monedas; ?>     </td>  
		                <td style="font-size:80%;"> <?php echo $res->n_plan_cuentas; ?>     </td> 
		                <td style="font-size:80%;"> <?php echo $res->t_plan_cuentas; ?>     </td>
		                <td style="font-size:80%;"> <?php echo $res->nombre_centro_costos; ?>     </td>
		                <td style="font-size:80%;"> <?php echo $res->nivel_plan_cuentas; ?>     </td>
		                <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("PlanCuentas","index"); ?>&id_p_cuentas=<?php echo $res->id_plan_cuentas; ?>" class="btn btn-warning" onClick="notificacion()" style="font-size:65%;">Editar</a>
			                </div>
			            
			            </td>
			            <td>   
			               	<div class="right">
			                    <a href="<?php echo $helper->url("PlanCuentas","borrarId"); ?>&id_p_cuentas=<?php echo $res->id_plan_cuentas; ?>" class="btn btn-danger" onClick="Borrar()" style="font-size:65%;">Borrar</a>
			                </div>
			            </td>
	   		</tr>
	   
	   </tbody>	
	        		
		        <?php } }else{ ?>
            <tr>
            <td></td>
            <td></td>
	                   <td colspan="5" style="color:#ec971f;font-size:8;"> <?php echo '<span id="snResult">No existen resultados</span>' ?></td>
	        <td></td>
		               
		    </tr>
            <?php 
		}
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
		</section>
        </div>
        </div>
        </form>
        </div>
        </div>
  
             <br>
			 <br>
			 <br> 
  
       
             <footer class="col-lg-12">
			 <?php include("view/modulos/footer.php"); ?>
			 </footer>
			 
			 <!-- para los modal -->
			 
			  <span id="val_radio_cuentas" style="display: none;">0</span>
			  <span id="val_codigo" style="display: none;">0</span>
			  <span id="val_grupo" style="display: none;">0</span>
        
    </body>  
    </html>          