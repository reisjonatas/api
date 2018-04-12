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

$dia = isset($_GET['dia']) ? $_GET['dia'] : die();
$mes = isset($_GET['mes']) ? $_GET['mes'] : die();
$ano = isset($_GET['ano']) ? $_GET['ano'] : die();
$produto = isset($_GET['produto']) ? $_GET['produto'] : die();
$item = isset($_GET['item']) ? $_GET['item'] : die();
$cidade = isset($_GET['cidade']) ? $_GET['cidade'] : die();

$mes2 = $mes + 1;
$ano2 = $ano - 1;
$data1 = $ano2."-".$mes2."-".$dia;
$data2 = $ano."-".$mes."-".$dia;

$reparoObj->datareparo1 = $data1;
$reparoObj->datareparo2 = $data2;
$reparoObj->cidade = $cidade;
$reparoObj->item = $item;
$array_items = array();

if($produto == "HEA" or $produto == "SRAC" or $produto == "MWO"){
	if($produto == "SRAC"){
		$reparoObj->nomeproduto = $produto;
		$array_items = $reparoObj->readAutorizadasBrasilbyNP();

	}elseif($produto == "MWO"){
		$reparoObj->nomeproduto = $produto;
		$array_items = $reparoObj->readAutorizadasBrasilbyNP();
	}
	else{
		$reparoObj->nomeproduto = "SRAC";
		$array_items = $reparoObj->readAutorizadasBrasilbyNP();
		$reparoObj->nomeproduto = "MWO";
		$array_items = array_merge($array_items,$reparoObj->readAutorizadasBrasilbyNP());
	}
}elseif($produto == "INVERTER" or $produto == "ONOFF" or $produto == "GRILL" or $produto == "SOLO"){
	$reparoObj->linhaproduto = $produto;
	$array_items = $reparoObj->readAutorizadasBrasilbyLP();
}elseif($produto == "SC" or $produto == "SH" or $produto == "SW"){
	$reparoObj->chassi = $produto;
	$array_items = $reparoObj->readAutorizadasBrasilbyCH();
	
}elseif($produto == "23" or $produto == "30"){
	$reparoObj->litro = $produto;
	$array_items = $reparoObj->readAutorizadasBrasilbyLI();
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