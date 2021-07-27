
<!DOCTYPE HTML>
<html>
<head>
	<title>Enviar Correo</title>
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta name="keywords" content="" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h1 style="text-align: center;">Formulario de contacto</h1>
		<form method="post">
			<div class="row justify-content-center">
				<div class="form-group col-sm-6">
					<label for="email">Correo electrónico: </label>
					<input type="email" class="form-control" placeholder="email@email.es" name="customer_email" id="email" required>
				</div>
				<div class="form-group col-sm-6">
					<label for="nombre">Nombre: </label>
					<input type="text" class="form-control" placeholder="Nombre" name="customer_name"  required>
				</div>
				<div class="form-group col-sm-6">
					<label for="nombre">Fecha: </label>
					<input type="date" class="form-control" name="fecha" required>
				</div>
				<div class="form-group col-sm-6">
					<label for="nombre">Imagen: </label>
					<input type="file" class="form-control" name="foto" required>
				</div>
				<?php
				if (isset($_POST['send'])){
					include("sendemail.php");
				$mail_username="dabaydullin35@gmail.com";//Correo electronico saliente 
				$mail_userpassword="Durant35";//Tu contraseña de gmail
				$mail_addAddress="abaidullin11@gmail.com";//correo electronico que recibira el mensaje
				$template="email_template.html";
				
				$mail_setFromEmail=$_POST['customer_email'];
				$mail_setFromName=$_POST['customer_name'];
				$fecha=$_POST['fecha'];
				$foto=$_POST['foto'];
				$mail_subject="Prueba Formulario";
				
				sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$fecha,$foto,$mail_subject,$template);
			}
			?>
			<div class="form-group col-sm-12">
				<input type="checkbox" name="terms" id="terminos">
				<label for="terms">Acepto los términos</label>
			</div>
			<div class="form-group col-sm-12">
				<input type="submit" class="btn btn-primary justify-content-center" value="Enviar mensaje" name="send" id="btnEnviar" disabled>
			</div>
		</div>
	</form> 
</div>

<script type="text/javascript">
	document.getElementById("terminos").addEventListener('change', checkAccepted);

	function checkAccepted(event) {
		var btnEnviar = document.getElementById("btnEnviar");
		console.log(this.checked);
		var isNotChecked = !this.checked;
		btnEnviar.disabled = isNotChecked;
	}
</script>
</body>
</html>