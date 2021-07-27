<?php

function sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$fecha,$foto,$mail_subject, $template){

/*---------------------------------------------------------------BBDD--*/
	$conectar = mysqli_connect('localhost', 'root', '');
	if(!$conectar){
		echo "No se pudo conectar con el servidor";
	}else{
		$base = mysqli_select_db($conectar, 'prueba_dmytro');
		if(!$base){
			echo "No se encontro la BBDD";
		}
	}

	$nombre = $_POST['customer_name'];
	$correo = $_POST['customer_email'];
	$fecha = $_POST['fecha'];

	$sql = "INSERT INTO formulario VALUES ('$nombre', '$correo', '$fecha')";
	$ejecutar = mysqli_query($conectar, $sql);
	if(!$ejecutar){
		echo "<p style='color:red'>Error!</p>";
	}else{
		echo "<br><p style='color:green'>Datos guardados correctamente en la BBDD!</p>";
	}
/*-------------------------------------------------------------------------EMAIL---*/
	require 'PHPMailer/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	$mail->isSMTP();                            
	$mail->Host = 'smtp.gmail.com';             
	$mail->SMTPAuth = true;                     
	$mail->Username = $mail_username;          
	$mail->Password = $mail_userpassword; 		
	$mail->SMTPSecure = 'tls';                  
	$mail->Port = 587;                         
	$mail->setFrom($mail_setFromEmail, $mail_setFromName); 
	$mail->addReplyTo($mail_setFromEmail, $mail_setFromName);
	$mail->addAddress($mail_addAddress);   
	$message = file_get_contents($template);
	$message = str_replace('{{first_name}}', $mail_setFromName, $message);
	$message = str_replace('{{fecha}}', $fecha, $message);
	$message = str_replace('{{foto}}', $foto, $message);
	$message = str_replace('{{customer_email}}', $mail_setFromEmail, $message);
	$mail->isHTML(true); 
	
	$mail->Subject = $mail_subject;
	$mail->msgHTML($message);
	if(!$mail->send()) {
		echo '<p style="color:red">No se pudo enviar el mensaje..';
		echo 'Error de correo: ' . $mail->ErrorInfo."</p>";
	} else {
		echo '<p style="color:green">Tu mensaje ha sido enviado!</p>';
	}
}
?>