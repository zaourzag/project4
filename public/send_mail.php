<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $to = $_POST['email']; // Vervang met jouw e-mailadres
    $subject = "Nieuw bericht van je website";
    
    $name = strip_tags($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    if (!$email) {
        die("Ongeldig e-mailadres.");
    }

    $headers = "From: webmaster@example.com\r\n";  // Vervang met je eigen domein
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body = "Naam: $name\n";
    $body .= "E-mail: $email\n\n";
    $body .= "Bericht:\n$message\n";

    if (mail($to, $subject, $body, $headers)) {
        echo "Bericht succesvol verzonden!";
    } else {
        echo "Er is een fout opgetreden bij het verzenden.";
    }
} else {
    echo "Ongeldige aanvraag.";
}
?>
