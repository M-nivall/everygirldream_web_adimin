<?php
include '../../include/connections.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $applicant_id = mysqli_real_escape_string($con, $_POST['applicant_id']);
    
    // Update applicant status to Approved
    $sql = "UPDATE seminar_registrations 
            SET app_status = 'Approved', 
                approved_at = CURRENT_TIMESTAMP 
            WHERE id = '$applicant_id'";
    
    if (mysqli_query($con, $sql)) {
        $response['status'] = '1';
        $response['message'] = 'Applicant approved successfully';
    } else {
        $response['status'] = '0';
        $response['message'] = 'Failed to approve applicant: ' . mysqli_error($con);
    }
} else {
    $response['status'] = '0';
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
mysqli_close($con);
?>