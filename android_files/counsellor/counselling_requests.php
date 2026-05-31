<?php
include '../../include/connections.php';

$response = array();

 $userID=$_POST['userID'];

// Fetch all pending emergency reports
$select = "SELECT c.session_id, c.county, c.town_village, c.specific_address, 
                  c.description, c.counselling_status, g.first_name, g.last_name, g.phone_no
           FROM counselling_sessions c
           INNER JOIN girls g ON c.user_id = g.girl_id
           WHERE counselling_status = 'Assigned' AND c.assigned_counsellor = '$userID'
           ORDER BY session_id DESC";

$query = mysqli_query($con, $select);

// Check query success
if (!$query) {
    $response['status'] = 0;
    $response['message'] = "Database error: " . mysqli_error($con);
    echo json_encode($response);
    exit;
}

if (mysqli_num_rows($query) > 0) {
    $response['status'] = 1;
    $response['message'] = "Pending emergency reports found";
    $response['details'] = array();

    while ($row = mysqli_fetch_assoc($query)) {
        $temp = array();
        $temp['sessionID'] = $row['session_id'];
        $temp['county'] = $row['county'];
        $temp['townVillage'] = $row['town_village'];
        $temp['specificAddress'] = $row['specific_address'];
        $temp['description'] = $row['description'];
        $temp['status'] = $row['counselling_status'];

        $temp['userName'] = $row['first_name'].' '.$row['last_name'];
         $temp['phoneNo'] = $row['phone_no'];

        array_push($response['details'], $temp);
    }
} else {
    $response['status'] = 0;
    $response['message'] = "No record found";
}

// Return JSON
echo json_encode($response);
?>