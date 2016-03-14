// Onload function for car models
function carMakeModelLoad(passID) {
	var makeValue = $("#Make option:selected").text();
	var myData;
	if(makeValue == '') {
		$("#Model").empty();
		$("#Model").append($("<option />").val('').text(''));
	} 
	else{
		$("#Model").append($("<option></option>").val(1).html("Test val 1"));
		$("#Model").append($("<option></option>").val(2).html("Test val 2"));
			$("#Model").append($("<option></option>").val(3).html("Test val 3"));
	}
	/*	else {
		if (passID == "not") {
			myData = {'fnName':'modelFromMake' ,'carMake': makeValue};
		} else {
			myData = {'fnName':'modelFromMake', 'id':idToJS, 'carMake': makeValue};
		}
   	$.ajax({
   			type: "POST",
   			url: "/admin/includes/loadModels.php",
   			data: myData,
   			cache: false,
   			dataType: "json",
   			success: function(data) {
   				if (passID == "not") {
   					noIDModels(data);
   				} else {
   					withIDModels(data);
   				}
   			},
   			error: function(err) {
   				alert("No Models for selected car make. "+err.responseText);
				$("#Model").empty();
				$("#Model").append($("<option />").val('').text(''));
			}
   		}); 
	} */
}


function noIDModels(data) {
	$("#Model").empty();
		for(i=0; i<data.length; i++) {
				$("#Model").append($("<option />").val(data[i]).text(data[i]));
		}
}

function withIDModels(data) {
	$("#Model").empty();
		for(i=0; i<data.length - 1; i++) {
				$("#Model").append($("<option />").val(data[i]).text(data[i]));
		}
		if(data[data.length-1] != 'X') {
			$('#Model').val(data[data.length-1]);
		}	
}

//Function to hide submit button on pageload.
function hideSubmit() {

	var s = document.getElementById( 'registerButton' );
	s.style.opacity = '0.7';
	s.disabled=true;

}

function hideSubmit_c() {

	var s = document.getElementById( 'registersButton' );
	s.style.opacity = '0.7';
	s.disabled=true;
}

//Function to show Donate my Vehicle button
function showsubmit() {
var s = document.getElementById( 'registerButton' );
    s.style.opacity = '1';
    s.disabled=false;
}

function showsubmit_c() {
var s = document.getElementById( 'registersButton' );
    s.style.opacity = '1';
    s.disabled=false;
}

function reduceClick() {
	var myButton = document.getElementById('registerButton');
	var handler = function(){
	   console.log("removing listener");
	   myButton.removeEventListener('click',handler);
	}
	myButton.addEventListener('click', handler);
}

////Function to check global form errors array
//function checkFormError() {
//	if(jsformError.length == 0) {
//		return true;
//	}
//	return false;
//}

//Function to verify Captcha
function verifyCaptcha() {
	var inputtext = $('#captchatext').val();
	
	$.ajax({
			url: "captcha_helper.php",
			dataType: "html",
			success: function(data) {
				if(inputtext == data) {
					$('#captchafail').show();
					$('#captchafail').text('Captcha Validated');
			        $('#captchafail').css("color","green");
			        showsubmit();	
				} else {
					$('#captchafail').show();
			        $('#captchafail').text('Incorrect Captcha. Please try again.');
			        $("#captchafail").css("color","red");
			        hideSubmit();
				}
			},
			error: function(err) {
				alert("An unexpected error has occured.");
//				$('#captchatext').val('');
		}
		}); 
}


function verifyCaptcha_c() {
	var inputtext = $('#captchatext').val();
	
	$.ajax({
			url: "captcha_helper.php",
			dataType: "html",
			success: function(data) {
				if(inputtext == data) {
					$('#captchafail').show();
					$('#captchafail').text('Captcha Validated');
			        $('#captchafail').css("color","green");
			        showsubmit_c();	
				} else {
					$('#captchafail').show();
			        $('#captchafail').text('Incorrect Captcha. Please try again.');
			        $("#captchafail").css("color","red");
			        hideSubmit();
				}
			},
			error: function(err) {
				alert("An unexpected error has occured.");
//				$('#captchatext').val('');
		}
		}); 
}

//Function to refresh captcha when wrong code is entered.
function reloadCaptcha() {
	var d = new Date();
	$('#captchaimg').attr('src','captcha.php?'+d.getTime());
	$('#captchatext').val('');
	$('#captchafail').hide();
	hideSubmit();
}


function fnameTest(e) {
	var name_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var first_name = $('#First_Name').val();
    if(!name_regex.test(first_name)) {
    	e.preventDefault();
        $('#fnamefail').show();
        $('#fnamefail').text('First name can contain characters, numeric and special characters up to 30 characters');
        $("#fnamefail").css("color","red");
        return false;
    } else {
    	$('#fnamefail').hide();
    	return true;
    }
}

function lnameTest(e) {
	var name_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var last_name = $('#Last_Name').val();
	
    if(!name_regex.test(last_name)) {
    	e.preventDefault();
        $('#lnamefail').show();
        $('#lnamefail').text('Last name can contain characters, numeric and special characters up to 30 characters');
        $("#lnamefail").css("color","red");
        return false;
    } else {
    	$('#lnamefail').hide();
    	return true;
    }
}

function emailTest(e) {
	var email=$('#Email').val();
	  var emailReg = /^([a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+@([a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+\.)+[\w]{2,4})?$/;
	if( !emailReg.test( email ) && email.length != 0) {
		e.preventDefault();
		 $('#emailfail').show();
		 $('#emailfail').text('Invalid Email Address');
		 $("#emailfail").css("color","red");
	     return false;
	    } else {
	    	$('#emailfail').hide();
	    	return true;
	    }
}

function address1Test(e) {
	var addr_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var addr1 = $('#Mailing_Address1').val();
	
  if(!addr_regex.test(addr1)) {
	  e.preventDefault();
      $('#adr1fail').show();
      $('#adr1fail').text('Address Line one can contain characters, numeric and special characters up to 255 characters');
      $("#adr1fail").css("color","red");
      return false;
  } else {
	  $('#adr1fail').hide();
  	return true;
  }
}

function address2Test(e) {
	var addr_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var addr2 = $('#Mailing_Address2').val();
	
  if(!addr_regex.test(addr2) && addr2.length != 0) {
	  e.preventDefault();
      $('#adr2fail').show();
      $('#adr2fail').text('Address Line two can contain characters, numeric and special characters up to 255 characters');
      $("#adr2fail").css("color","red");
      return false;
  } else {
	  $('#adr2fail').hide();
  	return true;
  }
}

function cityTest(e) {
	var city_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var city = $('#City').val();
	
  if(!city_regex.test(city)) {
	  e.preventDefault();
      $('#cityfail').show();
      $('#cityfail').text('City can contain characters, numeric and special characters up to 40 characters');
      $("#cityfail").css("color","red");
      return false;
  } else {
	  $('#cityfail').hide();
  	return true;
  }
}

function zipTest(e) {
	var zip_regex =/^\d{5}$/;
	var zip = $('#Zip').val();
	
  if(!zip_regex.test(zip)) {
	  e.preventDefault();
      $('#zipfail').show();
      $('#zipfail').text('Zip Code needs to have 5 numeric digits');
      $("#zipfail").css("color","red");
      return false;
  } else {
	  $('#zipfail').hide();
  	return true;
  }
}

function carAddress1Test(e) {
	var addr_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var addr1 = $('#caraddress1').val();
	
  if(!addr_regex.test(addr1) && addr1.length != 0) {
	  e.preventDefault();
      $('#caradr1fail').show();
      $('#caradr1fail').text('Address Line one can contain characters, numeric and special characters up to 255 characters');
      $("#caradr1fail").css("color","red");
      return false;
  } else {
	  $('#caradr1fail').hide();
  		return true;
  }
}

function carAddress2Test(e) {
	var addr_regex = /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var addr1 = $('#caraddress2').val();
	
  if(!addr_regex.test(addr1) && addr1.length != 0) {
	  e.preventDefault();
      $('#caradr2fail').show();
      $('#caradr2fail').text('Address Line two can contain characters, numeric and special characters up to 255 characters');
      $("#caradr2fail").css("color","red");
      return false;
  } else {
	  $('#caradr2fail').hide();
  	return true;
  }
}

function carCityTest(e) {
	var city_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var city = $('#carcity').val();
	
  if(!city_regex.test(city) && city.length != 0) {
	  e.preventDefault();
      $('#carcityfail').show();
      $('#carcityfail').text('City can contain characters, numeric and special characters up to 40 characters');
      $("#carcityfail").css("color","red");
      return false;
  } else {
	  $('#carcityfail').hide();
  	return true;
  }
}

function carZipTest(e) {
	var zip_regex = /^\d{5}$/;
	var zip = $('#carzip').val();
	
  if(!zip_regex.test(zip) && zip.length != 0) {
	  e.preventDefault();
      $('#carzipfail').show();
      $('#carzipfail').text('Zip Code needs to have 5 numeric digits');
      $("#carzipfail").css("color","red");
      return false;
  } else {
	  $('#carzipfail').hide();
  	return true;
  }
}

function memberIDTest(e) {
	var memID_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var memID = $('#MemberIDNumber').val();
	
  if(!memID_regex.test(memID) && memID.length != 0) {
	  e.preventDefault();
      $('#memberIDfail').show();
      $('#memberIDfail').text('Alphanumeric only');
      $("#memberIDfail").css("color","red");
      return false;
  } else {
	  $('#memberIDfail').hide();
  	return true;
  }
}

function yearmakemodelTest(e) {
	var yearmake_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var yearmake = $('#YearMakeModel').val();
	
  if(!yearmake_regex.test(yearmake) && yearmake.length != 0) {
	  e.preventDefault();
      $('#yearmakemodelfail').show();
      $('#yearmakemodelfail').text('Alphanumeric only');
      $("#yearmakemodelfail").css("color","red");
      return false;
  } else {
	  $('#yearmakemodelfail').hide();
  	return true;
  }

}

function mileageTest(e) {
	var mileage_regex =  /^\d{0,7}$/;
	var mileage = $('#Mileage').val();
	
  if(!mileage_regex.test(mileage) && mileage.length != 0) {
	  e.preventDefault();
      $('#mileagefail').show();
      $('#mileagefail').text('Mileage can contain Only Numeric digits up to 7 characters');
      $("#mileagefail").css("color","red");
      return false;
  } else {
	  $('#mileagefail').hide();
  	return true;
  }
}

function commentsTest(e) {
	var comment_regex = /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var comments = $('#Comments').val();

	if (!comment_regex.test(comments) && comments.length != 0) {
		e.preventDefault();
		$('#commentsfail').show();
		$('#commentsfail').text('Alphanumeric only');
		$("#commentsfail").css("color", "red");
		return false;
	}
	else {
		$('#commentsfail').hide();
		return true;
	}
}

function otherTest(e) {
	var city_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var other = $('#other').val();
	
	 if(!city_regex.test(other) && other.length != 0) {
		 e.preventDefault();
	     $('#otherfail').show();
	     $('#otherfail').text('Alphanumeric only');
	     $("#otherfail").css("color","red");
	     return false;
	  } else {
		  $('#otherfail').hide();
	 	return true;
	 }
}

function phoneTest(e) {
	var phoneac = $('#Home_Telephone_Ac').val();
	var phonea = $('#homephonea').val();
	var phoneb = $('#homephoneb').val();
	var phone = phoneac+phonea+phoneb;
	
	var regex= /^[0-9]{3}[0-9]{7}$/;
	 
	
	if(!regex.test(phone)) {
		e.preventDefault();
	    $('#phonefail').show();
	    $('#phonefail').text('Home/Cell Phone needs to have 10 digits');
	    $("#phonefail").css("color","red");
	    return false;
	} else {
		$('#phonefail').hide();
		return true;
	}
}

function workPhoneTest(e) {
	var workac = $('#Work_Telephone_Ac').val();
	var worka = $('#workphonea').val();
	var workb = $('#workphoneb').val();
	var workext = $('#Work_Telephone_Ext').val();
	var workPhone = workac+worka+workb+workext;
	
	var regex= /^[0-9]{3}[0-9]{7}[0-9]{0,10}$/;
	if(!regex.test(workPhone) && workPhone.length != 0) {
		e.preventDefault();
	    $('#workphonefail').show();
	    $('#workphonefail').text('Work Phone Number Phone needs to have 10 digits');
	    $("#workphonefail").css("color","red");
	    return false;
	} else {
		$('#workphonefail').hide();
		return true;
	}
}

$(document).ready(function(){
	
// Load model field dependent on make change
$('#Make').change(function() {
	carMakeModelLoad("not");
});

// First name validation
$('#First_Name').keyup(function() {
	var name_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var first_name = $('#First_Name').val();
	
    if(!name_regex.test(first_name) && first_name.length != 0) {
        $('#fnamefail').show();
        $('#fnamefail').text('First name can contain characters, numeric and special characters up to 30 characters');
        $("#fnamefail").css("color","red");
        return false;
    } else {
    	$('#fnamefail').hide();
    	return true;
    }
});

//Last name validation
$('#Last_Name').keyup(function() {
	var name_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var last_name = $('#Last_Name').val();
	
    if(!name_regex.test(last_name) && last_name.length != 0) {
        $('#lnamefail').show();
        $('#lnamefail').text('Last name can contain characters, numeric and special characters up to 30 characters');
        $("#lnamefail").css("color","red");
        return false;
    } else {
    	$('#lnamefail').hide();
    	return true;
    }

});

//New Email Validation
$('#Email').blur(function(){
    $('#Email').filter(function(){
       var email=$('#Email').val();
       var emailReg = /^([a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+@([a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+\.)+[\w]{2,4})?$/;
       if( !emailReg.test( email ) && email.length != 0 ) {
		 $('#emailfail').show();
		 $('#emailfail').text('Invalid Email Address');
		 $("#emailfail").css("color","red");
		 return false;
	    } else {
	    	$('#emailfail').hide();
	    	return true;
	    }
    })
});

//Home Addess Validation

//Address Line-1
$('#Mailing_Address1').keyup(function() {
	var addr_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var addr1 = $('#Mailing_Address1').val();
	
  if(!addr_regex.test(addr1) && addr1.length != 0) {
      $('#adr1fail').show();
      $('#adr1fail').text('Address Line one can contain characters, numeric and special characters up to 255 characters');
      $("#adr1fail").css("color","red");
      return false;
  } else {
	  $('#adr1fail').hide();
  	return true;
  }
});

//Address Line-2
$('#Mailing_Address2').keyup(function() {
	var addr_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var addr2 = $('#Mailing_Address2').val();
	
  if(!addr_regex.test(addr2) && addr2.length != 0) {
      $('#adr2fail').show();
      $('#adr2fail').text('Address Line two can contain characters, numeric and special characters up to 255 characters');
      $("#adr2fail").css("color","red");
      return false;
  } else {
	  $('#adr2fail').hide();
  	return true;
  }

});

//City Validation
$('#City').keyup(function() {
	var city_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var city = $('#City').val();
	
  if(!city_regex.test(city) && city.length != 0) {
      $('#cityfail').show();
      $('#cityfail').text('City can contain characters, numeric and special characters up to 40 characters');
      $("#cityfail").css("color","red");
      return false;
  } else {
	  $('#cityfail').hide();
  	return true;
  }

});

//State Validation
$('#State').change(function() {
	var state = $.trim($('#State :selected').text());
	if(state == '') {
      $('#statefail').show();
      $('#statefail').text('State must be selected!');
      $("#statefail").css("color","red");
      return false;
  } else {
	$('#statefail').hide();
  	return true;
  }

});

//Zipcode Validation
$('#Zip').blur(function() {
	var zip_regex = /^\d{5}$/;
	var zip = $('#Zip').val();
	
  if(!zip_regex.test(zip) && zip.length != 0) {
      $('#zipfail').show();
      $('#zipfail').text('Zip Code needs to have 5 numeric digits');
      $("#zipfail").css("color","red");
      return false;
  } else {
	  $('#zipfail').hide();
  	return true;
  }

});

//Car Addess Validation

//Car Address Line-1
$('#caraddress1').keyup(function() {
	var addr_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var addr1 = $('#caraddress1').val();
	
  if(!addr_regex.test(addr1) && addr1.length != 0) {
      $('#caradr1fail').show();
      $('#caradr1fail').text('Address Line one can contain characters, numeric and special characters up to 255 characters');
      $("#caradr1fail").css("color","red");
      return false;
  } else {
	  $('#caradr1fail').hide();
  	return true;
  }
});

//Car Address Line-2
$('#caraddress2').keyup(function() {
	var addr_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var addr1 = $('#caraddress2').val();
	
  if(!addr_regex.test(addr1) && addr1.length != 0) {
      $('#caradr2fail').show();
      $('#caradr2fail').text('Address Line two can contain characters, numeric and special characters up to 255 characters');
      $("#caradr2fail").css("color","red");
      return false;
  } else {
	  $('#caradr2fail').hide();
  	return true;
  }
});

//Car City Validation
$('#carcity').keyup(function() {
	var city_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var city = $('#carcity').val();
	
  if(!city_regex.test(city) && city.length != 0) {
      $('#carcityfail').show();
      $('#carcityfail').text('City can contain characters, numeric and special characters up to 40 characters');
      $("#carcityfail").css("color","red");
      return false;
  } else {
	  $('#carcityfail').hide();
  	return true;
  }

});

//Car state Validation
//$('#carstate').focusout(function() {
//	var state_regex =  /^[a-zA-Z]+$/;
//	var state = $('#carstate').val();
//	
//  if(!state_regex.test(state) || state.val()=='') {
//      $('#carstatefail').show();
//      $('#carstatefail').text('State must be selected!');
//      $("#carstatefail").css("color","red");
//      
//      setTimeout(function() {
//		    $('#carstatefail').fadeOut('fast');
//		}, 3000);
//     //  $("#carstate").focus();
//      return false;
//  } else {
//  	return true;
//  }
//
//});


//CarZipcode Validation

$('#carzip').blur(function() {
	var zip_regex =/^\d{5}$/;
	var zip = $('#carzip').val();
	
  if(!zip_regex.test(zip) && zip.length != 0) {
      $('#carzipfail').show();
      $('#carzipfail').text('Zip Code needs to have 5 numeric digits');
      $("#carzipfail").css("color","red");
      return false;
  } else {
	  $('#carzipfail').hide();
  	return true;
  }

});

$('#MemberIDNumber').keyup(function() {
	var memID_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var memID = $('#MemberIDNumber').val();
	
  if(!memID_regex.test(memID) && memID.length != 0) {
      $('#memberIDfail').show();
      $('#memberIDfail').text('Alphanumeric only');
      $("#memberIDfail").css("color","red");
      return false;
  } else {
	  $('#memberIDfail').hide();
  	return true;
  }
});

//Type, year, make, model not listed validation
$('#YearMakeModel').keyup(function() {
	var yearmake_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var yearmake = $('#YearMakeModel').val();
	
  if(!yearmake_regex.test(yearmake) && yearmake.length != 0) {
      $('#yearmakemodelfail').show();
      $('#yearmakemodelfail').text('Alphanumeric only');
      $("#yearmakemodelfail").css("color","red");
      return false;
  } else {
	  $('#yearmakemodelfail').hide();
  	return true;
  }

});

// Mileage Validation

$('#Mileage').keyup(function() {
	var mileage_regex =  /^\d{0,7}$/;
	var mileage = $('#Mileage').val();
	
  if(!mileage_regex.test(mileage) && mileage.length != 0 ) {
      $('#mileagefail').show();
      $('#mileagefail').text('Mileage can contain Only Numeric digits up to 7 characters');
      $("#mileagefail").css("color","red");
      return false;
  } else {
	  $('#mileagefail').hide();
  	return true;
  }

});

//Comments Validation
$('#Comments').keyup(function() {
	var comment_regex = /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var comments = $('#Comments').val();

	if (!comment_regex.test(comments) && comments.length != 0) {
		$('#commentsfail').show();
		$('#commentsfail').text('You can enter up to 255 characters only');
		$("#commentsfail").css("color", "red");
		return false;
	}
	else {
		$('#commentsfail').hide();
		return true;
	}

});

//Other Field for how to hear validation
$('#other').keyup(function() {
	var city_regex =  /^[a-z0-9A-Z\s\~\!\@\#\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\'\:\"\,\.\/\\\<\>\?\|]+$/i;
	var other = $('#other').val();
	
	if(!city_regex.test(other) && other.length != 0) {
		$('#otherfail').show();
	    $('#otherfail').text('Alphanumeric only');
	    $("#otherfail").css("color","red");
	    return false;
	 } else {
		 $('#otherfail').hide();
	 	 return true;
	 }
});

//Home_Telephone_Ac validation
$('#Home_Telephone_Ac').keyup(function() {
	var regex= /^[0-9]{0,3}$/;
    var phoneac = $('#Home_Telephone_Ac').val();
	
	if(!regex.test(phoneac) && phoneac.length != 0) {
	    $('#phonefail').show();
	    $('#phonefail').text('Home/Cell Phone needs to have 10 digits');
	    $("#phonefail").css("color","red");
	    return false;
	} else {
		$('#phonefail').hide();
		return true;
	}
});

//homephonea validation
$('#homephonea').keyup(function() {
	var regex= /^\d{0,3}$/;
	
	var phoneac = $('#homephonea').val();
	
	if(!regex.test(phoneac) && phoneac.length != 0 ) {
	    $('#phonefail').show();
	    $('#phonefail').text('Home/Cell Phone needs to have 10 digits');
	    $("#phonefail").css("color","red");
	    return false;
	} else {
		$('#phonefail').hide();
		return true;
	}
});

//homephoneb validation
$('#homephoneb').keyup(function() {
	 var regex= /^\d{0,4}$/;
	
	var phoneac = $('#homephoneb').val();
	
	if(!regex.test(phoneac) && phoneac.length != 0 ) {
		$('#phonefail').show();
	    $('#phonefail').text('Home/Cell Phone needs to have 10 digits');
	    $("#phonefail").css("color","red");
	    return false;
	 } else {
		 $('#phonefail').hide();
	  	 return true;
	  }
});

//Functions to move cursor to next field automatically - For Home 
$('#Home_Telephone_Ac').keyup(function() {
  if(this.value.length == $(this).attr('maxlength')) {
      $('#homephonea').focus();
  }
});

$('#homephonea').keyup(function() {
  if(this.value.length == $(this).attr('maxlength')) {
      $('#homephoneb').focus();
  }
});

//Work_Telephone_Ac validation
$('#Work_Telephone_Ac').keyup(function() {
	var regex= /^[0-9]{0,3}$/;
	var phoneac = $('#Work_Telephone_Ac').val();
	
	if(!regex.test(phoneac) && phoneac.length != 0 ) {
	    $('#workphonefail').show();
	    $('#workphonefail').text('Work Phone Number Phone needs to have 10 digits');
	    $("#workphonefail").css("color","red");
	    return false;
	} else {
		$('#workphonefail').hide();
		return true;
	}
});

//workphonea validation
$('#workphonea').keyup(function() {
	var regex= /^\d{0,3}$/;
	var phoneac = $('#workphonea').val();
	
	if(!regex.test(phoneac) && phoneac.length != 0 ) {
	    $('#workphonefail').show();
	    $('#workphonefail').text('Work Phone Number Phone needs to have 10 digits');
	    $("#workphonefail").css("color","red");
	    return false;
	} else {
		$('#workphonefail').hide();
		return true;
	}
});

//workphoneb validation
$('#workphoneb').keyup(function() {
	var regex= /^\d{0,4}$/;
	var phoneac = $('#workphoneb').val();
	
	if(!regex.test(phoneac) && phoneac.length != 0 ) {
		$('#workphonefail').show();
	    $('#workphonefail').text('Work Phone Number Phone needs to have 10 digits');
	    $("#workphonefail").css("color","red");
	    return false;
	  } else {
		$('#workphonefail').hide();
	  	return true;
	  }
});

//workphone extension field validation 
$('#Work_Telephone_Ext').keyup(function() {
	var regex= /^\d{0,10}$/;
	var phoneac = $('#Work_Telephone_Ext').val();
	
    if(!regex.test(phoneac) && phoneac.length != 0) {
        $('#workphonefail').show();
        $('#workphonefail').text('Ext can contain only numeric digits up to 10 characters');
        $("#workphonefail").css("color","red");
        return false;
    } else {
	    $('#workphonefail').hide();
  	    return true;
  }
});

//Functions to move cursor to next field automatically - For Work 

$('#Work_Telephone_Ac').keyup(function() {
  if(this.value.length == $(this).attr('maxlength')) {
      $('#workphonea').focus();
  }
});

$('#workphonea').keyup(function() {
  if(this.value.length == $(this).attr('maxlength')) {
      $('#workphoneb').focus();
  }
});

$('#workphoneb').keyup(function() {
  if(this.value.length == $(this).attr('maxlength')) {
      $('#Work_Telephone_Ext').focus();
  }
});

//Function to validate each mandatory missing fields while doing a form submission
$('#registerButton').click(function(e) {
	var fname = $.trim($('#First_Name').val());
	var lname = $.trim($('#Last_Name').val());
	var email = $.trim($('#Email').val());

	var zip = $.trim($('#Zip').val());
	var homephone1 = $.trim($('#Home_Telephone_Ac').val());
	var homephone2 = $.trim($('#homephonea').val());
	var homephone3 = $.trim($('#homephoneb').val());

	// First name 
	if(fname==='') {
	e.preventDefault();
    $('#fnamefail').show();
    $('#fnamefail').text('First Name is required');
    $("#fnamefail").css("color","red");
	} else { fnameTest(e); }
	
// Last name
	if(lname==='') {
		e.preventDefault();
    $('#lnamefail').show();
    $('#lnamefail').text('Last Name is required');
    $("#lnamefail").css("color","red");
	} else { lnameTest(e); }

	emailTest(e);

	// Zipcode
	if(zip==='') {
		e.preventDefault();
    $('#zipfail').show();
    $('#zipfail').text('Zipcode is required');
    $("#zipfail").css("color","red");
	} else { zipTest(e); }
	

	
	if (homephone1 === '' && homephone2 === '' && homephone3 === '') {
		e.preventDefault();
	      $('#phonefail').show();
	      $('#phonefail').text('Home/Cell Phone is required');
	      $("#phonefail").css("color","red");
	} else { phoneTest(e); }
	

	//setTimeout(function(){ reloadCaptcha(); }, 100);
});


$('#registersButton').click(function(e) {
	var fname = $.trim($('#First_Name').val());
	var lname = $.trim($('#Last_Name').val());
	var email = $.trim($('#Email').val());
/*	var addr1 = $.trim($('#Mailing_Address1').val());
	var city = $.trim($('#City').val());
	var state = $.trim($('#State :selected').text()); */
	var zip = $.trim($('#Zip').val());
	var homephone1 = $.trim($('#Home_Telephone_Ac').val());
	var homephone2 = $.trim($('#homephonea').val());
	var homephone3 = $.trim($('#homephoneb').val());

	// First name 
	if(fname==='') {
	e.preventDefault();
    $('#fnamefail').show();
    $('#fnamefail').text('First Name is required');
    $("#fnamefail").css("color","red");
	} else { fnameTest(e); }
	
// Last name
	if(lname==='') {
		e.preventDefault();
    $('#lnamefail').show();
    $('#lnamefail').text('Last Name is required');
    $("#lnamefail").css("color","red");
	} else { lnameTest(e); }

	emailTest(e);
	
	// Zipcode
	if(zip==='') {
		e.preventDefault();
    $('#zipfail').show();
    $('#zipfail').text('Zipcode is required');
    $("#zipfail").css("color","red");
	} else { zipTest(e); }
	

	if (homephone1 === '' && homephone2 === '' && homephone3 === '') {
		e.preventDefault();
	      $('#phonefail').show();
	      $('#phonefail').text('Home/Cell Phone is required');
	      $("#phonefail").css("color","red");
	} else { phoneTest(e); }
	
/*	workPhoneTest(e);
	
	mileageTest(e);
	commentsTest(e);
	otherTest(e);	
	yearmakemodelTest(e);  */
	//setTimeout(function(){ reloadCaptcha(); }, 100);
});

$(document).delegate('textarea[maxlength]', 'input keyup' , function(e) {
    // maxlength attribute does not in IE prior to IE10
    // http://stackoverflow.com/q/4717168/740639
    var $this = $(this);
    var maxlength = $this.attr('maxlength');
    if (!!maxlength) {
        var text = $this.val();

        if (text.length > maxlength) {
            // truncate excess text (in the case of a paste)
            $this.val(text.substring(0,maxlength));
            e.preventDefault();
        }

    }

});


});
