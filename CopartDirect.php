<?php
session_start();
error_reporting(E_ALL);
//include_once 'connection.php';
include_once 'form_validate.php';
?>
<!doctype html>
<html lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<META Name="keywords" Content="donate a car, donate car, donate car to charity, donating car, car donation, car donations, car donation charity, vehicle donations, auto donations">
	<meta name="description" content="The Cash for cars� Vehicle Donation Program makes it easy to donate to your favorite cause. Check out our full directory of Non-profit partner organizations. " >

<!-- <meta http-equiv='cache-control' content='no-cache'> -->
<!-- <meta http-equiv='expires' content='0'> -->
<!-- <meta http-equiv='pragma' content='no-cache'> -->
<title>Cash For Cars</title>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/base/jquery-ui.css" />
<link rel="stylesheet" href="/css/formStyle.css" />

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.js"></script>
<script type="text/javascript" src="/js/jquery_autotab_1.js"></script>
<script type="text/javascript" >$(document).ready(function(){ $('.phac, .pha, .phb').autotab_magic(); });</script>
<script type="text/javascript" src="/js/slidingformwidget.js"></script>
<script type="text/javascript" src="/js/common2.js" ></script>
<script src='https://www.google.com/recaptcha/api.js'></script>

<script type="text/javascript">
	var formName = "<?php echo "index.php"; ?>";
	window.onload = hideSubmit;
</script>

<style type="text/css">
table , td, th, tr {
/*         	border: 1px solid black;      */
}
</style>

</head>

<body>
<?php include_once("formwidget_ga.php"); ?>

<div id="donate" class="left">

<?php 
$state_list = array('AL'=>"Alabama",
		'AK'=>"Alaska",
		'AZ'=>"Arizona",
		'AR'=>"Arkansas",
		'CA'=>"California",
		'CO'=>"Colorado",
		'CT'=>"Connecticut",
		'DE'=>"Delaware",
		'DC'=>"District Of Columbia",
		'FL'=>"Florida",
		'GA'=>"Georgia",
		'HI'=>"Hawaii",
		'ID'=>"Idaho",
		'IL'=>"Illinois",
		'IN'=>"Indiana",
		'IA'=>"Iowa",
		'KS'=>"Kansas",
		'KY'=>"Kentucky",
		'LA'=>"Louisiana",
		'ME'=>"Maine",
		'MD'=>"Maryland",
		'MA'=>"Massachusetts",
		'MI'=>"Michigan",
		'MN'=>"Minnesota",
		'MS'=>"Mississippi",
		'MO'=>"Missouri",
		'MT'=>"Montana",
		'NE'=>"Nebraska",
		'NV'=>"Nevada",
		'NH'=>"New Hampshire",
		'NJ'=>"New Jersey",
		'NM'=>"New Mexico",
		'NY'=>"New York",
		'NC'=>"North Carolina",
		'ND'=>"North Dakota",
		'OH'=>"Ohio",
		'OK'=>"Oklahoma",
		'OR'=>"Oregon",
		'PA'=>"Pennsylvania",
		'RI'=>"Rhode Island",
		'SC'=>"South Carolina",
		'SD'=>"South Dakota",
		'TN'=>"Tennessee",
		'TX'=>"Texas",
		'UT'=>"Utah",
		'VT'=>"Vermont",
		'VA'=>"Virginia",
		'WA'=>"Washington",
		'WV'=>"West Virginia",
		'WI'=>"Wisconsin",
		'WY'=>"Wyoming");	

		$formErrors = array();
		if (firstnameValid($_POST['First_Name'])) $GLOBALS['formErrors'][] = firstnameValid($_POST['First_Name']);
		if (lastnameValid($_POST['Last_Name'])) $GLOBALS['formErrors'][] = lastnameValid($_POST['Last_Name']) ;
		if (emailValid($_POST['Email'])) $GLOBALS['formErrors'][] = emailValid($_POST['Email']) ;
	
		
		if (address1Valid($_POST['Mailing_Address1'])) $GLOBALS['formErrors'][] = address1Valid($_POST['Mailing_Address1']) ;
		if (address2Valid($_POST['Mailing_Address2'])) $GLOBALS['formErrors'][] = address2Valid($_POST['Mailing_Address2']) ;
		if (cityValid($_POST['City'])) $GLOBALS['formErrors'][] = cityValid($_POST['City']) ;
		if (stateValid($_POST['State'])) $GLOBALS['formErrors'][] = stateValid($_POST['State']) ;
		if (zipValid($_POST['Zip'])) $GLOBALS['formErrors'][] = zipValid($_POST['Zip']) ;
		
		if (caraddress1Valid($_POST['caraddress1'])) $GLOBALS['formErrors'][] = caraddress1Valid($_POST['caraddress1']) ;
		if (caraddress2Valid($_POST['caraddress2'])) $GLOBALS['formErrors'][] = caraddress2Valid($_POST['caraddress2']) ;
		if (carcityValid($_POST['carcity'])) $GLOBALS['formErrors'][] = carcityValid($_POST['carcity']) ;
		if (carzipValid($_POST['carzip'])) $GLOBALS['formErrors'][] = carzipValid($_POST['carzip']) ;
		
		$homePhone = $_POST['Home_Telephone_Ac'].$_POST['homephonea'].$_POST['homephoneb'];
		if (phoneValid($homePhone)) $GLOBALS['formErrors'][] = phoneValid($homePhone);
		
		$workPhone = $_POST['Work_Telephone_Ac'].$_POST['workphonea'].$_POST['workphoneb'];
		if (workPhoneValid($workPhone)) $GLOBALS['formErrors'][] = workPhoneValid($workPhone);
		if (workphoneextValid($_POST['Work_Telephone_Ext'])) $GLOBALS['formErrors'][] = workphoneextValid($_POST['Work_Telephone_Ext']) ;
		
		if (memberIDValid($_POST['MemberIDNumber'])) $GLOBALS['formErrors'][] = memberIDValid($_POST['MemberIDNumber']) ;
		if (yearmakemodelValid($_POST['YearMakeModel'])) $GLOBALS['formErrors'][] = yearmakemodelValid($_POST['YearMakeModel']) ;
		if (mileageValid($_POST['Mileage'])) $GLOBALS['formErrors'][] = mileageValid($_POST['Mileage']) ;
		if (commentsValid($_POST['Comments'])) $GLOBALS['formErrors'][] = commentsValid($_POST['Comments']) ;
		if (otherValid($_POST['other'])) $GLOBALS['formErrors'][] = otherValid($_POST['other']) ;
		
		if (captchaValid($_POST['txtCaptcha'])) $GLOBALS['formErrors'][] = captchaValid($_POST['txtCaptcha']) ;
	
	if(sizeof($GLOBALS['formErrors']) == 0) {
		include_once 'lead.php';
		
		$formValues = array();
		if(isset($_POST['First_Name']) && $_POST['First_Name'] != '') $formValues['FirstName'] = $_POST['First_Name'];
		if(isset($_POST['Last_Name']) && $_POST['Last_Name'] != '') $formValues['LastName'] = $_POST['Last_Name'];
		if(isset($_POST['Email']) && $_POST['Email'] != '') $formValues['email'] = $_POST['Email'];
		
		
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
		if(isset($_POST["Drivable"])) { $formValues['Is_Car_Drivable__c'] = 'Yes'; } else {$formValues['Is_Car_Drivable__c'] = 'No';}
		if(!isset($_POST["LienRelease"])) { $formValues['Lien__c'] = 'Yes'; } else { $formValues['Lien__c'] = 'No'; }
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
		
		$leadResponse = create_lead($formValues);
		if($leadResponse == 1) { 
		/*	if (strcmp($_GET['i'], '2503') == 0 || strcmp($_GET['i'], '2504') == 0) {
				header("location: nra_thankyou.php?i=".$_GET['i']);
				exit();
			} else { */
				header("location: thankyou.php");
				exit();
		//	}
 		} 
	} else {  ?>

	
	<form style="width: 550px;" id="formElem" name="formElem" method="post">
	
	<?php 
	//	$id = (empty($_GET['i'])) ? '' : $_GET['i']; 
		//extract(orgDetails($id));
	?>

<!-- <noscript> 
<table style="width:550px; margin: 0;" class="acenter"><tr><td colspan="3">For full functionality of this site it is necessary to enable JavaScript.-->
<!--  Here are the <a href="http://www.enable-javascript.com/" target="_blank"> -->
<!--  instructions how to enable JavaScript in your web browser</a>. -->
<!-- </td></tr></table> -->
<!-- </noscript>	 -->
	
<p>


	<input id="NewOrg" name="NewOrg" type='hidden'   value=''/>
</p>



<tr class="blank_row"><td colspan="3"></td></tr>



<!-- <div class="fullform"> -->
<?php 
/*	if (strcmp($_GET['i'], '2503') == 0 || strcmp($_GET['i'], '2504') == 0) {
		echo "<label id=\"label1\" class=\"nraformlabel\">Schedule A Pick-up</label>";
	} else { */
		echo "<label id=\"label1\" class=\"formlabel\">SCHEDULE A PICK-UP</label>";
//	}
?>
<?php echo "<br><br>"; ?>
<div class="reducedOpacity">
  <table style="width:550px; margin: 0;">
		
		<tr><td class="aleftBold" rowspan="9">Contact</td></tr>
		<tr>
			<td><input style="border: 1px solid #C40A20 !important;" id="First_Name" name="First_Name" maxlength="30" autofocus="autofocus" value="<?php if(isset($_POST['First_Name'])) echo $_POST['First_Name']; ?>"/></td>
			<td><input style="border: 1px solid #C40A20 !important;" id="Last_Name" name="Last_Name" maxlength="30" value="<?php if(isset($_POST['Last_Name'])) echo $_POST['Last_Name']; ?>"/></td> 
		</tr>
		<tr>
			<td class="statictext">First Name*</td>
			<td class="statictext">Last Name*</td>
		</tr>
		<tr><td class="acenter" colspan="2"><label id="fnamefail" style="display: none;"></label></td></tr>
		<tr><td class="acenter" colspan="2"><label id="lnamefail" style="display: none;"></label></td></tr>
		
		<tr><td colspan="2"><input id="Email" name="Email" maxlength="255" value="<?php if(isset($_POST['Email'])) echo $_POST['Email']; ?>"/></td></tr>
		<tr><td colspan="2" class="statictext">Email</td></tr>
		<tr><td class="acenter" colspan="2"><label id="emailfail" style="display: none;"></label></td></tr>
		
</table>    
<!-- </fieldset> -->
</div>

<?php echo "<br><br>"; ?>

<!--  <div id="loadingCircle" style="display: none;"></div>-->

<!-- <label id="label2" class="formlabel">ADDITIONAL INFORMATION</label> -->
<?php 
 /*	if (strcmp($_GET['i'], '2503') == 0 || strcmp($_GET['i'], '2504') == 0) {
		echo "<label id=\"label2\" class=\"nraformlabel\">Additional Information</label>";
	} else { */
		echo "<label id=\"label2\" class=\"formlabel\">ADDITIONAL INFORMATION</label>";
//	}
?>
<?php echo "<br><br>"; ?>

<table style="width:550px; margin: 0;">

  <tr><td class="aleftBold" rowspan="10">Home Address</td></tr>
  <tr>
    <td><input style="border: 1px solid #C40A20 !important;" id="Mailing_Address1" name="Mailing_Address1" maxlength="255" value="<?php if(isset($_POST['Mailing_Address1'])) echo $_POST['Mailing_Address1']; ?>"/></td> 
    <td><input id="Mailing_Address2" name="Mailing_Address2" maxlength="255" value="<?php if(isset($_POST['Mailing_Address2'])) echo $_POST['Mailing_Address2']; ?>"/></td> 
  </tr>
  <tr>
		<td class="statictext">Address Line 1*</td>
		<td class="statictext">Address Line 2</td>
	</tr>
  <tr><td class="acenter" colspan="2"><label id="adr1fail" style="display: none;"></label></td></tr>
  <tr><td class="acenter" colspan="2"><label id="adr2fail" style="display: none;"></label></td></tr>
  
  <tr><td colspan="2">
	  <table>
		  <tr>
		    <td><input style="border: 1px solid #C40A20 !important;" id="City" name="City" maxlength="40" value="<?php if(isset($_POST['City'])) echo $_POST['City']; ?>"/></td>
		    <td><select style="border: 1px solid #C40A20 !important;" id="State" name="State">
		                        		<option value=""></option>
		                            	<?php foreach ($state_list as $key => $value) {
		                     
		                            			echo '<option value="'.$key.'" '.'>'.$key.' - '.$value.'</option>';
		                            	}
		                            		?>
		                            </select></td> 
		        <td><input style="border: 1px solid #C40A20 !important;" id="Zip" name="Zip" maxlength="5" value="<?php if(isset($_POST['Zip'])) echo $_POST['Zip']; ?>"/></td> 
			</tr>
			<tr>
			  	<td class="statictext">City*</td>
				<td class="statictext">State*</td>
				<td class="statictext">Zip*</td>
			</tr>
		</table>
	</td></tr>
	
	<tr><td class="acenter" colspan="2"><label id="cityfail" style="display: none;"></label></td></tr>
  	<tr><td class="acenter" colspan="2"><label id="statefail" style="display: none;"></label></td></tr>
  	<tr><td class="acenter" colspan="2"><label id="zipfail" style="display: none;"></label></td></tr>

	<tr class="blank_row"><td colspan="3"></td></tr>

  <tr><td class="aleftBold" rowspan="10">Vehicle Location (if not at home)</td></tr>
  <tr>
    <td><input id="caraddress1" name="caraddress1" maxlength="255" value="<?php if(isset($_POST['caraddress1'])) echo $_POST['caraddress1']; ?>"/></td> 
    <td><input id="caraddress2" name="caraddress2" maxlength="255" value="<?php if(isset($_POST['caraddress2'])) echo $_POST['caraddress2']; ?>"/></td> 
  </tr>
  <tr>
		<td class="statictext">Address Line 1</td>
		<td class="statictext">Address Line 2</td>
	</tr>
  <tr><td class="acenter" colspan="2"><label id="caradr1fail" style="display: none;"></label></td></tr>
  <tr><td class="acenter" colspan="2"><label id="caradr2fail" style="display: none;"></label></td></tr>
  
  <tr><td colspan="2">
  <table>
	  <tr>
	    <td><input id="carcity" name="carcity" maxlength="40" value="<?php if(isset($_POST['carcity'])) echo $_POST['carcity']; ?>"/></td>
	    <td><select id="carstate" name="carstate">
	                        		<option value=""></option>
	                            	<?php foreach ($state_list as $key => $value) {
	                            //	echo '<option value="'.$key.'" '.(($_POST['State'] == ($key.' - '.$value))?'selected="selected"':"").'>'.$key.' - '.$value.'</option>';
	                            	echo '<option value="'.$key.'" '.'>'.$key.' - '.$value.'</option>';
	                            	}
	                            		?>
	                            </select></td> 
	        <td><input id="carzip" name="carzip" maxlength="5" value="<?php if(isset($_POST['carzip'])) echo $_POST['carzip']; ?>"/></td> 
		</tr>
		<tr>
		  	<td class="statictext">City</td>
			<td class="statictext">State</td>
			<td class="statictext">Zip</td>
		</tr>
	</table></td>
	</tr>
	<tr><td class="acenter" colspan="2"><label id="carcityfail" style="display: none;"></label></td></tr>
  	<tr><td class="acenter" colspan="2"><label id="carstatefail" style="display: none;"></label></td></tr>
  	<tr><td class="acenter" colspan="2"><label id="carzipfail" style="display: none;"></label></td></tr>
   
	
	<tr class="blank_row"><td colspan="3"></td></tr>
	<tr>
		<td class="aleftBold" rowspan="3">Home/Cell Phone*</td>
		<td colspan="2"><table><tr>
			<td><label>(</label></td>
			<td><input style="border: 1px solid #C40A20 !important;" id="Home_Telephone_Ac" name="Home_Telephone_Ac" maxlength="3"  value="<?php if(isset($_POST['Home_Telephone_Ac'])) echo $_POST['Home_Telephone_Ac']; ?>"></td>
			<td><label>)</label></td>
	    	<td><input style="border: 1px solid #C40A20 !important;" id="homephonea" name="homephonea" maxlength="3" value="<?php if(isset($_POST['homephonea'])) echo $_POST['homephonea']; ?>"></td>
	    	<td><label>-</label></td>
	    	<td><input style="border: 1px solid #C40A20 !important;" id="homephoneb" name="homephoneb" maxlength="4" value="<?php if(isset($_POST['homephoneb'])) echo $_POST['homephoneb']; ?>"></td>
	    	<td><select id="besttime" name="besttime" >
	                        	<option value="Morning" <?php if(isset($_POST['besttime']) && $_POST['besttime'] == 'Morning') { echo ' selected="selected"';} ?> >Morning</option>
	                        	<option value="Afternoon" <?php if(isset($_POST['besttime']) && $_POST['besttime'] == 'Afternoon') { echo ' selected="selected"';} ?> >Afternoon</option>
	                       		<option value="Evening" <?php if(isset($_POST['besttime']) && $_POST['besttime'] == 'Evening') { echo ' selected="selected"';} ?> >Evening</option>
                        	</select></td> 
	    	</tr>
	    	<tr>
	    		<td></td>
			  	<td class="statictext">xxx*</td>
			  	<td></td>
				<td class="statictext">xxx*</td>
				<td></td>
				<td class="statictext">xxxx*</td>
				<td class="statictext">&nbsp;Best Time</td>
			</tr>
	    	</table>
	    </td>
	</tr>

	<tr><td class="acenter" colspan="2"><label id="phonefail" style="display: none;"></label></td></tr>
	<!--  <tr><td class="acenter" colspan="2"><label id="phonefaila" style="display: none;"></label></td></tr>
	<tr><td class="acenter" colspan="2"><label id="phonefailb" style="display: none;"></label></td></tr>-->
	
	
	<tr class="blank_row"><td colspan="3"></td></tr>
	<tr>
		<td class="aleftBold" rowspan="3">Work Phone</td>
		<td colspan="2"><table><tr>
			<td><label>(</label></td>
			<td><input id="Work_Telephone_Ac" name="Work_Telephone_Ac" maxlength="3" value="<?php if(isset($_POST['Work_Telephone_Ac'])) echo $_POST['Work_Telephone_Ac']; ?>"></td>
			<td><label>)</label></td>
	    	<td><input id="workphonea" name="workphonea" maxlength="3" value="<?php if(isset($_POST['workphonea'])) echo $_POST['workphonea']; ?>"></td>
	    	<td><label>-</label></td>
	    	<td><input id="workphoneb" name="workphoneb" maxlength="4" value="<?php if(isset($_POST['workphoneb'])) echo $_POST['workphoneb']; ?>"></td>
	    	<td><label class="customText" >x</label></td>
	    	<td><input id="Work_Telephone_Ext" name="Work_Telephone_Ext" maxlength="10" value="<?php if(isset($_POST['Work_Telephone_Ext'])) echo $_POST['Work_Telephone_Ext']; ?>"/></td>
	    	</tr>
	    	<tr>
			  	<td></td>
			  	<td class="statictext">xxx</td>
			  	<td></td>
				<td class="statictext">xxx</td>
				<td></td>
				<td class="statictext">xxxx</td>
				<td></td>
				<td class="statictext">Ext.</td>
			</tr>
	</table>
	    </td>
	</tr>
	
	<tr><td class="acenter" colspan="2"><label id="workphonefail" style="display: none;"></label></td></tr>
	  
</table>	  


<?php echo "<br><br>"; ?>

<!-- <label id="label1" class="formlabel">DONATION DETAILS</label> -->
<?php 
/*	if (strcmp($_GET['i'], '2503') == 0 || strcmp($_GET['i'], '2504') == 0) {
		echo "<label id=\"label1\" class=\"nraformlabel\">Donation Details</label>";
	} else { */
		echo "<label id=\"label1\" class=\"formlabel\">DONATION DETAILS</label>";
//	}
?>

<?php echo "<br><br>"; ?>
<table style="width:550px; margin: 0;">
	<tr>
		<td class="aleftBold" rowspan="7">Vehicle</td>
		
		<td colspan="2"><input id="VehicleType" name="VehicleType"/></td>
	</tr>
		<tr><td class="statictext">Vehicle Type</td></tr>
		<tr><td class="acenter" colspan="2"><label id="mileagefail" style="display: none;"></label></td></tr>
		<tr>
		<td colspan="2">
			<table>
				<tr>
					<td><select id="Year1" name="Year1" >
                        		<option value=""></option>
                            	<?php for($i=date('Y', strtotime('+1 years')); $i>= 1900 ; $i--) {
//                             	echo "<option value=\"$i\">$i</option>";
                            //	echo '<option value="'.$i.'" '.(($_POST['Year1'] == $i)?'selected="selected"':"").'>'.$i.'</option>';
                            echo '<option value="'.$i.'" '.'>'.$i.'</option>';
                         
                            	}
                            	
                            	
                            		?>
                            </select></td> 
					<td><select name="Make" id="Make">
					<option>ABACO</option>
					<option>ACADMEY YATCHS/CANYON</option>
					<optionC-DORY</option>
					<option>BRISTOL</option>
					<option>BLUE STAR</option>
					<option>BIG MAC</option>
					<option>VOLVO</option>
					</select></td>
					<td><select name="Model" id="Model" style="width: 100%;"></select></td> 		
					</tr>
					<tr>
						  	<td class="statictext">Year</td>
							<td class="statictext">Make</td>
							<td class="statictext">Model</td>
					</tr>
			</table>	
		</td>
	</tr>
	
	<tr><td colspan="2" class="acenter"><label class="customText" >If not listed, type in the vehicle details below:</label></td></tr>
	
	<tr><td class="acenter" colspan="2"><input id="YearMakeModel" name="YearMakeModel" maxlength="255" value="<?php if(isset($_POST['YearMakeModel'])) echo $_POST['YearMakeModel']; ?>"/></td> </tr>
	<tr><td class="acenter" colspan="2"><label id="yearmakemodelfail" style="display: none;"></label></td></tr> 
       
	<tr><td><input id="Mileage" name="Mileage" maxlength="7" value="<?php if(isset($_POST['Mileage'])) echo $_POST['Mileage']; ?>"/></td></tr>
	<tr><td class="statictext">Mileage</td></tr>
	<tr><td class="acenter" colspan="2"><label id="mileagefail" style="display: none;"></label></td></tr>
	
	<tr><td class="aleftBold">Is the car drivable?</td><td><input style="text-align: left;vertical-align: middle;" type="checkbox" id="Drivable" name="Drivable" <?php if(isset($_POST['Drivable'])) echo "checked"; ?>/></td></tr>
	<tr><td class="aleftBold">Is the car paid for entirely?</td><td><input style="text-align: left;vertical-align: middle;" type="checkbox" id="LienRelease" name="LienRelease" <?php if(isset($_POST['LienRelease'])) echo "checked"; ?>/></td></tr>
	
	<tr class="blank_row"><td colspan="3"></td></tr>
	<tr><td class="aleftBold" rowspan="3">Comments</td></tr>
	<tr><td colspan="2"><textarea id="Comments" name="Comments"  maxlength="255" cols="30" rows="3" style="resize: none;" value="<?php if(isset($_POST['Comments'])) echo $_POST['Comments']; ?>"></textarea></td></tr>
	<tr><td class="acenter" colspan="2"><label id="commentsfail" style="display: none;"></label></td></tr>
	
	<tr class="blank_row"><td colspan="3"></td></tr>
	<tr><td class="aleftBold" rowspan="5">How did you hear about us?</td></tr>
	<tr><td><select name="howHear" id="howHear">
			<option value="Non Profit Website" <?php if(isset($_POST['howHear']) && $_POST['howHear'] == 'Non Profit Website') { echo ' selected="selected"';} ?> >Non Profit Website</option>
			<option value="Radio" <?php if(isset($_POST['howHear']) && $_POST['howHear'] == 'Radio') { echo ' selected="selected"';} ?> >Radio</option>
			<option value="TV" <?php if(isset($_POST['howHear']) && $_POST['howHear'] == 'TV') { echo ' selected="selected"';} ?> >TV</option>
			<option value="Print Advertising" <?php if(isset($_POST['howHear']) && $_POST['howHear'] == 'Print Advertising') { echo ' selected="selected"';} ?> >Print Advertising</option>
			<option value="Internet Search" <?php if(isset($_POST['howHear']) && $_POST['howHear'] == 'Internet Search') { echo ' selected="selected"';} ?> >Internet Search</option>
			<option value="Social Media" <?php if(isset($_POST['howHear']) && $_POST['howHear'] == 'Social Media') { echo ' selected="selected"';} ?> >Social Media</option>
			<option value="Referral" <?php if(isset($_POST['howHear']) && $_POST['howHear'] == 'Referral') { echo ' selected="selected"';} ?> >Referral</option>
			<option value="Other" <?php if(isset($_POST['howHear']) && $_POST['howHear'] == 'Other') { echo ' selected="selected"';} ?> >Other</option>
		</select></td>
	</tr>
	<tr><td colspan="2" class="acenter"><label class="customText">If other selected, type in below:</label></td></tr>
	<tr><td colspan="2"><input type="text" id="other" name="other" maxlength="40" value="<?php if(isset($_POST['other'])) echo $_POST['other']; ?>"></td></tr>
	
	<tr><td colspan="2" class="acenter"><label id="otherfail" style="display: none;"></label></td></tr> 
	
	
<!--  	<tr class="blank_row"><td colspan="3"></td></tr>
	<tr>
		<td></td>
		<td colspan="1" style="margin: 0px auto !important;">
		<table><tr>
		<td><img style="-webkit-border-radius: 10px !important; border-radius: 10px !important; border: 1px solid black;" src="/includes/captcha.php?<?php echo microtime(); ?>" alt= "Captcha" id= "captchaimg" /></td>
		<td style="text-align: center;"><div style="line-height: 10px;">&nbsp;<input style="width: 120px;" type="text" id= "captchatext" name="txtCaptcha" maxlength="6"/><br><label class="statictext">Enter Captcha</label></div></td>
		</tr></table></td>
		<!--  <td><input class="captchaButton" type="button" name ="verifycaptchabtn"  id="verifycaptchabtn" value="Verify" onclick="verifyCaptcha()"></td>
	</tr>
	<tr><td class="acenter" colspan="3"><label id="captchafail" style="display: none;"></label></td></tr>
	<tr>
	<td></td>
	<td><input style="width: 100px !important;" class="captchaButton" type="button" name ="reloadcaptchabtn"  id="reloadcaptchabtn" value="Reload" onclick="reloadCaptcha()">&nbsp;<input style="width: 100px !important;" class="captchaButton" type="button" name ="verifycaptchabtn"  id="verifycaptchabtn" value="Verify" onclick="verifyCaptcha()"></td>
	</tr>	
	-->
	
	<tr class="blank_row"><td colspan="3"></td></tr>
	<tr>
		<td></td>
		<td colspan="1" style="margin: 0px auto !important;">
		<table><tr>
		<td><img style="-webkit-border-radius: 10px !important; border-radius: 10px !important; border: 1px solid black;" src="captcha.php?<?php echo microtime(); ?>" alt= "Captcha" id= "captchaimg" /></td>
		<td style="text-align: center;"><div style="line-height: 10px;">&nbsp;<input style="width: 120px;" type="text" id= "captchatext" name="txtCaptcha" maxlength="6"/><br><label class="statictext">Enter Captcha</label></div></td>
		</tr>
		<tr><td class="acenter" colspan="2"><label class="customText" style="text-align: center;">Letters are case sensitive</label></td></tr>
		</table></td>
	</tr>
	<tr><td class="acenter" colspan="3"><label id="captchafail" style="display: none;"></label></td></tr>
	<tr>
	<td></td>
	<td><input style="width: 100px !important;" class="captchaButton" type="button" name ="reloadcaptchabtn"  id="reloadcaptchabtn" value="Reload" onclick="reloadCaptcha()">&nbsp;<input style="width: 100px !important;" class="captchaButton" type="button" name ="verifycaptchabtn"  id="verifycaptchabtn" value="Verify" onclick="verifyCaptcha()"></td>
	</tr>	
</table>    

<?php echo "<br><br>"; ?>
<div class="acenter">
	<input class="customSubmit" type="submit" action="process.php" method="post" value="Donate my vehicle" id="registerButton" name="submit">

</div>
<br>	
</form>		
<?php echo "<br><br>"; unset($_SESSION['captchaText']); } ?>
