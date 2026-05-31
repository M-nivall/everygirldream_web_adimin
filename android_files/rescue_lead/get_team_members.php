<?php
include '../../include/connections.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $team_name = mysqli_real_escape_string($con, $_POST['team_name']);
    
    // Query to get team members
    $sql = "SELECT emp_id, f_name, l_name, contact 
            FROM employees 
            WHERE team = '$team_name' 
            AND status = 'Active'
            ORDER BY f_name ASC";
    
    $result = mysqli_query($con, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $members = array();
        
        while ($row = mysqli_fetch_assoc($result)) {
            $member = array(
                'userID' => $row['emp_id'],
                'fullName' => $row['f_name'].' '.$row['l_name'],
                'phoneNo' => $row['contact']
            );
            $members[] = $member;
        }
        
        $response['status'] = '1';
        $response['message'] = 'Team members found';
        $response['members'] = $members;
        
    } else {
        $response['status'] = '0';
        $response['message'] = 'No team members found';
    }
    
} else {
    $response['status'] = '0';
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
mysqli_close($con);
?>