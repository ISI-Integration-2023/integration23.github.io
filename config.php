<?php
//$ROOT_PATH = $_SERVER['DOCUMENT_ROOT'];

$ROOT_PATH = '/user1/others/integration/public_html/';


$GLOBALS['ROOT_PATH_GLOBAL'] = $ROOT_PATH;

$HTTP_HOST = 'https://'.$_SERVER['HTTP_HOST'].'/~integration';

$ADMIN_USER = "cazzedadmin";
$ADMIN_PASS = "pi314159";

$SENDGRID_APIKEY = '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';  // mail server api


$timestamp = (int)(date('i'));

/*if ($timestamp % 2 == 0) {
	$SENDGRID_APIKEY = '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';  // 
	}
else {
	$SENDGRID_APIKEY = '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';  // need to create a new mail api
}*/



//echo($SENDGRID_APIKEY);


?>
