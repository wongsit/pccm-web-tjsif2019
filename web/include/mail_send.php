<?php

require_once __DIR__ . '/../vendor/autoload.php';
// require 'vendor/autoload.php';
require __DIR__ . '/PHPMailerAutoload.php';

$mail = new PHPMailer();
if(is_null($invite)){
    throw new Exception("No invite variable was set.");
}

$invite['from'] = "";

switch($user['title']) {
    case 1: $invite['from'] .= 'Mr.'; break;
    case 2: $invite['from'] .= 'Ms.'; break;
    case 3: $invite['from'] .= 'Mrs.'; break;
    case 4: $invite['from'] .= 'Miss.'; break;
    case 5: $invite['from'] .= 'Dr.'; break;
}

$invite['from'] .= $user['firstname'] . " " . $user['lastname'];

$message = file_get_contents( __DIR__ . "/mail_template.txt");
$message = str_replace("%%from%%", $invite['from'], $message);
$message = str_replace("%%token%%", $invite['token'], $message);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'noreply@pccm.ac.th';                 // SMTP username
    $mail->Password = 'prince2012';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('noreply@pccm.ac.th', 'TJ-SIF 2019 Website');
    $mail->addAddress($invite['email']);               // Name is optional
    $mail->addReplyTo('w.khanchai@gmail.com', 'TJ-SIF 2019 SECRETARIAT');

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'The invitation to TJ-SIF2019 Official Website';
    $mail->Body    = $message;

    $mail->send();
    // print('Message has been sent');
		error_log("Message has been sent\r\n", 3, "/var/tmp/errors.log");
} catch (Exception $e) {
    // print('Message could not be sent.');
		error_log('Mailer Error: ' . $mail->ErrorInfo, 1, "noreply@pccm.ac.th");
    print('Mailer Error: ' . $mail->ErrorInfo);
}
?>
