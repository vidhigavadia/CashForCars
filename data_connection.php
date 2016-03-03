<?php

require_once 'vendor/autoload.php';
$app = new Silex\Application();
$app['debug'] = true;
$dbopts = parse_url(getenv('DATABASE_URL'));

$dsn = 'pgsql:'
    . 'host='.$dbopts["host"]. ';'
    . 'dbname='.ltrim($dbopts["path"],'/').';'
    . 'user='.$dbopts["user"].';'
    . 'port=' . $dbopts["port"].';'
    . 'sslmode=require;'
    . 'password='. $dbopts["pass"];
function getSFCredentials() {

try
{
	$db = new PDO($dsn);
	$query = "select username , convert_from(decrypt(password,'d0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282','aes'),'utf-8') as pass from credentials;";
$result = $db->query($query);
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
//	$credentials[0]= $row['username'];
	//$credentials[1] =$row['pass'];
	return $row;
}
$result->closeCursor();
//var_dump($credentials);
	
}
catch(PDOException $pe)
{
	die('Connection error, because: ' .$pe->getMessage());
}
 

}


function getSFData() {

try
{
	$db = new PDO($dsn);
	$query = "select convert_from(decrypt(id,'iu8758SB*&%EGE$)kjkb7666klS472.?/:2Fr4DFJ2324saf&*(*%#@!^','aes'),'utf-8') as client_id , convert_from(decrypt(secret,'iu8758SB*&%EGE$)kjkb7666klS472.?/:2Fr4DFJ2324saf&*(*%#@!^','aes'),'utf-8') as client_secret from client_values;";
  $result = $db->query($query);
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
return $row;
}
$result->closeCursor();

	
}
catch(PDOException $pe)
{
	die('Connection error, because: ' .$pe->getMessage());
}
 

}


?>
