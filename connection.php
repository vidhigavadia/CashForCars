<?php
define('SERVER_DOC_ROOT',$_SERVER['DOCUMENT_ROOT']);
$appDir = str_replace ($_SERVER['DOCUMENT_ROOT'], '', dirname($_SERVER['SCRIPT_FILENAME']));
error_reporting(E_ALL);
define('SERVER_URL','https://'.$_SERVER['SERVER_NAME']);
define('APP_URL',SERVER_URL.APP_FOL);
define('APP_DIR',SERVER_DOC_ROOT.APP_FOL);
define('SERVER_ADDRESS',$_SERVER['SERVER_NAME']);
define('PAGE_URL',"https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
include_once SERVER_DOC_ROOT.'/admin/includes/config.php';
include_once SERVER_DOC_ROOT.'/admin/includes/functions.php';
error_log("config: ".SERVER_DOC_ROOT.'/admin/includes/config.php');
error_log("function: ".SERVER_DOC_ROOT.'/admin/includes/functions.php');
function db_connect(){
	static $dbConnection;
	
	if(!isset($dbConnection)){
		$dbConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	}
	
	if ($dbConnection === false){
		error_log("Common.php: MYSQL connect error: " . mysqli_connect_error());
	}
	return $dbConnection;
}
?>
