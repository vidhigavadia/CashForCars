<?php
session_start();
error_reporting(E_ALL);
include_once 'form_validate.php';
$formErrors = array();
$form_data = $_POST;
//$form_data = json_decode($post_data,true);
error_log(print_R($_POST,TRUE) );
//error_log($post_data);
	
//	if($form_data->Last_Name[0]!='') echo "<p>json last</p>";
	if (firstnameValid($form_data['first_name'])) $GLOBALS['formErrors'][] = lastnameValid($form_data['first_name']) ;
	if (lastnameValid($form_data['last_name'])) $GLOBALS['formErrors'][] = lastnameValid($form_data['last_name']) ;
	if (emailValid($form_data['email'])) $GLOBALS['formErrors'][] = emailValid($form_data['email']) ;
	if (phoneValid($form_data['phone_number'])) $GLOBALS['formErrors'][] = phoneValid($form_data['phone_number']);
	if (address1Valid($form_data['address_line_1'])) $GLOBALS['formErrors'][] = address1Valid($form_data['address_line_1']) ;
	if (address2Valid($form_data['address_line_2'])) $GLOBALS['formErrors'][] = address2Valid($form_data['address_line_2']) ;
	if (cityValid($form_data['city'])) $GLOBALS['formErrors'][] = cityValid($form_data['city']) ;
	if (stateValid($form_data['state'])) $GLOBALS['formErrors'][] = stateValid($form_data['state']) ;
	if (zipValid($form_data['zip'])) $GLOBALS['formErrors'][] = zipValid($form_data['zip']) ;
	if (yearValid($form_data['year'])) $GLOBALS['formErrors'][] = mileageValid($form_data['year']) ;
	if (makeValid($form_data['make'])) $GLOBALS['formErrors'][] = mileageValid($form_data['make']) ;
	if (modelValid($form_data['model'])) $GLOBALS['formErrors'][] = mileageValid($form_data['model']) ;
	if (mileageValid($form_data['mileage'])) $GLOBALS['formErrors'][] = mileageValid($form_data['mileage']) ;
	if (commentsValid($form_data['comments'])) $GLOBALS['formErrors'][] = commentsValid($form_data['comments']) ;
	if (otherValid($form_data['if_other_selected_type_in_below'])) $GLOBALS['formErrors'][] = otherValid($form_data['if_other_selected_type_in_below']) ;
	if (pickupDateValid($form_data['pick_up_date'])) $GLOBALS['formErrors'][] = pickupDateValid($form_data['pick_up_date']) ;
	
	if (caraddress1Valid($form_data['caraddress1'])) $GLOBALS['formErrors'][] = caraddress1Valid($form_data['caraddress1']) ;
	if (caraddress2Valid($form_data['caraddress2'])) $GLOBALS['formErrors'][] = caraddress2Valid($form_data['caraddress2']) ;
	if (carcityValid($form_data['vehicle_city'])) $GLOBALS['formErrors'][] = carcityValid($form_data['vehicle_city']) ;
	if (carzipValid($form_data['vehicle_zip'])) $GLOBALS['formErrors'][] = carzipValid($form_data['vehicle_zip']) ;
		
	if(sizeof($GLOBALS['formErrors']) == 0) {
		include_once 'lead.php';
		
		$formValues = array();
		
		
		if($form_data['last_name']!='') $formValues['LastName'] =$form_data['last_name'];
		if($form_data['phone_number']!='') $formValues['Phone'] = $form_data['phone_number'];
		if($form_data['email']!='') $formValues['email'] = $form_data['email'];
		if($form_data['year']!='') $formValues['year__c'] = $form_data['year'];
		if($form_data['make']!='') $formValues['make__c'] =$form_data['make'];
		if($form_data['model']!='') $formValues['model__c'] = $form_data['model'];
		if($form_data['make']!='') $formValues['make__c'] =$form_data['make'];
		if($form_data['first_name']!='') $formValues['FirstName'] = $form_data['first_name'];
		$address = $form_data['address_line_1'].",".$form_data['address_line_2'];
		if($address!='') $formValues['Street'] =$address;
		
		if($form_data['city']!='') $formValues['City'] = $form_data['city'];
		if($form_data['state']!='') $formValues['state'] =$form_data['state'];
		if($form_data['zip']!='') $formValues['PostalCode'] = $form_data['zip'];
	
		if($form_data['caraddress1']!='') $formValues['Pickup_Address1__c'] = $form_data['caraddress1'];
		if($form_data['caraddress2']!='') $formValues['Pickup_Address2__c'] = $form_data['caraddress2'];
		if($form_data['vehicle_city']!='') $formValues['Pickup_City__c'] = $form_data['vehicle_city'];
		if($form_data['vehicle_state']!='') $formValues['Pickup_Location_State__c'] =$form_data['vehicle_state'];
		if($form_data['vehicle_zip']!='') $formValues['Pickup_Postal_Code__c'] = $form_data['vehicle_zip'];
		
		if($form_data['pick_up_date']!='') $formValues['Pickup_date__c'] = $form_data['pick_up_date'];
		if($form_data['select_a_pickuptime']!='') $formValues['Pickup_Time__c'] = $form_data['select_a_pickuptime'];
		if($form_data['best_time']!='') $formValues['BestTimetoCall__c'] =$form_data['best_time'];
		if($form_data['mileage']!='') $formValues['Veh_Miles__c'] = $form_data['mileage'];
		
		if(!empty($form_data['is_car_drivable'])){
			if($form_data['is_car_drivable']=='Yes'){
				$formValues['Is_Car_Drivable__c'] ='Yes';
				
			} 
			else{
				$formValues['Is_Car_Drivable__c'] ='No';
				
			}
		}
		
		if(!empty($form_data['is_car_paid_for_entirely'])){
			
			if($form_data['is_car_paid_for_entirely']!='Yes')
			{
				$formValues['Lien__c'] ='Yes';
				
			}
			else{ 
				$formValues['Lien__c'] ='No';
				
			}
		}
		if($form_data['comments']!='') $formValues['Web_Lead_Comments__c'] =$form_data['comments'];
		if($form_data['mileage']!='') $formValues['How_did_you_hear_about_us__c'] = $form_data['mileage'];
		
		if (strcmp(strtoupper(trim($form_data['how_did_you_hear_about_us'])), strtoupper(trim('Other'))) != 0) {
			$formValues['How_did_you_hear_about_us__c'] = $form_data['how_did_you_hear_about_us'];
		} else {
			$formValues['How_did_you_hear_about_us__c'] = $form_data['if_other_selected_type_in_below'];
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
	header("HTTP/1.0 500 Internal Server Error");
		error_log(print_r($GLOBALS['formErrors'],TRUE));
		echo "Error";
	exit(0);
		
	}
	
		
//	}
?>
