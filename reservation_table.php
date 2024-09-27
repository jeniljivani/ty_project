<?php
require_once 'admin/db.php';

if (isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['table'], $_POST['date'], $_POST['time'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $table = $_POST['table'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Validate the inputs (simple validation example)
    if (empty($name) || empty($email) || empty($phone) || empty($table) || empty($date) || empty($time)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit();
    }

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $con->prepare("INSERT INTO reservations (name, email, phone, table_number, reservation_date, reservation_time) 
        VALUES (?, ?, ?, ?, ?, ?)");
    
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param('ssssss', $name, $email, $phone, $table, $date, $time);
        
        // Execute the statement
        $result = $stmt->execute();
        
        if ($result) {
            echo json_encode(['status' => true, 'message' => 'Reservation successful']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to submit your reservation. Please try again.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the SQL statement.']);
    }

} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid form submission.']);
}
