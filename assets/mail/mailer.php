<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function isEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Sanitize input
    $name = htmlspecialchars(strip_tags($_POST['name'] ?? ''));
    $email = htmlspecialchars(strip_tags($_POST['email'] ?? ''));
    $comments = htmlspecialchars(strip_tags($_POST['message'] ?? ''));

    // Validate form inputs
    if (empty($name)) {
        echo '<div class="alert alert-error">You must enter your name.</div>';
        exit();
    } elseif (empty($email)) {
        echo '<div class="alert alert-error">You must enter your email address.</div>';
        exit();
    } elseif (!isEmail($email)) {
        echo '<div class="alert alert-error">You must enter a valid email address.</div>';
        exit();
    } elseif (empty($comments)) {
        echo '<div class="alert alert-error">You must enter your comments.</div>';
        exit();
    }

    // Email recipient
    $to = "saifahmed020401@gmail.com"; // Replace with your email address
    $subject = "Contact Form Submission from $name";
    $message = "You have received a contact form submission. Below are the details:" . PHP_EOL . PHP_EOL;
    $message .= "Name: $name" . PHP_EOL;
    $message .= "Email: $email" . PHP_EOL;
    $message .= "Message: " . PHP_EOL . $comments;

    // Set headers
    $headers = "From: $email" . PHP_EOL .
               "Reply-To: $email" . PHP_EOL .
               "Content-Type: text/plain; charset=UTF-8" . PHP_EOL;

    // Attempt to send the email
    if (mail($to, $subject, $message, $headers)) {
        echo '<div class="alert alert-success">';
        echo '<h3>Email Sent Successfully.</h3>';
        echo "<p>Thank you <strong>$name</strong>, your message has been submitted to us.</p>";
        echo '</div>';
    } else {
        echo '<div class="alert alert-error">There was an error sending your message. Please try again later.</div>';
    }
} else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}