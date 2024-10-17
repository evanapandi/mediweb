<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Pastikan path ini sesuai dengan lokasi autoload Composer Anda

$receiving_email_address = 'it.medifarma@medifarma.biz';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // PHPMailer instantiation
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
        $mail->Host = 'mailsmtp.medifarma.biz'; // Ganti dengan SMTP server Anda
        $mail->SMTPAuth = false; // Nonaktifkan otentikasi jika SMTP Anda tidak memerlukan username/password
        $mail->SMTPSecure = false;
        $mail->Port = 25; // Port server SMTP Anda

        // Recipients
        $mail->setFrom($email, $name); // Email pengirim dari form
        $mail->addAddress($receiving_email_address); // Email tujuan

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = "
            <h3>New Contact Message</h3>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Message:</strong> {$message}</p>
        ";

        $mail->send();
        echo 'OK'; // Respons ke AJAX, berhasil dikirim
    } catch (Exception $e) {
        echo 'Error: ' . $mail->ErrorInfo; // Respons ke AJAX, ada kesalahan
    }
} else {
    echo 'Error: Form was not submitted correctly.';
}


  // /**
  // * Requires the "PHP Email Form" library
  // * The "PHP Email Form" library is available only in the pro version of the template
  // * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  // * For more info and help: https://bootstrapmade.com/php-email-form/
  // */

  // // Replace contact@example.com with your real receiving email address
  // $receiving_email_address = 'it.medifarma@medifarma.com';

  // if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
  //   include( $php_email_form );
  // } else {
  //   die( 'Unable to load the "PHP Email Form" Library!');
  // }

  // $contact = new PHP_Email_Form;
  // $contact->ajax = true;
  
  // $contact->to = $receiving_email_address;
  // $contact->from_name = $_POST['name'];
  // $contact->from_email = $_POST['email'];
  // $contact->subject = $_POST['subject'];

  // // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  // /*
  // $contact->smtp = array(
  //   'host' => 'example.com',
  //   'username' => 'example',
  //   'password' => 'pass',
  //   'port' => '587'
  // );
  // */

  // $contact->add_message( $_POST['name'], 'From');
  // $contact->add_message( $_POST['email'], 'Email');
  // $contact->add_message( $_POST['message'], 'Message', 10);

  // echo $contact->send();
?>
