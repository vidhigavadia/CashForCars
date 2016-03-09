<?php

define('DB_HOST','localhost:3306');
define('DB_USER', 'root');
define('DB_PASSWORD','root');
define('DB_DATABASE','cwh');
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
if ($db === false){
		error_log("Common.php: MYSQL connect error: " . mysqli_connect_error());
}

/*try {
	global $db;
	$host = DB_HOST;  $dbname = DB_DATABASE;
	$db = new PDO("mysql:host=$host;dbname=$dbname", DB_USER,DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e){error_log('Something went wrong. Grab a cup of tea and contact the system admin.');} */

function getSFData() {



	$query ="select convert_from(decrypt(username,'iu8758SB*&%EGE$)kjkb7666klS472.?/:2Fr4DFJ2324saf&*(*%#@!^','aes'),'utf-8') as username , convert_from(decrypt(password,'iu8758SB*&%EGE$)kjkb7666klS472.?/:2Fr4DFJ2324saf&*(*%#@!^','aes'),'utf-8') as password, convert_from(decrypt(id,'iu8758SB*&%EGE$)kjkb7666klS472.?/:2Fr4DFJ2324saf&*(*%#@!^','aes'),'utf-8') as client_id , convert_from(decrypt(secret,'iu8758SB*&%EGE$)kjkb7666klS472.?/:2Fr4DFJ2324saf&*(*%#@!^','aes'),'utf-8') as client_secret from sf_data;"; 
$result = $db->query($query);
while ($row = $result->fetch_assoc()) {
//	$credentials[0]= $row['username'];
	//$credentials[1] =$row['pass'];
	return $row;
}

	
 
}
function insertAccessData($access,$url) {



	$time = date('Y-m-d H:i:s');
	
	 $stmt = "INSERT INTO access VALUES ('$access','$url','$time')";
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
	
	 $stmt = "UPDATE access SET token='$new_access' where token='$access'";
	
  if ($db->query($stmt) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $db->error;
}


 
}
?>
