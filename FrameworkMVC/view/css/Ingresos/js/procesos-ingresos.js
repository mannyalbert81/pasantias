
		$(document).ready(function(){
			load_ingresos(1);
		});
		
		
		function load_ingresos(page){
			var i= $("#i").val();
			$("#ingresos").fadeIn('slow');
			$.ajax({
				url:'view/css/Ingresos/ajax/cargar_ingresos.php?action=ajax&page='+page+'&i='+i,
				 beforeSend: function(objeto){
				$("#ingresos").html('<img src="view/images/ajax-loader.gif"> Cargando...');
				},
				success:function(data){
					$(".div_ingresos").html(data).fadeIn('slow');
					$("#ingresos").html("");
				}
			})
		}
        
		
		