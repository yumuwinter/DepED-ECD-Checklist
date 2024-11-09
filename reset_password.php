<?php
// Include necessary files
require 'C:\Users\Alnie\phpmailer\vendor\autoload.php'; // Ensure this path is correct
require 'connection.php'; // Include your connection file

// Initialize variables for error/success messages
$error = '';
$success = '';

// Check if the token is provided in the URL
if (!isset($_GET['token']) || empty(trim($_GET['token']))) {
    $error = 'No token provided. Please check the link or request a new password reset.';
} else {
    $token = $_GET['token'];

    // If the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize and validate the new password
        $newPassword = trim($_POST['new_password']);

        // Validate password input
        if (empty($newPassword)) {
            $error = 'New password is required.';
        } elseif (strlen($newPassword) < 6) {
            $error = 'Password must be at least 6 characters long.';
        }

        if (empty($error)) {
            // Check if the token is valid and not expired
            $stmt = $conn->prepare("SELECT user_id FROM user_tbl WHERE pw_token = ? AND pw_token_expiration > NOW()");
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // Token is valid, fetch user ID
                $stmt->bind_result($user_id);
                $stmt->fetch();

                // Hash the new password
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Use PASSWORD_DEFAULT for future-proofing

                // Update the user's password, clear the token and expiration
                $stmt = $conn->prepare("UPDATE user_tbl SET password_hash = ?, pw_token = NULL, pw_token_expiration = NULL WHERE user_id = ?");
                $stmt->bind_param("si", $hashedPassword, $user_id);

                if ($stmt->execute()) {
                    $success = 'Password has been reset successfully. You can now <a href="login.php">log in</a> with your new password.';
                } else {
                    $error = 'Failed to reset password. Please try again later.';
                }

            } else {
                // Token is invalid or expired
                $error = 'Invalid or expired token. Please try requesting a new password reset link.';
            }

            $stmt->close();
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>

	<!-- Page Title -->

	<title>DepED ECD Checklist - Log-in</title>

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

    <!-- RESET PASSWORD FORM -->
    <div class="rp-form">
        <h2>Reset Password</h2>
        <?php if (!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php elseif (!empty($success)): ?>
            <div class="success-message"><?php echo $success; ?></div>
        <?php else: ?>
            <form method="POST" action="">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" id="new_password" required>
                <button type="submit">Reset Password</button>
            </form>
        <?php endif; ?>
    </div>
    <!-- RESET PASSWORD FORM END -->

</body>
</html>