<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class Data{
 
    // database connection and table name
    private $conn;
    private $table_name = "data";
 
    // object properties
    public $id;
    public $dia;
    public $mes;
    public $ano;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
	function readall(){
 
 	   // select all query
	    $query = "SELECT id, dia, mes, ano FROM data where id = (select MAX(id) from data)";
        
 
	    // prepare query statement
	    $stmt = $this->conn->prepare($query);
 
	    // execute query
 	   $stmt->execute();
 
 	   return $stmt;
	}
    function readId(){
     
        // query to read single record
        $query = "SELECT
                    id
                FROM
                    data
                WHERE
                    dia = ? and mes = ? and ano = ?";
     
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
     
        // bind id of product to be updated
        

        $stmt->bindParam(1, $this->dia);
        $stmt->bindParam(2, $this->mes);
        $stmt->bindParam(3, $this->ano);
     
        // execute query
        $stmt->execute();
     
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        // set values to object properties
        $this->id = $row['id'];
    }
}