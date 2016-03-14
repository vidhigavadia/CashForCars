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
<title>Copart Direct</title>

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

	var formName = "<?php echo "CopartDirect.php"; ?>";
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
	
	if(isset($_POST['OrgID'])) {
		$formErrors = array();
		if (firstnameValid($_POST['First_Name'])) $GLOBALS['formErrors'][] = firstnameValid($_POST['First_Name']);
		if (lastnameValid($_POST['Last_Name'])) $GLOBALS['formErrors'][] = lastnameValid($_POST['Last_Name']) ;
		if (emailValid($_POST['Email'])) $GLOBALS['formErrors'][] = emailValid($_POST['Email']) ;
	
		
		
	
		if (zipValid($_POST['Zip'])) $GLOBALS['formErrors'][] = zipValid($_POST['Zip']) ;
		
	
		$homePhone = $_POST['Home_Telephone_Ac'].$_POST['homephonea'].$_POST['homephoneb'];
		if (phoneValid($homePhone)) $GLOBALS['formErrors'][] = phoneValid($homePhone);
		
	
		if (yearmakemodelValid($_POST['YearMakeModel'])) $GLOBALS['formErrors'][] = yearmakemodelValid($_POST['YearMakeModel']) ;
	
	
		if (otherValid($_POST['other'])) $GLOBALS['formErrors'][] = otherValid($_POST['other']) ;
		
		if (captchaValid($_POST['txtCaptcha'])) $GLOBALS['formErrors'][] = captchaValid($_POST['txtCaptcha']) ;
		
		error_log(print_r($GLOBALS['formErrors']));
	} 
	if(isset($_POST['OrgID']) && sizeof($GLOBALS['formErrors']) == 0) {
		include_once 'lead.php';

		
		$formValues = array();
		if(isset($_POST['First_Name']) && $_POST['First_Name'] != '') $formValues['FirstName'] = $_POST['First_Name'];
		if(isset($_POST['Last_Name']) && $_POST['Last_Name'] != '') $formValues['LastName'] = $_POST['Last_Name'];
		if(isset($_POST['Email']) && $_POST['Email'] != '') $formValues['email'] = $_POST['Email'];
	
	
		if(isset($_POST['Zip']) && $_POST['Zip'] != '') $formValues['PostalCode'] = $_POST['Zip'];
		
	
		
		if(isset($_POST['besttime']) && $_POST['besttime'] != '') $formValues['BestTimetoCall__c'] = $_POST['besttime'];
		$phone = $_POST['Home_Telephone_Ac'].$_POST['homephonea'].$_POST['homephoneb'];
		if(isset($phone) && $phone != '') $formValues['Phone'] = $phone;
		

		if(isset($_POST['Year1']) && $_POST['Year1'] != '') $formValues['year__c'] = $_POST['Year1'];
		if(isset($_POST['Make']) && $_POST['Make'] != '') $formValues['make__c'] = $_POST['Make'];
		if(isset($_POST['Model']) && $_POST['Model'] != '') $formValues['model__c'] = $_POST['Model'];
	
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
	


<!-- <noscript> 
<table style="width:550px; margin: 0;" class="acenter"><tr><td colspan="3">For full functionality of this site it is necessary to enable JavaScript.-->
<!--  Here are the <a href="http://www.enable-javascript.com/" target="_blank"> -->
<!--  instructions how to enable JavaScript in your web browser</a>. -->
<!-- </td></tr></table> -->
<!-- </noscript>	 -->
	
<p>

	<input type='hidden' name='OrgID' id='OrgID' value='2503'>
	<input id="NewOrg" name="NewOrg" type='hidden'   value=''/>
</p>



<tr class="blank_row"><td colspan="3"></td></tr>



<!-- <div class="fullform"> -->
<?php 
/*	if (strcmp($_GET['i'], '2503') == 0 || strcmp($_GET['i'], '2504') == 0) {
		echo "<label id=\"label1\" class=\"nraformlabel\">Schedule A Pick-up</label>";
	} else { */
		echo "<label id=\"label1\" class=\"formlabel\">CONTACT DETAILS</label>";
//	}
?>
<?php echo "<br><br>"; ?>
<div class="reducedOpacity">
  <table style="width:550px; margin: 0;">
		
	<tr><td class="aleftBold" rowspan="7">Contact</td></tr>
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
		
		
			<tr>
		<td class="aleftBold" rowspan="2">Home/Cell Phone*</td>
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
	
		<tr><td class="aleftBold" rowspan="3">Zip Code</td></tr>
		<tr>
			 <td><input style="border: 1px solid #C40A20 !important;" id="Zip" name="Zip" maxlength="5" value="<?php if(isset($_POST['Zip'])) echo $_POST['Zip']; ?>"/></td> 
		
		</tr>
		<tr>
			<td class="statictext">Zip Code*</td>
		</tr>
		
	    
</table>    
<!-- </fieldset> -->
</div>


<?php echo "<br><br>"; ?>

<!-- <label id="label1" class="formlabel">DONATION DETAILS</label> -->
<?php 
/*	if (strcmp($_GET['i'], '2503') == 0 || strcmp($_GET['i'], '2504') == 0) {
		echo "<label id=\"label1\" class=\"nraformlabel\">Donation Details</label>";
	} else { */
		echo "<label id=\"label1\" class=\"formlabel\">VEHICLE DETAILS</label>";
//	}
?>

<?php echo "<br><br>"; ?>
<table style="width:550px; margin: 0;">
<tr>
		<td class="aleftBold" rowspan="7">Vehicle</td>
		
		<td colspan="2"><input id="VehicleType" name="VehicleType"/></td>
	</tr>
		<tr><td class="statictext">Vehicle Type</td></tr>
		<tr><td class="acenter" colspan="2"><label id="typefail" style="display: none;"></label></td></tr>
		<tr>
		<td class="acenter" colspan="2">
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
	
	<tr class="blank_row"><td colspan="3"></td></tr>
	<tr><td class="aleftBold" rowspan="5">How did you hear about us?</td></tr>
	<tr><td><select name="howHear" id="howHear">
			<option value="Online" <?php if(isset($_POST['howHear']) && $_POST['howHear'] == 'Online') { echo ' selected="selected"';} ?> >Online</option>
			<option value="Newspaper" <?php if(isset($_POST['howHear']) && $_POST['howHear'] == 'Newspaper') { echo ' selected="selected"';} ?> >Newspaper</option>
			<option value="Gas Station TV" <?php if(isset($_POST['howHear']) && $_POST['howHear'] == 'Gas Station TV') { echo ' selected="selected"';} ?> >Gas Station TV</option>
			<option value="Billboard" <?php if(isset($_POST['howHear']) && $_POST['howHear'] == 'Billboard') { echo ' selected="selected"';} ?> >Billboard</option>
			<option value="Driving By" <?php if(isset($_POST['howHear']) && $_POST['howHear'] == 'Driving By') { echo ' selected="selected"';} ?> >Driving By</option>
			<option value="Social Media" <?php if(isset($_POST['howHear']) && $_POST['howHear'] == 'Social Media') { echo ' selected="selected"';} ?> >Social Media</option>
			<option value="Friend" <?php if(isset($_POST['howHear']) && $_POST['howHear'] == 'Friend') { echo ' selected="selected"';} ?> >Friend</option>
			<option value="DMV Video" <?php if(isset($_POST['howHear']) && $_POST['howHear'] == 'DMV Video') { echo ' selected="selected"';} ?> >DMV Video</option>
			<option value="Don't Remember" <?php if(isset($_POST['howHear']) && $_POST['howHear'] == "Don't Remember") { echo ' selected="selected"';} ?> >Don't Remember</option>
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
	<input class="customSubmit" type="submit" value="Donate my vehicle" id="registersButton" name="submit">

</div>
<br>	
</form>		
<?php echo "<br><br>"; unset($_SESSION['captchaText']); } ?>
