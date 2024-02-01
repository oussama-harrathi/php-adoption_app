<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get form data
  $name = $_POST['name'];
  $message = $_POST['message'];

  if (empty($name) || empty($message)) {
    echo 'Please fill in all the required fields.';
    exit;
  }

  $mail = new PHPMailer(true);

  try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'harrathioussama8@gmail.com';
    $mail->Password = 'scvxrdtiwxdbqiur';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('sender@example.com', 'Sender Name');
    $mail->addAddress('oussamaharrathi333@gmail.com', 'Recipient Name');

    $mail->Subject = 'New Contact Form Submission';
    $mail->Body = "Name: $name\n\nMessage: $message";

    $mail->send();

    // Display success message
    echo 'Message sent successfully!';

    // Redirect to index.php after 3 seconds
    header('Refresh: 2; URL=index.php');
    exit;
  } catch (Exception $e) {
    echo 'Error sending message: ' . $mail->ErrorInfo;
  }
} else {
  header('Location: contact.php');
  exit;
}
?>


