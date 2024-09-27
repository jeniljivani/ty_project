<?php
require_once 'admin/db.php';

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$review = trim($_POST['review']);
$image = 'user.png'; // Default image name

// Handle image upload if provided
if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
    $image = rand(1, 1000) . "_" . $_FILES['image']['name']; // Unique image name
    $image_path = 'admin/image/review/' . $image;
    move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
}

// Insert into the database
$stmt = $con->prepare("INSERT INTO review (name, email, review, image) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $review, $image);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Review submitted successfully!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to submit review.']);
}

$stmt->close();
$con->close();
?>
