<?php

namespace ZOV;

require_once "MyFirebase.php";


$getData = json_decode(file_get_contents("php://input"));

//print_r($getData->data->array_ppk);
//echo '<pre>'.print_r(json_decode(file_get_contents("php://input")),1).'</pre>';

$dataMassive = $getData->data->array_ppk;
$ppk_id = $getData->data->ppk_id;
$address = $getData->data->address;
$isOn = $getData->data->isOn;
$number_object = $getData->data->number_object;
$latitude = $getData->data->latitude;
$longitude =$getData->data->longitude;
$type_pult = $getData->data->type_pult;

// Установка timezone Киев как основа
date_default_timezone_set('Europe/Kiev');

$path = "google-service-account.json";

$myFirebase = new MyFirebase($path); 

$iterationResultFalier = 0;
$lenghtGetListPPK = 0;

foreach($dataMassive as $item) {
    $lenghtGetListPPK++;
           
    $ppk_id_column = $item->$ppk_id;
    $address_column = $item->$address;
    $isOn_column = $item->$isOn;
    $number_object_column = $item->$number_object;
    $latitude_column = $item->$latitude;
    $longitude_column = $item->$longitude;

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