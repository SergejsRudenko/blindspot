<?php

require_once("./api.php");


function checkOrder($cookie) {
	GLOBAL $db_prefix, $database;

	$public_key = $cookie;

	$messages = sendEmail($cookie);
	// echo $messages . "</br>";

	// $data = $database->select($db_prefix . 'temp_orders', [
	// 	"id",
	// 	"public_key"
	// ],[
	// 	'AND'=>[
	//     	'public_key' => $public_key,
	//     ]
	// ]);

	// if ( count($data) > 0 ){

		// $database->delete($db_prefix . 'temp_orders', [
		// 	'AND' => [
		// 		'public_key' 	=> $public_key
		// 	]
		// ]);


		unsetCustomSession($cookie);

		// if ( isset($_SESSION['svg_file_id']) ) {
		// 	unset($_SESSION['svg_file_id']);
		// }

		unset($_COOKIE['pub_k']);
    	setcookie('pub_k', '', time() - 3600, '/');

    	// echo "DELETED";
    	exit;
	// }
}

$ses_id = $_GET['sess'];
if ($ses_id){
	$ses_id = explode("?", $ses_id);
	$ses_id = $ses_id[0];
}
$ses = getCustomSession($ses_id);
if (isset($ses) && $ses){
	checkOrder($ses_id);	
}


/*
function checkOrderSafari($cookie) {
	GLOBAL $db_prefix, $database;

	$public_key = $cookie;

	$messages = sendEmail($cookie);
	// echo $messages . "</br>";

	if ( isset($_SESSION['svg_file_id']) ) {
		unset($_SESSION['svg_file_id']);
	}

	unset($_COOKIE['p_key']);
	setcookie('p_key', '', time() - 3600, '/');

	// echo "DELETED";
	exit;
}



if ( isset($_COOKIE['pub_k']) && !empty($_COOKIE['pub_k']) ) {
	

	$file = fopen('referers/referers.txt','a');
	fwrite($file, $_SERVER['HTTP_REFERER']." - ".time()." ".date('d/m/Y', time())." - other - ".$_COOKIE['pub_k']."\n");
	fclose($file);

	// checkOrder($_COOKIE['pub_k']);

} else if ( isset($_COOKIE['p_key']) && !empty($_COOKIE['p_key']) ) {
	

	$file = fopen('referers/referers.txt','a');
	fwrite($file, $_SERVER['HTTP_REFERER']." - ".time()." ".date('d/m/Y', time())." - safari - ".$_COOKIE['p_key']."\n");
	fclose($file);

	checkOrderSafari($_COOKIE['p_key']);
} else {
	// echo "NOTHING";

	$file = fopen('referers/referers.txt','a');
	fwrite($file, $_SERVER['HTTP_REFERER']." - ".time()." ".date('d/m/Y', time())." - nothing"."\n");
	fclose($file);

	exit;
}
*/

?>