<?php

// Paymentlink integration in core PHP

// Payment link will work  onnly with live keys

// Merchant need to capture below array data  from customer using frontend

$data = array(                                 
			  "upi_link"   => 'true',
			  "amount"     => 100, 
			  "currency"   => "INR",
			  "reference_id"=>"12534",
			  "description"=>"Payment for policy no #23456", 
		      "customer"   => array(
								  "name"    => "Gaurav Kumar",
								  "contact" => "9999999999",
								  "email"   => "gaurav.kumar@razorpay.com"
						       ),
		      "notify" => array(
		      	                'sms' => "true"
		      	                ),
              "reminder_enable"=> "true",
              "notes"=>array (
	              				 "policy_name"    =>"Jeevan Bima",
	              				 "kespl_order_id" => "K111",
					             "usercity"       => "pune",
					             "userpincode"    => "411037",
					             "devicetype"     => "devtest" 
				              )
 
  	         ); 

$data_string = json_encode($data);
$api_key = "rzp_live_*****";          //  api keys
$password = "aW3Tkqew***lLmmWyi4K";  //  secret keys

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "https://api.razorpay.com/v1/payment_links");
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $api_key.':'.$password);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Accept: application/json', 'Content-Type: application/json')

);
$result = curl_exec($ch); 
$returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE); 
curl_close($ch);

$response = json_decode($result, true);
print_r($response);

?>
        
  