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

$database = new Database();
$db = $database->getConnection();
$reparoObj = new Reparo($db);

$dia = isset($_GET['dia']) ? $_GET['dia'] : die();
$mes = isset($_GET['mes']) ? $_GET['mes'] : die();
$ano = isset($_GET['ano']) ? $_GET['ano'] : die();
$produto = isset($_GET['produto']) ? $_GET['produto'] : die();
$estado = isset($_GET['estado']) ? $_GET['estado'] : die();

$mes2 = $mes + 1;
$ano2 = $ano - 1;
$data1 = $ano2."-".$mes2."-".$dia;
$data2 = $ano."-".$mes."-".$dia;

$reparoObj->datareparo1 = $data1;
$reparoObj->datareparo2 = $data2;
$reparoObj->estado = $estado;
$array_items = array();

if($produto == "HEA" or $produto == "SRAC" or $produto == "MWO"){
	if($produto == "SRAC"){
		$reparoObj->nomeproduto = $produto;
		$array_items = $reparoObj->readItemsbyNP(1);

	}elseif($produto == "MWO"){
		$reparoObj->nomeproduto = $produto;
		$array_items = $reparoObj->readItemsbyNP(2);
	}
	else{
		$reparoObj->nomeproduto = "SRAC";
		$array_items = $reparoObj->readItemsbyNP(1);
		$reparoObj->nomeproduto = "MWO";
		$array_items = array_merge($array_items,$reparoObj->readItemsbyNP(1));
	}
}else{
	$reparoObj->linhaproduto = $produto;
	$array_items = $reparoObj->readItemsbyLP();
}

$array_items = array_unique($array_items);

$item_arr=array();
$items_arr["records"]=array();
foreach ($array_items as $item) {
	
	$item_arr = array(
	    "nome" => $item
	);
	array_push($items_arr["records"], $item_arr);
}
 
print_r(json_encode($items_arr));
?>