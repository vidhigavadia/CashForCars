<?php
	// Server URL's
	define("SERVER_URL", $_SERVER['SERVER_NAME']);
	define("DEV_URL", "cwhdev.copart.com");
	define("QA_URL", "cwhqa.copart.com");
	define("PROD_URL", "www.carswithheart.com");
	
	// Document path
	define("DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]);
	
	if (SERVER_URL == DEV_URL || SERVER_URL == QA_URL) 
	{
		//Gooddata URL's
		define("LYNKID_AT", "@copartgd-qa.com");
		define("GD_SOURCE_URL", "https://reports-qa.copart.com/gdc/account/customerlogin?sessionId=");
		define("GD_TARGET_URL", "/dashboard.html%23project%3D%2Fgdc%2Fprojects%2Frfuuzgivn2y41jsuoll0uyrddxztolex%26dashboard%3D%2Fgdc%2Fmd%2Frfuuzgivn2y41jsuoll0uyrddxztolex%2Fobj%2F13074");
		
		define("CONTACT_US", "sachin.fegade@copart.com");
		// Salesforce Login URL's
// 		define("SF_LOGIN_URL", "https://test.salesforce.com/services/oauth2/token");
	} else if (SERVER_URL == PROD_URL) 
	{
		//Gooddata URL's
		define("LYNKID_AT", "@copartgd.com");
		define("GD_SOURCE_URL", "https://reports.copart.com/gdc/account/customerlogin?sessionId=");
		define("GD_TARGET_URL", "/dashboard.html%23project%3D%2Fgdc%2Fprojects%2Fqfvdbqtxv2gxf24ezh8icramxq3httrc%26dashboard%3D%2Fgdc%2Fmd%2Fqfvdbqtxv2gxf24ezh8icramxq3httrc%2Fobj%2F15222");
		
		define("CONTACT_US", "info@carswithheart.com");
		// Salesforce Login URL's
// 		define("SF_LOGIN_URL", "https://login.salesforce.com/services/oauth2/token");
	}
	// Salesforce Redirect URL's
	define("SF_REDIRECT_URL", "https://".SERVER_URL."/formWidget.php");
	
	// Widget Values
	define("RECORD_TYPE_ID", "012320000009eyu");
	define("OWNER_ID", "00G320000030A70");
	
	define("CURR_SESSION_ID", session_id());
	// define("SF_ERROR_MAIL", "aseem.chaudhary@copart.com");
	define("SF_ERROR_MAIL", "CWHSupport@copart.com");
	define("SF_ERROR_SUBJECT", "CarsWithHeart Issue");
?>
