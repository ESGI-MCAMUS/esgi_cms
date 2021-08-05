<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './assets/PHPMailer-master/src/Exception.php';
require './assets/PHPMailer-master/src/PHPMailer.php';
require './assets/PHPMailer-master/src/SMTP.php';

class Mailer {
  public static function envoieMail($email, $prenom = "", $nom = "", $entete, $contenu) {
    //Create an instance; passing `true` enables exceptions

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
      //Server settings
      //   $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output SMTP::DEBUG_SERVER
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = SMTP_HOST;                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = SMTP_USERNAME;                     //SMTP username
      $mail->Password   = SMTP_PASSWORD;                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = SMTP_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);

      $name = $prenom . ' ' . $nom;

      $mail->addAddress($email, $name);     //Add a recipient

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = $entete;
      $mail->Body    = $contenu;

      $mail->send();
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }
}
