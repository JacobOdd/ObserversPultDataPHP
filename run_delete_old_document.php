<?php 

namespace ZOV;

require_once "MyFirebase.php";

$values = $_POST["values"];
// Установка timezone Киев как основа
date_default_timezone_set('Europe/Kiev');

$path = "google-service-account.json";

$myFirebase = new MyFirebase($path); 

$timestamp = time();

$responseMethod = $myFirebase->deleteDocument($timestamp);

if($responseMethod) {
	$response["http_code"] = "200";
	echo json_encode($response);
} else {
	$response["http_code"] = "500";
	echo json_encode($response);
}



