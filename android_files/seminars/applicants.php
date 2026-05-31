<?php
include '../../include/connections.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $seminarID = $_POST['seminarID'];

// Creating the query
$select = "SELECT id,full_name, phone, age_group, app_status
        FROM seminar_registrations
        WHERE seminar_id = '$seminarID' 
        ORDER BY id DESC";

$query = mysqli_query($con, $select);

$results = array();

if (mysqli_num_rows($query) > 0) {
    $results['status'] = "1";
    $results['message'] = "Seminar Applicants";
    $results['details'] = array();

    while ($row = mysqli_fetch_assoc($query)) {
        $temp = array();
        $temp['ID'] = $row['id'];
        $temp['fullName'] = $row['full_name'];
        $temp['phone'] = $row['phone'];
        $temp['ageGroup'] = $row['age_group'];
        $temp['appStatus'] = $row['app_status'];

        array_push($results['details'], $temp);
    }
} else {
    $results['status'] = "0";
    $results['message'] = "No record found";
}

echo json_encode($results);
}
?>
