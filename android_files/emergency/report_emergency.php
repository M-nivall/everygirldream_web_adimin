<?php

include "../../include/connections.php";

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Receive POST data
    $is_anonymous     = $_POST['is_anonymous'];
    $urgency          = $_POST['urgency'];
    $county           = $_POST['county'];
    $town_village     = $_POST['town_village'];
    $specific_address = $_POST['specific_address'];
    $age_group        = $_POST['age_group'];
    $number_of_girls  = $_POST['number_of_girls'];
    $description      = $_POST['description'];

    // Basic validation
    if (
        empty($urgency) ||
        empty($county) ||
        empty($town_village) ||
        empty($age_group) ||
        empty($number_of_girls) ||
        strlen($description) < 20
    ) {

        $response['status'] = 0;
        $response['message'] = 'Invalid or missing data';
        echo json_encode($response);
        exit;
    }

    // Insert query
    $insert = "INSERT INTO emergency_reports
        (is_anonymous, urgency, county, town_village, specific_address,
         age_group, number_of_girls, description, emergency_status)
        VALUES
        ('$is_anonymous', '$urgency', '$county', '$town_village', '$specific_address',
         '$age_group', '$number_of_girls', '$description', 'Pending')";

    if (mysqli_query($con, $insert)) {

        $response['status'] = 1;
        $response['message'] = 'Emergency report submitted successfully';

    } else {

        $response['status'] = 0;
        $response['message'] = 'Please try again';
    }

    echo json_encode($response);
}
?>