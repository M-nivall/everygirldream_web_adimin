<?php

include "../../include/connections.php";


if($_SERVER['REQUEST_METHOD']=='POST'){

$reportID=$_POST['reportID'];

$update=" UPDATE emergency_reports SET emergency_status = 'In Progress' WHERE report_id='$reportID'";
if(mysqli_query($con,$update)){

    $response['status']=1;
    $response['message']='Updated Successfully';

}else{
    $response['status']=0;
    $response['message']='Please try again';


}
echo json_encode($response);
}
?>