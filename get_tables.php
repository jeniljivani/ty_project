<?php

    require_once 'admin/db.php';

$date = $_POST['date'];
$time = $_POST['time'];

// Query to fetch available tables on the selected date and time
$sql = "SELECT table_number FROM tables WHERE table_number NOT IN 
        (SELECT table_number FROM reservations WHERE reservation_date = '$date' )";

$table_number_res = $con->query($sql);

if ($table_number_res->num_rows > 0) { 
    while($table_number = $table_number_res->fetch_assoc()) {
        echo '<option value="' . $table_number['table_number'] . '">' . $table_number['table_number'] . '</option>';
    }
} else {
    echo '<option value="">No tables available</option>';
}

$conn->close();
?>
