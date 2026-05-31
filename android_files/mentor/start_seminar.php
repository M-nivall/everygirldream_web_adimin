<?php

include "../../include/connections.php";

if($_SERVER['REQUEST_METHOD']=='POST'){

$seminarID=$_POST['seminarID'];

$update=" UPDATE seminars SET seminar_status = 'In Progress' WHERE seminar_id='$seminarID'";

if(mysqli_query($con,$update)){

    $response['status']=1;
    $response['message']='Seminar Starts Now';

}else{

    $response['status']=0;
    $response['message']='Please try again';

}

echo json_encode($response);

}
?>