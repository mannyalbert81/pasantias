
<?php include("view/modulos/head.php"); ?>
<?php $n_plan_cuentas=array("A"=>'Acreedora',"D"=>'Deudora');
      $resultMenu = array("codigo"=>'Codigo',"nombre"=>'Nombre',"tipo"=>'Tipo',"naturaleza"=>'Naturaleza');?>

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
			    transform: scale(1.25);
			    cursor:pointer;
			    cursor:hand;
			}
			.textfail.form-control
			{
			border: 1px solid red;
			-moz-box-shadow: 0 0 10px red;
			-webkit-box-shadow: 0 0 10px red;
			box-shadow: 0 0 10px red;
			}
			.errores{
		    -webkit-boxshadow: 0 0 10px rgba(0, 0, 0, 0.3);
		    -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
		    -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
		    border-radius:10px;
		    -webkit-border-radius: 10px;
		    background: red;
		    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
		    color: #fff;
		    display: none;
		    font-size: 12px;
		    margin-top: -40px;
		    margin-left: 150px;
		    padding: 10px;
		    position: absolute;
		     z-index: 1;
		}
		.errores:before{ /* Este es un truco para crear una flechita */
		    content: '';
		    border-top: 8px solid transparent;
		    border-bottom: 8px solid transparent;
		    border-right: 8px solid #BC1010;
		    border-left: 8px solid transparent;
		    left: -16px;
		    position: absolute;
		    top: 5px;
		    
		}
		 </style>
		 
		 <!-- funcion para llenar los grupos al selecionar las cuentas (Pasivo,Activo,Patrimonio,Egresos,Ingresos) -->
		<script type="text/javascript">

		$(document).ready(function(){

			$("input:radio[name='cuentas']").change(function() {

				$("#subcuenta").hide();

				// identificamos al ddl a cambiar
		           var grupo = $("#id_grupo");
		           var subgrupo = $("#id_subgrupo");
		           
		        // tomamos parametros -> idgrupo,entidades
		           var cuentas = $(this).val();
		           var entidades = $("#id_entidad").val();

		        //tomar valor de radio buton en la pagina
		        $("#val_radio_cuentas").text(cuentas);

		            if(cuentas != 0)
		            {
			            var datos = {  
			            		 	idcuentas: cuentas,
			            		 	identidades: entidades 
		                    	 	 };

		         	   	$.post("<?php echo $helper->url("PlanCuentas","returnGrupo"); ?>", datos, function(resultado) {

		         	   	 //vaciamos el ddl a cambiar
			         	   	grupo.empty();

		         	  		if ( resultado.length == 0 ) {
		         	  			grupo.append("<option value ='0' >Sin Grupos</option>");
      		 			        console.log("NO DATA!")
			   		 		    }else{
			   		 		    grupo.append("<option value ='0' >-Seleccione-</option>");
									$.each(resultado, function(index, value) {
										grupo.append("<option value= " +value.id_plan_cuentas +" >" + value.nombre_plan_cuentas  + "</option>");	
		                    		 });
			   		 		    }
	 		   
		         		  }, 'json');

		         	   subgrupo.empty();  

			         subgrupo.append("<option value='-1'>Sin Registros</option>");	
			                    		 

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

			  //click en botton guardar
			  $("#Guardar").click(function(){

				  			  });   
			

			});
		
		</script>
		
		<script type="text/javascript">
		$(function(){

		        $('#agregar_grupo').click(function(){

		        	var respuesta=true;

		        	var cuentas = $('input:radio[name=cuentas]:checked').val();
		        	var  valCuentas = $("#val_radio_cuentas").text();
		        	var  valCodigo = $("#val_codigo").text();

					if(typeof(cuentas) == "undefined")
					{
						
						$("#mensaje_cuentas").text("selecione una opcion");
			    		$("#mensaje_cuentas").fadeIn("slow");

			    		respuesta = false;
						
					}
					
		        	if(valCuentas>0||respuesta==true)
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
				        html+="<input type='text' class='form-control' id='modal_grupo_codigo' name='modal_grupo_codigo' value='"+codigoC+"' readonly />";
				        html+="</div>";
				        html+="</div>";
				        html+="<div class = 'col-xs-12 col-md-6'>";
				        html+="<div class='form-group'>";
				        html+="<label for='modal_grupo_tipo' class='control-label'>Tipo</label><br>";
				        html+="<input type='text' class='form-control' id='modal_grupo_tipo' name='modal_grupo_tipo' value='G' readonly >";
				        html+="</div>";
				        html+="</div>";
				        html+="<div class = 'col-xs-12 col-md-6'>";
				        html+="<div class='form-group'>";
				        html+="<label for='modal_grupo_nivel' class='control-label'>Nivel</label><br>";
				        html+="<input type='text' class='form-control' id='modal_grupo_nivel' name='modal_grupo_nivel' value='2' readonly >";
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
				   
		        });

		        $("input:radio[name=cuentas]" ).focus(function() {
					  $("#mensaje_cuentas").fadeOut("slow");
				    });
		    
		});
		
		</script>
		
		<!-- funcion : traer valor de los grupos q contiene -->
		<script type="text/javascript">
		$(document).ready(function(){

			$("#id_grupo").change(function() {

				var value_id_grupo=$('#id_grupo').val();	

				if(value_id_grupo >= 0)
				{
					
					call_returnCodSubGrupo();
					call_returnSubGrupo();
					
				}	
						
			});
		});
		</script>
		
		
		<!-- funcion: agregar cuenta nivel3 -->
		<script type="text/javascript">
		$(function(){
			
			$('#agregar_subgrupo').click(function(){

				var respuesta=true;
				
				var cuentas = $('input:radio[name=cuentas]:checked').val();
				var val_id_grupo = $("#id_grupo").val();
                var valCuentas = $("#val_radio_cuentas").text();
	        	var subgrupo = $("#val_grupo").text();

				if(typeof(cuentas) == "undefined")
				{
					
					$("#mensaje_cuentas").text("selecione cuenta");
		    		$("#mensaje_cuentas").fadeIn("slow");

		    		respuesta = false;
					
				}

				if(val_id_grupo <= 0)
				{

				$("#mensaje_id_grupo").text("Selecione grupo");
	    		$("#mensaje_id_grupo").fadeIn("slow");

	    		respuesta = false;
				
				}

	        	if(respuesta==true)
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
			        html+="<h4 style='color:#ec971f;'>Registrar Nuevo SubGrupo </h4><hr/>";
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
			        html+="<input type='text' class='form-control' id='modal_subgrupo_codigo' name='modal_subgrupo_codigo' value='"+subgrupo+"' readonly>";
			        html+="</div>";
			        html+="</div>";
			        html+="<div class = 'col-xs-12 col-md-6'>";
			        html+="<div class='form-group'>";
			        html+="<label for='modal_subgrupo_tipo' class='control-label'>Tipo</label><br>";
			        html+="<input type='text' class='form-control' id='modal_subgrupo_tipo' name='modal_subgrupo_tipo' value='G' readonly>";
			        html+="</div>";
			        html+="</div>";
			        html+="<div class = 'col-xs-12 col-md-6'>";
			        html+="<div class='form-group'>";
			        html+="<label for='modal_subgrupo_nivel' class='control-label'>Nivel</label><br>";
			        html+="<input type='text' class='form-control' id='modal_subgrupo_nivel' name='modal_subgrupo_nivel' value='3' readonly>";
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
			    
	        });

			$("input:radio[name=cuentas]" ).focus(function() {
				  $("#mensaje_cuentas").fadeOut("slow");
			    });
		    
			$("#id_grupo" ).focus(function() {
				  $("#mensaje_id_grupo").fadeOut("slow");
			    });
		    
		});
		
		</script>
		
		<!-- script editar cuenta -->
		<script type="text/javascript">
		
		//sin definir el click
				
		  function editar_cuenta_modal(rowTabla){

		        	var  valCuentas = 1;		        	
		        	var id_plan_cuentas = '';
		        	var nombre_plan_cuentas = '';
		        	var codigo_plan_cuentas = ''; 		        	
		        	var datoscuenta = rowTabla.id;
		        	var array_plan_cuentas;

		        	array_plan_cuentas = datoscuenta.split(',');
		        	id_plan_cuentas = array_plan_cuentas[0];
		        	codigo_plan_cuentas = array_plan_cuentas[1];
		        	nombre_plan_cuentas = array_plan_cuentas[2];
		        	

		        	//console.log(id_plan_cuentas+'\n'+nombre_plan_cuentas+'\n'+codigo_plan_cuentas);
		        	
		        	  	
		        	if(datoscuenta!='')
				    {

					      $('#modal_edit_cuenta').dialog({
				                            autoOpen: false,
				                            modal: true,
				                            height: 450,
				                            width: 500,
				                            buttons: {
				                "Actualizar": function() {

					                var datos = { 
							                id_entidad_p_cuentas:$('#id_entidad').val(),
							                id_p_cuentas:$('#modal_edit_id').val(),
			                    	 		nombre_p_cuentas:$('#modal_edit_nombre').val(),
			                    	 		codigo_p_cuentas:$('#modal_edit_codigo').val(),
			                    	 		id_moneda_p_cuentas:$('#modal_edit_id_moneda').val(),
			                    	 		n_p_cuentas:$('#modal_edit_naturaleza').val(),
			                    	 		id_centro_c_p_cuentas:$('#modal_edit_id_centro_c').val()
			                    	 	 };
				                     //alert(datos['id_entidad_p_cuentas']);
				                     
				                 var nombre_edit= $('#modal_edit_nombre').val();
			                    
			                     if(nombre_edit!='')
			                     {
					                $.ajax({
				                           url:"<?php echo $helper->url("PlanCuentas","ActualizarCuenta");?>"
				                           ,type : "POST"
				                           ,async: true
				                           ,data : datos
				                           ,success: function(msg){

												var res = msg.split('"');
				                        	   
					                           if(res[1]=='1' || res[1]==1)
					                           {
				                                $('#modal_edit_cuenta').dialog('close');
				                                //loading();
					                           }else
					                           {
					                        	   $('#modal_respuesta_grupo').html ("<span style='color:red'>!datos no han sido actualizados..</span>"); 
							                     
					                           }
				                           }
				                   });
				                     
			                     }else
			                     {
			                    	 textFail("modal_edit_nombre");
			                         $('#modal_respuesta_edit').html ("<span style='color:red'>!Existen campos vacios..</span>"); 
			                           
			                     }                      
				   
				                },
				                "Cancelar": function(){
				                    $('#modal_edit_cuenta').dialog('close');
				                }
				            }    

				        }); 

				        var  html = "";
				        html+="<h4 style='color:#ec971f;'>Actualizar Cuentas</h4><hr/>";
				        html+="<div class = 'col-xs-12 col-md-6'>";
				        html+="<div class='form-group'>";
				        html+="<label for='modal_edit_codigo' class='control-label'>Codigo</label><br>";
				        html+="<input type='text' class='form-control' id='modal_edit_codigo' name='modal_edit_codigo' value='"+codigo_plan_cuentas+"' readonly >";
				        html+="</div>";
				        html+="</div><br>";	
			            html+="<div class = 'col-xs-12 col-md-6'>";
				        html+="<div class='form-group'>";
				        html+="<label for='modal_edit_nombre' class='control-label'>Nombre</label><br>";
				        html+="<input type='text' class='form-control' id='modal_edit_nombre' name='modal_edit_nombre' value='"+nombre_plan_cuentas+"' onfocus='textSucces(this)' >";
				        html+="<input type='hidden' class='form-control'  id='modal_edit_id' name='modal_edit_id' value='"+id_plan_cuentas+"'  >";
					    html+="</div>";
				        html+="</div>";				        
				        html+="<div class='col-xs-12 col-md-6'>";
				        html+="<div class='form-group'>";
				        html+="<label for='modal_edit_naturaleza' class='control-label'>Naturaleza</label>";
				        html+="<select name='modal_edit_naturaleza' id='modal_edit_naturaleza'  class='form-control' >";
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
				        html+="<label for='modal_edit_id_centro_c' class='control-label'>Centro Costos</label>";
				        html+="<select name='modal_edit_id_centro_c' id='modal_edit_id_centro_c'  class='form-control' >";
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
				        html+="<label for='modal_edit_id_moneda' class='control-label'>Moneda</label>";
				        html+="<select name='modal_edit_id_moneda' id='modal_edit_id_moneda'  class='form-control' >";
				        html+="<?php if(!empty($resultMoneda)){ foreach($resultMoneda as $res) {?>";
				        html+="<option value='<?php echo $res->id_monedas; ?>' ><?php echo $res->nombre_monedas; ?> </option>";
						html+="<?php } }else{?>";
						html+="<option value='-1' >Sin Grupos</option>";
						html+="<?php }?>";
					    html+="</select>"; 
					    html+="<span class='help-block'></span>"; 
					    html+="</div>";
					    html+="</div>";
					    html+="<div class='col-xs-12 col-md-12' id='modal_respuesta_edit'></div><br>";

					    				       
				        $('#modal_edit_cuenta').html (html);  
				       

				        $('#modal_edit_cuenta').dialog('open');
						
				    }
				    else{

					    alert('no exiten datos');
					    
				    }


		        }

		
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

         	   if ( resultado.length == 0 ) {
         		  subgrupo.append("<option value ='0' >Sin Registros</option>");
    	  			
  		 		    }else{
  		 		  subgrupo.append("<option value ='0' >-Seleccione-</option>");
         	   	
	         		$.each(resultado, function(index, value) {
	         		    subgrupo.append("<option value= " +value.id_plan_cuentas +" data-codigo_plan_cuentas="+value.codigo_plan_cuentas+" >" + value.nombre_plan_cuentas  + "</option>");	
	
	            		 });
  		 		    }

         		 		 	 		   
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

		function call_returnCodCuenta()
		{
			var codgrupo_l3 = $("#val_subgrupo").text();
        	var entidades = $("#id_entidad").val();

			$.ajax({
	            url:"<?php echo $helper->url("PlanCuentas","returnCodCuenta");?>"
	            ,type : "POST"
	            ,async: true
	            ,data : {cod_grupo:codgrupo_l3,identidades:entidades}
	            ,success: function(msg){

		              if(msg!='')
		               {
		            	 var res = msg.split('"');
		            	 var cod = res[1].split('.');
		            	 var cod1 = cod[0]+'.'+cod[1]+'.'+cod[2]+'.';
		            	 var cod2 = cod[3]+'.';
		            	 
		            	$("#codigo1_cuenta").val(String(cod1));
		            	$("#codigo2_cuenta").val(String(cod2));
		               }
	               }
        		});

		}

		function call_returnSubCuenta()
		{
			
        	var valGrupo = $("#val_radio_cuentas").text();
        	var entidades = $("#id_entidad").val();
        	var cuenta = $("#id_cuenta");

        	$.post("<?php echo $helper->url("PlanCuentas","returnCuenta"); ?>", {identidades:entidades,idgrupo:valGrupo}, function(resultado) {
        		cuenta.empty();
        		cuenta.append("<option value='0'>--Seleccione--</option>");	
         		 
        		
         		 		$.each(resultado, function(index, value) {
         		 			cuenta.append("<option value= " +value.id_plan_cuentas +" data-cuenta_codigo_plan_cuentas="+value.codigo_plan_cuentas+" >" + value.nombre_plan_cuentas  + "</option>");	
         	         		 });

         		 		 	 		   
         		  }, 'json');

		}

		function call_returnCodSubCuenta()
		{
			var codgrupo_l3 = $("#val_subgrupo").text();
        	var entidades = $("#id_entidad").val();

			$.ajax({
	            url:"<?php echo $helper->url("PlanCuentas","returnCodCuenta");?>"
	            ,type : "POST"
	            ,async: true
	            ,data : {cod_grupo:codgrupo_l3,identidades:entidades}
	            ,success: function(msg){

		              if(msg!='')
		               {
		            	 var res = msg.split('"');
		            	 var cod = res[1].split('.');
		            	 var cod1 = cod[0]+'.'+cod[1]+'.'+cod[2]+'.';
		            	 var cod2 = cod[3]+'.';
		            	 
		            	$("#codigo1_cuenta").val(String(cod1));
		            	$("#codigo2_cuenta").val(String(cod2));
		               }
	               }
        		});

		}

		function call_returnCuentaAnalisis(valor)
		{
			var id_plan_cuentas_view = valor;
			
        	var entidades = $("#id_entidad").val();
        	
        	var cuentaAnalisis = $("#id_cuenta_analisis");
        	

        	$.post("<?php echo $helper->url("PlanCuentas","returnCuentaAnalisis"); ?>", {identidades:entidades,id_plan_cuentas:id_plan_cuentas_view}, function(resultado) {

        		cuentaAnalisis.empty();
        		cuentaAnalisis.append("<option value='0'>--Seleccione--</option>");	
        		var codigo='';
        		var substr_codigo='';
         		 
        		
         		 		$.each(resultado, function(index, value) {
             		 		
         		 			codigo = value.codigo_plan_cuentas;
         		 			substr_codigo=codigo.split('.');
         		 			//strvalores[strvalores.length-1]
         		 			
         		 			cuentaAnalisis.append("<option value= " +value.id_plan_cuentas +" data-cuenta_analisis_codigo_plan_cuentas="+value.codigo_plan_cuentas+" >"+substr_codigo[substr_codigo.length-2]+'.-' + value.nombre_plan_cuentas  + "</option>");	
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
			$('#modal_respuesta_grupo').html ("");
		}

		
		
		
		</script>
		
		<script type="text/javascript">
		$(document).ready(function(){

			$('#id_subgrupo').change( function(){
				
				var cod_subgrupo = $(this).children('option:selected').data('codigo_plan_cuentas');
				$("#val_subgrupo").text(cod_subgrupo);

				call_returnCodCuenta();
				
			 });

			
		});
		
		//para validar array
		//if(arrayName.length > 0){  //this array is not empty}else{//this array is empty}

		</script>
		
		<script type="text/javascript">
		$(document).ready(function(){

			$('#id_cuenta').change( function(){

				$("#codigo1_subcuenta").val('');

				var cod_cuenta = $(this).val();

				//para pasar el codigo
				var codigo = $(this).children('option:selected').data('cuenta_codigo_plan_cuentas');
				
				var cod1_input = $("#codigo1_subcuenta").val(codigo);
				
				call_returnCuentaAnalisis(cod_cuenta);
				
			 });

			
		});

		

		</script>
		
		<script type="text/javascript">
		function mensaje(){
			
		  var respuesta = confirm('¿Eliminar Cuenta?')
		   return respuesta;
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
            <div id="mensaje_cuentas" class="errores"></div>
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
			     <div id="mensaje_id_grupo" class="errores"></div> 
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
	                 <input type="text" class="form-control " id="codigo1_cuenta" name="codigo1_cuenta" value="" readonly>
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
					 <option value="-1" >Sin registros</option>
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
                 <input type="text" class="form-control" id="tipo_cuenta" name="tipo_cuenta" value="C"  readonly>
                 <span class="help-block"></span>
            </div>
		    </div>
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="nivel_cuenta" class="control-label">Nivel</label>
                 <input type="text" class="form-control" id="nivel_cuenta" name="nivel_cuenta" value="4" readonly >
                 <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-12 col-md-6">
			<div class="form-group">
				 <label for="id_centro_c" class="control-label">Centro Costos</label>
				 <select name="id_centro_c" id="id_centro_c"  class="form-control" >
				        <?php if(!empty($resultCentroC)){ foreach($resultCentroC as $res) {?>
				        <option value="<?php echo $res->id_centro_costos; ?>" ><?php echo $res->nombre_centro_costos; ?> </option>
						<?php } }else{?>
						<option value="-1" >Sin registros</option>
						<?php }?>
					    </select> 
					    <span class="help-block"></span>
			</div>
			</div>
			
		    </div>
		   
		   <!-- Para agregar la subcuenta -->
		   <script type="text/javascript">
		   function mostrarSubcuenta(){

			   var grupo = $("#val_radio_cuentas").text();

			   if(grupo==null||grupo==0||grupo=='0'||grupo=='')
			   {
				   alert("selecione una cuenta principal");
			   }else{
				   
				   if( $("#subcuenta").is(":hidden") ){
					   $("#subcuenta").show();
					   call_returnSubCuenta();
					}else{
					   $("#subcuenta").hide();
					}
			   }
			   
			   
			   
		   }
		   </script>
		   <h4 style="color:#ec971f; float: left;">Cuenta de Analisis</h4>
		   <div class="div-img" style="float: left; padding-left: 20px;" >
           <img  onclick="mostrarSubcuenta();"  class="img" src="view/images/add.jpg" title="agregar" alt="agregar" height="40px">
           </div>
		   <br>
		   <hr/>
            <div id="subcuenta" class ="clase_subcuenta" style="display:none;">
            
            <div class="row">
		    <div class="col-xs-12 col-md-6">
		    <div class="form-group">
                 <label for="id_cuenta" class="control-label">Cuenta</label>
                 <select name="id_cuenta" id="id_cuenta"  class="form-control" >
					 <option value="-1" >Sin Registros</option>
			     </select> 
			     <span class="help-block"></span>
            </div>
		    </div>
		    <div class="col-xs-12 col-md-6">
		    <div class="form-group">
                 <label for="id_cuenta_analisis" class="control-label">Existentes</label>
                 <select name="id_cuenta_analisis" id="id_cuenta_analisis"  class="form-control" >
					 <option value="-1" >Sin Registros</option>
			     </select> 
			     <span class="help-block"></span>
			     <input type="hidden" class="form-control" id="cuenta_analisis_existente" name="codigo2_subcuenta" value="" >
	         </div>
		    </div>
		    
			</div>
			
		    <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="" class="control-label">Codigo Cuenta Analisis</label><br>
                 <div class="row">
	                 <div class="col-xs-8 col-md-8">
	                 <input type="text" class="form-control " id="codigo1_subcuenta" name="codigo1_subcuenta" value="" readonly>
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
                 <label for="nombre_subcuenta" class="control-label">Nombre Cuenta Analisis</label>
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
					 <option value="-1" >Sin registros</option>
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
                 <input type="text" class="form-control" id="tipo_subcuenta" name="tipo_subcuenta" value="S" readonly>
                 <span class="help-block"></span>
            </div>
		    </div>
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                 <label for="nivel_subcuenta" class="control-label">Nivel</label>
                 <input type="text" class="form-control" id="nivel_subcuenta" name="nivel_subcuenta" value="5"  readonly>
                 <span class="help-block"></span>
            </div>
		    </div>
		    </div>
		    
		    <div class="row">
		    <div class="col-xs-12 col-md-6">
			<div class="form-group">
				 <label for="id_centro_c_subcuenta" class="control-label">Centro Costos</label>
				 <select name="id_centro_c_subcuenta" id="id_centro_c_subcuenta"  class="form-control" >
				        <?php if(!empty($resultCentroC)){ foreach($resultCentroC as $res) {?>
				        <option value="<?php echo $res->id_centro_costos; ?>" ><?php echo $res->nombre_centro_costos; ?> </option>
						<?php } }else{?>
						<option value="-1" >Sin registros</option>
						<?php }?>
				</select> 
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
                 <input type="submit" id="Guardar" name="Guardar" value="Guardar" class="btn btn-success"/>
            
            </div>
		    </div>
		    </div>
		    
            
            
            </form>
       
       
            
            <form action="<?php echo $helper->url("PlanCuentas","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
     		<br>
     		<div class="well">  
            <h4 style="color:#ec971f;">Plan de Cuentas Registrados</h4>
            
            <div id="modal_mensajes"></div>
            <div style="display:none" id="modal-confirmation" title="¿Eliminar?">¿Esta seguro de eliminar cuenta?</div>
            
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
									<a href="#"><span>Previous</span></a>
								</li>
								<li>
									<a href="#" class="active"><span>1</span></a>
								</li>
								<li>
									<a href="#"><span>2</span></a>
								</li>
								<li>
									<a href="#"><span>3</span></a>
								</li>
								<li>
									<a href="#"><span>4</span></a>
								</li>
								<li>
									<a href="#"><span>5</span></a>
								</li>
								<li>
									<a href="#"><span>Next</span></a>
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
			           	      <?php $datoscuenta=$res->id_plan_cuentas.','.$res->codigo_plan_cuentas.','.$res->nombre_plan_cuentas; ?>
			                  <a  title="<?php echo $res->nombre_plan_cuentas; ?>" id="<?php echo $datoscuenta; ?>"  href="javascript:null()" class="btn btn-warning" onclick="editar_cuenta_modal(this);" style="font-size:65%;">Editar</a>
			               </div>			            
			            </td>
			            <td>   
			               	<div class="right">
			                    <a href="<?php echo $helper->url("PlanCuentas","borrarId"); ?>&id_p_cuentas=<?php echo $res->id_plan_cuentas; ?>" class="btn btn-danger" onClick="return mensaje();" style="font-size:65%;">Borrar</a>
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
		
		<!-- modaledita -->
        <div id="modal_edit_cuenta">
        
		</div>
	
		
			
  
       
             <footer class="col-lg-12">
             
			 <?php include("view/modulos/footer.php"); ?>
			 </footer>
			 
			 <!-- para los modal -->
			 
			  <span id="val_radio_cuentas" style="display: none;">0</span>
			  <span id="val_codigo" style="display: none;">0</span>
			  <span id="val_grupo" style="display: none;">0</span>
			  <span id="val_subgrupo" style="display: none;">0</span>
			  
        
    </body>  
    </html>  
    <?php include("view/modulos/modal.php"); ?>
   <?php
   $arbol = $resultSet;
   $html = "";
   $nivel1=array();
   $nivel2=array();
   $nivel3=array();
   $nivel4=array();
   $nivel5=array();
   //print_r($arbol);
   
   foreach ($arbol as $resarbol)
   {
   		
   }
   
   ?>        