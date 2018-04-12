<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/data.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$data = new Data($db);
 
// query products
$stmt = $data->readall();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $data_arr=array();
    $datas_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $data_item=array(
            "id" => $id,
            "dia" => $dia,
			"mes" => $mes,
			"ano" => $ano
        );
 
        array_push($datas_arr["records"], $data_item);
    }
 
    echo json_encode($datas_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>