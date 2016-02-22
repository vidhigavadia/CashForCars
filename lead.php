<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"].'/common_config.php';
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
function create_lead($formvalues, $instance_url, $access_token) {
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
    	
    	$message = FormSubmitFailureTemplate($mailData);
    	$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    	mail(SF_ERROR_MAIL, SF_ERROR_SUBJECT, $message, $headers);
    }
    curl_close($curl);
    return $flag;
}
?>
