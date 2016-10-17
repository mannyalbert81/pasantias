
		$(document).ready(function(){
			load(1);
		});
		
		
		function load(page){
			var i= $("#i").val();
			$("#ingresos").fadeIn('slow');
			$.ajax({
				url:'view/css/Comprobantes/ajax/cargar_ingresos.php?action=ajax&page='+page+'&i='+i,
				 beforeSend: function(objeto){
				$("#ingresos").html('<img src="view/images/ajax-loader.gif"> Cargando...');
				},
				success:function(data){
					$(".div_ingresos").html(data).fadeIn('slow');
					$("#ingresos").html("");
				}
			})
		}
        
		
		