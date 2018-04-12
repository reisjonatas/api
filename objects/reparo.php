<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class Reparo{
 
    // datareparobase connection and table name
    private $conn;
    private $table_name = "reparo";
 
    // object properties
    public $id;
    public $item;
    public $cidade;
    public $estado;
    public $autorizada;
    public $nomeproduto;
    public $linhaproduto;
	public $chassi;
	public $litro;
	
	public $datareparo1;
	public $datareparo2;
  
    // constructor with $db as datareparobase connection
    public function __construct($db){
        $this->conn = $db;
    }
    function readItemsTotalbyNP(){
        $aux = false;
        $query = "SELECT item,count(item) as total  FROM reparo where nomeproduto = ? and (datareparo BETWEEN ? and ?) and estado = ? and (datavenda BETWEEN ? and ?) GROUP BY item ORDER BY COUNT(item) DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->nomeproduto);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->estado);
        $stmt->bindParam(5, $this->datareparo1);
        $stmt->bindParam(6, $this->datareparo2);
        
        
        $stmt->execute();

        $num = $stmt->rowCount();

        $items = array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row); 
                $datareparo_item=array();       
                array_push($datareparo_item, $item);
                array_push($datareparo_item, $total);
                array_push($items,$datareparo_item);
            }
        }     

        return $items;
    }

    function readItemsTotalbyLP(){
        $aux = false;
        $query = "SELECT item,count(item) as total  FROM reparo where linhaproduto = ? and (datareparo BETWEEN ? and ?) and estado = ? and (datavenda BETWEEN ? and ?) GROUP BY item ORDER BY COUNT(item) DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->linhaproduto);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->estado);
        $stmt->bindParam(5, $this->datareparo1);
        $stmt->bindParam(6, $this->datareparo2);
        
        
        $stmt->execute();

        $num = $stmt->rowCount();
        
        $items = array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row); 
                $datareparo_item=array();       
                array_push($datareparo_item, $item);
                array_push($datareparo_item, $total);
                array_push($items,$datareparo_item);
            }
        }     

        return $items;
    }
	
	function readItemsTotalbyCH(){
        $aux = false;
        $query = "SELECT item,count(item) as total  FROM reparo where chassi = ? and (datareparo BETWEEN ? and ?) and estado = ? and (datavenda BETWEEN ? and ?) GROUP BY item ORDER BY COUNT(item) DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->chassi);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->estado);
        $stmt->bindParam(5, $this->datareparo1);
        $stmt->bindParam(6, $this->datareparo2);
        
        
        $stmt->execute();

        $num = $stmt->rowCount();

        $items = array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row); 
                $datareparo_item=array();       
                array_push($datareparo_item, $item);
                array_push($datareparo_item, $total);
                array_push($items,$datareparo_item);
            }
        }     

        return $items;
    }

    function readItemsTotalbyLI(){
        $aux = false;
        $query = "SELECT item,count(item) as total  FROM reparo where litro= ? and (datareparo BETWEEN ? and ?) and estado = ? and (datavenda BETWEEN ? and ?) GROUP BY item ORDER BY COUNT(item) DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->litro);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->estado);
        $stmt->bindParam(5, $this->datareparo1);
        $stmt->bindParam(6, $this->datareparo2);
        
        
        $stmt->execute();

        $num = $stmt->rowCount();
        
        $items = array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row); 
                $datareparo_item=array();       
                array_push($datareparo_item, $item);
                array_push($datareparo_item, $total);
                array_push($items,$datareparo_item);
            }
        }     

        return $items;
    }
    function readItemsTotalBrasilbyNP(){
        $aux = false;
        $query = "SELECT item,count(item) as total  FROM reparo where nomeproduto = ? and (datareparo BETWEEN ? and ?) and (datavenda BETWEEN ? and ?) GROUP BY item ORDER BY COUNT(item) DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->nomeproduto);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->datareparo1);
        $stmt->bindParam(5, $this->datareparo2);
        
        
        $stmt->execute();

        $num = $stmt->rowCount();

        $items = array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row); 
                $datareparo_item=array();       
                array_push($datareparo_item, $item);
                array_push($datareparo_item, $total);
                array_push($items,$datareparo_item);
            }
        }     

        return $items;
    }

    function readItemsTotalBrasilbyLP(){
        $aux = false;
        $query = "SELECT item,count(item) as total  FROM reparo where linhaproduto = ? and (datareparo BETWEEN ? and ?) and (datavenda BETWEEN ? and ?) GROUP BY item ORDER BY COUNT(item) DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->linhaproduto);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->datareparo1);
        $stmt->bindParam(5, $this->datareparo2);
        
        
        $stmt->execute();

        $num = $stmt->rowCount();
        
        $items = array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row); 
                $datareparo_item=array();       
                array_push($datareparo_item, $item);
                array_push($datareparo_item, $total);
                array_push($items,$datareparo_item);
            }
        }     

        return $items;
    }
	
	function readItemsTotalBrasilbyCH(){
        $aux = false;
        $query = "SELECT item,count(item) as total  FROM reparo where chassi = ? and (datareparo BETWEEN ? and ?) and (datavenda BETWEEN ? and ?) GROUP BY item ORDER BY COUNT(item) DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->chassi);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->datareparo1);
        $stmt->bindParam(5, $this->datareparo2);
        
        
        $stmt->execute();

        $num = $stmt->rowCount();

        $items = array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row); 
                $datareparo_item=array();       
                array_push($datareparo_item, $item);
                array_push($datareparo_item, $total);
                array_push($items,$datareparo_item);
            }
        }     

        return $items;
    }

    function readItemsTotalBrasilbyLI(){
        $aux = false;
        $query = "SELECT item,count(item) as total  FROM reparo where litro = ? and (datareparo BETWEEN ? and ?) and (datavenda BETWEEN ? and ?) GROUP BY item ORDER BY COUNT(item) DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->litro);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->datareparo1);
        $stmt->bindParam(5, $this->datareparo2);
        
        
        $stmt->execute();

        $num = $stmt->rowCount();
        
        $items = array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row); 
                $datareparo_item=array();       
                array_push($datareparo_item, $item);
                array_push($datareparo_item, $total);
                array_push($items,$datareparo_item);
            }
        }     

        return $items;
    }

    function readCidadesbyNP(){
        
        $query = "SELECT cidade, count(item) FROM reparo where nomeproduto = ? and (datareparo BETWEEN ? and ?) and estado = ? and item = ? and (datavenda BETWEEN ? and ?) GROUP by cidade ORDER by count(item) DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->nomeproduto);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->estado);
        $stmt->bindParam(5, $this->item);
        $stmt->bindParam(6, $this->datareparo1);
        $stmt->bindParam(7, $this->datareparo2);
        
        
        $stmt->execute();

        $num = $stmt->rowCount();

        $datareparo_cidade=array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);         
                if(in_array($cidade, $datareparo_cidade) == false){
                    array_push($datareparo_cidade, $cidade);
                }
            }
        }

        return $datareparo_cidade;
    }

    function readCidadesbyLP(){     
        $query = "SELECT cidade, count(item) FROM reparo where linhaproduto = ? and (datareparo BETWEEN ? and ?) and estado = ? and item = ? and (datavenda BETWEEN ? and ?) GROUP by cidade ORDER by count(item) DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->linhaproduto);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->estado);
        $stmt->bindParam(5, $this->item);
        $stmt->bindParam(6, $this->datareparo1);
        $stmt->bindParam(7, $this->datareparo2);
               
        $stmt->execute();

        $num = $stmt->rowCount();

        $datareparo_cidade=array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);         
                if(in_array($cidade, $datareparo_cidade) == false){
                    array_push($datareparo_cidade, $cidade);
                }
            }
        }

        return $datareparo_cidade;
    }
	function readCidadesbyCH(){
        
        $query = "SELECT cidade, count(item) FROM reparo where chassi = ? and (datareparo BETWEEN ? and ?) and estado = ? and item = ? and (datavenda BETWEEN ? and ?) GROUP by cidade ORDER by count(item) DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->chassi);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->estado);
        $stmt->bindParam(5, $this->item);
        $stmt->bindParam(6, $this->datareparo1);
        $stmt->bindParam(7, $this->datareparo2);
        
        
        $stmt->execute();

        $num = $stmt->rowCount();

        $datareparo_cidade=array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);         
                if(in_array($cidade, $datareparo_cidade) == false){
                    array_push($datareparo_cidade, $cidade);
                }
            }
        }

        return $datareparo_cidade;
    }

    function readCidadesbyLI(){     
        $query = "SELECT cidade, count(item) FROM reparo where litro = ? and (datareparo BETWEEN ? and ?) and estado = ? and item = ? and (datavenda BETWEEN ? and ?) GROUP by cidade ORDER by count(item) DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->litro);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->estado);
        $stmt->bindParam(5, $this->item);
        $stmt->bindParam(6, $this->datareparo1);
        $stmt->bindParam(7, $this->datareparo2);
               
        $stmt->execute();

        $num = $stmt->rowCount();

        $datareparo_cidade=array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);         
                if(in_array($cidade, $datareparo_cidade) == false){
                    array_push($datareparo_cidade, $cidade);
                }
            }
        }

        return $datareparo_cidade;
    }

    function readCidadesBrasilbyNP(){
        
        $query = "SELECT cidade, count(item) FROM reparo where nomeproduto = ? and (datareparo BETWEEN ? and ?) and item = ? and (datavenda BETWEEN ? and ?) GROUP by cidade ORDER by count(item) DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->nomeproduto);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->item);
        $stmt->bindParam(5, $this->datareparo1);
        $stmt->bindParam(6, $this->datareparo2);
        
        
        $stmt->execute();

        $num = $stmt->rowCount();

        $datareparo_cidade=array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);         
                if(in_array($cidade, $datareparo_cidade) == false){
                    array_push($datareparo_cidade, $cidade);
                }
            }
        }

        return $datareparo_cidade;
    }

    function readCidadesBrasilbyLP(){     
        $query = "SELECT cidade, count(item) FROM reparo where linhaproduto = ? and (datareparo BETWEEN ? and ?) and item = ? and (datavenda BETWEEN ? and ?) GROUP by cidade ORDER by count(item) DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->linhaproduto);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->item);
        $stmt->bindParam(5, $this->datareparo1);
        $stmt->bindParam(6, $this->datareparo2);
               
        $stmt->execute();

        $num = $stmt->rowCount();

        $datareparo_cidade=array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);         
                if(in_array($cidade, $datareparo_cidade) == false){
                    array_push($datareparo_cidade, $cidade);
                }
            }
        }

        return $datareparo_cidade;
    }
	
	function readCidadesBrasilbyCH(){
        
        $query = "SELECT cidade, count(item) FROM reparo where chassi = ? and (datareparo BETWEEN ? and ?) and item = ? and (datavenda BETWEEN ? and ?) GROUP by cidade ORDER by count(item) DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->chassi);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->item);
        $stmt->bindParam(5, $this->datareparo1);
        $stmt->bindParam(6, $this->datareparo2);
        
        
        $stmt->execute();

        $num = $stmt->rowCount();

        $datareparo_cidade=array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);         
                if(in_array($cidade, $datareparo_cidade) == false){
                    array_push($datareparo_cidade, $cidade);
                }
            }
        }

        return $datareparo_cidade;
    }

    function readCidadesBrasilbyLI(){     
        $query = "SELECT cidade, count(item) FROM reparo where litro = ? and (datareparo BETWEEN ? and ?) and item = ? and (datavenda BETWEEN ? and ?) GROUP by cidade ORDER by count(item) DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->litro);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->item);
        $stmt->bindParam(5, $this->datareparo1);
        $stmt->bindParam(6, $this->datareparo2);
               
        $stmt->execute();

        $num = $stmt->rowCount();

        $datareparo_cidade=array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);         
                if(in_array($cidade, $datareparo_cidade) == false){
                    array_push($datareparo_cidade, $cidade);
                }
            }
        }

        return $datareparo_cidade;
    }

    function readAutorizadasbyNP(){
        
            $query = "SELECT autorizada FROM reparo where nomeproduto = ? and (datareparo BETWEEN ? and ?) and estado = ? and item = ? and cidade = ? and (datavenda BETWEEN ? and ?)";
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(1, $this->nomeproduto);
            $stmt->bindParam(2, $this->datareparo1);
			$stmt->bindParam(3, $this->datareparo2);
            $stmt->bindParam(4, $this->estado);
            $stmt->bindParam(5, $this->item);
			$stmt->bindParam(6, $this->cidade);
            $stmt->bindParam(7, $this->datareparo1);
            $stmt->bindParam(8, $this->datareparo2);
        
        
        $stmt->execute();

        $num = $stmt->rowCount();

        $datareparo_autorizada=array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);         
                if(in_array($autorizada, $datareparo_autorizada) == false){
                    array_push($datareparo_autorizada, $autorizada);
                }
            }
        }

        return $datareparo_autorizada;
    }

    function readAutorizadasbyLP(){
        $query = "SELECT autorizada FROM reparo where linhaproduto = ? and (datareparo BETWEEN ? and ?) and estado = ? and item = ? and cidade = ? and (datavenda BETWEEN ? and ?)";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->linhaproduto);
        $stmt->bindParam(2, $this->datareparo1);
		$stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->estado);
		$stmt->bindParam(5, $this->item);
		$stmt->bindParam(6, $this->cidade);
        $stmt->bindParam(7, $this->datareparo1);
        $stmt->bindParam(8, $this->datareparo2);
               
        $stmt->execute();

        $num = $stmt->rowCount();

        $datareparo_autorizada=array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);         
                if(in_array($autorizada, $datareparo_autorizada) == false){
                    array_push($datareparo_autorizada, $autorizada);
                }
            }
        }

        return $datareparo_autorizada;
    }

    function readAutorizadasBrasilbyNP(){
        
            $query = "SELECT autorizada FROM reparo where nomeproduto = ? and (datareparo BETWEEN ? and ?) and item = ? and cidade = ? and (datavenda BETWEEN ? and ?)";
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(1, $this->nomeproduto);
            $stmt->bindParam(2, $this->datareparo1);
            $stmt->bindParam(3, $this->datareparo2);
            $stmt->bindParam(4, $this->item);
            $stmt->bindParam(5, $this->cidade);
            $stmt->bindParam(6, $this->datareparo1);
            $stmt->bindParam(7, $this->datareparo2);
        
        
        $stmt->execute();

        $num = $stmt->rowCount();

        $datareparo_autorizada=array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);         
                if(in_array($autorizada, $datareparo_autorizada) == false){
                    array_push($datareparo_autorizada, $autorizada);
                }
            }
        }

        return $datareparo_autorizada;
    }

    function readAutorizadasBrasilbyLP(){
        $query = "SELECT autorizada FROM reparo where linhaproduto = ? and (datareparo BETWEEN ? and ?)  and item = ? and cidade = ? and (datavenda BETWEEN ? and ?)";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->linhaproduto);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->item);
        $stmt->bindParam(5, $this->cidade);
        $stmt->bindParam(6, $this->datareparo1);
        $stmt->bindParam(7, $this->datareparo2);
               
        $stmt->execute();

        $num = $stmt->rowCount();

        $datareparo_autorizada=array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);         
                if(in_array($autorizada, $datareparo_autorizada) == false){
                    array_push($datareparo_autorizada, $autorizada);
                }
            }
        }

        return $datareparo_autorizada;
    }
	
	function readAutorizadasbyCH(){
        
            $query = "SELECT autorizada FROM reparo where chassi = ? and (datareparo BETWEEN ? and ?) and estado = ? and item = ? and cidade = ? and (datavenda BETWEEN ? and ?)";
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(1, $this->chassi);
            $stmt->bindParam(2, $this->datareparo1);
			$stmt->bindParam(3, $this->datareparo2);
            $stmt->bindParam(4, $this->estado);
            $stmt->bindParam(5, $this->item);
			$stmt->bindParam(6, $this->cidade);
            $stmt->bindParam(7, $this->datareparo1);
            $stmt->bindParam(8, $this->datareparo2);
        
        
        $stmt->execute();

        $num = $stmt->rowCount();

        $datareparo_autorizada=array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);         
                if(in_array($autorizada, $datareparo_autorizada) == false){
                    array_push($datareparo_autorizada, $autorizada);
                }
            }
        }

        return $datareparo_autorizada;
    }

    function readAutorizadasbyLI(){
        $query = "SELECT autorizada FROM reparo where litro = ? and (datareparo BETWEEN ? and ?) and estado = ? and item = ? and cidade = ? and (datavenda BETWEEN ? and ?)";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->litro);
        $stmt->bindParam(2, $this->datareparo1);
		$stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->estado);
		$stmt->bindParam(5, $this->item);
		$stmt->bindParam(6, $this->cidade);
        $stmt->bindParam(7, $this->datareparo1);
        $stmt->bindParam(8, $this->datareparo2);
               
        $stmt->execute();

        $num = $stmt->rowCount();

        $datareparo_autorizada=array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);         
                if(in_array($autorizada, $datareparo_autorizada) == false){
                    array_push($datareparo_autorizada, $autorizada);
                }
            }
        }

        return $datareparo_autorizada;
    }

    function readAutorizadasBrasilbyCH(){
        $query = "SELECT autorizada FROM reparo where chassi = ? and (datareparo BETWEEN ? and ?) and item = ? and cidade = ? and (datavenda BETWEEN ? and ?)";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->chassi);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->item);
        $stmt->bindParam(5, $this->cidade);
        $stmt->bindParam(6, $this->datareparo1);
        $stmt->bindParam(7, $this->datareparo2);
        
        
        $stmt->execute();

        $num = $stmt->rowCount();

        $datareparo_autorizada=array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);         
                if(in_array($autorizada, $datareparo_autorizada) == false){
                    array_push($datareparo_autorizada, $autorizada);
                }
            }
        }

        return $datareparo_autorizada;
    }

    function readAutorizadasBrasilbyLI(){
        $query = "SELECT autorizada FROM reparo where litro = ? and (datareparo BETWEEN ? and ?)  and item = ? and cidade = ? and (datavenda BETWEEN ? and ?)";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->litro);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->item);
        $stmt->bindParam(5, $this->cidade);
        $stmt->bindParam(6, $this->datareparo1);
        $stmt->bindParam(7, $this->datareparo2);
               
        $stmt->execute();

        $num = $stmt->rowCount();

        $datareparo_autorizada=array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);         
                if(in_array($autorizada, $datareparo_autorizada) == false){
                    array_push($datareparo_autorizada, $autorizada);
                }
            }
        }

        return $datareparo_autorizada;
    }


    function readTotalbyItemNP(){

            $query = "SELECT * FROM reparo where nomeproduto = ? and (datareparo BETWEEN ? and ?) and estado = ? and item = ? and (datavenda BETWEEN ? and ?)";
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(1, $this->nomeproduto);
            $stmt->bindParam(2, $this->datareparo1);
            $stmt->bindParam(3, $this->datareparo2);
            $stmt->bindParam(4, $this->estado);
            $stmt->bindParam(5, $this->item);
            $stmt->bindParam(6, $this->datareparo1);
            $stmt->bindParam(7, $this->datareparo2);
        
        
        $stmt->execute();

        $row = $stmt->rowCount(); 

        return $row;
    }

    function readTotalbyItemLP(){
        $query = "SELECT COUNT(id) as total From reparo where linhaproduto = ? and (datareparo BETWEEN ? and ?) and estado = ? and item = ? and (datavenda BETWEEN ? and ?)";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->linhaproduto);
        $stmt->bindParam(2, $this->datareparo1);
		$stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->estado);
        $stmt->bindParam(5, $this->item);
        $stmt->bindParam(6, $this->datareparo1);
        $stmt->bindParam(7, $this->datareparo2);
               
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        return $row['total'];
    }

    function readTotalbyEstadoNP($tipo){
        if($tipo == 3){
            $query = "SELECT COUNT(id) as total FROM reparo where nomeproduto = ? or nomeproduto = ? and (datareparo BETWEEN ? and ?) and estado = ? and (datavenda BETWEEN ? and ?)";
            $stmt = $this->conn->prepare( $query );
			$stmt->bindParam(1, $this->rac);
            $stmt->bindParam(2, $this->mwo);
            $stmt->bindParam(3, $this->datareparo1);
			$stmt->bindParam(4, $this->datareparo2);
            $stmt->bindParam(5, $this->estado);
        }else{
            $query = "SELECT COUNT(id) as total FROM reparo where nomeproduto = ? and (datareparo BETWEEN ? and ?) and estado = ? and (datavenda BETWEEN ? and ?)";
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(1, $this->nomeproduto);
            $stmt->bindParam(2, $this->datareparo1);
			$stmt->bindParam(3, $this->datareparo2);
            $stmt->bindParam(4, $this->estado);
            $stmt->bindParam(5, $this->datareparo1);
            $stmt->bindParam(6, $this->datareparo2);
        }
        
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total'];
    }

    function readTotalbyEstadoLP(){
        $query = "SELECT COUNT(id) as total From reparo where linhaproduto = ? and (datareparo BETWEEN ? and ?) and estado = ? and (datavenda BETWEEN ? and ?)";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->linhaproduto);
        $stmt->bindParam(2, $this->datareparo1);
		$stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->estado);
        $stmt->bindParam(5, $this->datareparo1);
        $stmt->bindParam(6, $this->datareparo2);
               
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        return $row['total'];
    }

 
	
	function readTotalbyEstadoCH(){
        $query = "SELECT COUNT(id) as total FROM reparo where chassi = ? and (datareparo BETWEEN ? and ?) and estado = ? and (datavenda BETWEEN ? and ?)";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->chassi);
        $stmt->bindParam(2, $this->datareparo1);
		$stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->estado);
        $stmt->bindParam(5, $this->datareparo1);
        $stmt->bindParam(6, $this->datareparo2);
  
        
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total'];
    }

    function readTotalbyEstadoLI(){
        $query = "SELECT COUNT(id) as total From reparo where litro = ? and (datareparo BETWEEN ? and ?) and estado = ? and (datavenda BETWEEN ? and ?)";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->litro);
        $stmt->bindParam(2, $this->datareparo1);
		$stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->estado);
        $stmt->bindParam(5, $this->datareparo1);
        $stmt->bindParam(6, $this->datareparo2);
               
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        return $row['total'];
    }

    function readTotalEstadosNP(){
        $query = "SELECT estado, COUNT(id) as total FROM reparo where nomeproduto = ? and (datareparo BETWEEN ? and ?) and (datavenda BETWEEN ? and ?) GROUP by estado ORDER by estado ASC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->nomeproduto);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->datareparo1);
        $stmt->bindParam(5, $this->datareparo2);
                
        $stmt->execute();

        $estados = array();
         
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
               extract($row);       
               $estados[$estado] = $total;
        }
    
        return $estados;
    }

    function readTotalEstadosLP(){
        $query = "SELECT estado,COUNT(id) as total From reparo where linhaproduto = ? and (datareparo BETWEEN ? and ?) and (datavenda BETWEEN ? and ?) GROUP by estado ORDER by estado ASC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->linhaproduto);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->datareparo1);
        $stmt->bindParam(5, $this->datareparo2);
               
        $stmt->execute();

        $estados = array();
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
               extract($row);         
               $estados[$estado] = $total;
        }

        return $estados;
    }
	
	function readTotalEstadosCH(){
        $query = "SELECT estado, COUNT(id) as total FROM reparo where chassi = ? and (datareparo BETWEEN ? and ?) and (datavenda BETWEEN ? and ?) GROUP by estado ORDER by estado ASC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->chassi);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->datareparo1);
        $stmt->bindParam(5, $this->datareparo2);
                
        $stmt->execute();

        $estados = array();
         
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
               extract($row);       
               $estados[$estado] = $total;
        }
    
        return $estados;
    }

    function readTotalEstadosLI(){
        $query = "SELECT estado,COUNT(id) as total From reparo where litro = ? and (datareparo BETWEEN ? and ?) and (datavenda BETWEEN ? and ?) GROUP by estado ORDER by estado ASC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->litro);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->datareparo1);
        $stmt->bindParam(5, $this->datareparo2);
               
        $stmt->execute();

        $estados = array();
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
               extract($row);         
               $estados[$estado] = $total;
        }

        return $estados;
    }
    

    function readTotalBrasilbyNP(){
        $query = "SELECT COUNT(id) as total FROM reparo where nomeproduto = ? and (datareparo BETWEEN ? and ?) and (datavenda BETWEEN ? and ?)";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->nomeproduto);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->datareparo1);
        $stmt->bindParam(5, $this->datareparo2);
        
        
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total'];
    }

    function readTotalBrasilbyLP(){
        $query = "SELECT COUNT(id) as total From reparo where linhaproduto = ? and (datareparo BETWEEN ? and ?) and (datavenda BETWEEN ? and ?)";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->linhaproduto);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->datareparo1);
        $stmt->bindParam(5, $this->datareparo2);
               
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        return $row['total'];
    }
	
	function readTotalBrasilbyCH(){
        $query = "SELECT COUNT(id) as total FROM reparo where chassi= ? and (datareparo BETWEEN ? and ?) and (datavenda BETWEEN ? and ?)";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->chassi);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->datareparo1);
        $stmt->bindParam(5, $this->datareparo2);
        
        
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total'];
    }

    function readTotalBrasilbyLI(){
        $query = "SELECT COUNT(id) as total From reparo where litro = ? and (datareparo BETWEEN ? and ?) and (datavenda BETWEEN ? and ?)";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->litro);
        $stmt->bindParam(2, $this->datareparo1);
        $stmt->bindParam(3, $this->datareparo2);
        $stmt->bindParam(4, $this->datareparo1);
        $stmt->bindParam(5, $this->datareparo2);
               
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        return $row['total'];
    }

    function getUltimaData(){
        $query = "SELECT MAX(datareparo) as data FROM reparo";
        $stmt = $this->conn->prepare( $query );
               
        $stmt->execute();
 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['data'];
    }
}