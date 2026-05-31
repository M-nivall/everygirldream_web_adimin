<?php

include '../../include/connections.php';




//creating a query
$select = "SELECT s.request_id, s.quantity_offered, s.unit_price, s.total_price, s.bid_status, e.f_name, e.l_name
    FROM supplier_bids s  
    INNER JOIN employees e ON e.emp_id = s.supplier_id WHERE s.bid_status = 'Received' ORDER BY s.request_id DESC";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['details'] = array();
      $results['message']="Order history";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['requestID'] = $row['request_id'];
          $temp['supplierName'] = $row['f_name'].' '.$row['l_name'];
          $temp['quantity'] = $row['quantity_offered'];
          $temp['unitPrice'] = $row['unit_price'];
          $temp['totalPrice'] = $row['total_price'];
          $temp['bidStatus'] = $row['bid_status'];
          

          array_push($results['details'], $temp);

      }


  }else{
      $results['status'] = "0";
      $results['message'] = "No More Pending Payments Found";

}
//displaying the result in json format
echo json_encode($results);



//$today = date('Ymd');
//$startDate = date('Ymd', strtotime('-100 days'));
//$range = $today - $startDate;
//$rand = rand(100, 999);
//echo $rand;
//echo "</br>";
//$random = substr(md5(mt_rand()), 0, 2);
//echo $random;

?>