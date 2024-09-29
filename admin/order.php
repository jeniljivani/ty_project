<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receive the selected items, total count, and total amount
    $selectedItems = $_POST['items'];
    $totalCount = $_POST['totalCount'];
    $totalAmount = $_POST['totalAmount'];
    
    // Process data if needed or return a response
    if($selectedItems && $totalCount && $totalAmount) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Data received',
            'selectedItems' => $selectedItems,
            'totalCount' => $totalCount,
            'totalAmount' => $totalAmount
        ]);
    }else{
        echo json_encode([
            'status' => 'error',
            'message' => 'Data not received'
        ]);
    }
}


?>