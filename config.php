<?php
session_start();
error_reporting(E_ALL);
include_once 'form_validate.php';
/*$params = array(
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
//print_r ($response); */


//getting values

$formErrors = array();
$post_data = $_POST['data_json'];
$form_data = json_decode($post_data,true);
//error_log("response:". $post_data['data_json']);
		//if (firstnameValid($_POST['First_Name'])) $GLOBALS['formErrors'][] = firstnameValid($_POST['First_Name']);
	//	if (lastnameValid($_POST['Last_Name'])) $GLOBALS['formErrors'][] = lastnameValid($_POST['Last_Name']) ;
	if(isset($_POST['First_Name'])) echo "<p>present</p>";
	if(isset($_POST['Last_Name'])) echo "<p>present2</p>";
	if($form_data['last_name']!='') echo "<p>json last</p>";
		
//	if(sizeof($GLOBALS['formErrors']) == 0) {
		include_once 'lead.php';
		
		$formValues = array();
	//	if(isset($_POST['First_Name']) && $_POST['First_Name'] != '') $formValues['FirstName'] = $_POST['First_Name'];
	//	if(isset($_POST['Last_Name']) && $_POST['Last_Name'] != '') $formValues['LastName'] = $_POST['Last_Name'];
		
		
		if($form_data['last_name']!='') $formValues['LastName'] = $form_data['last_name'];
	//	if(isset($_POST['Last_Name']) && $_POST['Last_Name'] != '') $formValues['LastName'] = $_POST['Last_Name'];
		
		$formValues['RecordTypeid'] = '012320000009eyu'; 
		$formValues['LeadSource'] = 'Form Widget'; // "Pictorial Widget" for Pictorial form
		$formValues['ownerId'] = '00G320000030A70';
		$leadResponse = create_lead($formValues);
		if($leadResponse == 1) { 
		/*	if (strcmp($_GET['i'], '2503') == 0 || strcmp($_GET['i'], '2504') == 0) {
				header("location: nra_thankyou.php?i=".$_GET['i']);
				exit();
			} else { */
				header("location: thankyou.php");
				echo "<p>Ok</p>";
				//exit();
		//	}
 		} 
		
//	}

?>
