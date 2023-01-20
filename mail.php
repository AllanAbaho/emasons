<?php
// Uncomment next line if you're not using a dependency loader (such as Composer)
// require_once 'vendor/sendgrid/sendgrid/sendgrid-php.php';
require 'config.php';
require 'vendor/autoload.php';

use SendGrid\Mail\Mail;

$email = new Mail();
if (!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["subject"]) && !empty($_POST["message"])) {
    $name = $_POST['name'];
    $emailAddress = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $email->setFrom($emailAddress);
    $email->setSubject($subject);
    $email->addTo($companyEmail);
    $email->addContent(
        "text/html",
        "<p>Hello Admin,<br>
            Please find my details below,<br>
            Full Name: $name,<br>
            Email: $emailAddress, <br>
            Subject: $subject.<br>
            Message: $message.<br>
            kr,<br>
            $name
    </p>"
    );
    $sendgrid = new \SendGrid($apiKey);
    if ($sendgrid->send($email)) {
        header("Location: index.php?message=success");
        die();
    }
} else {
    header("Location: index.php?message=danger");
    die();
}
// try {
//     $response = $sendgrid->send($email);
//     // return $response;
// } catch (Exception $e) {
//     echo 'Caught exception: '. $e->getMessage() ."\n";
// }
