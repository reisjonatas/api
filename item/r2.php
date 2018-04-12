<?php
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

        $datareparo_item=array();
        $items = array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);         
                array_push($datareparo_item, $item);
                array_push($datareparo_item, $total);
                array_push($items,$datareparo_item);
            }
        }     

        return $items;
    }
?>