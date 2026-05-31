<?php

include "../../include/connections.php";

if($_SERVER['REQUEST_METHOD']=='POST'){

$requestID = $_POST['requestID'];
$unit_price = $_POST['unit_price'];
$total_price = $_POST['total_price'];
$supplierID = $_POST['supplierID'];
$quantity = $_POST['quantity'];

// Check if supplier already placed a bid
$check = "SELECT * FROM supplier_bids 
          WHERE request_id='$requestID' 
          AND supplier_id='$supplierID'";

$result = mysqli_query($con,$check);

if(mysqli_num_rows($result) > 0){

    $response['status'] = 0;
    $response['message'] = "You have already submitted a bid for this request.";

}else{

    $insert="INSERT INTO supplier_bids(request_id,supplier_id,quantity_offered,unit_price,total_price)
             VALUES('$requestID','$supplierID','$quantity','$unit_price','$total_price')";

    if(mysqli_query($con,$insert)){

        $response['status']=1;
        $response['message']="Bid Submitted Successfully";

    }else{

        $response['status']=0;
        $response['message']="Failed to submit bid";

    }

}

echo json_encode($response);

}
?>