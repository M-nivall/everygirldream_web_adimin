<?php

include "../../include/connections.php";

if($_SERVER['REQUEST_METHOD']=='POST'){

$seminarID=$_POST['seminarID'];
$report=$_POST['report'];

$update=" UPDATE seminars SET seminar_status = 'Completed', seminar_report = '$report' WHERE seminar_id='$seminarID'";

if(mysqli_query($con,$update)){

    $response['status']=1;
    $response['message']='Congratulations, you have successfully completed semianar session';

}else{

    $response['status']=0;
    $response['message']='Please try again';

}

echo json_encode($response);

}
?>