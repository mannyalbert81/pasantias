
		$(document).ready(function(){
			load(1);
		});
		

		function load(page){
			var parametros = {"action":"ajax","page":page};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'view/ajax/productos_factura.phppaises_ajax.php',
				data: parametros,
				 beforeSend: function(objeto){
				$("#loader").html('<img src="view/images/ajax-loader.gif"> Cargando...');
				},
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$("#loader").html("");
				}
			})
		}
		
		
		
	function agregar (id)
	
		{  
		    var descripcion=document.getElementById('descripcion_'+id).value;
			var debe=document.getElementById('debe_'+id).value;
			var haber=document.getElementById('haber_'+id).value;
			//Inicia validacion
			if (isNaN(debe))
			{
			alert('Esto no es un numero');
			document.getElementById('debe_'+id).focus();
			return false;
			}
			if (isNaN(haber))
			{
			alert('Esto no es un numero');
			document.getElementById('haber_'+id).focus();
			return false;
			}
			//Fin validacion
			
			$.ajax({
        type: "POST",
        url: "view/ajax/agregar_facturacion.php",
        data: "id="+id+"&descripcion="+descripcion+"&debe="+debe+"&haber="+haber,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});
		}
		
			function eliminar (id)
		{
			
			$.ajax({
        type: "GET",
        url: "view/ajax/agregar_facturacion.php",
        data: "id="+id,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});

		}
		
		$("#datos_factura").submit(function(){
		  var id_cliente = $("#id_cliente").val();
		  var id_vendedor = $("#id_vendedor").val();
		  var condiciones = $("#condiciones").val();
		  
		  if (id_cliente==""){
			  alert("Debes seleccionar un cliente");
			  $("#nombre_cliente").focus();
			  return false;
		  }
		 VentanaCentrada('./pdf/documentos/factura_pdf.php?id_cliente='+id_cliente+'&id_vendedor='+id_vendedor+'&condiciones='+condiciones,'Factura','','1024','768','true');
	 	});
		
		$( "#guardar_cliente" ).submit(function( event ) {
		  $('#guardar_datos').attr("disabled", true);
		  
		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/nuevo_cliente.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados_ajax").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#resultados_ajax").html(datos);
					$('#guardar_datos').attr("disabled", false);
					load(1);
				  }
			});
		  event.preventDefault();
		})
		
		$( "#guardar_producto" ).submit(function( event ) {
		  $('#guardar_datos').attr("disabled", true);
		  
		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/nuevo_producto.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados_ajax_productos").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#resultados_ajax_productos").html(datos);
					$('#guardar_datos').attr("disabled", false);
					load(1);
				  }
			});
		  event.preventDefault();
		})
