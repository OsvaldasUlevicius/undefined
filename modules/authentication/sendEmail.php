<?php
require_once '../../vendor/autoload.php';

// Create the Transport
// TODO
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
    ->setUsername("")
    ->setPassword("");

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

function sendVerificationEmail($userEmail, $token)
{
    // TODO
    $emailName = "";
    $emailPassword = "";
    $emailFullname = "Undefined Inc";
    
    global $mailer;

    // Create a message
    $message = (new Swift_Message('Thank you for registering @ Undefined!'))
        ->setFrom([$emailName => $emailFullname])
        ->setTo($userEmail);

    // Adding image to the body of the mail
    $attachment = Swift_Attachment::fromPath('../../public/img/logo_transparent.png')->setDisposition('inline');
    $attachment->getHeaders()->addTextHeader('Content-ID', '<ABC123>');
    $attachment->getHeaders()->addTextHeader('X-Attachment-Id', 'ABC123');
    $cid = $message->embed($attachment);
    $img = '<img src="cid:ABC123"/>';

    $body = '<!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <title>Verification Mail</title>
      <style>
          img {
              display: block;
              width: 30%; 
          }
      </style>
    </head>

    <body>
      <div class="wrapper">
        <p>Thank you for signing up on our site. Please click on the link below to verify your account:</p>
        <a href="http://localhost/undefined/modules/authentication/verify_email.php?token=' . $token . '">'.$token.'</a>
        '.$img.'
      </div>
    </body>

    </html>';

    $message->setBody($body, 'text/html');

    // Send the message
    $result = $mailer->send($message);
}
