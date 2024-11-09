<?php
include('connection.php');
include('action/school/edit_school.php');
include('session/super_admin.php');

// Check if school_id is set in the URL
if (isset($_GET['school_id'])) {
    $school_id = $_GET['school_id'];

    // Fetch school data from the database
    $sql = "SELECT school_name, region, division, district, school_head FROM school_tbl WHERE school_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $school_id);
    $stmt->execute();
    $stmt->bind_result($school_name, $region, $division, $district, $school_head);
    $stmt->fetch();
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>

    <!-- TITLE -->
    
    <title>DepED ECD Checklist - Update School </title>
    
    <!-- STYLE -->

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

    <!-- UPDATE SCHOOL FORM -->
    <div class="us_form">
        
        <h2>Update School</h2>

        <form action="" method="post">

            <input type="hidden" name="school_id" value="<?php echo $school_id; ?>">
            <label>School Name</label>
            <br>
            <input type="text" id="school_name" name="school_name" value="<?php echo htmlspecialchars($school_name); ?>" readonly>
            <br>
            <label>Region</label>
            <br>
            <input type="text" id="region" name="region" value="<?php echo htmlspecialchars($region); ?>" readonly>
            <br>
            <label>District</label>
            <br>
            <input type="text" id="district" name="district" value="<?php echo htmlspecialchars($district); ?>" readonly>
            <br>
            <label>Division</label>
            <br>
            <input type="text" id="division" name="division" value="<?php echo htmlspecialchars($division); ?>" readonly>
            <br>
            <label>School Head</label>
            <br>
            <input type="text" id="school_head" name="school_head" value="<?php echo htmlspecialchars($school_head); ?>" readonly>
            <br>
            <br>
            <center>
            <button type="button" class="update_btn" id="editBtn" onclick="toggleEdit()">Edit</button>
            <button type="submit" class="update_btn" id="saveBtn" onclick="return confirmSave()" style="display: none;">Save</button>
            </center>

        </form>

    </div>
    <!-- UPDATE SCHOOL FORM END -->

</section>

<!-- JAVASCRIPT -->
<script>
function toggleEdit() {
    const fields = ["school_name", "region", "district", "division", "school_head"];
    const editBtn = document.getElementById("editBtn");
    const saveBtn = document.getElementById("saveBtn");

    // Toggle readonly attribute and button visibility
    fields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        field.readOnly = !field.readOnly;
    });

    // Toggle button text and visibility
    if (editBtn.innerText === "Edit") {
        editBtn.style.display = "none"; // Hide Edit button
        saveBtn.style.display = "inline"; // Show Save button
    } else {
        editBtn.innerText = "Edit";
    }
}

function confirmSave() {
    return confirm("Are you sure you want to save the changes?");
}
</script>
 <!-- JAVASCRIPT END -->
</body>
</html>