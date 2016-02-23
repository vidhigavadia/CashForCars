<?php

error_reporting(E_ALL);

include_once 'lead.php';
include_once 'functions_query.php';
		$sfconfig = sfConfigRead();
		
		$formValues = array();
		if(isset($_POST['First_Name']) && $_POST['First_Name'] != '') $formValues['FirstName'] = $_POST['First_Name'];
		if(isset($_POST['Last_Name']) && $_POST['Last_Name'] != '') $formValues['LastName'] = $_POST['Last_Name'];
		if(isset($_POST['Email']) && $_POST['Email'] != '') $formValues['email'] = $_POST['Email'];
		if(isset($_POST['VehPickupDate']) && $_POST['VehPickupDate'] != '') $formValues['Pickup_date__c'] = $_POST['VehPickupDate'];
		if(isset($_POST['time']) && $_POST['time'] != '') $formValues['Pickup_Time__c'] = $_POST['time'];
		
		$address = $_POST['Mailing_Address1'].", ".$_POST['Mailing_Address2'];
		if(isset($address)) $formValues['Street'] = $address;
		if(isset($_POST['City']) && $_POST['City'] != '') $formValues['City'] = $_POST['City'];
		if(isset($_POST['State']) && $_POST['State'] != '') $formValues['state'] = $_POST['State'];
		if(isset($_POST['Zip']) && $_POST['Zip'] != '') $formValues['PostalCode'] = $_POST['Zip'];
		
		if(isset($_POST['caraddress1']) && $_POST['caraddress1'] != '') $formValues['Pickup_Address1__c'] = $_POST['caraddress1'];
		if(isset($_POST['caraddress2']) && $_POST['caraddress2'] != '') $formValues['Pickup_Address2__c'] = $_POST['caraddress2'];
		if(isset($_POST['carcity']) && $_POST['carcity'] != '') $formValues['Pickup_City__c'] = $_POST['carcity'];
		if(isset($_POST['carstate']) && $_POST['carstate'] != '') $formValues['Pickup_Location_State__c'] = $_POST['carstate'];
		if(isset($_POST['carzip']) && $_POST['carzip'] != '') $formValues['Pickup_Postal_Code__c'] = $_POST['carzip'];
		
		if(isset($_POST['besttime']) && $_POST['besttime'] != '') $formValues['BestTimetoCall__c'] = $_POST['besttime'];
		$phone = $_POST['Home_Telephone_Ac'].$_POST['homephonea'].$_POST['homephoneb'];
		if(isset($phone) && $phone != '') $formValues['Phone'] = $phone;
		
		$wphone = $_POST['Work_Telephone_Ac'].$_POST['workphonea'].$_POST['workphoneb'];
		if(isset($wphone) && $wphone != '') $formValues['Work_Phone__c'] = $wphone;
		if(isset($_POST['Work_Telephone_Ext']) && $_POST['Work_Telephone_Ext'] != '') $formValues['Work_Phone_Extension__c'] = $_POST['Work_Telephone_Ext'];
		
		if(isset($_POST['MemberIDNumber']) && $_POST['MemberIDNumber'] != '') $formValues['NPOMemberNumber__c'] = $_POST['MemberIDNumber'];
		if(isset($_POST['Year1']) && $_POST['Year1'] != '') $formValues['year__c'] = $_POST['Year1'];
		if(isset($_POST['Make']) && $_POST['Make'] != '') $formValues['make__c'] = $_POST['Make'];
		if(isset($_POST['Model']) && $_POST['Model'] != '') $formValues['model__c'] = $_POST['Model'];
		if(isset($_POST['Mileage']) && $_POST['Mileage'] != '') $formValues['Veh_Miles__c'] = $_POST['Mileage'];
		
// 		if(checkbox_value("Drivable") == 1) { $formValues['Is_Car_Drivable__c'] = 'Yes'; }
// 		if(checkbox_value("LienRelease") == 0) { $formValues['Lien__c'] = 'Yes'; }
	//	if(checkbox_value("Drivable") == 1) { $formValues['Is_Car_Drivable__c'] = 'Yes'; } else {$formValues['Is_Car_Drivable__c'] = 'No';}
	//	if(checkbox_value("LienRelease") == 0) { $formValues['Lien__c'] = 'Yes'; } else { $formValues['Lien__c'] = 'No'; }
		if(isset($_POST['Comments']) && $_POST['Comments'] != '') $formValues['Web_Lead_Comments__c'] = $_POST['Comments'];
		if (strcmp(strtoupper(trim($_POST['howHear'])), strtoupper(trim('Other'))) != 0) {
			$formValues['How_did_you_hear_about_us__c'] = $_POST['howHear'];
		} else {
			$formValues['How_did_you_hear_about_us__c'] = $_POST['other'];
		}
		
		if(isset($_POST['YearMakeModel']) && $_POST['YearMakeModel'] != '') $formValues['VehicleDescription__c'] = $_POST['YearMakeModel'];
		$formValues['RecordTypeid'] = '012320000009eyu'; 
	//	$formValues['Non_Profit_Organization__c'] = $_POST['NPOQAAccID'];
		$formValues['LeadSource'] = 'Form Widget'; // "Pictorial Widget" for Pictorial form
		$formValues['ownerId'] = '00G320000030A70';
		
		$leadResponse = create_lead($formValues, $sfconfig['instance'], $sfconfig['token']);
		if($leadResponse == 1) { 
		/*	if (strcmp($_GET['i'], '2503') == 0 || strcmp($_GET['i'], '2504') == 0) {
				header("location: nra_thankyou.php?i=".$_GET['i']);
				exit();
			} else { */
				header("location: thankyou.php?i=".$_GET['i']);
				exit();
		//	}
 		} 
	} 

?>
