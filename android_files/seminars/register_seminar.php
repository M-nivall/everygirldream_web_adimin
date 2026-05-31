<?php

include '../../include/connections.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $seminarID = $_POST['seminarID'];
    $fullname  = $_POST['fullname'];
    $phone     = $_POST['phone'];
    $ageGroup  = $_POST['ageGroup'];
    $userID  = $_POST['userID'];

    if (empty($seminarID) || empty($fullname) || empty($phone) || empty($ageGroup)) {

        $response["status"] = 0;
        $response["message"] = "Some details are missing";

        echo json_encode($response);

    } else {

        $insert = "INSERT INTO seminar_registrations(seminar_id, user_id, full_name, phone, age_group)
                   VALUES ('$seminarID','$userID','$fullname','$phone','$ageGroup')";

        if (mysqli_query($con, $insert)) {

            $response["status"] = 1;
            $response["message"] = "You have successfully registered for this seminar";

        } else {

            $response["status"] = 0;
            $response["message"] = "Something went wrong. Please try again";
        }

        echo json_encode($response);
    }

    mysqli_close($con);
}
?>