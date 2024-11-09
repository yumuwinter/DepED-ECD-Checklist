<?php
// Set timezone
date_default_timezone_set('Asia/Manila');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Forgot Password Process
// Include necessary files
require 'C:\Users\Alnie\phpmailer\vendor\autoload.php'; // Include Composer's autoloader
require 'connection.php'; // Include your connection file
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request'])) {
    $email_address = $_POST['email_address'];

    // Check if email exists
    $stmt = $conn->prepare("SELECT superadmin_id FROM superadmin_tbl WHERE sa_email = ?");
    $stmt->bind_param("s", $email_address); // Use the correct variable here
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email exists, generate a token
        $token = bin2hex(random_bytes(32)); // Generate a random token
        $expiration = date('Y-m-d H:i:s', strtotime('+1 hour')); // Set expiration time

        // Store token and expiration in the database
        $stmt = $conn->prepare("UPDATE user_tbl SET pw_token = ?, pw_token_expiration = ? WHERE email_address = ?");
        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }
        $stmt->bind_param("sss", $token, $expiration, $email_address); // Use the correct variable here
        
        // Execute the statement and check for success
        if ($stmt->execute()) {
            // Send reset email
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Set the SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'lktena.knowledge@gmail.com'; // SMTP username
                $mail->Password = 'wbsy hfyk wrwb sgxl'; // App password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Recipients
                $mail->setFrom('lktena.knowledge@gmail.com', 'Laurence Kristian M. Tena');
                $mail->addAddress($email_address); // Use the correct variable here

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Request';
                $mail->Body = 'Click <a href="http://localhost/ecd_grading_system/reset_password.php?token=' . $token . '">here</a> to reset your password. This link will expire in 1 hour.<br><br>Your token is: ' . $token;

                $mail->send();
                echo 'Reset link has been sent to your email.';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo 'Failed to update token: ' . $stmt->error; // Debug message
        }
    } else {
        echo 'Email address not found.';
    }

    $stmt->close();
} else {
    // Optional: You can add an else statement here for handling the case when the form is not submitted
    echo 'Please enter your email address to request reset.';
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>

	<!-- Page Title -->

	<title>DepED ECD Checklist - Forgot Password </title>

	<!-- Style -->

	<link rel="stylesheet" type="text/css" href="style/logform.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/740de17fe5.js" crossorigin="anonymous"></script>

</head>
<body>

    <!-- HEADER -->
    <header>
    
    </header>
    <!-- HEADER END -->

    <!-- FORGOT PASSWORD FORM -->

    <form method="POST" action="">

    <div class="fpass_form">

        <center><h2>FORGOT PASSWORD</h2></center>
        <label>Email Address</label>
        <br>
        <input type="email" name="email_address" required>
        <br>
        <center><button type="submit" name="request" class="rr_btn">Request Reset</button></center>

    </div>

    </form>

    <!-- FORM END -->

<!-- JAVASCRIPT -->

<script>

</script>

<!-- JAVASCRIPT END -->

</body>
</html>