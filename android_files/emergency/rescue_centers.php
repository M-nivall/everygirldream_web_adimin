<?php
include "../../include/connections.php";

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $sql = "SELECT * FROM rescue_centers WHERE status = 'Active' ORDER BY county, town";
    
    $result = mysqli_query($con, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $centers = array();
        
        while ($row = mysqli_fetch_assoc($result)) {
            $center = array(
                'centerID' => $row['id'],
                'centerName' => $row['center_name'],
                'county' => $row['county'],
                'town' => $row['town'],
                'address' => $row['address'],
                'phone' => $row['phone'],
                'email' => $row['email'],
                'operatingHours' => $row['operating_hours']
            );
            $centers[] = $center;
        }
        
        $response['status'] = '1';
        $response['message'] = 'Rescue centers found';
        $response['centers'] = $centers;
        
    } else {
        $response['status'] = '0';
        $response['message'] = 'No rescue centers found';
    }
    
} else {
    $response['status'] = '0';
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
mysqli_close($con);
?>