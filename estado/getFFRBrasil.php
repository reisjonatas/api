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
 
// get database connection
$database = new Database();
$db = $database->getConnection();
$reparoObj = new Reparo($db);
$vendasObj = new vendas($db);

$dia = isset($_GET['dia']) ? $_GET['dia'] : die();
$mes = isset($_GET['mes']) ? $_GET['mes'] : die();
$ano = isset($_GET['ano']) ? $_GET['ano'] : die();
$produto = isset($_GET['produto']) ? $_GET['produto'] : die();

$mes2 = $mes + 1;
$ano2 = $ano - 1;
$data1 = $ano2."-".$mes2."-1";
$data2 = $ano."-".$mes."-".$dia;

$reparoObj->datareparo1 = $data1;
$reparoObj->datareparo2 = $data2;
$vendasObj->datavenda1 = $data1;
$vendasObj->datavenda2 = $data2;

$totalAtual = 0;
$totalanterior = 0;
$totalvendaatual = 0;
$totalvendaanterior = 0;
if($produto == "HEA" or $produto == "SRAC" or $produto == "MWO"){
	if($produto == "SRAC" or $produto == "MWO"){
		$reparoObj->nomeproduto = $produto;
		$vendasObj->nomeproduto = $produto;
		$totalAtual = $reparoObj->readTotalBrasilbyNP();
		$totalvendaatual = $vendasObj->readbyNP();

		$ano = $ano2;
		$ano2 = $ano2 - 1;
		$data1 = $ano2."-".$mes2."-1";
		$data2 = $ano."-".$mes."-".$dia;
		$reparoObj->datareparo1 = $data1;
		$reparoObj->datareparo2 = $data2;
		$vendasObj->datavenda1 = $data1;
		$vendasObj->datavenda2 = $data2;

		$totalanterior = $reparoObj->readTotalBrasilbyNP();
		$totalvendaanterior = $vendasObj->readbyNP();


	}
	else{
		$reparoObj->nomeproduto = "SRAC";
		$vendasObj->nomeproduto = "SRAC";
		$totalAtual = $reparoObj->readTotalBrasilbyNP();
		$totalvendaatual = $vendasObj->readbyNP();
		$reparoObj->nomeproduto = "MWO";
		$vendasObj->nomeproduto = "MWO";
		$totalAtual += $reparoObj->readTotalBrasilbyNP();
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
		$totalanterior = $reparoObj->readTotalBrasilbyNP();
		$totalvendaanterior = $vendasObj->readbyNP();
		$reparoObj->nomeproduto = "MWO";
		$vendasObj->nomeproduto = "MWO";
		$totalanterior += $reparoObj->readTotalBrasilbyNP();
		$totalvendaanterior += $vendasObj->readbyNP();

	}
}elseif($produto == "INVERTER" or $produto == "ONOFF" or $produto == "GRILL" or $produto == "SOLO"){
	$reparoObj->linhaproduto = $produto;
	$vendasObj->linhaproduto = $produto;
	$totalAtual = $reparoObj->readTotalBrasilbyLP();
	$totalvendaatual = $vendasObj->readbyLP();
	$ano = $ano2;
	$ano2 = $ano2 - 1;
	$data1 = $ano2."-".$mes2."-1";
	$data2 = $ano."-".$mes."-".$dia;
	$reparoObj->datareparo1 = $data1;
	$reparoObj->datareparo2 = $data2;
	$vendasObj->datavenda1 = $data1;
	$vendasObj->datavenda2 = $data2;
	$totalanterior = $reparoObj->readTotalBrasilbyLP();
	$totalvendaanterior = $vendasObj->readbyLP();
}elseif($produto == "SC" or $produto == "SH" or $produto == "SW"){
	$reparoObj->chassi = $produto;
	$vendasObj->nomeproduto = "SRAC";
	$totalAtual = $reparoObj->readTotalBrasilbyCH();
	$totalvendaatual = $vendasObj->readbyNP();
	$ano = $ano2;
	$ano2 = $ano2 - 1;
	$data1 = $ano2."-".$mes2."-1";
	$data2 = $ano."-".$mes."-".$dia;
	$reparoObj->datareparo1 = $data1;
	$reparoObj->datareparo2 = $data2;
	$vendasObj->datavenda1 = $data1;
	$vendasObj->datavenda2 = $data2;
	$totalanterior = $reparoObj->readTotalBrasilbyCH();
	$totalvendaanterior = $vendasObj->readbyNP();
	
}elseif($produto == "23L" or $produto == "30L" ){
	$reparoObj->litro = $produto;
	$vendasObj->nomeproduto = "MWO";
	$totalAtual = $reparoObj->readTotalBrasilbyLI();
	$totalvendaatual = $vendasObj->readbyNP();
	$ano = $ano2;
	$ano2 = $ano2 - 1;
	$data1 = $ano2."-".$mes2."-1";
	$data2 = $ano."-".$mes."-".$dia;
	$reparoObj->datareparo1 = $data1;
	$reparoObj->datareparo2 = $data2;
	$vendasObj->datavenda1 = $data1;
	$vendasObj->datavenda2 = $data2;
	$totalanterior = $reparoObj->readTotalBrasilbyLI();
	$totalvendaanterior = $vendasObj->readbyNP();
}	
try {
	if($totalvendaatual == 0){
		$ffrAtual = 0;
	}else{
		 $ffrAtual = ($totalAtual/$totalvendaatual)*100;
	}
  
}
catch(ErrorException $e){
    $ffrAtual = 0;
}

try {
   if($totalvendaanterior == 0){
   	  $ffrAnterior = 0;
   }else{
   	  $ffrAnterior = ($totalanterior/$totalvendaanterior)*100;
   }
   
}
catch(ErrorException $e){
    $ffrAnterior = 0;
}

if($ffrAnterior == $ffrAtual and $ffrAnterior = 0){
	$improved = 0;
}else{
	if($ffrAnterior == 0){
		$improved = -100;
	}else
	 if($ffrAtual==0){
	 	$improved = 100;
	 }else{
	 	$improved = (($ffrAnterior - $ffrAtual)/$ffrAnterior)*100;
	 }
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