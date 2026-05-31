<?php

include '../../include/connections.php';

$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

    $title = $_POST['title'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $description = $_POST['description'];
    $mentor = $_POST['mentor'];

    $insert = "INSERT INTO seminars 
    (title, location, seminar_date, seminar_time, description, mentor) 
    VALUES 
    ('$title','$location','$date','$time','$description','$mentor')";

    if(mysqli_query($con,$insert)){

        $response['status'] = 1;
        $response['message'] = "Seminar created successfully";

    }else{

        $response['status'] = 0;
        $response['message'] = "Failed to create seminar. Please try again";

    }

}else{

    $response['status'] = 0;
    $response['message'] = "Invalid request";

}

echo json_encode($response);

?>