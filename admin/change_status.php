<?php
require_once 'db.php';

$status = $_POST['status'];
$id = $_POST['id'];
$update = "UPDATE `items_order` SET `chef_status` = '$status' WHERE `id` = $id";

$res = mysqli_query($con, $update);
if ($res) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Status updated successfully',
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to update status',
    ]);
}
