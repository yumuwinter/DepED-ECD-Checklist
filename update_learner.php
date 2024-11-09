<?php
include('connection.php');
?>
<!DOCTYPE html>
<html>
<head>

	<!-- TITLE -->
	<title></title>

	<!-- STYLE -->

</head>
<body>
	<!-- HEADER -->
	<?php

	?>
	<!-- HEADER END -->

<section>

	<!-- UPDATE LEARNER'S INFO -->
	<form action="" method="post">

		<label>First Name</label>
		<input type="text" name="first_name" value="<?php ?>">

		<label>Middle Name</label>
		<input type="text" name="middle_name" value="<?php ?>">

		<label>Last Name</label>
		<input type="text" name="last_name" value="<?php ?>">

		<label>Suffix</label>
		<input type="text" name="suffix" value="<?php ?>">

		<label>Sex</label>
		<select name="sex" id="sex" value="<?php ?>">
			<option value="M">Male</option>
			<option value="F">Female</option>
		</select>

		<label>Birthdate</label>
		<input type="date" name="birthdate" value="<?php ?>">

		<label>IP (Ethnic Group)</label>
		<input type="text" name="ethnic_group" value="<?php ?>">

		<label>Religion</label>
		<input type="text" name="religion" value="<?php ?>">

		<label>Address Street</label>
		<input type="text" name="adr_street" value="<?php ?>">

		<label>Address Barangay</label>
		<input type="text" name="adr_barangay" value="<?php ?>">

		<label>Address City</label>
		<input type="text" name="adr_city" value="<?php ?>">

		<label>Adress Province</label>
		<input type="text" name="adr_province" value="<?php ?>">

		<label>Fathers's Name</label>
		<input type="text" name="father_name" value="<?php ?>">

		<label>Mother's Name</label>
		<input type="text" name="mother_name" value="<?php ?>">

		<label>Guardian</label>
		<input type="text" name="guardian" value="<?php ?>">

		<label>Relationship with Guardian</label>
		<input type="text" name="guardian_rel" value="<?php ?>">

		<label>Contact Number</label>
		<input type="number" name="contact_number" value="<?php ?>">

		<!-- BUTTON -->
		<button type="submit" name="update">Update</button>
	</form>
	<!-- UPDATE LEARNER'S INFO END -->	
</section>

<!-- JAVASCRIPT -->
<script>
	
</script>
<!-- JAVASCRIPT END -->

</body>
</html>