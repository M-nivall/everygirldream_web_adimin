<?php

   include '../../include/connections.php';


   $select="SELECT username FROM employees WHERE userlevel = 'Mentor'";
   $record=mysqli_query($con,$select);

   if(mysqli_num_rows($record)>0){

       $response['status']=1;
       $response['message']="Mentors";

       $response['details']=array();
       while($row=mysqli_fetch_array($record)){

           $index['username']=$row['username'];
           //s$index['fullName'] = $row['f_name'].' '.$row['l_name'];

           array_push($response['details'],$index);
       }
   }else{
       $response['status']=0;
       $response['message']="No record found";
   }

   echo json_encode($response);

?>