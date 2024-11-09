<?php
include('connection.php');

// Check if class_id is set in the URL
if (isset($_GET['class_id'])) {
    $class_id = intval($_GET['class_id']);

    // Fetch class data from the database
    $sql = "SELECT school_year, g_level, section, teacher FROM class_tbl WHERE class_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $class_id);
    $stmt->execute();
    $stmt->bind_result($school_year, $g_level, $section, $teacher);
    $stmt->fetch();
    $stmt->close();
}

?>
<!DOCTYPE html>
<html>
<head>
    <!-- TITLE -->
    <title>DepED ECD Checklist - Update Class </title>
</head>
<body>

    <!--HEADER -->
    <?php
        include('ad_header.php');
    ?>

    <!--HEADER END-->

<section>

    <!-- UPDATE CLASS FORM -->
    <div class="uc_form">
        
        <h2>Update Class</h2>

        <form method="post" action="">

        <input type="hidden" name="class_id" value="<?php echo $class_id; ?>" readonly>
        <br>
        <label>School Year</label>
        <br>
        <input type="text" name="school_year" value="<?php echo htmlspecialchars($school_year); ?>" readonly>
        <br>
        <label>Level</label>
        <br>
        <input type="text" name="g_level" value="<?php echo htmlspecialchars($g_level); ?>" readonly>
        <br>
        <label>Section</label>
        <br>
        <input type="text" name="section" value="<?php echo htmlspecialchars($section); ?>" readonly>
        <br>
        <label>Teacher</label>
        <br>
        <input type="text" name="teacher" value="<?php echo htmlspecialchars($teacher); ?>" readonly>
        <br>

        <button type="submit">Save Changes</button>

        </form>

    </div>

    <!-- UPDATE CLASS FORM END -->
</section>

</body>
</html>