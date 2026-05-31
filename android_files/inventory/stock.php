<?php

include '../../include/connections.php';

$select = "SELECT * FROM sanitary_stock LIMIT 1";
$query = mysqli_query($con, $select);

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_array($query);

    $response['status'] = 1;
    $response['message'] = "Stock";
    $response['stock'] = [
        'quantity'            => $row['quantity'],
        'minimum_stock_level' => $row['minimum_stock_level'],
        'last_updated'        => $row['last_updated']
    ];
} else {
    $response['status'] = 0;
    $response['message'] = "No stock data found";
}

echo json_encode($response);
?>And