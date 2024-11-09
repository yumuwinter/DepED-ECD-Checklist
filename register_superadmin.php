<?php
include('connection.php');

// Initialize error and success messages
$error_message = '';
$success_message = '';

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $suffix = $_POST['suffix'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_hash = $_POST['password_hash'];

    // Check if all fields are filled
    if (empty($first_name) || empty($last_name) || empty($username) || empty($email) || empty($password_hash)) {
        $error_message = "All fields are required.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password_hash, PASSWORD_DEFAULT);

        // Prepare an SQL statement to insert the new super admin
        $query = "INSERT INTO superadmin_tbl (first_name, middle_name, last_name, suffix, username, email, password_hash, created) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssss", $first_name, $middle_name, $last_name, $suffix, $username, $email, $hashed_password);

        // Execute the statement and check for success
        if (mysqli_stmt_execute($stmt)) {
            $success_message = "Super Admin created successfully!";
        } else {
            $error_message = "Error creating Super Admins: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>
<!-- REGISTER SUPER ADMIN -->
<form action="" method="post">

<input type="text" name="first_name" placeholder="First Name">
<br>
<input type="text" name="middle_name" placeholder="Middle Name">
<br>
<input type="text" name="last_name" placeholder="Last Name">
<br>
<input type="text" name="suffix" placeholder="Suffix">
<br>
<input type="text" name="username" placeholder="Username">
<br>
<input type="email" name="email" placeholder="Email">
<br>
<input type="password" name="password_hash" placeholder="Password">
<br>
<button type="submit">Create</button>

</form>

    <!-- Display error or success messages -->
    <?php if ($error_message): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <?php if ($success_message): ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php endif; ?>
    
</body>
<html>
