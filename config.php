<?php
session_start();
error_reporting(E_ALL);
include_once 'form_validate.php';

$formErrors = array();
$post_data = $_POST['data_json'];
$form_data = json_decode($post_data,true);
//error_log(print_R($_POST,TRUE) );
error_log($post_data);
	

	if(array_key_exists('first_name',$form_data)){
		if (firstnameValid($form_data['first_name'][0])) $GLOBALS['formErrors'][] = lastnameValid($form_data['first_name'][0]) ;
		
	}
	if(array_key_exists('Last_Name',$form_data)){
		if (lastnameValid($form_data['Last_Name'][0])) $GLOBALS['formErrors'][] = lastnameValid($form_data['Last_Name'][0]) ;
		
	}
	if(array_key_exists('email',$form_data)){
		if (emailValid($form_data['email'][0])) $GLOBALS['formErrors'][] = emailValid($form_data['email'][0]) ;
		
	}
	if(array_key_exists('phone_number',$form_data)){
		if (phoneValid($form_data['phone_number'][0])) $GLOBALS['formErrors'][] = phoneValid($form_data['phone_number'][0]);
		
	}
	if(array_key_exists('address_line_1',$form_data)){
		if (address1Valid($form_data['address_line_1'][0])) $GLOBALS['formErrors'][] = address1Valid($form_data['address_line_1'][0]) ;
		
	}
	if(array_key_exists('address_line_2',$form_data)){
		if (address2Valid($form_data['address_line_2'][0])) $GLOBALS['formErrors'][] = address2Valid($form_data['address_line_2'][0]) ;
		
	}
	if(array_key_exists('city',$form_data)){
		if (cityValid($form_data['city'][0])) $GLOBALS['formErrors'][] = cityValid($form_data['city'][0]) ;
		
	}
	if(array_key_exists('state',$form_data)){
		if (stateValid($form_data['state'][0])) $GLOBALS['formErrors'][] = stateValid($form_data['state'][0]) ;
	}

	if(array_key_exists('zip',$form_data)){
		if (zipValid($form_data['zip'][0])) $GLOBALS['formErrors'][] = zipValid($form_data['zip'][0]) ;
	}	

	if(array_key_exists('year',$form_data)){
		if (yearValid($form_data['year'][0])) $GLOBALS['formErrors'][] = mileageValid($form_data['year'][0]) ;
	}
	
	if(array_key_exists('make',$form_data)){
		if (makeValid($form_data['make'][0])) $GLOBALS['formErrors'][] = mileageValid($form_data['make'][0]) ;
		
	}
	if(array_key_exists('model',$form_data)){
		if (modelValid($form_data['model'][0])) $GLOBALS['formErrors'][] = mileageValid($form_data['model'][0]) ;
	}
	
	if(array_key_exists('mileage',$form_data)){
		if (mileageValid($form_data['mileage'][0])) $GLOBALS['formErrors'][] = mileageValid($form_data['mileage'][0]) ;
		
	}
	if(array_key_exists('comments',$form_data)){
	
		if (commentsValid($form_data['comments'][0])) $GLOBALS['formErrors'][] = commentsValid($form_data['comments'][0]) ;
	}
	if(array_key_exists('other',$form_data)){
		if (otherValid($form_data['other'][0])) $GLOBALS['formErrors'][] = otherValid($form_data['other'][0]) ;
		
	}
	if(array_key_exists('pick_up_date',$form_data)){
		if (pickupDateValid($form_data['pick_up_date'][0])) $GLOBALS['formErrors'][] = pickupDateValid($form_data['pick_up_date'][0]) ;
	}
	
	if(array_key_exists('caraddress1',$form_data)){
		if (caraddress1Valid($form_data['caraddress1'][0])) $GLOBALS['formErrors'][] = caraddress1Valid($form_data['caraddress1'][0]) ;
		
	}
	if(array_key_exists('caraddress2',$form_data)){
	if (caraddress2Valid($form_data['caraddress2'][0])) $GLOBALS['formErrors'][] = caraddress2Valid($form_data['caraddress2'][0]) ;
		
	}
	if(array_key_exists('vehicle_city',$form_data)){
	
		if (carcityValid($form_data['vehicle_city'][0])) $GLOBALS['formErrors'][] = carcityValid($form_data['vehicle_city'][0]) ;
	}
	
	if(array_key_exists('vehicle_zip',$form_data)){
	if (carzipValid($form_data['vehicle_zip'][0])) $GLOBALS['formErrors'][] = carzipValid($form_data['vehicle_zip'][0]) ;
		
	}
	
		

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
		if(array_key_exists('mileage',$form_data)){
			if($form_data['mileage'][0]!='') $formValues['Veh_Miles__c'] = $form_data['mileage'][0];	
		}
		
		
		if(!empty($form_data['is_car_drivable'])){
			if($form_data['is_car_drivable'][0]=='Yes'){
				$formValues['Is_Car_Drivable__c'] ='Yes';
				
			} 
			else{
				$formValues['Is_Car_Drivable__c'] ='No';
				
			}
		}
		
		if(!empty($form_data['is_car_paid_for_entirely'])){
			
			if($form_data['is_car_paid_for_entirely'][0]!='Yes')
			{
				$formValues['Lien__c'] ='Yes';
				
			}
			else{ 
				$formValues['Lien__c'] ='No';
				
			}
		}
		if($form_data['comments'][0]!='') $formValues['Web_Lead_Comments__c'] =$form_data['comments'][0];
	
		
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
	header("HTTP/1.0 500 Internal Server Error");
		error_log(print_r($GLOBALS['formErrors'],TRUE));
		echo "Error";
	exit(0);
		
	}
	
		
//	}

?>
