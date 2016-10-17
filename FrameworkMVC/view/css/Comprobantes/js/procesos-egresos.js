
		$(document).ready(function(){
			load(1);
		});
		
		
		function load(page){
			var e= $("#e").val();
			$("#egresos").fadeIn('slow');
			$.ajax({
				url:'view/css/Comprobantes/ajax/cargar_egresos.php?action=ajax&page='+page+'&e='+e,
		
				beforeSend: function(objeto){
				$("#egresos").html('<img src="view/images/ajax-loader.gif"> Cargando...');
				},
				success:function(data){
					$(".div_egresos").html(data).fadeIn('slow');
					$("#egresos").html("");
				}
			})
		}
        
		
		