<?php  

// Llamando a los campos
$nombre = $_POST['name1'];
$correo = $_POST['phone2'];
$telefono = $_POST['email1'];
$mensaje = $_POST['message1'];

// Datos para el correo
$destinatario = "info@extremerivieramaya.com";
$asunto = "Contacto desde nuestra web";

$carta = "De: $nombre \n";
$carta .= "Correo: $correo \n";
$carta .= "Telefono: $telefono \n";
$carta .= "Mensaje: $mensaje";

// Enviando Mensaje
mail($destinatario, $asunto, $carta);
header('Location:mensaje-de-envio.html');

?>