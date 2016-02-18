<?php
function firstnameValid($value) {
	trim($value);
	if(strlen($value) == 0) {
		return 'First Name is Required';
	} elseif (!preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'First name can contain characters, numeric and special characters up to 30 characters';
	} else{
		return '';
	}
}
function lastnameValid($value) {
	trim($value);
	if(strlen($value) == 0) {
		return 'Last Name is Required';
	} elseif (!preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'Last name can contain characters, numeric and special characters up to 30 characters';
	} else{
		return '';
	}
}
function emailValid($value) { 
	trim($value);
	if (strlen($value) != 0 && !preg_match('/^([a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+@([a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+\.)+[\w]{2,4})?$/', $value)) {
		return 'Invalid Email Address';
	} else{
		return '';
	}
}
function pickupDateValid($value) {
	trim($value);
	if (strlen($value) != 0 && !preg_match('/^(\d){4}\-(\d){2}\-(\d){2}$/', $value)) {
		return 'Date format should be yyyy-mm-dd';
	} else{
		return '';
	}
}
function address1Valid($value) {
	trim($value);
	if(strlen($value) == 0) {
		return 'Address Line one is required';
	} elseif (!preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'Address Line one can contain characters, numeric and special characters up to 255 characters';
	}else{
		return '';
	}
}
function address2Valid($value) {
	trim($value);
	if (strlen($value) != 0 && !preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'Address Line two can contain characters, numeric and special characters up to 255 characters';
	}else{
		return '';
	}
}
function cityValid($value) {
	trim($value);
	if(strlen($value) == 0) {
		return 'City is required';
	} elseif (!preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'City can contain characters, numeric and special characters up to 40 characters';
	}else{
		return '';
	}
}
function stateValid($value) {
	if(strlen($value) == 0) {
		return 'State must be selected';
	} else{
		return '';
	}
}
function zipValid($value) {
	trim($value);
	if(strlen((string)$value) == 0) {
		return 'ZipCode is Required';
	} elseif (!preg_match('/^\d{5}$/', $value)) {
		return 'Zip Code needs to have 5 numeric digits';
	} else{
		return '';
	}
}
function caraddress1Valid($value) {
	trim($value);
	if (strlen($value) != 0 && !preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'Car Address Line one can contain characters, numeric and special characters up to 255 characters';
	}else{
		return '';
	}
}
function caraddress2Valid($value) {
	trim($value);
	if (strlen($value) != 0 && !preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'Car Address Line two can contain characters, numeric and special characters up to 255 characters';
	}else{
		return '';
	}
}
function carcityValid($value) {
	trim($value);
	if (strlen($value) != 0 && !preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'Car City can contain characters, numeric and special characters up to 40 characters';
	}else{
		return '';
	}
}
function carzipValid($value) {
	trim($value);
	if (strlen((string)$value) != 0 && !preg_match('/^\d{5}$/', $value)) {
		return 'Car Zip Code needs to have 5 numeric digits';
	} else{
		return '';
	}
}
function phoneValid($value) {
	trim($value);
	if(strlen((string)$value) == 0) {
		return 'Home/Cell Phone is required';
	} elseif (!preg_match('/^[0-9]{3}\d{7}$/', $value)) {
		return 'Home/Cell Phone needs to have 10 digits';
	} else {
		return '';
	}
}
function workPhoneValid($value) {
	trim($value);
	if (strlen((string)$value) != 0 && !preg_match('/^[0-9]{3}\d{7}$/', $value)) {
		return 'Work Phone Number Phone needs to have 10 digits';
	}else{
		return '';
	}
}
// function phoneacValid($value) {
// 	trim($value);
// 	if(strlen((string)$value) == 0) {
// 		return 'Home Call Phone is required';
// 	} elseif (!preg_match('/^[1-9]{0,3}$/', $value)) {
// 		return 'HomeCall Phone can contain only numeric digits up to 10 characters';
// 	}else{
// 		return '';
// 	}
// }
// function phoneaValid($value) {
// 	trim($value);
// 	if(strlen((string)$value) == 0) {
// 		return 'Home Call Phone is required';
// 	} elseif (!preg_match('/^\d{0,3}$/', $value)) {
// 		return 'HomeCall Phone can contain only numeric digits up to 10 characters';
// 	}else{
// 		return '';
// 	}
// }
// function phonebValid($value) {
// 	trim($value);
// 	if(strlen((string)$value) == 0) {
// 		return 'Home Call Phone is required';
// 	} elseif (!preg_match('/^\d{0,4}$/', $value)) {
// 		return 'HomeCall Phone can contain only numeric digits up to 10 characters';
// 	}else{
// 		return '';
// 	}
// }
// function workphoneacValid($value) {
// 	trim($value);
// 	if (strlen((string)$value) != 0 && !preg_match('/^[1-9]{0,3}$/', $value)) {
// 		return 'Work Phone can contain only numeric digits up to 10 characters';
// 	}else{
// 		return '';
// 	}
// }
// function workphoneaValid($value) {
// 	trim($value);
// 	if (strlen((string)$value) != 0 && !preg_match('/^\d{0,3}$/', $value)) {
// 		return 'Work Phone can contain only numeric digits up to 10 characters';
// 	}else{
// 		return '';
// 	}
// }
// function workphonebValid($value) {
// 	trim($value);
// 	if (strlen((string)$value) != 0 && !preg_match('/^\d{0,4}$/', $value)) {
// 		return 'Work Phone can contain only numeric digits up to 10 characters';
// 	}else{
// 		return '';
// 	}
// }
function workphoneextValid($value) {
	trim($value);
	if (strlen((string)$value) != 0 && !preg_match('/^\d{0,10}$/', $value)) {
		return 'Ext can contain only numeric digits up to 10 characters';
	}else{
		return '';
	}
}
function memberIDValid($value) {
	trim($value);
	if (strlen((string)$value) != 0 && !preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'Member ID text field can contain characters, numeric and special characters up to 100 characters';
	}else{
		return '';
	}
}
function yearmakemodelValid($value) {
	trim($value);
	if (strlen((string)$value) != 0 && !preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'Year, Make, Model text field can contain characters, numeric and special characters up to 255 characters';
	}else{
		return '';
	}
}
function mileageValid($value) {
	trim($value);
	if (strlen((string)$value) != 0 && !preg_match('/^\d{0,7}$/', $value)) {
		return 'Mileage can contain only Numeric digits up to 7 characters';
	}else{
		return '';
	}
}
function commentsValid($value) {
	trim($value);
	if (strlen((string)$value) != 0 && !preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'You can enter up to 255 characters only';
	}else{
		return '';
	}
}
function otherValid($value) {
	trim($value);
	if (strlen((string)$value) != 0 && !preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'Other field can contain characters, numeric and special characters up to 40 characters';
	}else{
		return '';
	}
}
function captchaValid($value) {
	trim($value);
	if(strlen($value) == 0) {
		return 'Captcha is required';
	} elseif (!preg_match('/^[a-z0-9A-Z]+$/', $value)) {
		return 'Invalid Captcha';
	} elseif (strcmp($value, $_SESSION['captchaText']) == 0){
		return '';
	}
}
/* ************************************ */
/*  NPO Registration Server validations */
/* ************************************ */
function orgNameValid($value) {
	trim($value);
	if(strlen($value) == 0) {
		return 'Organization Name is Required';
	} elseif (!preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'Organization name can contain characters, numeric and special characters up to 255 characters';
	} else{
		return '';
	}
}
function orgAbbrvValid($value) {
	trim($value);
	if (strlen($value) != 0 && !preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'Abbreviations or Other Names can contain characters, numeric and special characters up to 255 characters';
	} else{
		return '';
	}
}
function orgphoneValid($value) {
	trim($value);
	if(strlen((string)$value) == 0) {
		return 'Organization Phone is required';
	} elseif (!preg_match('/^[0-9]{3}\d{7}$/', $value)) {
		return 'Organization Phone can contain only numeric digits up to 10 characters';
	}else{
		return '';
	}
}
// function orgphoneacValid($value) {
// 	trim($value);
// 	if(strlen((string)$value) == 0) {
// 		return 'Organization Phone is required';
// 	} elseif (!preg_match('/^[1-9]{0,3}$/', $value)) {
// 		return 'Organization Phone can contain only numeric digits up to 10 characters';
// 	}else{
// 		return '';
// 	}
// }
// function orgphoneaValid($value) {
// 	trim($value);
// 	if(strlen((string)$value) == 0) {
// 		return 'Organization Phone is required';
// 	} elseif (!preg_match('/^\d{0,3}$/', $value)) {
// 		return 'Organization Phone can contain only numeric digits up to 10 characters';
// 	}else{
// 		return '';
// 	}
// }
// function orgphonebValid($value) {
// 	trim($value);
// 	if(strlen((string)$value) == 0) {
// 		return 'Organization Phone is required';
// 	} elseif (!preg_match('/^\d{0,4}$/', $value)) {
// 		return 'Organization Phone can contain only numeric digits up to 10 characters';
// 	}else{
// 		return '';
// 	}
// }
function orgphoneextValid($value) {
	trim($value);
	if (strlen($value) != 0 && !preg_match('/^\d{0,10}$/', $value)) {
		return 'Organization Phone Ext. can contain only numeric digits up to 10 characters';
	}else{
		return '';
	}
}
// function orgwebsiteValid($value) {
// 	trim($value);
// 	if (strlen($value) != 0 && !preg_match('/(https?:\/\/)?(\w+\-?\.?\/?)+\.[a-z]{2,6}/', $value)) {
// 		return 'Invalid website URL';
// 	}else{
// 		return '';
// 	}
// }
// Updated Website- URL Function - Added on 23 Oct, 2015  
function orgwebsiteValid($value) {
		trim($value);
	 
// if (strlen($value) != 0 && !preg_match('/^http:\/\/|(^https?://)|(/localhost\/h(?:\/|\?|$)/)|(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?(\/([\w#!:.?+=&%@!\/-])?)$/', $value)) {	
			
		if (strlen($value) != 0 && !preg_match('/((http|ftp|https):\/{2})?(?!localhost)([a-zA-Z0-9]+([\.]+)){2}([a-zA-Z0-9]+([\/]?))+/', $value)) {
		return 'Invalid website URL';
		}else{
			return '';
		}
	 }
function orgaddress1Valid($value) {
	trim($value);
	if (strlen($value) != 0 && !preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'Address Line one can contain characters, numeric and special characters up to 255 characters';
	}else{
		return '';
	}
}
function orgaddress2Valid($value) {
	trim($value);
	if (strlen($value) != 0 && !preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'Address Line two can contain characters, numeric and special characters up to 255 characters';
	}else{
		return '';
	}
}
function orgcityValid($value) {
	trim($value);
	if (strlen($value) != 0 && !preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'Organization City can contain characters, numeric and special characters up to 40 characters';
	}else{
		return '';
	}
}
function orgzipValid($value) {
	trim($value);
	if (strlen((string)$value) != 0 && !preg_match('/^\d{5}$/', $value)) {
		return 'Organization Zip Code needs to have 5 numeric digits';
	} else{
		return '';
	}
}
function orgfnameValid($value) {
	trim($value);
	if (strlen((string)$value) != 0 && !preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'First name can contain characters, numeric and special characters up to 30 characters';
	} else{
		return '';
	}
}
function orglnameValid($value) {
	trim($value);
	if (strlen((string)$value) != 0 && !preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'Last name can contain characters, numeric and special characters up to 30 characters';
	} else{
		return '';
	}
}
function orgpcValid($value) {
	trim($value);
	if (strlen((string)$value) != 0 && !preg_match('/^[0-9]{3}\d{7}$/', $value)) {
		return 'Primary Contact\'s Work Phone can contain only numeric digits up to 10 characters';
	}else{
		return '';
	}
}
// function orgpcacValid($value) {
// 	trim($value);
// 	if (strlen((string)$value) != 0 && !preg_match('/^[1-9]{0,3}$/', $value)) {
// 		return 'Primary Contact\'s Work Phone can contain only numeric digits up to 10 characters';
// 	}else{
// 		return '';
// 	}
// }
// function orgpcaValid($value) {
// 	trim($value);
// 	if (strlen((string)$value) != 0 && !preg_match('/^\d{0,3}$/', $value)) {
// 		return 'Primary Contact\'s Work Phone can contain only numeric digits up to 10 characters';
// 	}else{
// 		return '';
// 	}
// }
// function orgpcbValid($value) {
// 	trim($value);
// 	if (strlen((string)$value) != 0 && !preg_match('/^\d{0,4}$/', $value)) {
// 		return 'Primary Contact\'s Work Phone can contain only numeric digits up to 10 characters';
// 	}else{
// 		return '';
// 	}
// }
function orgpcextValid($value) {
	trim($value);
	if (strlen((string)$value) != 0 && !preg_match('/^\d{0,10}$/', $value)) {
		return 'Primary Contact\'s Work Phone Ext. can contain only numeric digits up to 10 characters';
	}else{
		return '';
	}
}
function orgpccValid($value) {
	trim($value);
	if (strlen((string)$value) != 0 && !preg_match('/^[0-9]{3}\d{7}$/', $value)) {
		return 'Primary Contact\'s Cell Phone can contain only numeric digits up to 10 characters';
	}else{
		return '';
	}
}
// function orgpccacValid($value) {
// 	trim($value);
// 	if (strlen((string)$value) != 0 && !preg_match('/^[1-9]{0,3}$/', $value)) {
// 		return 'Primary Contact\'s Cell Phone can contain only numeric digits up to 10 characters';
// 	}else{
// 		return '';
// 	}
// }
// function orgpccaValid($value) {
// 	trim($value);
// 	if (strlen((string)$value) != 0 && !preg_match('/^\d{0,3}$/', $value)) {
// 		return 'Primary Contact\'s Cell Phone can contain only numeric digits up to 10 characters';
// 	}else{
// 		return '';
// 	}
// }
// function orgpccbValid($value) {
// 	trim($value);
// 	if (strlen((string)$value) != 0 && !preg_match('/^\d{0,4}$/', $value)) {
// 		return 'Primary Contact\'s Cell Phone can contain only numeric digits up to 10 characters';
// 	}else{
// 		return '';
// 	}
// }
/* ************************************ */
/*  Contact us validations */
/* ************************************ */
function nameValid($value) {
	trim($value);
	if(strlen($value) == 0) {
		return 'Name is Required';
	} elseif (!preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'Name can contain characters, numeric and special characters up to 60 characters';
	} else{
		return '';
	}
}
function contactEmailValid($value) {
	trim($value);
	if(strlen($value) == 0) {
		return 'Email is Required';
	} elseif (!preg_match('/^([a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+@([a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+\.)+[\w\-]{2,4})?$/', $value)) {
		return 'Invalid Email Address';
	} else{
		return '';
	}
}
function subjectValid($value) {
	trim($value);
	if(strlen($value) == 0) {
		return 'Subject is Required';
	} elseif (!preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'Subject can contain characters, numeric and special characters up to 255 characters';
	} else{
		return '';
	}
}
function contactCommentsValid($value) {
	trim($value);
	if(strlen($value) == 0) {
		return 'Message is Required';
	} elseif(!preg_match('/^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i', $value)) {
		return 'Message can contain characters, numeric and special characters up to 255 characters';
	}else{
		return '';
	}
}
?>
