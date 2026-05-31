<?php
include '../../include/connections.php';

if($_SERVER['REQUEST_METHOD']=='POST'){

$username=$_POST['username'];

$response = array();

// Fetch all pending emergency reports
$select = "SELECT s.seminar_id, s.title, s.location, s.seminar_date, s.seminar_time, s.description, s.seminar_status, s.mentor,
           e.f_name, e.l_name
           FROM seminars s 
           INNER JOIN employees e ON s.mentor = e.username
           WHERE seminar_status = 'Upcoming' AND s.mentor = '$username'
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

        $temp['mentor'] =$row['f_name'].' '.$row['l_name'];

        array_push($response['details'], $temp);
    }
} else {
    $response['status'] = 0;
    $response['message'] = "No upcoming seminars available";
}

// Return JSON
echo json_encode($response);
}
?>