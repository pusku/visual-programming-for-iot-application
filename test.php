<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


// function parseJson(){
//     $str = file_get_contents('https://samples.openweathermap.org/data/2.5/weather?q=London,uk&appid=b6907d289e10d714a6e88b30761fae22');
//     $json = json_decode($str, true);
//     $status = $json['weather'][0]['description'];
//     //echo $status;
//     return $status;
// }

//The URL that we want to send a PUT request to.

function action_motor(){
    $url = 'http://localhost:8080/restapp/public/index.php/api/action/update/1';
    
    $fields=array (
        "id"=>"1",
        "atag"=>"/ac0wtc23",
        "action"=>"1",
        "time"=>"2018-09-09 14:08:27"
    );

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($fields));

    $response = curl_exec($ch);

    echo $response;
}

function email(){

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'shuvoprosad@gmail.com';                 // SMTP username
        $mail->Password = 'Ss$papapapa';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
    
        //Recipients
        //$mail->setFrom('shuvoprosad@gmail.com', 'Mailer');
        // $mail->addAddress('shuvoprosad@gmail.com', 'Joe User');     // Add a recipient
         $mail->addAddress('shuvoprosad@gmail.com');               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
    
        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}

email();
// function get_lowersensor(){
//     $url = 'http://localhost:8080/restapp/public/index.php/api/lowerlastvalue';
//     $str = file_get_contents($url);
//     $json = json_decode($str, true);
//     $status = $json[0]['data'];
//     echo $status;

// }


