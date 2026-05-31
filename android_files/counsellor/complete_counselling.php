<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $sessionID=$_POST['sessionID'];

     $update="UPDATE counselling_sessions SET counselling_status = 'Completed' WHERE session_id='$sessionID'";
     if(mysqli_query($con,$update)){

         $response['status']=1;
         $response['message']='Counselling Started Successfully';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
      }
?>