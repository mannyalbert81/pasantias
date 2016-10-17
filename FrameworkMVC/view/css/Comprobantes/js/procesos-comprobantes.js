
		$(document).ready(function(){
			load(1);
		});
		
		
		function load(page){
		   // var parametros = {"action":"ajax","page":page};
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'view/css/Comprobantes/ajax/cargar_plan_cuentas.php?action=ajax&page='+page+'&q='+q,
			//	url:'view/css/Comprobantes/ajax/cargar_plan_cuentas.php',
				
		//		data: parametros,
				 beforeSend: function(objeto){
				$("#loader").html('<img src="view/images/ajax-loader.gif"> Cargando...');
				},
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$("#loader").html("");
				}
			})
		}
        
		
		