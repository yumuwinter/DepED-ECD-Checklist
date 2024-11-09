<?php
include('connection.php');
include('action/school/create_school.php');
include('session/super_admin.php');
?>
<!DOCTYPE html>
<html>
<head>

    <!-- TITLE -->
    <title>DepED ECD Checklist - School</title>

    <!-- STYLE -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/740de17fe5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/main.css">

</head>
<body>

    <!-- HEADER --> 
    <?php
    include('ad_header.php');
    ?>
    <!-- HEADER END -->

<section>

    <!-- CREATE SCHOOL -->

    <h2>SCHOOLS</h2>

    <!-- SUCCESS / ERROR MESSAGE -->
    <?php
    // Display success or error messages
    if ($success_message) {
    echo "<p style='color: green; font-size: 10px;'>$success_message</p>";
    }
    if ($error_message) {
        echo "<p style='color: red; font-size: 10px;'>$error_message</p>";
    }
    ?>
    <!-- SUCCESS / ERROR MESSAGE END -->

    <div>
        <input type="text" class="search_bar" id="search_school" placeholder="Search a School...">
        <button class="search_btn" onclick="searchSchool()">Search</button>
        <button id="create_btn" class="create_btn">Create School</button>
        <a href="register_admin.php"><button class=""> Register School Admin</button></a>
    </div>

    	<!-- POP-UP -->
	    <div id="Modal" class="modal">
    	    <div class="modal-content">

    		    <span class="close">&times;</span>

        		    <form method="post" action="">
            		    
                	<h2>CREATE SCHOOL</h2>

                	<label>School Name</label>
                    <br>
                	<input type="text" name="school_name" required>
                    <br>
                    <label>Region</label>
                    <br>
                	<input type="text" name="region" >
                    <br>
                	<label>Division</label>
                    <br>
                	<input type="text" name="division">
                    <br>
                    <label>District</label>
                    <br>
                    <input type="text" name="district">
                    <br>
                    <label>School Head</label>
                    <br>
                    <input type="text" name="school_head">
                    <br>
                    <center>
                	<button type="submit" name="create_school" > Save School </button>
                    </center>
                    
    		        </form>
    	    </div>
	    </div>
        <!-- POP-UP END -->


    <!-- CREATE SCHOOL END -->

    <!-- SCHOOL TABLE -->
<br>
    <table>

        <th>No.</th>
        <th>School</th>
        <th>Region</th>
        <th>Division</th>
        <th>District</th>
        <th>Classes</th>
        <th>Action</th>

        <tbody id="school_table">
        <?php include('schooltbl_function.php'); ;?>
        </tbody>

    </table>

    <!-- SCHOOL TABLE END -->

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

// DELETE FUNCTION
function deleteSchool(schoolId) {
    if (confirm('Are you sure you want to delete this school?')) {
        // Create an AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "action/delete_school.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
        // Define the callback function
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Remove the row from the table if deletion is successful
                    var row = document.getElementById("school_" + schoolId);
                    row.parentNode.removeChild(row);
                } else {
                    alert("Error deleting record: " + response.error);
                }
            }
        };
        
        // Send the request with the school_id
        xhr.send("school_id=" + schoolId);
    }
}

// SEARCH SCHOOL 
function searchSchool() {
    var searchTerm = document.getElementById("search_school").value;

    // Create an AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "action/school/search_school.php?search_term=" + encodeURIComponent(searchTerm), true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Update the table body with the search results
            document.getElementById("school_table").innerHTML = xhr.responseText;
        } else {
            alert("Error occurred while searching for schools.");
        }
    };
    
    // Send the request
    xhr.send();
}
</script>

<!-- JAVASCRIPT END -->

</body>
</html>