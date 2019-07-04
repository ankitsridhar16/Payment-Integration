<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>
<title>Payment Details!</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>
<div class="w3-container">
    <h1 class='w3-center'>Thank you ! Your Payment Details</h1>
    <p class="w3-center">You will recieve a response and an invoice via mail. <a href="index.html">Back to Home</a></p>
 <?php

include 'src/instamojo.php';

$api = new Instamojo\Instamojo($api_key, $api_secret,'https://'.$mode.'.instamojo.com/api/1.1/');

$payid = $_GET["payment_request_id"];


try {
    $response = $api->paymentRequestStatus($payid);


    echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>" ;
    echo "<h4>Name: " . $response['payments'][0]['buyer_name'] . "</h4>" ;
    echo "<h4>Donor Email: " . $response['payments'][0]['buyer_email'] . "</h4>" ;
    echo "<h4>Purpose: " . $response['purpose'] . "</h4>" ;
    echo "<h4>Payment Status: " . $response['status'] . "</h4>" ;
    echo "<h4>Payment Amount: " . $response['amount'] . " ".$response['payments'][0]['currency']."</h4>" ;

    ?>


    <?php
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}



  ?>
 </div>
 </body>
 </html>