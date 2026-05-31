<?php

include "../../include/connections.php";

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Receive POST data
    $county           = $_POST['county'];
    $town_village     = $_POST['town_village'];
    $specific_address = $_POST['specific_address'];
    $description      = $_POST['description'];
    $userID      = $_POST['userID'];

    $date      = $_POST['date'];

    // Basic validation
    if (
        empty($county) ||
        empty($town_village) ||
        strlen($description) < 20
    ) {

        $response['status'] = 0;
        $response['message'] = 'Invalid or missing data';
        echo json_encode($response);
        exit;
    }

    // Insert query
    $insert = "INSERT INTO counselling_sessions
        (user_id, county, town_village, specific_address, description, counselling_date, counselling_status)
        VALUES
        ('$userID', '$county', '$town_village', '$specific_address', '$description', '$date', 'Pending')";

    if (mysqli_query($con, $insert)) {

        $response['status'] = 1;
        $response['message'] = 'Counselling request submitted successfully';

    } else {

        $response['status'] = 0;
        $response['message'] = 'Please try again';
    }

    echo json_encode($response);
}
?>