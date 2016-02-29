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
	if (firstnameValid($form_data['first_name'][0])) $GLOBALS['formErrors'][] = lastnameValid($form_data['first_name'][0]) ;
	if (lastnameValid($form_data['Last_Name'][0])) $GLOBALS['formErrors'][] = lastnameValid($form_data['Last_Name'][0]) ;
	if (emailValid($form_data['email'][0])) $GLOBALS['formErrors'][] = emailValid($form_data['email'][0]) ;
	if (phoneValid($form_data['phone_number'][0])) $GLOBALS['formErrors'][] = phoneValid($form_data['phone_number'][0]);
	if (address1Valid($form_data['address_line_1'])) $GLOBALS['formErrors'][] = address1Valid($form_data['address_line_1']) ;
	if (address2Valid($form_data['address_line_2'])) $GLOBALS['formErrors'][] = address2Valid($form_data['address_line_2']) ;
	if (cityValid($form_data['city'])) $GLOBALS['formErrors'][] = cityValid($form_data['city']) ;
	if (stateValid($form_data['state'])) $GLOBALS['formErrors'][] = stateValid($form_data['state']) ;
	if (zipValid($form_data['zip'])) $GLOBALS['formErrors'][] = zipValid($form_data['zip']) ;
	if (mileageValid($form_data['mileage'])) $GLOBALS['formErrors'][] = mileageValid($form_data['mileage']) ;
	if (commentsValid($form_data['comments'])) $GLOBALS['formErrors'][] = commentsValid($form_data['comments']) ;
	if (otherValid($form_data['other'])) $GLOBALS['formErrors'][] = otherValid($form_data['other']) ;

	if(sizeof($GLOBALS['formErrors']) == 0) {

		include_once 'lead.php';
		
		$formValues = array();

		
		
		if($form_data['Last_Name'][0]!='') $formValues['LastName'] =$form_data['Last_Name'][0];
		if($form_data['phone_number'][0]!='') $formValues['Phone'] = $form_data['phone_number'][0];
		if($form_data['email'][0]!='') $formValues['email'] = $form_data['email'][0];
		if($form_data['year'][0]!='') $formValues['year__c'] = $form_data['year'][0];
		if($form_data['make'][0]!='') $formValues['make__c'] =$form_data['make'][0];
		if($form_data['model'][0]!='') $formValues['model__c'] = $form_data['model'][0];
		if($form_data['make'][0]!='') $formValues['make__c'] =$form_data['make'][0];
		if($form_data['first_name'][0]!='') $formValues['FirstName'] = $form_data['first_name'][0];
		$address = $form_data['address_line_1'][0].",".$form_data['address_line_2'][0];
		if($address!='') $formValues['Street'] =$address;
		
		if($form_data['city'][0]!='') $formValues['City'] = $form_data['city'][0];
		if($form_data['state'][0]!='') $formValues['state'] =$form_data['state'][0];
		if($form_data['zip'][0]!='') $formValues['PostalCode'] = $form_data['zip'][0];
		if($form_data['select_a_pickuptime'][0]!='') $formValues['Pickup_Time__c'] = $form_data['select_a_pickuptime'][0];
		if($form_data['best_time'][0]!='') $formValues['BestTimetoCall__c'] =$form_data['best_time'][0];
		if($form_data['mileage'][0]!='') $formValues['Veh_Miles__c'] = $form_data['mileage'][0];
		if($form_data['is_car_drivable'][0]==1) $formValues['Is_Car_Drivable__c'] =$form_data['is_car_drivable'][0];
		if($form_data['is_car_paid_for_entirely'][0]!=1) $formValues['Lien__c'] = $form_data['is_car_paid_for_entirely'][0];
		if($form_data['comments'][0]!='') $formValues['Web_Lead_Comments__c'] =$form_data['comments'][0];
		if($form_data['mileage'][0]!='') $formValues['How_did_you_hear_about_us__c'] = $form_data['mileage'][0];
		
		if (strcmp(strtoupper(trim($form_data['how_did_you_hear_about_us'][0])), strtoupper(trim('Other'))) != 0) {
			$formValues['How_did_you_hear_about_us__c'] = $form_data['how_did_you_hear_about_us'][0];
		} else {
			$formValues['How_did_you_hear_about_us__c'] = $form_data['other'];
		}
		$formValues['RecordTypeid'] = '012320000009eyu'; 
		$formValues['LeadSource'] = 'Form Widget'; // "Pictorial Widget" for Pictorial form
		$formValues['ownerId'] = '00G320000030A70';
		$leadResponse = create_lead($formValues);
		if($leadResponse == 1) { 
		
				header("location: thankyou.php");
				echo "<p>Ok</p>";
			
 		} 
	
	
	}
	
		
//	}

?>
