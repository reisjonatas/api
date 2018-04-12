<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/item.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare item object
$item = new Item($db);
 
// set ID property of item to be edited
$item->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of item to be edited
$item->readId();
 
// create array
$item_arr = array(
    "id" =>  $item->id,
    "nome" => $item->nome
);
 
// make it json format
print_r(json_encode($item_arr));
?>