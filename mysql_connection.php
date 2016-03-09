<?php
function getSFData() {
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
try
{
	$db = new PDO($dsn);
	$query ="select convert_from(decrypt(username,'iu8758SB*&%EGE$)kjkb7666klS472.?/:2Fr4DFJ2324saf&*(*%#@!^','aes'),'utf-8') as username , convert_from(decrypt(password,'iu8758SB*&%EGE$)kjkb7666klS472.?/:2Fr4DFJ2324saf&*(*%#@!^','aes'),'utf-8') as password, convert_from(decrypt(id,'iu8758SB*&%EGE$)kjkb7666klS472.?/:2Fr4DFJ2324saf&*(*%#@!^','aes'),'utf-8') as client_id , convert_from(decrypt(secret,'iu8758SB*&%EGE$)kjkb7666klS472.?/:2Fr4DFJ2324saf&*(*%#@!^','aes'),'utf-8') as client_secret from sf_data;"; 
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
function insertAccessData($access,$url) {
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
try
{
	$db = new PDO($dsn);
	$time = date('Y-m-d H:i:s');
	
	 $stmt = $db->prepare("INSERT INTO access VALUES (:access, :url, :time)");
	
	$stmt->bindParam(':access', $access, PDO::PARAM_STR, 100);
    	$stmt->bindParam(':url', $url, PDO::PARAM_STR, 100);
	 $stmt->bindParam(':time', $time, PDO::PARAM_STR, 100);
  if($stmt->execute()) {
      echo '1 row has been inserted';  
    }
  $db = null;
//var_dump($credentials);
	
}
catch(PDOException $pe)
{
	die('Connection error, because: ' .$pe->getMessage());
}
 
}
function getAccessData() {
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
try
{
	$db = new PDO($dsn);
	$query ="select * from access";
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
function updateAccessData($access,$new_access) {
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
try
{
	$db = new PDO($dsn);
	$time = date('Y-m-d H:i:s');
	
	 $stmt = $db->prepare("UPDATE access SET token=".$new_access." where token=".$access);
	
  if($stmt->execute()) {
      echo '1 row has been inserted';  
    }
  $db = null;
//var_dump($credentials);
	
}
catch(PDOException $pe)
{
	die('Connection error, because: ' .$pe->getMessage());
}
 
}
?>
