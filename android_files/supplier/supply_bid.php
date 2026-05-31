<?php

include "../../include/connections.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$requestID = $_POST['requestID'];
$supplierID = $_POST['supplierID'];

/* 1️⃣ Update stock request */
$updateRequest = "UPDATE stock_requests 
SET request_status='Supplied'
WHERE request_id='$requestID'";

if(mysqli_query($con,$updateRequest)){

    /* 2️⃣ Update supplier bid */
    $updateBid = "UPDATE supplier_bids 
    SET bid_status='Supplied'
    WHERE request_id='$requestID'
    AND supplier_id='$supplierID'";

    if(mysqli_query($con,$updateBid)){

        $response['status'] = 1;
        $response['message'] = "Supplied Successfully";

    }else{

        $response['status'] = 0;
        $response['message'] = "Failed to update supplier bid";

    }

}else{

    $response['status'] = 0;
    $response['message'] = "Failed to update request status";

}

echo json_encode($response);

}

?>