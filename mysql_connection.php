<?php

define('DB_HOST','localhost:3306');
define('DB_USER', 'root');
define('DB_PASSWORD','root');
define('DB_DATABASE','cwh');
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
if ($db === false){
		error_log("Common.php: MYSQL connect error: " . mysqli_connect_error());
}
 $key = '!@VWfekj5bwe^4db@M0pAkDk;ccnwd!``~][asdBm;<p';
/*try {
	global $db;
	$host = DB_HOST;  $dbname = DB_DATABASE;
	$db = new PDO("mysql:host=$host;dbname=$dbname", DB_USER,DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e){error_log('Something went wrong. Grab a cup of tea and contact the system admin.');} */

function getSFData() {



$query ="select CONVERT(AES_DECRYPT(username,'$key') using utf8) as username , CONVERT(AES_DECRYPT(password,'$key') using utf8) as password, CONVERT(AES_DECRYPT(id,'$key') using utf8) as client_id , CONVERT(AES_DECRYPT(secret,'$key') using utf8) as client_secret from sf_data;"; 
$result = $db->query($query);
while ($row = $result->fetch_assoc()) {
//	$credentials[0]= $row['username'];
	//$credentials[1] =$row['pass'];
	return $row;
}

	
 
}
function insertAccessData($access,$url) {



	$time = date('Y-m-d H:i:s');
	
	 $stmt = "INSERT INTO access VALUES (AES_ENCRYPT('$access','$key'),AES_ENCRYPT('$url','$key'),AES_ENCRYPT('$time','$key'))";
	 $retval = mysql_query( $stmt, $db );
  if($retval) {
      echo '1 row has been inserted';  
    }


	
 
}
function getAccessData() {

	$query ="select * from access";
$result = $db->query($query);
while ($row = $result->fetch_assoc()) {
//	$credentials[0]= $row['username'];
	//$credentials[1] =$row['pass'];
	return $row;
}

}
function updateAccessData($access,$new_access) {

	$time = date('Y-m-d H:i:s');
	
	 $stmt = "UPDATE access SET token=AES_ENCRYPT('$new_access','$key') where token=AES_ENCRYPT('$access','$key')";
	
  if ($db->query($stmt) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $db->error;
}


 
}
?>
