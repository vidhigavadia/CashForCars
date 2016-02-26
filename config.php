<?php
session_start();
error_reporting(E_ALL);
include_once 'form_validate.php';

$formErrors = array();
$post_data = $_POST['data_json'];
$form_data = json_decode($post_data,true);
error_log( print_R($form_data,TRUE) );
error_log($form_data['Last_Name'][0]);
	

//	if($form_data->Last_Name[0]!='') echo "<p>json last</p>";
		

		include_once 'lead.php';
		
		$formValues = array();

		
		
		if($form_data['Last_Name'][0]!='') $formValues['LastName'] =$form_data['Last_Name'][0];
		if($form_data['phone_number'][0]!='') $formValues['Phone'] = $form_data['phone_number'][0];
		if($form_data['email'][0]!='') $formValues['email'] = $form_data['email'][0];
		if($form_data['year'][0]!='') $formValues['year__c'] = $form_data['year'][0];
		if($form_data['make'][0]!='') $formValues['make__c'] =$form_data['make'][0];
		if($form_data['model'][0]!='') $formValues['model__c'] = $form_data['model'][0];
		$formValues['RecordTypeid'] = '012320000009eyu'; 
		$formValues['LeadSource'] = 'Form Widget'; // "Pictorial Widget" for Pictorial form
		$formValues['ownerId'] = '00G320000030A70';
		$leadResponse = create_lead($formValues);
		if($leadResponse == 1) { 
		
				header("location: thankyou.php");
				echo "<p>Ok</p>";
			
 		} 
		
//	}

?>
