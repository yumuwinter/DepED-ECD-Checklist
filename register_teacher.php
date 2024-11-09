<?php
include('connection.php');
include('action/account/registerteacher_function.php');
include('session/super_admin.php');

// Query to get schools
$sql = "SELECT school_id, school_name FROM school_tbl";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>

	<!-- Page Title -->

	<title>DepED ECD Checklist - Register Teacher </title>

	<!-- Style -->

	<link rel="stylesheet" type="text/css" href="style/main.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/740de17fe5.js" crossorigin="anonymous"></script>

</head>
<body>

  <!-- HEADER -->
  <?php
    include('ad_header.php');
  ?>
  <!-- HEADER END -->

	<!-- CREATE ACCOUNT FORM -->
  <div class="acc_form">

	<h2>Register Teacher</h2>

	<form action="" method="POST">

    <!-- ERROR/SUCCESS MESSAGE -->
      <?php if ($error_message): ?>
        <center><p style="color: red;"><?php echo $error_message; ?></p></center>
      <?php endif; ?>

      <?php if ($success_message): ?>
        <center><p style="color: green;"><?php echo $success_message; ?></p></center>
      <?php endif; ?>
    <!-- ERROR/SUCCESS MESSAGE END -->

    <!-- SELECT SCHOOL -->
    <select name="school_id" id="school">
        <option value="">-- Select School --</option>
        <?php
        // Check if there are results and populate the select options
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['school_id'] . '">' . $row['school_name'] . '</option>';
            }
        } else {
            echo '<option value="">No schools available</option>';
        }
        ?>
    </select>
    <!-- SELECT SCHOOL END-->

    <!-- INPUT TEACHER DETAILS -->
    <input type="text" name="first_name" placeholder="First Name">
    
    <input type="text" name="middle_name" placeholder="Middle Name (Optional)">

    <input type="text" name="last_name" placeholder="Last Name">

    <input type="text" name="suffix" placeholder="Suffix (Optional)">

    <input type="text" name="username" placeholder="Username">

    <input type="email" name="email" placeholder="Email">

    <input type="password" name="password_hash" id="password" placeholder="Password">
    <!-- INPUT TEACHER DETAILS END -->

    <!-- PASSWORD CHECKBOX -->
    <input type="checkbox" onclick="togglePassword()"> Show Password

    <center>
      <button type="submit" name="register">Register Teacher</button>
    </center>

    </form>

  </div>
	<!-- CREATE ACCOUNT FORM END -->

<!-- JAVASCRIPT -->
<script>
  // Show Password 
  function togglePassword() {
    var passwordField = document.getElementById("password");
    if (passwordField.type === "password") {
      passwordField.type = "text";
    } else {
      passwordField.type = "password";
    }
  }
</script>
<!-- JAVASCRIPT END -->
</body>
</html>