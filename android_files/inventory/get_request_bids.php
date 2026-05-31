<?php

include "../../include/connections.php";

$requestID = $_POST['requestID'];

$query = "SELECT supplier_bids.*,
CONCAT(employees.f_name,' ',employees.l_name) AS supplier_name
FROM supplier_bids
JOIN employees ON employees.emp_id = supplier_bids.supplier_id
WHERE supplier_bids.request_id='$requestID' AND supplier_bids.bid_status IN ('Pending Approval', 'Approved', 'Supplied', 'Received')
ORDER BY supplier_bids.total_price ASC";

$result = mysqli_query($con,$query);

$data = array();

while($row = mysqli_fetch_assoc($result)){
    $data[] = $row;
}

echo json_encode(["data"=>$data]);

?>