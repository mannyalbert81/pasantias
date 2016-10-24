<?php

		$conn  = pg_connect("user=postgres port=5432 password=.Romina.2012 dbname=contabilidad_des host=186.4.241.148");
	
		if(!$conn)
		{
			die( "No se pudo conectar");
		}
        
        if (empty($_POST['id'])) {
           $errors[] = "ID vacío";
        } 
		else if (empty($_POST['concepto'])){
			$errors[] = "Concepto vacío";
		} else if (empty($_POST['fecha'])){
			$errors[] = "Fecha vacío";
		}   else if (
			!empty($_POST['id']) &&
			!empty($_POST['concepto']) &&
			!empty($_POST['fecha'])
			
		){

		// escaping, additionally removing everything that could be (html/javascript-) code
		$concepto=pg_escape_string($conn,(strip_tags($_POST["concepto"],ENT_QUOTES)));
		$fecha=pg_escape_string($conn,(strip_tags($_POST["fecha"],ENT_QUOTES)));
		
		$id=intval($_POST['id']);
		$sql="UPDATE ccomprobantes SET  concepto_ccomprobantes='".$concepto."', fecha_ccomprobantes='".$fecha."'	WHERE id_ccomprobantes='".$id."'";
		
		$query_update = pg_query($conn,$sql);
			if ($query_update){
				$messages[] = "Los datos han sido actualizados satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".pg_error($conn);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>	