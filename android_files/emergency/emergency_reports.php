<?php
include '../../include/connections.php';

$response = array();

// Fetch all pending emergency reports
$select = "SELECT er.report_id, er.is_anonymous, er.urgency, er.county, er.town_village, er.specific_address, 
                  er.age_group, er.number_of_girls, er.description, er.emergency_status
           FROM emergency_reports er
           WHERE er.emergency_status='Pending'
           ORDER BY er.report_id DESC";

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
        $temp['reportID'] = $row['report_id'];
        $temp['anonymous'] = $row['is_anonymous'];
        $temp['urgency'] = $row['urgency'];
        $temp['county'] = $row['county'];
        $temp['townVillage'] = $row['town_village'];
        $temp['specificAddress'] = $row['specific_address'];
        $temp['ageGroup'] = $row['age_group'];
        $temp['numberOfGirls'] = $row['number_of_girls'];
        $temp['description'] = $row['description'];
        $temp['status'] = $row['emergency_status'];

        array_push($response['details'], $temp);
    }
} else {
    $response['status'] = 0;
    $response['message'] = "No pending emergency reports found";
}

// Return JSON
echo json_encode($response);
?>