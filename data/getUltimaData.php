<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/item.php';
include_once '../objects/reparo.php';
include_once '../objects/data.php';
include_once '../objects/estado.php';
include_once '../objects/nomeproduto.php';
include_once '../objects/linhaproduto.php';
include_once '../objects/cidade.php';
include_once '../objects/autorizada.php';
 
$database = new Database();
$db = $database->getConnection();
$reparoObj = new Reparo($db);


$ultimaData = $reparoObj->getUltimaData();

$item_arr=array();
$items_arr["records"]=array();
	
$item_arr = array(
    "data" => $ultimaData
);
array_push($items_arr["records"], $item_arr);

 
print_r(json_encode($items_arr));
?>