
		$(document).ready(function(){
			load_egresos(1);
		});
		
		
		function load_egresos(page){
			var e= $("#e").val();
			$("#egresos").fadeIn('slow');
			$.ajax({
				url:'view/css/Egresos/ajax/cargar_egresos.php?action=ajax&page='+page+'&e='+e,
		
				beforeSend: function(objeto){
				$("#egresos").html('<img src="view/images/ajax-loader.gif"> Cargando...');
				},
				success:function(data){
					$(".div_egresos").html(data).fadeIn('slow');
					$("#egresos").html("");
				}
			})
		}
        
		
		