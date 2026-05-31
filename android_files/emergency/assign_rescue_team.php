<?php

include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $reportID = $_POST['reportID'];
    $selectedTeam = $_POST['selectedTeam'];

    // 1. Get rescue_lead from rescue_team table
    $leadQuery = "SELECT rescue_lead FROM rescue_team WHERE team_name = '$selectedTeam' LIMIT 1";
    $leadResult = mysqli_query($con, $leadQuery);

    if ($leadResult && mysqli_num_rows($leadResult) > 0) {
        $leadRow = mysqli_fetch_assoc($leadResult);
        $rescueLead = $leadRow['rescue_lead'];

        // 2. Update emergency_reports including rescue_lead
        $update = "
            UPDATE emergency_reports 
            SET 
                assigned_team = '$selectedTeam',
                rescue_lead = '$rescueLead',
                emergency_status = 'Assigned'
            WHERE report_id = '$reportID'
        ";

        if (mysqli_query($con, $update)) {
            $response['status'] = 1;
            $response['message'] = 'Rescue Team Assigned Successfully';
        } else {
            $response['status'] = 0;
            $response['message'] = 'Failed to assign rescue team';
        }

    } else {
        $response['status'] = 0;
        $response['message'] = 'Selected rescue team not found';
    }

    echo json_encode($response);
}
?>