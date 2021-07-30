<?php 

namespace ZOV;

require_once "DB/TypePDO.php";
require_once "MyFirebase.php";
require_once "settings/settings.php";

// CONNECT DB
$typePDO = TYPE_PDO;
$nameDB = NAME_DB;//$_POST["name_db"]; // "laravel";
$host = HOST; //$_POST["host"]; // "localhost";
$adminDB = ADMIN_DB;//$_POST["admin_db"]; // "root";
$passwordDB = PASSWORD_DB;//$_POST["password_db"]; // ""

// CHARACTERS DB (TABLE,COLUMN).
$nameTableDB = NAME_TABLE_DB;
$ppk_id = PPK_ID_COLUMN_DB;
$address = ADDRESS_COLUMN_DB;
$isOn = IS_ON_COLUMN_DB;
$number_object = NUMBER_OBJECT_COLUMN_DB;
$latitudes = LATITUDE_COLUMN_DB;
$longitudes = LONGITUDE_COLUMN_DB;

// УНИКАЛЬНЫЙ ПРЕФИКС ЕЛЕМЕНТА СООТВЕТСТВИЮ PPK/ПУЛЬТУ
$type_pult = TYPE_PULT_FIREBASE;

// CHARACTERS DB REQUEST (COLUMN) Example: SELECT * FROM $nameTableDB WHERE requestIsOn = true;
$requestColumnIsOn = IS_EXISTS_IS_ON_COLUMN_DB; // Значение должно совпадать с isOn если есть такой столбец
$requestValueColumnIsOn = IS_ON_VALUE; // Вообщем над вытягивать данные у которых включена тревога НО эт если requestColumnIsOn cуществует в таблице. Example:"1","1.0","true",1,1.0,true

$values = $_POST["values"];
// Установка timezone Киев как основа
date_default_timezone_set('Europe/Kiev');
// PATH JSON 
$path = "google-service-account.json";

$typeHostNameDB = "";
if($typePDO == "mysql") {
  $typeHostNameDB = "{$typePDO}:host={$host};dbname={$nameDB}";
} elseif ($typePDO == "sqlsrv") {
  $typeHostNameDB = "{$typePDO}:Server={$host};Database={$nameDB}";	
} else {
  $typeHostNameDB = "{$typePDO}:host={$host};dbname={$nameDB}";
}

$myDb = new TypePDO($typeHostNameDB,$adminDB,$passwordDB);

$getListPPK = false;
if($requestColumnIsOn == $isOn) {
	$getListPPK = $myDb->getPPKWhere($nameTableDB,$requestColumnIsOn,$requestValueColumnIsOn);
} else {
	$getListPPK = $myDb->getPPK($nameTableDB);
}

if($getListPPK != false) {

	$myFirebase = new MyFirebase($path); 

	$iterationResultFalier = 0;
	$lenghtGetListPPK = 0;
	foreach($getListPPK as $ppk) {
		$lenghtGetListPPK++;

		$ppk_id_column = $ppk[$ppk_id];
		$address_column = $ppk[$address];
		$isOn_column = $ppk[$isOn];
		$number_object_column = $ppk[$number_object];
		$latitude_column = $ppk[$latitudes];
		$longitude_column = $ppk[$longitudes];

		if(!isset($ppk_id_column) || !isset($address_column)) {
			continue;
		}

		if(!isset($number_object_column)) {
			$number_object_column = "unknown";
		}

		if(!isset($isOn_column)) {
			$isOn_column = true;
		}

		if(!isset($latitude_column)) {
			$latitude_column = 0.0;
		}

		if(!isset($longitude_column)) {
			$longitude_column = 0.0;
		}

		if(is_numeric($isOn_column)) {
			if($isOn_column == 1 || $isOn_column == 1.0) {
				$isOn_column = true;
			} else {
				$isOn_column = false;
			}
		} elseif(is_bool($isOn_column) === true) {
			if($isOn_column) 
				$isOn_column = true;
			else 
				$isOn_column = false;
		} elseif (is_string($isOn_column)) {
			if($isOn_column == "1" || $isOn_column == "1.0" || $isOn_column == "true") {
				$isOn_column = true;
			} else {
				$isOn_column = false;
			}
		} else {
			$isOn_column = true;
		}

		if(!$isOn_column) {
			continue;
		}

		$timestamp = time() + 60*3; // now + 3 minutes

		$result = $myFirebase->setDocument(
				$ppk_id_column,
				$address_column,
				$isOn_column,
				$number_object_column,
				$latitude_column,
				$longitude_column,
				$type_pult,
				$timestamp
			);

		if(!$result) {
			$iterationResultFalier++;	
		}

	}

	if($iterationResultFalier == $lenghtGetListPPK) {
		$response["http_code"] = "500";
		echo json_encode($response);
	} else {
		$response["http_code"] = "200";
		echo json_encode($response);
	}
} else {
	$response["http_code"] = "500";
	echo json_encode($response);
}


