<?php
require_once 'admin/db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Retrieve POST data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];  

  // Prepare SQL query to insert data
  $sql = "INSERT INTO contact (name, email, subject, message) VALUES (?, ?, ?, ?)";
  
  // Prepare and bind the statement
  $stmt = $con->prepare($sql);
  $stmt->bind_param("ssss", $name, $email, $subject, $message);

  // Execute the query and check for success
  if ($stmt->execute()) {
    // Send a success response
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Your message has been sent successfully!']);
  } else {
    http_response_code(500);
    echo json_encode(['error' => 'Error inserting data: ' . $stmt->error]);
  }

  // Close the statement and connection
  $stmt->close(); 
} else {
  http_response_code(405); // Method Not Allowed
  echo json_encode(['error' => 'Invalid request method']);
}
?>
