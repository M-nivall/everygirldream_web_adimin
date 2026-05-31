<?php

include "../../include/connections.php";

if($_SERVER['REQUEST_METHOD']=='POST'){

$supplierID = $_POST['supplierID'];
$quantity = $_POST['quantity'];


    $insert="INSERT INTO donations(donor_id, quantity)
             VALUES('$supplierID','$quantity')";

    if(mysqli_query($con,$insert)){

        $response['status']=1;
        $response['message']="Donation Submitted Successfully";

    }else{

        $response['status']=0;
        $response['message']="Failed to submit bid";

    }



echo json_encode($response);

}
?>