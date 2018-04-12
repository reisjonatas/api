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
$item = isset($_GET['item']) ? $_GET['item'] : die();

$mes2 = $mes + 1;
$ano2 = $ano - 1;
$data1 = $ano2."-".$mes2."-1";
$data2 = $ano."-".$mes."-".$dia;

$reparoObj->datareparo1 = $data1;
$reparoObj->datareparo2 = $data2;
$reparoObj->estado = $estado;
$reparoObj->item = $item;
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

	

$total_arr=array();
$totais_arr["records"]=array();
$total_arr = array(
	"Atual" => $ffrAtual,
    "Anterior" => $ffrAnterior,
    "Improved" => $improved
);
array_push($totais_arr["records"], $total_arr);

print_r(json_encode($totais_arr));
?>