<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class Vendas{
 
    // totalvendasbase connection and table name
    private $conn;
    private $table_name = "vendas";

    // object properties
    public $id;
    public $datavenda1;
    public $datavenda2;
	public $nomeproduto;
    public $linhaproduto;

    // constructor with $db as totalvendasbase connection
    public function __construct($db){
        $this->conn = $db;
    }

   function readTotal(){
        $query = "SELECT SUM(valor) as total FROM vendas where datavenda between ? and ?";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->datavenda1);
        $stmt->bindParam(2, $this->datavenda2);
        
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total'];
    }

    function readbyNP(){
        $query = "SELECT SUM(valor) as total FROM vendas where data = ? and nomeproduto = ?";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->datavenda2);
        $stmt->bindParam(2, $this->nomeproduto);
        
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total'];
    }
    function readbyLP(){
        $query = "SELECT valor as total FROM vendas where data = ? and linhaproduto = ?";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->datavenda2);
        $stmt->bindParam(2, $this->linhaproduto);
        
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total'];
    }
}