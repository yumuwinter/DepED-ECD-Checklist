<?php
include('connection.php');
include('action/totals.php');
include('session/super_admin.php');
?>
<!DOCTYPE html>
<html>
<head>

	<!-- Page Title -->

	<title>DepED ECD Checklist - Admin </title>

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

<section>

	<!-- ADMIN PANEL -->

	<h1>Admin Panel</h1>

  <div class="container">
    
    <div class="stats">
      <h3>Users</h3>
      <p>Super Admins:</p>
      <p>School Admins:</p>
      <p>Teachers:</p>
    </div>

    <div class="stats">
      <h3>Schools</h3>
      <p><?php echo $totalSchools; ?></p>
    </div>

    <div class="stats">
      <h3>Classes</h3>
      <p>0</p>
    </div>

    <div class="stats">
      <h3>Learners</h3>
      <p>0</p>
      <p>Male: 0</p>
      <p>Female: 0</p>
    </div>

  </div>

	<!-- ADMIN PANEL END -->

</section>

<!-- JAVASCRIPT -->

<script>


</script>

<!-- JAVASCRIPT END -->

</body>
</html>