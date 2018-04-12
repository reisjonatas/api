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
include_once '../objects/totalvenda.php';

$database = new Database();
$db = $database->getConnection();
$reparoObj = new Reparo($db);
$vendasObj = new vendas($db);

$dia = isset($_GET['dia']) ? $_GET['dia'] : die();
$mes = isset($_GET['mes']) ? $_GET['mes'] : die();
$ano = isset($_GET['ano']) ? $_GET['ano'] : die();
$produto = isset($_GET['produto']) ? $_GET['produto'] : die();
$anoOriginal = $ano;

$mes2 = $mes + 1;
$ano2 = $ano - 1;
$data1 = $ano2."-".$mes2."-1";
$data2 = $ano."-".$mes."-".$dia;

$reparoObj->datareparo1 = $data1;
$reparoObj->datareparo2 = $data2;
$vendasObj->datavenda1 = $data1;
$vendasObj->datavenda2 = $data2;
$array_items = array();
$array_items_anterior = array();

$totalAtual = 0;
$totalanterior = 0;
$totalvendaatual = 0;
$totalvendaanterior = 0;

if($produto == "HEA" or $produto == "SRAC" or $produto == "MWO"){
	if($produto == "SRAC" or $produto == "MWO"){
		$reparoObj->nomeproduto = $produto;
		$vendasObj->nomeproduto = $produto;
		$array_items = $reparoObj->readItemsTotalBrasilbyNP();
		$totalvendaatual = $vendasObj->readbyNP();

		$ano = $ano2;
		$ano2 = $ano2 - 1;
		$data1 = $ano2."-".$mes2."-1";
		$data2 = $ano."-".$mes."-".$dia;
		$reparoObj->datareparo1 = $data1;
		$reparoObj->datareparo2 = $data2;
		$vendasObj->datavenda1 = $data1;
		$vendasObj->datavenda2 = $data2;

		$array_items_anterior = $reparoObj->readItemsTotalBrasilbyNP();
		$totalvendaanterior = $vendasObj->readbyNP();
	}
	else{
		$reparoObj->nomeproduto = "SRAC";
		$vendasObj->nomeproduto = "SRAC";
		$array_items = $reparoObj->readItemsTotalBrasilbyNP();
		$totalvendaatual = $vendasObj->readbyNP();
		$reparoObj->nomeproduto = "MWO";
		$vendasObj->nomeproduto = "MWO";
		$array_items = array_merge($array_items,$reparoObj->readItemsTotalBrasilbyNP());
		$totalvendaatual += $vendasObj->readbyNP();

		$ano = $ano2;
		$ano2 = $ano2 - 1;
		$data1 = $ano2."-".$mes2."-1";
		$data2 = $ano."-".$mes."-".$dia;
		$reparoObj->datareparo1 = $data1;
		$reparoObj->datareparo2 = $data2;
		$vendasObj->datavenda1 = $data1;
		$vendasObj->datavenda2 = $data2;

		$reparoObj->nomeproduto = "SRAC";
		$vendasObj->nomeproduto = "SRAC";
		$array_items_anterior = $reparoObj->readItemsTotalBrasilbyNP();
		$totalvendaanterior = $vendasObj->readbyNP();
		$reparoObj->nomeproduto = "MWO";
		$vendasObj->nomeproduto = "MWO";
		$array_items_anterior = array_merge($array_items_anterior,$reparoObj->readItemsTotalBrasilbyNP());
		$totalvendaanterior += $vendasObj->readbyNP();


	}
}elseif($produto == "INVERTER" or $produto == "ONOFF" or $produto == "GRILL" or $produto == "SOLO"){
	$reparoObj->linhaproduto = $produto;
	$vendasObj->linhaproduto = $produto;
	$array_items = $reparoObj->readItemsTotalBrasilbyLP();
	$totalvendaatual = $vendasObj->readbyLP();

	$ano = $ano2;
	$ano2 = $ano2 - 1;
	$data1 = $ano2."-".$mes2."-1";
	$data2 = $ano."-".$mes."-".$dia;
	$reparoObj->datareparo1 = $data1;
	$reparoObj->datareparo2 = $data2;
	$vendasObj->datavenda1 = $data1;
	$vendasObj->datavenda2 = $data2;

	$array_items_anterior = $reparoObj->readItemsTotalBrasilbyLP();
	$totalvendaanterior = $vendasObj->readbyLP();
}elseif($produto == "SC" or $produto == "SH" or $produto == "SW"){
	$reparoObj->chassi = $produto;
	$vendasObj->nomeproduto= "SRAC";
	$array_items = $reparoObj->readItemsTotalBrasilbyCH();
	$totalvendaatual = $vendasObj->readbyNP();
	$ano = $ano2;
	$ano2 = $ano2 - 1;
	$data1 = $ano2."-".$mes2."-1";
	$data2 = $ano."-".$mes."-".$dia;
	$reparoObj->datareparo1 = $data1;
	$reparoObj->datareparo2 = $data2;
	$vendasObj->datavenda1 = $data1;
	$vendasObj->datavenda2 = $data2;
	$array_items_anterior = $reparoObj->readItemsTotalBrasilbyCH();
	$totalvendaanterior = $vendasObj->readbyNP();
	
}elseif($produto == "23" or $produto == "30" ){
	$reparoObj->litro = $produto;
	$vendasObj->nomeproduto = "MWO";
	$array_items = $reparoObj->readItemsTotalBrasilbyLI();
	$totalvendaatual = $vendasObj->readbyNP();
	$ano = $ano2;
	$ano2 = $ano2 - 1;
	$data1 = $ano2."-".$mes2."-1";
	$data2 = $ano."-".$mes."-".$dia;
	$reparoObj->datareparo1 = $data1;
	$reparoObj->datareparo2 = $data2;
	$vendasObj->datavenda1 = $data1;
	$vendasObj->datavenda2 = $data2;
	$array_items_anterior = $reparoObj->readItemsTotalBrasilbyLI();
	$totalvendaanterior = $vendasObj->readbyNP();
}


$item_arr=array();
$items_arr["records"]=array();
foreach ($array_items as $item_i) {
	$ffrAtual = ($item_i[1]/$totalvendaatual)*100;
	$ffrAnterior = 0;
	$serviceAtual = $item_i[1];
	$serviceAnterior = 0;
	foreach ($array_items_anterior as $item_j) {
		if($item_i[0] == $item_j[0]){
			$ffrAnterior = ( $item_j[1]/$totalvendaanterior)*100;
			$serviceAnterior =  $item_j[1];
			break;
		}
	}
	if($ffrAnterior == 0 and $ffrAtual == 0){
		$improved = 0;
	}else
		if($ffrAnterior == 0){
			$improved = -100;
		}else
		 if($ffrAtual==0){
		 	$improved = 100;
		 }else{
		 	$improved = (($ffrAnterior - $ffrAtual)/$ffrAnterior)*100;
		 }
	if($serviceAnterior == 0){
		$improvedS = -100*$serviceAtual;
	}else{
	 if($serviceAtual==0){
	 	$improvedS = 100;
	 }else{
	 	$improvedS = (($serviceAnterior - $serviceAtual)/$serviceAnterior)*100;
	 }
	}
	if($serviceAnterior == 0 and $serviceAtual == 0){
		$improvedS = 0;
	}
	$item_arr = array(
		"nome" => $item_i[0],
		"anoAnterior" => $ano,
		"anoAtual" => $ano+1,
		"valorAtual" => $ffrAtual,
	    "valorAnterior" => $ffrAnterior,
	    "improved" => $improved,
	    "valorAtualS" => $serviceAtual,
	    "valorAnteriorS" => $serviceAnterior,
	    "improvedS" => $improvedS
	);
	array_push($items_arr["records"], $item_arr);
}
print_r(json_encode($items_arr));
?>