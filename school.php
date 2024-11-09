<?php
include('connection.php');
include('action/class/create_class.php');
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

// CREATE CLASS PROCESS

?>
<!DOCTYPE html>
<html>
<head>

    <!-- TITLE -->
    <title>ECD Checklist - <?php echo htmlspecialchars($school_name); ?></title>

    <!-- STYLE -->
    
</head>
<body>

    <!-- HEADER -->
    <?php
    include('ad_header.php');
    ?>   
    <!-- HEADER -->

<section>

    <!-- S. INFORMATION -->
    <div >
        <h2><p><?php echo htmlspecialchars($school_name); ?></h2>
        <div>

            <label>Region:</label> <p><?php echo htmlspecialchars($region); ?></p>
            <label>Division:</label> <p><?php echo htmlspecialchars($division); ?></p>
            <label>District:</label> <p><?php echo htmlspecialchars($district); ?></p>
            <label>School Head:</label> <p><?php echo htmlspecialchars($school_head); ?></p>
            
        </div>
    </div>

    <!-- S. INFORMATION EDIT END -->

    <!-- CREATE CLASS -->

    <div>
        <input type="text" class="search_bar" placeholder="Search a class...">
        <button class="search_btn">Search</button>
        <button id="create_btn" class="create_btn"> Create Class </button>
        <a href="register_teacher.php"><button> Register Teacher</button></a>
    </div>	

        <!-- POP-UP -->

	    <div id="Modal" class="modal">
    	    <div class="modal-content">

    		    <span class="close">&times;</span>

        		    <form method="post" action="">
            		    
                	<h2>CREATE CLASS</h2>
                    <input type="hidden" name="school_id" value="<?php echo $_GET['school_id']; ?>">

                    <label>School Year</label>
                    <br>
                    <input type="text" name="school_year" required>
                    <br>
                    <label>Level</label>
                    <br>
                    <input type="text" name="g_level" required>
                    <br>
                    <label>Section</label>
                    <br>
                    <input type="text" name="section" required>
                    <br>
                    <button type="submit" name="save_class">Save Class</button>

    		        </form>
    	    </div>
	    </div>    
    <!-- CREATE CLASS END-->

<br>

    <!-- CLASS TABLE -->

    <table>

        <th>No.</th>
        <th>School Year</th>
        <th>Level</th>
        <th>Section</th>
        <th>Teacher</th>
        <th>Action</th>

        <tbody>
        <?php
        include('classtbl_function.php');
        ?>
        </tbody>

    </table>

    <!-- CLASS TABLE END -->

</section>

<!-- JAVASCRIPT -->
<script>
 // BUTTON POP-UP
    var modal = document.getElementById("Modal");
	var btn = document.getElementById("create_btn");
	var span = document.getElementsByClassName("close")[0];

	btn.onclick = function(){
		modal.style.display = "flex";
	}

	span.onclick = function() {
		modal.style.display = "none";
	}

	window.onclick = function(event){
		if(event.target == modal) {
			modal.style.display = "none";
		}
	}
</script>
<!-- JAVASCRIPT END -->

</body>
</html>