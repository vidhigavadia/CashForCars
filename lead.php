<?php

require_once 'vendor/autoload.php';
include_once 'data_connection.php';
/*$SFData = getSFData();

	$params = array(
		"grant_type" => "password",
		"client_id" => $SFData['client_id'],
		"client_secret" => $SFData['client_secret'],
		"username" =>$SFData['username'],
		"password" => $SFData['password']);
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
insertAccessData($access_token,$instance_url); 
$accessData = getAccessData();

$time = strtotime($accessData['my_time']);
error_log($time);
$curtime = time();

if(($curtime-$time) > 300) {   
  echo "exceed";
}
else{
	echo "valid";
} */

function checkVar($var) {
	if(strcmp(gettype($var), 'string') == 0) {
		if((strlen(trim($var)) > 0 )) {
			return trim($var);
		} else {
		return '';
		}
	}
	
	if(strcmp(gettype($var), 'integer') == 0) {
		if((strlen(string(trim($var))) > 0 )) {
			return trim($var);
		} else {
			return '';
		}
	}
}

function create_lead($formvalues) {
require_once 'vendor/autoload.php';
//include_once 'data_connection.php';
include_once 'mysql_connection.php';
$SFData = getSFData();

	$params = array(
		"grant_type" => "password",
		"client_id" => $SFData['client_id'],
		"client_secret" => $SFData['client_secret'],
		"username" =>$SFData['username'],
		"password" => $SFData['password']);
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
	
	
	
	
	$flag = 1;
	$url = "$instance_url/services/data/v20.0/sobjects/Lead/";
	$content = json_encode($formvalues);
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER,
			array("Authorization: OAuth $access_token",
				"Content-type: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ( $status != 201 ) {
    	$flag = 0;
    	error_log("Error - lead: Status: $status, Response: $json_response, Curl_error: " . curl_error($curl) . ", Curl_errno: " . curl_errno($curl));
    	echo "<script type='text/javascript'>alert('An unexpected error has occurred');window.history.go(-1);</script>";
    	
    	$response = json_decode($json_response, true);
    	$responseMsg = (($response[0]['message']) ? $response[0]['message'] : "--");
    	$responseECode = (($response[0]['errorCode']) ? $response[0]['errorCode'] : "--");
    	
    	$mailData = array("Salesforce Lead creation failure!", $status, $responseMsg, $responseECode, trim(curl_errno($curl)));
    	
    //	$message = FormSubmitFailureTemplate($mailData);
    	$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    //	mail(SF_ERROR_MAIL, SF_ERROR_SUBJECT, $message, $headers);
    }
    curl_close($curl);
    return $flag;
}
?>
