<?php

include "../../include/connections.php";


if($_SERVER['REQUEST_METHOD']=='POST'){

$requestID=$_POST['requestID'];

$update="UPDATE supplier_bids SET bid_status = 'Paid' WHERE request_id = '$requestID'";
  
  
$update2="UPDATE stock_requests SET request_status = 'Paid' WHERE request_id = '$requestID'";
    mysqli_query($con,$update2);
if(mysqli_query($con,$update)){

    $response['status']=1;
    $response['message']='Supplier Paid Successfully';

}else{
    $response['status']=0;
    $response['message']='Please try again';


}
echo json_encode($response);
}
?>