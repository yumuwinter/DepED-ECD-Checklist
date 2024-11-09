<?php
include('connection.php');
include('session/super_admin.php');
include('action/account/registeradmin_function.php');

// Query to get schools
$sql = "SELECT school_id, school_name FROM school_tbl";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>

	<!-- Page Title -->

	<title>DepED ECD Checklist - Register Admin </title>

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

	<h2>CREATE SCHOOL ADMIN</h2>

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


    <!-- INPUT DETAILS -->
    <input type="text" name="first_name" required placeholder="First Name">

    <input type="text" name="middle_name" placeholder="Middle Name (Optional)">

    <input type="text" name="last_name" required placeholder="Last Name">

    <input type="text" name="suffix" placeholder="Suffix (Optional)">

    <input type="text" name="username" required placeholder="Username">

    <input type="email" name="email" required placeholder="Email">

    <input type="password" name="password_hash" id="password" placeholder="Password" required>
    <!-- INPUT DETAILS END -->

    <!-- Show Password Checkbox -->

    <input type="checkbox" onclick="togglePassword()"> Show Password

    <center>
      <button type="submit" name="register">Save</button>
    </center>

    </form>

  </div>

	<!-- CREATE ACCOUNT FORM END -->

<!-- JAVASCRIPT -->

<script>
  function toggleMenu(open) {
    const menuSlide = document.getElementById("menuSlide");
    if (open) {
      menuSlide.classList.add("show");
    } else {
      menuSlide.classList.remove("show");
    }
  }

  // Close the menu when clicking outside
  document.addEventListener("click", function(event) {
    const menuSlide = document.getElementById("menuSlide");
    const hamburgerIcon = document.querySelector(".hamburger");

    if (!menuSlide.contains(event.target) && !hamburgerIcon.contains(event.target)) {
      // Close menu if clicked outside of menuSlide and hamburger icon
      toggleMenu(false);
    }
  });

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