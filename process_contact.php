<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = strip_tags(trim($_POST["message"]));

    // Set your email address where you want to receive messages
    $to = "vaishnavi.22320188@viit.ac.in"; // Replace with your actual email address
    $email_subject = "New Contact Form Submission from Object Haven";
    $email_body = "You have received a new message from the Object Haven contact form:\n\n";
    $email_body .= "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Subject: $subject\n";
    $email_body .= "Message:\n$message\n";
    $headers = "From: $email\n";
    $headers .= "Reply-To: $email\n";

    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        // Optionally, you can store the submission in a database here

        // Redirect back to the contact page (or a thank you page)
        // In this setup with the popup, we don't want to redirect immediately.
        // The JavaScript on contact.html handles the success message.
        // You could potentially send a success status back via AJAX for more advanced handling.
    } else {
        // Handle email sending error (you might want to log this)
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    // If the script is accessed directly, redirect to the contact page
    header("Location: contact.html");
    exit();
}
?>