<?php include 'config.php'; ?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <section>
        <div class="justify-content-center align-content-center"><img class="img-fluid" src="assets/img/logo_small.png" style="width:120px;margin-left:43%;">
            <h2 class="text-center" style="font-family:Montserrat, sans-serif;font-weight:800;">The Sparks Foundation | Donate&nbsp;</h2>
            <p class="text-center">Fill your details | Our payment portal is powered by Instamojo&nbsp;</p>
            <form class="w3-container" method='POST' action="">
       <p>      
    <label class="w3-text-black"><b>Name</b></label>
    <input class="w3-input w3-border" name="name" type="text" required></p>
    <p>      
    <label class="w3-text-black"><b>Number</b></label>
    <input class="w3-input w3-border" name="number" type="text" required></p>
    <p>      
    <label class="w3-text-black"><b>Email</b></label>
    <input class="w3-input w3-border" name="email" type="text" required></p>
    <p>      
    <label class="w3-text-black"><b>Amount </b></label>
    <input class="w3-input w3-border" name="amount" type="number" required></p>
    <p>
    <input type="submit" name='submit' class="w3-btn w3-blue" value='Proceed to Pay!'></p>
  </form>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
if(isset($_POST['submit'])){
$amount = $_POST['amount'];
$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://'.$mode.'.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:$api_key",
                  "X-Auth-Token:$api_secret"));
$payload = Array(
    'purpose' => 'Donation',
    'amount' => $amount,
    'phone' => $number,
    'buyer_name' => $name,
    'redirect_url' => $redirect_url,
    'send_email' => true,
    'webhook' => $webhook_url,
    'send_sms' => true,
    'email' => $email,
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 




$data = json_decode($response, true);

if($data['success'] == 1){
   $payment_id = $data['payment_request']['id'];
   echo '<script src="https://js.instamojo.com/v1/checkout.js"></script>
    <script>
        Instamojo.open("https://'.$mode.'.instamojo.com/@ankit_sridhar16/'.$payment_id.'"); 
    </script>
    ';
       
}else{
    echo '<div class="w3-panel w3-red w3-content">
  
  <p>Error encountered !</p>
</div>';
}

}

?>