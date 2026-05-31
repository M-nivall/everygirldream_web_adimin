<?php


include '../../include/connections.php';


$select="SELECT request_id, quantity_needed, urgency, request_status, created_at FROM stock_requests
    WHERE request_status IN ('Open for Bids', 'Supplier Selected', 'Supplied', 'Received')
    ORDER BY request_id DESC";
$query=mysqli_query($con,$select);
if(mysqli_num_rows($query)>0){
    $response['status']=1;
    $response['details']=array();
    $response['message']='Request';
    
while($row=mysqli_fetch_array($query)){
    $index["request_id"]=$row["request_id"];
    $index["quantity_needed"]=$row["quantity_needed"];
    $index["urgency"]=$row["urgency"];
    $index["request_status"]=$row["request_status"];
    $index["created_at"]=$row["created_at"];

    array_push($response["details"],$index);

}

}else{
    $response['status']=0;
    $response['message']='';
}
echo json_encode($response);
