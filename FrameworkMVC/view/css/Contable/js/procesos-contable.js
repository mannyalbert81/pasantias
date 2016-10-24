
		$(document).ready(function(){
			load_contable(1);
		});
		
		
		function load_contable(page){
			var c= $("#c").val();
			$("#contable").fadeIn('slow');
			$.ajax({
				url:'view/css/Contable/ajax/cargar_contable.php?action=ajax&page='+page+'&c='+c,
				 beforeSend: function(objeto){
				$("#contable").html('<img src="view/images/ajax-loader.gif"> Cargando...');
				},
				success:function(data){
					$(".div_contable").html(data).fadeIn('slow');
					$("#contable").html("");
				}
			})
		}
		
		$('#editar').on('show.bs.modal', function (event) {
			
			  var button = $(event.relatedTarget) // Botón que activó el modal
			  var ruc = button.data('ruc') // Extraer la información de atributos de datos
			  var id = button.data('id') // Extraer la información de atributos de datos
			  var nombres = button.data('nombres') // Extraer la información de atributos de datos
			  var retencion = button.data('retencion') // Extraer la información de atributos de datos
			  var concepto = button.data('concepto') // Extraer la información de atributos de datos
			  var fecha = button.data('fecha') // Extraer la información de atributos de datos
			  
			  var modal = $(this)
			  modal.find('.modal-title').text('Modificar Comprobante Contable')
			  modal.find('.modal-body #id').val(id)
			  modal.find('.modal-body #ruc').val(ruc)
			  modal.find('.modal-body #nombres').val(nombres)
			  modal.find('.modal-body #retencion').val(retencion)
			  modal.find('.modal-body #concepto').val(concepto)
			  modal.find('.modal-body #fecha').val(fecha)
			  $('.alert').hide();//Oculto alert
			  
			  
			})
			
			
			$( "#actualidarDatos" ).submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "view/css/Contable/modal/modificar.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#datos_ajax").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#datos_ajax").html(datos);
					
					load_contable(2);
				  }
			});
		  event.preventDefault();
		});
        
		
		