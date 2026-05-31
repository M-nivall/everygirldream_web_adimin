<?php

include '../../include/connections.php';

$response = array();

if(isset($_POST["userID"])){

    $userID = $_POST["userID"];

    $select = "SELECT s.request_id, s.quantity_needed, s.urgency, s.request_status, s.created_at,
                      b.unit_price, b.total_price
               FROM stock_requests s
               INNER JOIN supplier_bids b ON s.request_id = b.request_id
               WHERE b.bid_status IN ('Approved','Supplied','Received','Paid')
               AND b.supplier_id = '$userID'
               ORDER BY s.request_id DESC";

    $query = mysqli_query($con,$select);

    // CHECK IF QUERY FAILED
    if(!$query){
        $response["status"] = 0;
        $response["message"] = mysqli_error($con);
        echo json_encode($response);
        exit();
    }

    if(mysqli_num_rows($query) > 0){

        $response["status"] = 1;
        $response["details"] = array();
        $response["message"] = "Request";

        while($row = mysqli_fetch_assoc($query)){

            $index = array();

            $index["request_id"] = $row["request_id"];
            $index["quantity_needed"] = $row["quantity_needed"];
            $index["urgency"] = $row["urgency"];
            $index["request_status"] = $row["request_status"];
            $index["created_at"] = $row["created_at"];
            $index["unit_price"] = $row["unit_price"];
            $index["total_price"] = $row["total_price"];

            $response["details"][] = $index;
        }

    }else{

        $response["status"] = 0;
        $response["message"] = "No requests found";
    }

}else{
    $response["status"] = 0;
    $response["message"] = "userID missing";
}

echo json_encode($response);

?>