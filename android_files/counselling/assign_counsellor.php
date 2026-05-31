<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $sessionID=$_POST['sessionID'];
     $counsellor=$_POST['counsellor'];

     $select="SELECT * FROM employees WHERE username = '$counsellor'";
     $query=mysqli_query($con,$select);
     $row=mysqli_fetch_array($query);

     $empID=$row['emp_id'];

     $update="UPDATE counselling_sessions SET assigned_counsellor = '$empID', counselling_status = 'Assigned' WHERE session_id='$sessionID'";
     if(mysqli_query($con,$update)){

         $response['status']=1;
         $response['message']='Session Assigned Successfully';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
      }
?>