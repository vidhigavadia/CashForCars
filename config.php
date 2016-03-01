<?php
session_start();
error_reporting(E_ALL);
include_once 'form_validate.php';

$formErrors = array();
$post_data = $_POST['data_json'];
$form_data = json_decode($post_data,true);
error_log( print_R($form_data,TRUE) );
	

//	if($form_data->Last_Name[0]!='') echo "<p>json last</p>";
	if (firstnameValid($form_data['first_name'][0])) $GLOBALS['formErrors'][] = lastnameValid($form_data['first_name'][0]) ;
	if (lastnameValid($form_data['Last_Name'][0])) $GLOBALS['formErrors'][] = lastnameValid($form_data['Last_Name'][0]) ;
	if (emailValid($form_data['email'][0])) $GLOBALS['formErrors'][] = emailValid($form_data['email'][0]) ;
	if (phoneValid($form_data['phone_number'][0])) $GLOBALS['formErrors'][] = phoneValid($form_data['phone_number'][0]);
	if (address1Valid($form_data['address_line_1'][0])) $GLOBALS['formErrors'][] = address1Valid($form_data['address_line_1'][0]) ;
	if (address2Valid($form_data['address_line_2'][0])) $GLOBALS['formErrors'][] = address2Valid($form_data['address_line_2'][0]) ;
	if (cityValid($form_data['city'][0])) $GLOBALS['formErrors'][] = cityValid($form_data['city'][0]) ;
	if (stateValid($form_data['state'][0])) $GLOBALS['formErrors'][] = stateValid($form_data['state'][0]) ;
	if (zipValid($form_data['zip'][0])) $GLOBALS['formErrors'][] = zipValid($form_data['zip'][0]) ;
	if (yearValid($form_data['year'][0])) $GLOBALS['formErrors'][] = mileageValid($form_data['yesr'][0]) ;
	if (makeValid($form_data['make'][0])) $GLOBALS['formErrors'][] = mileageValid($form_data['make'][0]) ;
	if (modelValid($form_data['model'][0])) $GLOBALS['formErrors'][] = mileageValid($form_data['model'][0]) ;
	if (mileageValid($form_data['mileage'][0])) $GLOBALS['formErrors'][] = mileageValid($form_data['mileage'][0]) ;
	if (commentsValid($form_data['comments'][0])) $GLOBALS['formErrors'][] = commentsValid($form_data['comments'][0]) ;
	if (otherValid($form_data['other'][0])) $GLOBALS['formErrors'][] = otherValid($form_data['other'][0]) ;
	if (pickupDateValid($form_data['pick_up_date'][0])) $GLOBALS['formErrors'][] = pickupDateValid($form_data['pick_up_date'][0]) ;
	
	if (caraddress1Valid($form_data['caraddress1'][0])) $GLOBALS['formErrors'][] = caraddress1Valid($form_data['caraddress1'][0]) ;
	if (caraddress2Valid($form_data['caraddress2'][0])) $GLOBALS['formErrors'][] = caraddress2Valid($form_data['caraddress2'][0]) ;
	if (carcityValid($form_data['vehicle_city'][0])) $GLOBALS['formErrors'][] = carcityValid($form_data['vehicle_city'][0]) ;
	if (carzipValid($form_data['vehicle_zip'][0])) $GLOBALS['formErrors'][] = carzipValid($form_data['vehicle_zip'][0]) ;
		

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
	
		if($form_data['caraddress1'][0]!='') $formValues['Pickup_Address1__c'] = $form_data['caraddress1'][0];
		if($form_data['caraddress2'][0]!='') $formValues['Pickup_Address2__c'] = $form_data['caraddress2'][0];
		if($form_data['vehicle_city'][0]!='') $formValues['Pickup_City__c'] = $form_data['vehicle_city'][0];
		if($form_data['vehicle_state'][0]!='') $formValues['Pickup_Location_State__c'] =$form_data['vehicle_state'][0];
		if($form_data['vehicle_zip'][0]!='') $formValues['Pickup_Postal_Code__c'] = $form_data['vehicle_zip'][0];
		
		if($form_data['pick_up_date'][0]!='') $formValues['Pickup_date__c'] = $form_data['pick_up_date'][0];
		if($form_data['select_a_pickuptime'][0]!='') $formValues['Pickup_Time__c'] = $form_data['select_a_pickuptime'][0];
		if($form_data['best_time'][0]!='') $formValues['BestTimetoCall__c'] =$form_data['best_time'][0];
		if($form_data['mileage'][0]!='') $formValues['Veh_Miles__c'] = $form_data['mileage'][0];
		if($form_data['is_car_drivable'][0]=='Yes'){$formValues['Is_Car_Drivable__c'] ='Yes';} else{ $formValues['Is_Car_Drivable__c'] ='No';}
		if($form_data['is_car_paid_for_entirely'][0]!='Yes') {$formValues['Lien__c'] ='Yes';} else{ $formValues['Lien__c'] ='No';}
		if($form_data['comments'][0]!='') $formValues['Web_Lead_Comments__c'] =$form_data['comments'][0];
		if($form_data['mileage'][0]!='') $formValues['How_did_you_hear_about_us__c'] = $form_data['mileage'][0];
		
		if (strcmp(strtoupper(trim($form_data['how_did_you_hear_about_us'][0])), strtoupper(trim('Other'))) != 0) {
			$formValues['How_did_you_hear_about_us__c'] = $form_data['how_did_you_hear_about_us'][0];
		} else {
			$formValues['How_did_you_hear_about_us__c'] = $form_data['other'][0];
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
	else{
		//print the validation error
	
		error_log(print_r($GLOBALS['formErrors'],TRUE));	
		
	}
	
		
//	}

?>
