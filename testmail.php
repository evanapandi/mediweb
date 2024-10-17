<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Pastikan path ini benar

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();   
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
                                            // Set mailer to use SMTP
    $mail->Host = 'mailsmtp.medifarma.biz';                    // Specify main and backup SMTP servers
    $mail->SMTPAuth = false;                                   // Disable SMTP authentication
    $mail->SMTPSecure = false;                                 // Disable encryption
    $mail->Port = 25;                                          // Set TCP port

    // Recipients
    $mail->setFrom('it.medifarma@medifarma.biz', 'Your Name');  // Set sender email and name
    $mail->addAddress('it.medifarma@medifarma.biz');            // Add a recipient

    // Content
    $mail->isHTML(false);                                      // Set email format to plain text
    $mail->Subject = 'Test Mail Function';
    $mail->Body    = 'This is a test email to check if PHPMailer works with minimal configuration.';

    $mail->send();
    echo 'Mail sent successfully!';
} catch (Exception $e) {
    echo "Mail could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



// error_reporting(E_ALL);
// ini_set('display_errors', 1);


// $to = 'it.medifarma@medifarma.biz'; // Ganti dengan email Anda sendiri untuk mengetes
// $subject = 'Test Mail Function';
// $message = 'This is a test email to check if the mail() function works on this server.';
// $headers = 'From: intranet.center@medifarma.biz';

// if (mail($to, $subject, $message, $headers)) {
//     echo 'Mail sent successfully!';
// } else {
//     echo 'Mail failed to send.';
// }




?>
