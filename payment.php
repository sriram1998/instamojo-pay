<?php

$ch = curl_init();
echo "<script>console.log( 'Debug Objects:' );</script>";
curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_f5e6d0b5150a07b85bfe5a2323d",
                  "X-Auth-Token:test_fba0d421d3605f1dfb7fc747477"));
$payload = Array(
    'purpose' => 'FIFA 16',
    'amount' =>'2500',
    'phone' =>'9999999999',
    'buyer_name' =>'John Doe',
    'redirect_url' => 'http://localhost/payment/payment_success.php',
    'send_email' => true,
    'webhook' => '',
    'send_sms' => true,
    'email' =>'foo@example.com',
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 

$json_decode=json_decode($response , true);
$long_url= $json_decode['payment_request']['longurl'];
header('Location:'.$long_url);
echo $long_url;

?>