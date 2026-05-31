<?php

include "../../include/connections.php";

$donation_id = $_POST['donation_id'];
$quantity = $_POST['quantity'];

/* 1️⃣ Update the stock request */
$updateDonations = "UPDATE donations 
SET donation_status = 'Received'
WHERE donation_id='$donation_id'";

if(mysqli_query($con,$updateDonations)){

    /*  updated stock */
    $updatedStock = "UPDATE sanitary_stock 
    SET quantity = quantity + '$quantity'";

    mysqli_query($con,$updatedStock);

    echo "Donations Received Successfully";

}else{

    echo "Failed to receive donations";

}

?>