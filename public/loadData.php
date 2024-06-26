<?php

include('../config/dbcon.php'); // Include the database connection

$table_name = "tbl_course";

$query = "SELECT * FROM $table_name";

$response = mysqli_query($GLOBALS['connect'], $query);

if ($response) {
    echo "<strong>$table_name: </strong>";
    while ($i = mysqli_fetch_assoc($response)) {
        echo "<p>" . $i['code'] . "</p>";
        echo "<p>" . $i['cfull'] . "</p>";
        echo "<p>" . $i['created_date'] . "</p>";
        echo "<hr>";
    }
} else {
    echo "Error: " . mysqli_error($GLOBALS['connect']);
}

// Close the connection
mysqli_close($GLOBALS['connect']);
