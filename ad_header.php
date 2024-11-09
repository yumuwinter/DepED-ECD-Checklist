<!DOCTYPE html>
<html>
<head>

  <!-- STYLE -->

	<link rel="stylesheet" type="text/css" href="style/main.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/740de17fe5.js" crossorigin="anonymous"></script>

</head>
<body>

    <!-- HEADER -->

    <header>
        <!-- Main hamburger icon for opening the menu -->
        <i class="fa-solid fa-bars hamburger" onclick="toggleMenu(true)"></i>
        <img class="ecd_logo" src="logos/ecd_logo.png" alt="ECD Logo">
    </header>
    
    <!-- Slide menu container outside of the header for better layering -->
    <div class="slide" id="menuSlide">
        <!-- Close icon inside the menu for closing it -->
        <img class="ecd_logo" src="logos/ecd_logo.png" alt="ECD Logo" style="width: 80%; margin-left: 15px;">
        <h2 style="margin: 0 0px; font-size: 14px;">Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        <ul>
            <li><a href="user.php?superadmin_id">Profile</a></li>
            <li><a href="superadmin.php">Home</a></li>
            <li><a href="account.php">Create Account</a></li>
            <li><a href="school_list.php">Schools</a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="action/logout.php">Log-out</a></li>
        </ul>
    </div>    
    <!-- HEADER END -->

<!-- HEADER JAVASCRIPT -->
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
</script>
<!-- HEADER JAVASCRIPT END -->

</body>
</html>