<?php
include('connection.php');
$error_message = '';

// Process the login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password_hash = $_POST['password_hash'];

    // Prepare and execute the query to check credentials
    $query = "SELECT * FROM teacher_tbl WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username); // Bind the correct variable
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    // Verify the user's credentials
    if ($user && password_verify($password_hash, $user['password_hash'])) {
        // Valid login, set session variables
        $_SESSION['teacher_id'] = $user['teacher_id'];
        $_SESSION['username'] = $user['username'];
        
        // Redirect to the dashboard
        header("Location: teacher.php");
        exit();
    } else {
        // Invalid credentials
        $error_message = "Invalid username or password.";
    }
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- TITLE -->
	<title>DepED ECD Checklist - Teacher Login</title>

	<!-- STYLE -->
    <link rel="stylesheet" type="text/css" href="style/logform.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/740de17fe5.js" crossorigin="anonymous"></script>

</head>
<body>
	
	<!-- HEADER -->
	<header>

	</header>
	<!-- HEADER END -->
<section>

	<!-- LOGIN FORM -->
    <center>
        <form action="" method="post">
            <div class="login_form">
                <img class="seal_logo" src="logos/deped_seal.png" width="15%">
                <h1>Login</h1>

                <!-- ERROR -->
                <?php if ($error_message): ?>
                    <p style="color: red;"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <!-- ERROR END -->

                <i class="fa-solid fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
                <br>
                <i class="fa-solid fa-eye" id="togglePassword"></i>
                <input type="password" name="password_hash" id="password" placeholder="Password" required>
                <br>
                <button type="submit" name="login">Login</button>
                <br>
                <a href="forgot_password.php"><p class="f_pass">Forgot Password?</p></a>                
            </div>
        </form>
    </center>
	<!-- LOGIN FORM END -->

</section>	    

<!-- JAVASCRIPT -->
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
        // Toggle the type attribute between password and text
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Toggle the icon between fa-eye and fa-eye-slash
        this.classList.toggle('fa-eye-slash');
    });
</script>
<!-- JAVASCRIPT END -->

</body>
</html>