<?php
include '../../include/connections.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userID = $_POST['userID'];

$response = array();

// Fetch all pending emergency reports
$select = "SELECT n.seminar_id,n.full_name,n.app_status,s.title,s.location,s.seminar_date,s.seminar_time
           FROM seminar_registrations n
           INNER JOIN seminars s ON n.seminar_id = s.seminar_id
           WHERE n.app_status='Approved' AND n.user_id = '$userID'
           ORDER BY n.user_id = '$userID' DESC";

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
    $response['message'] = "Notices";
    $response['details'] = array();

    while ($row = mysqli_fetch_assoc($query)) {
        $temp = array();
        $temp['fullName'] = $row['full_name'];
        $temp['appStatus'] = $row['app_status'];
        $temp['title'] = $row['title'];
        $temp['seminarDate'] = $row['seminar_date'];
        $temp['seminarTime'] = $row['seminar_time'];

        array_push($response['details'], $temp);
    }
} else {
    $response['status'] = 0;
    $response['message'] = "No notice found";
}

// Return JSON
echo json_encode($response);
}
?>