<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/estado.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$estado = new Estado($db);
 
// query products
$stmt = $estado->readall();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $estados_arr=array();
    $estados_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $estado_item=array(
            "id" => $id,
            "nome" => $nome            
        );
 
        array_push($estados_arr["records"], $estado_item);
    }
 
    echo json_encode($estados_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>