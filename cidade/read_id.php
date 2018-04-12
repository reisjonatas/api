<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/cidade.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare cidade object
$cidade = new Cidade($db);
 
// set ID property of cidade to be edited
$cidade->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of cidade to be edited
$cidade->readId();
 
// create array
$cidade_arr = array(
    "id" =>  $cidade->id,
    "nome" => $cidade->nome,
	"estado" => $cidade->estadoId
);
 
// make it json format
print_r(json_encode($cidade_arr));
?>