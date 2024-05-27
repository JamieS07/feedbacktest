<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Create email
    $to = "shorthousej11@gmail.com"; // Recipient email address
    $subject = "Feedback Form Submission";
    $body = "Name: $name\nEmail: $email\nMessage: $message";
    $headers = "From: $email"; // Sender's email address, can be the user's email
    $attachments = array();
    
    // Check if file was uploaded
    if(isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
        $file_name = $_FILES['attachment']['name'];
        $file_tmp = $_FILES['attachment']['tmp_name'];
        $attachments[] = $file_tmp;
    }

    // Send email with attachment
    $result = mail($to, $subject, $body, $headers, $attachments);

    // Check if email sent successfully
    if ($result) {
        echo "Thank you! Your feedback has been submitted.";
    } else {
        echo "Error: Failed to submit feedback. Please try again later.";
    }

    // Clean up temporary files
    foreach ($attachments as $attachment) {
        unlink($attachment);
    }
}
?>
