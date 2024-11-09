<?php
include('connection.php');
// Function to fetch and display school data
$sql = "SELECT school_id, school_name, region, division, district FROM school_tbl";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {

        // school_tbl ROW

        echo "<tr id='school_" . $row['school_id'] . "'>";
        echo "<td style='width: 30px;'>" . $row['school_id'] . "</td>";
        echo "<td>" . $row['school_name'] . "</td>";
        echo "<td>" . $row['region'] . "</td>";
        echo "<td>" . $row['division'] . "</td>";
        echo "<td>" . $row['district'] . "</td>";

        // ACTION ROW

        echo "<td><a href='school.php?school_id=" . $row['school_id'] . "'><button class='table_btn'>View</button></a></td>";
        echo "<td><a href='update_school.php?school_id=" . $row['school_id'] . "'><button class='tableAct_btn'><i class='fa-solid fa-pencil'></i></button></a><button class='tableAct_btn' onclick='deleteSchool(" . $row['school_id'] . ")'><i class='fa-solid fa-trash'></i></button></td>";
        echo "</tr>";
        
    }
} else {
    echo "<tr><td colspan='8'>No schools found</td></tr>";
}

// Close connection
$conn->close();
?>