<?php


$name = htmlspecialchars(trim($_POST['name']));
$phone_number = htmlspecialchars(trim($_POST['phone_number']));
$email = htmlspecialchars($_POST['email']);
$contact_message = htmlspecialchars($_POST['contact_message']);

if (!empty($email) && !empty($contact_message)) {
    $receiver = 'epheremfisha5350@gmail.com';
    $subject = "From: $name <$email>";
    $body = "Email: $email\n\tPhone number: $phone_number\n\n\tMessage: $contact_message\n";
    $sender = "From: $email";

    if (mail($receiver, $subject, $body, $sender)) {
        echo "Your message has been sent!";
    } else {
        echo "Failed to send your message! Please try again.";
    }
} else {
    echo 'Your Email and Message is required!';
}
