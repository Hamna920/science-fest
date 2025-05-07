<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ...existing code...
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validate input
    if (empty($name) || empty($email) || empty($message)) {
        echo "All fields are required.";
        exit;
    }
    
    // New: Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    // Prepare email
    $to = '100203711@student.burnley.ac.uk'; // <-- Update with your email address
    $subject = 'New Contact Form Submission';
    $body = "Name: $name\nEmail: $email\nMessage:\n$message";
    
    // Modified email headers for better deliverability
    $headers = "From: no-reply@yourdomain.com\r\n"; // Change your fixed sender email as needed
    $headers .= "Reply-To: $email\r\n";

    // Attempt to send the email
    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you for contacting us, $name.";
    } else {
        echo "There was an error sending your message.";
    }
} else {
    echo "Invalid request.";
}
