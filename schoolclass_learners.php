<?php
include('connection.php');
?>
<!DOCTYPE html>
<html>
<head>
	<!-- TITLE -->
	<title>DepED ECD Checklist - </title>
</head>
<body>

	<!-- HEADER -->
	<?php
	?>
	<!-- HEADER END -->

<section>

	<div>
		<input type="text">
		<button> Search Learner</button>
		<button> Enroll Learner </button>
		<button> Enroll through SF1</button>
	</div>

	<!-- ENROLL LEARNER MANUALLY -->

	<h2>Enroll Learner</h2>
	<form action="" method="post">

		<input type="hidden" name="school_id">
		<input type="hidden" name="class_id">
		<input type="text" name="first_name" placeholder="First Name">
		<br>
		<input type="text" name="middle_name" placeholder="Middle Name (Optional)">
		<br>
		<input type="text" name="last_name" placeholder="Last Name">
		<br>
		<input type="text" name="suffix" placeholder="Suffix (Optional)">
		<br>
		<select name="sex" id="sex">
			<option value="M">Male</option>
			<option value="F">Female</option>
		</select>
		<br>
		<input type="date" name="birthdate">
		<br>
		<input type="text" name="ethnic_group" placeholder="IP (Ethnic Group)">
		<br>
		<input type="text" name="religion" placeholder="Religion">
		<br>
		<input type="text" name="adr_street" placeholder="Address Street">
		<br>
		<input type="text" name="adr_barangay" placeholder="Address Barangay">
		<br>
		<input type="text" name="adr_city" placeholder="Address City">
		<br>
		<input type="text" name="adr_province" placeholder="Address Province">
		<br>
		<input type="text" name="father_name" placeholder="Father's Name">
		<br>
		<input type="text" name="mother_name" placeholder="Mother's Name">
		<br>
		<input type="text" name="guardian" placeholder="Guardian's Name">
		<br>
		<input type="text" name="guardian_rel" placeholder="Guardian's Relationship">
		<br>
		<input type="number" name="contact_number" placeholder="Contact Number">
		<br>
 		<button type="submit" name="enroll">Enroll Learner</button>

 	</form>
	<!-- ENROLL LEARNER MANUALLY -->

	<!-- LEARNER LIST -->
	<table border="1">

		<th>No.</th>
		<th>LRN ID</th>
		<th>Learner's Name</th>
		<th>Status</th>
		<th>Action</th>

		<tbody>
		<?php

		?>
		</tbody>

	</table>
	<!-- LEARNER LIST END -->

<!-- JAVASCRIPT -->
<script>

</script>
<!-- JAVASCRIPT END -->
</section>
</body>
</html>