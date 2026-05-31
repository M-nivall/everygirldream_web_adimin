<?php

include "../../include/connections.php";

$requestID = $_POST['requestID'];
$supplierID = $_POST['supplierID'];
$quantity = $_POST['quantity'];

/* 1️⃣ Update the stock request */
$updateRequest = "UPDATE stock_requests 
SET request_status='Received',
selected_supplier='$supplierID'
WHERE request_id='$requestID'";

if(mysqli_query($con,$updateRequest)){

    /* 2️⃣ Approve the selected supplier bid */
    $approveBid = "UPDATE supplier_bids 
    SET bid_status='Received'
    WHERE supplier_id='$supplierID'
    AND request_id='$requestID'";

    mysqli_query($con,$approveBid);

    /* 2️⃣ updated stock */
    $updatedStock = "UPDATE sanitary_stock 
    SET quantity = quantity + '$quantity'";

    mysqli_query($con,$updatedStock);

    /* 3️⃣ Reject all other bids (recommended) */
    $rejectOthers = "UPDATE supplier_bids 
    SET bid_status='Rejected'
    WHERE supplier_id!='$supplierID'
    AND request_id='$requestID'";

    mysqli_query($con,$rejectOthers);

    echo "Stock Received Successfully";

}else{

    echo "Failed to approve supplier";

}

?>