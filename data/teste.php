<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/data.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare data object
$data = new Data($db);
 
// set ID property of data to be edited
$data->dia = isset($_GET['dia']) ? $_GET['dia'] : die();
$data->mes = isset($_GET['mes']) ? $_GET['mes'] : die();
$data->ano = isset($_GET['ano']) ? $_GET['ano'] : die();
// read the details of data to be edited

$data->readId();
 
// create array
$data_arr = array(
    "id" =>  $data->id
);
 
// make it json format
print_r(json_encode($data_arr));
?>