<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = strip_tags(trim($_POST["first"]));
    $last_name = strip_tags(trim($_POST["last"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Check the data
    if (empty($first_name) || empty($last_name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    // Recipient email (your Gmail)
    $to = "mcootauc@gmail.com";

    // Email subject & body
    $subject = "New contact from $first_name $last_name";
    $body = "Name: $first_name $last_name\n";
    $body .= "Email: $email\n\n";
    $body .= "Message:\n$message\n";

    // Headers
    $headers = "From: $first_name $last_name <$email>";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        // Set a 200 (okay) response code.
        http_response_code(200);
        echo "Thank You! Your message has been sent.";
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Oops! Something went wrong, we couldn't send your message.";
    }
} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
