<?php
include '../../include/connections.php';

$response = array();

// Fetch all pending emergency reports
$select = "SELECT seminar_id, title, location, seminar_date, seminar_time, description, seminar_status
           FROM seminars
           WHERE seminar_status IN('Upcoming', 'In Progress', 'Completed')
           ORDER BY seminar_id DESC";

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
    $response['message'] = "Upcoming Seminars";
    $response['details'] = array();

    while ($row = mysqli_fetch_assoc($query)) {
        $temp = array();
        $temp['seminarID'] = $row['seminar_id'];
         $temp['title'] = $row['title'];
        $temp['location'] = $row['location'];
        $temp['seminarDate'] = $row['seminar_date'];
        $temp['seminarTime'] = $row['seminar_time'];
        $temp['description'] = $row['description'];
        $temp['seminarStatus'] = $row['seminar_status'];

        array_push($response['details'], $temp);
    }
} else {
    $response['status'] = 0;
    $response['message'] = "No upcoming seminars available";
}

// Return JSON
echo json_encode($response);
?>