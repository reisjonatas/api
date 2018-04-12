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
$estado = isset($_GET['estado']) ? $_GET['estado'] : die();

$anoOriginal = $ano;

$mes2 = $mes + 1;
$ano2 = $ano - 1;
$data1 = $ano2."-".$mes2."-1";
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

foreach ($array_items as $item_i) {
	$ano = $anoOriginal;
	$mes2 = $mes + 1;
	$ano2 = $ano - 1;
	$data1 = $ano2."-".$mes2."-1";
	$data2 = $ano."-".$mes."-".$dia;
	$reparoObj->item = $item_i;
	$reparoObj->datareparo1 = $data1;
	$reparoObj->datareparo2 = $data2;
	$vendasObj->datavenda1 = $data1;
	$vendasObj->datavenda2 = $data2;
	$np = true;
	$totalAtual = 0;
	$totalanterior = 0;
	$totalvendaatual = 0;
	$totalvendaanterior = 0;
	if($produto == "HEA" or $produto == "SRAC" or $produto == "MWO"){
		if($produto == "SRAC"){
			$reparoObj->nomeproduto = $produto;
			$vendasObj->nomeproduto = $produto;
			$totalAtual = $reparoObj->readTotalbyItemNP(1);
			$totalvendaatual = $vendasObj->readbyNP();

			$ano = $ano2;
			$ano2 = $ano2 - 1;
			$data1 = $ano2."-".$mes2."-1";
			$data2 = $ano."-".$mes."-".$dia;
			$reparoObj->datareparo1 = $data1;
			$reparoObj->datareparo2 = $data2;
			$vendasObj->datavenda1 = $data1;
			$vendasObj->datavenda2 = $data2;

			$totalanterior = $reparoObj->readTotalbyItemNP(1);
			$totalvendaanterior = $vendasObj->readbyNP();


		}elseif($produto == "MWO"){
			$reparoObj->nomeproduto = $produto;
			$vendasObj->nomeproduto = $produto;
			$totalAtual = $reparoObj->readTotalbyItemNP(2);
			$totalvendaatual = $vendasObj->readbyNP();

			$ano = $ano2;
			$ano2 = $ano2 - 1;
			$data1 = $ano2."-".$mes2."-1";
			$data2 = $ano."-".$mes."-".$dia;
			$reparoObj->datareparo1 = $data1;
			$reparoObj->datareparo2 = $data2;
			$vendasObj->datavenda1 = $data1;
			$vendasObj->datavenda2 = $data2;

			$totalanterior = $reparoObj->readTotalbyItemNP(2);
			$totalvendaanterior = $vendasObj->readbyNP();
		}
		else{
			$reparoObj->nomeproduto = "SRAC";
			$vendasObj->nomeproduto = "SRAC";
			$totalAtual = $reparoObj->readTotalbyItemNP(1);
			$totalvendaatual = $vendasObj->readbyNP();
			$reparoObj->nomeproduto = "MWO";
			$vendasObj->nomeproduto = "MWO";
			$totalAtual += $reparoObj->readTotalbyItemNP(1);
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
			$totalanterior = $reparoObj->readTotalbyItemNP(1);
			$totalvendaanterior = $vendasObj->readbyNP();
			$reparoObj->nomeproduto = "MWO";
			$vendasObj->nomeproduto = "MWO";
			$totalanterior += $reparoObj->readTotalbyItemNP(1);
			$totalvendaanterior += $vendasObj->readbyNP();
		}
	}else{
		$reparoObj->linhaproduto = $produto;
		$vendasObj->linhaproduto = $produto;
		$totalAtual = $reparoObj->readTotalbyItemLP();
		$totalvendaatual = $vendasObj->readbyLP();
		$ano = $ano2;
		$ano2 = $ano2 - 1;
		$data1 = $ano2."-".$mes2."-1";
		$data2 = $ano."-".$mes."-".$dia;
		$reparoObj->datareparo1 = $data1;
		$reparoObj->datareparo2 = $data2;
		$vendasObj->datavenda1 = $data1;
		$vendasObj->datavenda2 = $data2;
		$totalanterior = $reparoObj->readTotalbyItemLP();
		$totalvendaanterior = $vendasObj->readbyLP();
	}
	try {
	   $ffrAtual = ($totalAtual/$totalvendaatual)*100;
	}
	catch(DivisionByZeroError $e){
	    $ffrAtual = 0;
	}

	try {
	   $ffrAnterior = ($totalanterior/$totalvendaanterior)*100;
	}
	catch(DivisionByZeroError $e){
	    $ffrAnterior = 0;
	}

	if($ffrAnterior == $ffrAtual and $ffrAnterior = 0){
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

	$item_arr = array(
		"nome" => $item_i,
		"anoAnterior" => $ano,
		"anoAtual" => $ano+1,
		"valorAtual" => $ffrAtual,
	    "valorAnterior" => $ffrAnterior,
	    "improved" => $improved
	);
	array_push($items_arr["records"], $item_arr);
}
 
print_r(json_encode($items_arr));
?>