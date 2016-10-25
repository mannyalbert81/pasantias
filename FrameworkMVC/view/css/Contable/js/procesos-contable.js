
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
		
		
		
		