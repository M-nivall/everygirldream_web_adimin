<?php


include '../../include/connections.php';

$quantity_needed=$_POST['quantity_needed'];
$urgency=$_POST['urgency'];
$description=$_POST['description'];


   $insert="INSERT INTO stock_requests (quantity_needed, urgency, description)VALUES ('$quantity_needed','$urgency','$description')";
  if(mysqli_query($con,$insert)){
    $response['status']=1;
    $response['message']='Submitted successfully';
    }else{
    $response['status']=0;
    $response['message']='Please try again. Something went wrong';
  }
echo json_encode($response);
