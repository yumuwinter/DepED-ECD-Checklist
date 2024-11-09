<?php
$mail->SMTPDebug = 2; // 0 = off (for production use), 1 = client messages, 2 = client and server messages
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'lktena.knowledge@gmail.com';
$mail->Password = 'wbsy hfyk wrwb sgxl'; // App password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

// Recipients
$mail->setFrom('lktena.knowledge@gmail.com', 'Laurence Kristian M. Tena');
$mail->addAddress($email_address); // Use the correct variable here

// Content
$mail->isHTML(true);
$mail->Subject = 'Password Reset Request';
$mail->Body = 'Click <a href="http://localhost/ecd_grading_system/reset_password.php?token=' . $token . '">here</a> to reset your password. This link will expire in 1 hour.';

// Send email
if (!$mail->send()) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
} else {
    echo 'Reset link has been sent to your email.';
}
?>