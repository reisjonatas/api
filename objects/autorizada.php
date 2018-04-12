<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class autorizada{
 
    // autorizadabase connection and table name
    private $conn;
    private $table_name = "autorizada";
 
    // object properties
    public $id;
    public $nome;
  
    // constructor with $db as autorizadabase connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
	function readall(){
 
 	   // select all query
	    $query = "SELECT id,nome FROM autorizada";
        
 
	    // prepare query statement
	    $stmt = $this->conn->prepare($query);
 
	    // execute query
 	   $stmt->execute();
 
 	   return $stmt;
	}
	// used when filling up the update product form
	function readId(){
	 
		// query to read single record
		$query = "SELECT
					id,nome
				FROM
					autorizada
				WHERE
					id = ?";
	 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
	 
		// bind id of product to be updated
		$stmt->bindParam(1, $this->id);
	 
		// execute query
		$stmt->execute();
	 
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
		// set values to object properties
		$this->id = $row['id'];
		$this->nome = $row['nome'];
	}
}