<?php
// include ('../../includes/sql-helper.php');
//$cipher = '!@VWfekj5bwe^4db@M0pAkDk;ccnwd!``~][asdBm;<p';
//include_once $_SERVER["DOCUMENT_ROOT"].'/admin/common.php';
$dblink = db_connect();
/*#######################################
		content INFO
#######################################*/ 
function donorList() {
	$query = mysqli_query($GLOBALS['dblink'], "
		SELECT *
 		FROM donor WHERE 
 		`delete` = 0
		");
	return $query; 
}
function donorInfo($id) {
	$query = mysqli_query($GLOBALS['dblink'], "
		SELECT *
		FROM donor WHERE 
		`delete` = 0
		AND 	DonationID = $id
		");
	return $query; 
}
function orgInfo($id) {
	$query = mysqli_query($GLOBALS['dblink'], "
		SELECT *
		FROM org WHERE 
		`delete` = 0
		AND 	OrgID = $id
		");
	return $query; 
}
function orgUncut($id) {
	$query = mysqli_query($GLOBALS['dblink'], "
		SELECT *
		FROM org WHERE 
		OrgID = $id
		");
	return $query; 
}
function orgsInfo() {
	$query = mysqli_query($GLOBALS['dblink'], "
		SELECT *
		FROM org WHERE 
		`delete` = 0 AND `active` = 0 ORDER BY OrgName
		");
	return $query; 
}
function org($id) {
	$query = mysqli_query($GLOBALS['dblink'], "
		SELECT *
		FROM org WHERE 
		OrgID = '$id'
		");
		while($row = mysqli_fetch_assoc($query)){ 
		return $row['OrgName'];}
}
function orgDetails($id) {
	$query = mysqli_query($GLOBALS['dblink'], "
			SELECT *
			FROM org WHERE
			OrgID = '$id'
			");
	while($row = mysqli_fetch_assoc($query)) {
		return $row;
	}
}
function orgSellerCode($id) {
	$query = mysqli_query($GLOBALS['dblink'], "
			SELECT *
			FROM org WHERE
			OrgID = '$id'
			");
	while($row = mysqli_fetch_assoc($query)){
		return $row['SellerCode'];
	}
}
function orgPercent($id) {
	$query = mysqli_query($GLOBALS['dblink'], "
		SELECT DonationPercentage
		FROM org WHERE 
		OrgID = '$id'
		");
		while($row = mysqli_fetch_assoc($query)){ 
		return $row['DonationPercentage'];}
}
function orgEmail($id) {
	$query = mysqli_query($GLOBALS['dblink'], "
		SELECT *
		FROM org WHERE 
		OrgID = '$id'
		");
		while($row = mysqli_fetch_assoc($query)){ 
		return $row['ContactEmail'];}
}
function getCipher() {
	$query = mysqli_query($GLOBALS['dblink'], "
			SELECT *
			FROM cipherkey WHERE SrNo = '1'
			");
	while($row = mysqli_fetch_assoc($query)) {
		return $row['Cipher'];
	}
}
function getSFData() {
// 	$key = getCipher();
	$key = $GLOBALS['cipher'];
	$query = mysqli_query($GLOBALS['dblink'], "
			SELECT 
			AES_DECRYPT(`IdNum`, \"$key\") as IdNum,
			AES_DECRYPT(`username`, \"$key\") as username, 
			AES_DECRYPT(`password`, \"$key\") as password,
			AES_DECRYPT(`Secret`, \"$key\") as Secret 
			from forceLogin where `SrNo`=9
			");
	while($row = mysqli_fetch_assoc($query)) {
		return $row;
	}
}
function getGDData() {
	$secret_key = "jhf^%$&5gjv9869yygig58575*&$#";
	$result = mysqli_query($GLOBALS['dblink'], "Select `para`, `iv` from `forceLogin` where `SrNo`=8") or error_log(mysqli_error($GLOBALS['dblink']));
	$decrypted_string = "";
	
	if ($result->num_rows > 0) {
		while ($row = mysqli_fetch_assoc($result)){
			$decrypted_string = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $secret_key, $row['para'], MCRYPT_MODE_CBC, $row['iv']);
		}
	}
	return $decrypted_string;
}
function updateSFCreds($idnum, $secret, $user, $pass) {
	$key = $GLOBALS['cipher'];
	mysqli_query($GLOBALS['dblink'],
			"UPDATE `forceLogin` set 
			`IdNum` = AES_ENCRYPT(\"$idnum\", \"$key\"),
			`Secret` = AES_ENCRYPT(\"$secret\", \"$key\"),
			`username` = AES_ENCRYPT(\"$user\", \"$key\"),
			`password` = AES_ENCRYPT(\"$pass\", \"$key\")
			where `SrNo` = 9") or error_log("Unable to update sf data to DB: ".mysqli_error($GLOBALS['dblink']));
}
function getDatetimeNow() {
// 	$tz_object = new DateTimeZone('America/Chicago');
// 	$datetime = new DateTime();
// 	$datetime->setTimezone($tz_object);
	date_default_timezone_set('America/Chicago');
	return date("F j, Y, g:i:s a");
}
function sfConfigWrite($url, $token) {
	$key = $GLOBALS['cipher'];
	$time = getDatetimeNow();
	mysqli_query($GLOBALS['dblink'], 
			"UPDATE `sfconfig` set `instance` = AES_ENCRYPT(\"$url\", \"$key\"), 
									`token` = AES_ENCRYPT(\"$token\", \"$key\"),
									`timestamp` = \"$time\" 						
									 where `id` = 1") 
	or error_log("Unable to write sfconfig: ".mysqli_error($GLOBALS['dblink']));
}
function sfConfigRead() {
	$key = $GLOBALS['cipher'];
	$query = mysqli_query($GLOBALS['dblink'], "
			SELECT 
			AES_DECRYPT(`instance`, \"$key\") as `instance`,
			AES_DECRYPT(`token`, \"$key\") as `token` 
			from `sfconfig` where `id`= 1") or error_log("Unable to read sfconfig: ".mysqli_error($GLOBALS['dblink']));
	while($row = mysqli_fetch_assoc($query)) {
		return $row;
	}
}
function FormSubmitFailureTemplate($dataArray) {
	$curlerror = "";
	$error_codes = array(
			"0" => 'CURLE_OK',
			"1" => 'CURLE_UNSUPPORTED_PROTOCOL',
			"2" => 'CURLE_FAILED_INIT',
			"3" => 'CURLE_URL_MALFORMAT',
			"4" => 'CURLE_URL_MALFORMAT_USER',
			"5" => 'CURLE_COULDNT_RESOLVE_PROXY',
			"6" => 'CURLE_COULDNT_RESOLVE_HOST',
			"7" => 'CURLE_COULDNT_CONNECT',
			"8" => 'CURLE_FTP_WEIRD_SERVER_REPLY',
			"9" => 'CURLE_REMOTE_ACCESS_DENIED',
			"11" => 'CURLE_FTP_WEIRD_PASS_REPLY',
			"13" => 'CURLE_FTP_WEIRD_PASV_REPLY',
			"14" => 'CURLE_FTP_WEIRD_227_FORMAT',
			"15" => 'CURLE_FTP_CANT_GET_HOST',
			"17" => 'CURLE_FTP_COULDNT_SET_TYPE',
			"18" => 'CURLE_PARTIAL_FILE',
			"19" => 'CURLE_FTP_COULDNT_RETR_FILE',
			"21" => 'CURLE_QUOTE_ERROR',
			"22" => 'CURLE_HTTP_RETURNED_ERROR',
			"23" => 'CURLE_WRITE_ERROR',
			"25" => 'CURLE_UPLOAD_FAILED',
			"26" => 'CURLE_READ_ERROR',
			"27" => 'CURLE_OUT_OF_MEMORY',
			"28" => 'CURLE_OPERATION_TIMEDOUT',
			"30" => 'CURLE_FTP_PORT_FAILED',
			"31" => 'CURLE_FTP_COULDNT_USE_REST',
			"33" => 'CURLE_RANGE_ERROR',
			"34" => 'CURLE_HTTP_POST_ERROR',
			"35" => 'CURLE_SSL_CONNECT_ERROR',
			"36" => 'CURLE_BAD_DOWNLOAD_RESUME',
			"37" => 'CURLE_FILE_COULDNT_READ_FILE',
			"38" => 'CURLE_LDAP_CANNOT_BIND',
			"39" => 'CURLE_LDAP_SEARCH_FAILED',
			"41" => 'CURLE_FUNCTION_NOT_FOUND',
			"42" => 'CURLE_ABORTED_BY_CALLBACK',
			"43" => 'CURLE_BAD_FUNCTION_ARGUMENT',
			"45" => 'CURLE_INTERFACE_FAILED',
			"47" => 'CURLE_TOO_MANY_REDIRECTS',
			"48" => 'CURLE_UNKNOWN_TELNET_OPTION',
			"49" => 'CURLE_TELNET_OPTION_SYNTAX',
			"51" => 'CURLE_PEER_FAILED_VERIFICATION',
			"52" => 'CURLE_GOT_NOTHING',
			"53" => 'CURLE_SSL_ENGINE_NOTFOUND',
			"54" => 'CURLE_SSL_ENGINE_SETFAILED',
			"55" => 'CURLE_SEND_ERROR',
			"56" => 'CURLE_RECV_ERROR',
			"58" => 'CURLE_SSL_CERTPROBLEM',
			"59" => 'CURLE_SSL_CIPHER',
			"60" => 'CURLE_SSL_CACERT',
			"61" => 'CURLE_BAD_CONTENT_ENCODING',
			"62" => 'CURLE_LDAP_INVALID_URL',
			"63" => 'CURLE_FILESIZE_EXCEEDED',
			"64" => 'CURLE_USE_SSL_FAILED',
			"65" => 'CURLE_SEND_FAIL_REWIND',
			"66" => 'CURLE_SSL_ENGINE_INITFAILED',
			"67" => 'CURLE_LOGIN_DENIED',
			"68" => 'CURLE_TFTP_NOTFOUND',
			"69" => 'CURLE_TFTP_PERM',
			"70" => 'CURLE_REMOTE_DISK_FULL',
			"71" => 'CURLE_TFTP_ILLEGAL',
			"72" => 'CURLE_TFTP_UNKNOWNID',
			"73" => 'CURLE_REMOTE_FILE_EXISTS',
			"74" => 'CURLE_TFTP_NOSUCHUSER',
			"75" => 'CURLE_CONV_FAILED',
			"76" => 'CURLE_CONV_REQD',
			"77" => 'CURLE_SSL_CACERT_BADFILE',
			"78" => 'CURLE_REMOTE_FILE_NOT_FOUND',
			"79" => 'CURLE_SSH',
			"80" => 'CURLE_SSL_SHUTDOWN_FAILED',
			"81" => 'CURLE_AGAIN',
			"82" => 'CURLE_SSL_CRL_BADFILE',
			"83" => 'CURLE_SSL_ISSUER_ERROR',
			"84" => 'CURLE_FTP_PRET_FAILED',
			"84" => 'CURLE_FTP_PRET_FAILED',
			"85" => 'CURLE_RTSP_CSEQ_ERROR',
			"86" => 'CURLE_RTSP_SESSION_ERROR',
			"87" => 'CURLE_FTP_BAD_FILE_LIST',
			"88" => 'CURLE_CHUNK_FAILED');
	
	foreach ($error_codes as $code => $description) {
		if (strcmp($code, $dataArray[4]) == 0) {
			$GLOBALS['curlerror'] = "$code ($description)";
		}
	}
	$temp = $GLOBALS['curlerror'];
	$tableStyle = "
			  font-family: sans-serif;
			  -webkit-font-smoothing: antialiased;
			  font-size: 100%;
			border-radius: 10px;
			overflow:hidden;
			";
	
	$headerStyle = "color: white;
			    font-weight: normal;
				font-size: 22px;
			    padding: 10px 20px;
			    text-align: center;
			    color: #ffffff;
			    background: #ea6153;";
	
	$thStyle = "background-color: rgb(238, 238, 238);
			    color: black;
			    font-weight: heavy;
			    padding: 10px 20px;
			    text-align: right;";
	
	$tdStyle = "background-color: rgb(238, 238, 238);
			    color: rgb(111, 111, 111);
			    padding: 10px 20px;
			    text-align: left;";
	
	$mailData = "<html>
	<body>
		<table style=\"$tableStyle\">
	    <tr><td colspan=\"2\" style=\"$headerStyle\">$dataArray[0]</td></tr>
	    <tr>
	      <th style=\"$thStyle\">Status Code</th>
	      <td style=\"$tdStyle\">$dataArray[1]</td>
	    </tr>
	    <tr>
	      <th style=\"$thStyle\">Response Message</th>
	      <td style=\"$tdStyle\">$dataArray[2]</td>
	    </tr>
	    <tr>
	      <th style=\"$thStyle\">Response Error Code</th>
	      <td style=\"$tdStyle\">$dataArray[3]</td>
	    </tr>
	    <tr>
	      <th style=\"$thStyle\">cURL Code</th>
	      <td style=\"$tdStyle\">$temp</td>
	    </tr>
		</table>
	</body></html>";
	
	return $mailData;
}
function dropdownField($id, $field, $list) {
	$query = mysqli_query($GLOBALS['dblink'], "
		SELECT *
		FROM `donor` WHERE
		`delete` = 0 AND `DonationID` = $id
		");
	$fieldValue = '';
	$return = '';
	while($row = mysqli_fetch_assoc($query)) {
		$fieldValue = $row["$field"];
	}
	
	if(strcmp((trim($fieldValue)), '') == 0) {
		$flag = 0;
		foreach($list as $value) {
			if($flag === 0) {
				$return .= "<option value='' selected=\"selected\">Select an option</option>";
				$flag = 1;
			}
			$return .= "<option value=\"$value\">$value</option>";
		}
	} else {
		foreach($list as $value) {
			if(strcmp((strtoupper(trim($fieldValue))), strtoupper($value)) == 0) {
				$return .= "<option value=\"$value\" selected=\"selected\">$value</option>";
			} else {
				$return .= "<option value=\"$value\">$value</option>";
			}
		}
	}
	return $return;
}
function orgList($id) {
	$query = mysqli_query($GLOBALS['dblink'], "
		SELECT *
		FROM org WHERE 
		`delete` = 0 AND `Active` = 0
		ORDER by OrgName
		");
		$return = '';
		if($id == '') $return ="<option  value=''  selected='selected'>Please select a non-profit</option>";
		while($row = mysqli_fetch_assoc($query)){ 
		if($row['OrgID'] == $id) $class = ' class="chosen" selected=selected"" '; else $class='';
		$return .= "<option $class value='".$row['OrgID']."'>".stripslashes($row['OrgName'])."</option>";
		}
		return $return;
}
function statusList($id){
	$query = mysqli_query($GLOBALS['dblink'], "SELECT * FROM tbl_status");
	
	$return = '';
	if($id == '') $return = "<option value ='' selected='selected'>Please select an assignment status</option>";
	while($row = mysqli_fetch_assoc($query)){
		if ($row['status_id'] == $id) $class = ' class="chosen" selected=selected"" '; else $class='';
		$return .= "<option $class value='".$row['status_id']."'>".stripslashes($row['status_desc'])."</option>";	
	}
	return $return;	
}
function year($make, $model) {
	if(!empty($make)) $make = " AND make LIKE '$make' "; else $make ='';
	if(!empty($model)) $model = " AND model LIKE '$model' "; else $model ='';
	$query = mysqli_query($GLOBALS['dblink'], "
		SELECT year
		FROM cars  
		WHERE 1 =1 
		$model
		$make
		GROUP BY year
		ORDER by year DESC
		");
		$return ="<option value='' selected='selected'>Select a year</option>";
		$return .="<option value='' >Any Year</option>";
		while($row = mysqli_fetch_assoc($query)){ 
		$return .= "<option value='".$row['year']."'>".$row['year']."</option>";
		}
		return $return;
}
function make() {
	$query = mysqli_query($GLOBALS['dblink'], "
		SELECT make
		FROM cars  
		GROUP BY make
		ORDER by make ASC
		");
		$return ="<option value='' selected='selected'>Select a make</option>";
		while($row = mysqli_fetch_assoc($query)){ 
		$return .= "<option value='".$row['make']."'>".$row['make']."</option>";
		}
		return $return;
}
function makeNew() {
	$query = mysqli_query($GLOBALS['dblink'], "
		SELECT distinct MakeDesc
		FROM makecode
		ORDER by MakeDesc ASC
		");
	$return ="<option value='' selected='selected'></option>";
	while($row = mysqli_fetch_assoc($query)){
		$return .= "<option value='".$row['MakeDesc']."'>".$row['MakeDesc']."</option>";
	}
	return $return;
}
function makeWithCode($carSelected) {
	$makeQuery = mysqli_query($GLOBALS['dblink'], "
	SELECT distinct MakeDesc
	FROM makecode
	ORDER by MakeDesc ASC
	");
	$return = '';
// 	$return = '<span class="small"><select name="Make" id="Make">';
	
	if(strcmp(strtoupper(trim($carSelected)), '') == 0) {
		$flag = 0;
		while($makeRow = mysqli_fetch_assoc($makeQuery)) {
			$makeValue = $makeRow['MakeDesc'];
			if($flag === 0) {
				$return .= "<option value='' selected=\"selected\"></option>";
				$return .= "<option value=\"$makeValue\">$makeValue</option>";
				$flag = 1;
			} else {
				$return .= "<option value=\"$makeValue\">$makeValue</option>";
			}
		}
	} else {
		$flag = 0;
		$return .= "<option value='' selected=\"selected\"></option>";
		while($makeRow = mysqli_fetch_assoc($makeQuery)) {
			$makeValue = $makeRow['MakeDesc'];	
			if(strcmp(strtoupper(trim($makeValue)), strtoupper(trim($carSelected))) == 0) {
				if($flag === 0) {
					$return .= "<option value=\"$makeValue\" selected=\"selected\">$makeValue</option>";
					$flag = 1;
				}
			} else {
				$return .= "<option value=\"$makeValue\">$makeValue</option>";
			}
		}
		if($flag === 0) {
			$return .= "<option value='' selected=\"selected\"></option>";
			$flag = 1;
		}
	}
	
// 	$return .= "</select><label for=\"Make\">$dValue</label></span>";
	return $return;
}
function makeWithCodeN($carSelected) {
	$makeQuery = mysqli_query($GLOBALS['dblink'], "
	SELECT distinct MakeDesc
	FROM makecode
	ORDER by MakeDesc ASC
	");
	$return = '<span class="small"><select name="Make" id="Make">';
	if(strcmp(strtoupper(trim($carSelected)), '') == 0) {
		$flag = 0;
		while($makeRow = mysqli_fetch_assoc($makeQuery)) {
			$makeValue = $makeRow['MakeDesc'];
			if($flag === 0) {
				$return .= "<option value='' selected=\"selected\"></option>";
				$return .= "<option value=\"$makeValue\">$makeValue</option>";
				$flag = 1;
			} else {
				$return .= "<option value=\"$makeValue\">$makeValue</option>";
			}
		}
	} else {
		$flag = 0;
		$return .= "<option value='' selected=\"selected\"></option>";
		while($makeRow = mysqli_fetch_assoc($makeQuery)) {
			$makeValue = $makeRow['MakeDesc'];
			if(strcmp(strtoupper(trim($makeValue)), strtoupper(trim($carSelected))) == 0) {
				if($flag === 0) {
					$return .= "<option value=\"$makeValue\" selected=\"selected\">$makeValue</option>";
					$flag = 1;
				}
			} else {
				$return .= "<option value=\"$makeValue\">$makeValue</option>";
			}
		}
		if($flag === 0) {
			$return .= "<option value='' selected=\"selected\"></option>";
			$flag = 1;
		}
	}
	$return .= '</select><label for="Make"></label></span>';
	return $return;
}
function getMakeCode($id) {
	$code = '';
	$query = mysqli_query($GLOBALS['dblink'], "select MakeCode from makecode where MakeDesc = 
			(Select Make from `donor` where `DonationID` = \"$id\")");
	
	while($row = mysqli_fetch_assoc($query)) {
		$code = $row['MakeCode'];
	}
	return $code;
}
function model() {
	$query = mysqli_query($GLOBALS['dblink'], "
		SELECT model
		FROM cars  
		GROUP BY model
		ORDER by model ASC
		");
		$return ="<option value='' selected='selected'>Select a model</option>";
		while($row = mysqli_fetch_assoc($query)){ 
		$return .= "<option value='".$row['model']."'>".$row['model']."</option>";
		}
		return $return;
}
function updateNotes($id, $lotno, $newNotes) {
// 	@mysql_query("UPDATE donor set Notes = \"$newNotes\", RecordStatus = \"S\" where DonationID = \"$id\"");
	mysqli_query($GLOBALS['dblink'], "UPDATE `donor` set `Status` = \"S\" `SDA` = \"$lotno\", `Notes` = \"$newNotes\" where `DonationID` = \"$id\"");
}
function randString($length) {
	$char = "0123456789ABCDEFabcdef";
	$char = str_shuffle($char);
	for($i = 0, $rand = '', $l = strlen($char) - 1; $i < $length; $i ++) {
		$rand .= $char{mt_rand(0, $l)};
	}
	return $rand;
}
?>
