<?php

//namespace ZOV;

require_once "DB/cParadox.php";
require_once "MyFirebase.php";
require_once "settings/settings.php";


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

$values = $_POST["values"];
// Установка timezone Киев как основа
date_default_timezone_set('Europe/Kiev');

$path = "google-service-account.json";

$pdx = new cParadox();
$pdx->m_default_field_value = "?";//" ";

if ($pdx->Open($nameTableDB)) {
     $tot_rec = $pdx->GetNumRecords();
    if ($tot_rec) {

        $myFirebase = new MyFirebase($path); 

        $iterationResultFalier = 0;
        $lenghtGetListPPK = 0;
        for($rec=0; $rec<$tot_rec; $rec++) {
            $lenghtGetListPPK++;
           /*
            print_r($item);
            echo "<tr>";
            echo "<td>" . $rec;
            echo "<td>" . $item['EVENTTIME'];
            echo "<td>" . $item['ACCOUNT'];
            echo "<td>" . $item['EVENT'];
            */
            $item = $pdx->GetRecord($rec);

            $ppk_id_column = $item[$ppk_id];
            $address_column = $item[$address];
            $isOn_column = $item[$isOn];
            $number_object_column = $item[$number_object];
            $latitude_column = $item[$latitudes];
            $longitude_column = $item[$longitudes];

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

            if($requestColumnIsOn == $isOn) {
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

        } // end for

        if($iterationResultFalier == $lenghtGetListPPK) {
            $response["http_code"] = "500";
            echo json_encode($response);
        } else {
            $response["http_code"] = "200";
            echo json_encode($response);
        }
    } else {
        $response["message"] = "Empty Table";
        echo json_encode($response);
    }
    $pdx->Close(); 
} else {
	$response["http_code"] = "500";
	echo json_encode($response);
}
