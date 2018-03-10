<?php
if($_POST)
{
    $to_email   	= "info@vuelatour.com"; //Recipient email, Replace with own email here
    $subject="Tours";

    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

        $output = json_encode(array( //create JSON data
            'type'=>'error',
            'text' => 'Sorry Request must be Ajax POST'
        ));
        die($output); //exit script outputting json data
    }

    //Sanitize input data using PHP filter_var().
     $fecha_llegada2     = filter_var (preg_replace("([^0-9/] | [^0-9-])","",$_POST["fecha_llegada"])); 
    $user_name		= filter_var($_POST["user_name"], FILTER_SANITIZE_STRING);
    $user_email		= filter_var($_POST["user_email"], FILTER_SANITIZE_EMAIL);
    $phone_number	= filter_var($_POST["phone_number"], FILTER_SANITIZE_NUMBER_INT);
    $message		= filter_var($_POST["msg"], FILTER_SANITIZE_STRING);
    $numero_personas		= filter_var($_POST["numero_personas"], FILTER_SANITIZE_STRING);
    $fecha_llegada		= filter_var( $fecha_llegada2, FILTER_SANITIZE_STRING);
    $tour		= filter_var($_POST["destino"], FILTER_SANITIZE_STRING);
   
    
   
    //additional php validation
   if(strlen($user_name)<0){ // If length is less than 4 it will output JSON error.
        $output = json_encode(array('type'=>'error', 'text' => 'El nombre es muy corto'));
        die($output);
    }
    if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){ //email validation
       $output = json_encode(array('type'=>'error', 'text' => 'Por favor introduzca una dirección de correo electrónico válida'.$user_email." holis"));
       die($output);
    }
    if(!filter_var($phone_number, FILTER_SANITIZE_NUMBER_FLOAT)){ //check for valid numbers in phone number field
        $output = json_encode(array('type'=>'error', 'text' => 'Introduzca sólo dígitos en el número de teléfono'));
        die($output);
    }
    if(strlen($message)<3){ //check emtpy message
        $output = json_encode(array('type'=>'error', 'text' => 'Olvidaste la parte más importante...'));
        die($output);
    }
    if(strlen($fecha_llegada<12)){ //check for valid numbers in phone number field
        $output = json_encode(array('type'=>'error', 'text' => 'Introduzca la fecha de su llegada..'));
        die($output);
    }
    if(strlen($numero_personas)<0){ // If length is less than 4 it will output JSON error.
        $output = json_encode(array('type'=>'error', 'text' => 'Introduzca cuantas personas son'));
        die($output);
    }

    //email body
    $message_body = $message."\r\n\r\n-".$user_name."\r\nPhone Number : ".$phone_number."\r\nEmail : ".$user_email."\r\nTour : ".$tour."\r\nLlegada : ". $fecha_llegada ;

    //proceed with PHP email.
    $headers = 'From: '.$user_name.'' . "\r\n" .
        'Callback: '.$phone_number.'' . "\r\n" .
        'Reply-To: '.$user_email.'' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    $send_mail = mail($to_email, $subject, $message_body, $headers);

    if(!$send_mail)
    {
        //If mail couldn't be sent output error. Check your PHP email configuration (if it ever happens)
        $output = json_encode(array('type'=>'error', 'text' => 'Could not send mail! Please check your PHP mail configuration.'));
        die($output);

    }else{
        $output = json_encode(array('type'=>'message', 'text' => 'Hola '.$user_name .' Le contestaremos lo antes posible!'));
        die($output);
    }
}
?>