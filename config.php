<?php
$params = array(
		"grant_type" => "password",
		"client_id" => "3MVG93MGy9V8hF9OvSukhaaKeTLsvrXwKAttYW8AT5vD6ZOe5Y4hjepm1gJLaRxIrkztbKFlflN6gdtuuhftQ",
		"client_secret" => "2174335346123706887",
		"username" =>"vidhi.gavadia@copart.com.full",
		"password" => "Test@123");
$curl = curl_init("https://test.salesforce.com/services/oauth2/token");
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
$json_response = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ( $status != 200 ) {
// 	$sfConnection = 0;
	error_log("Error - oauth_config: Status: $status, Response: $json_response, Curl_error: " . curl_error($curl) . ", Curl_errno: " . curl_errno($curl));
	echo "<script type='text/javascript'>alert('An unexpected error has occurred');window.history.go(-1);</script>";
	
	$response = json_decode($json_response, true);
	$responseError = (($response['error']) ? $response['error'] : "--");
	$responseEDesc = (($response['error_description']) ? $response['error_description'] : "--");
	 
	$mailData = array("Salesforce token fetch failure!", $status, $responseError, $responseEDesc, trim(curl_errno($curl)));
	 
//	$message = FormSubmitFailureTemplate($mailData);
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//	mail(SF_ERROR_MAIL, SF_ERROR_SUBJECT, $message, $headers);	
}
curl_close($curl);
$response = json_decode($json_response, true);
$access_token = $response['access_token'];
$instance_url = $response['instance_url'];
print_r "response:- $response";

?>
