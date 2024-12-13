<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $username = htmlspecialchars(trim($_POST['username']));
    $age = htmlspecialchars(trim($_POST['age']));
    $experience = htmlspecialchars(trim($_POST['experience']));

    // Validate input data
    $errors = [];
    if (empty($username) || strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters long.";
    }
    if (empty($age) || !is_numeric($age) || $age < 13) { // Example: minimum age is 13
        $errors[] = "You must be at least 13 years old to apply.";
    }
    if (empty($experience)) {
        $errors[] = "Please provide your roleplay experience.";
    }

    // If there are no errors, process the application
    if (empty($errors)) {
        // Email configuration
        $to = "dimoskiko09@gmail.com"; // Change to your email
        $subject = "New Application from $username";
        $message = "Username: $username\nAge: $age\nExperience: $experience";
        $headers = "From: dimoskiko09@gmail.com\r\n"; // Change to your email
        $headers .= "Reply-To: dimoskiko09@gmail.com\r\n"; // Change to your email

        // Send the email
        if (mail($to, $subject, $message, $headers)) {
            echo "<p>Application submitted successfully! Thank you for applying.</p>";
        } else {
            echo "<p>There was an error submitting your application. Please try again later.</p>";
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
} else {
    // Redirect to the application form if accessed directly
    header("Location: html.html"); // Change to your main page
    exit();
}
?>
