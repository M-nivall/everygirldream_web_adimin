<?php

include "../../include/connections.php";

//$requestID = $_POST['requestID'];

$query = "SELECT donations.*,
CONCAT(employees.f_name,' ',employees.l_name) AS donner_name
FROM donations
JOIN employees ON employees.emp_id = donations.donor_id
WHERE donations.donation_status IN ('Pending')
ORDER BY donations.donation_id ASC";

$result = mysqli_query($con,$query);

$data = array();

while($row = mysqli_fetch_assoc($result)){
    $data[] = $row;
}

echo json_encode(["data"=>$data]);

?>