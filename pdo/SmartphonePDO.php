<?php
include_once "../model/Smartphone.php";

include_once "Conexao.php";
/**
 * Description of SmartphonePDO
 *
 * @author FelipeFlakster
 */
class SmartphonePDO extends Conexao {
    private $conn;
    
    public function __construct() {
        $this->conn = parent::getConexao();
    }
    public function insert($Smartphone){
        try{
            $stmt = $this->conn->prepare("INSERT INTO Smartphone "
                . "(S_nome,S_marca,S_modelo,S_codnome,S_CPU,S_GPU,S_Ram,S_Armazenamento,S_Chipset,S_Display,S_Rede) "
                . "VALUES (?, ? , ? , ? , ? , ? , ? , ? , ? , ? , ? )");
                $stmt->bindValue(1, $Smartphone->getS_nome());
                $stmt->bindValue(2, $Smartphone->getS_marca());
                $stmt->bindValue(3, $Smartphone->getS_modelo());
                $stmt->bindValue(4, $Smartphone->getS_codnome());
                $stmt->bindValue(5, $Smartphone->getS_CPU());
                $stmt->bindValue(6, $Smartphone->getS_GPU());
                $stmt->bindValue(7, $Smartphone->getS_Ram());
                $stmt->bindValue(8, $Smartphone->getS_Armazenamento());
                $stmt->bindValue(9, $Smartphone->getS_Chipset());
                $stmt->bindValue(10, $Smartphone->getS_Display());
                $stmt->bindValue(11, $Smartphone->getS_Rede());         
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em SmartphonePDO->insert: " . $ex->getMessage();
            return false;
        }
    }
    
    public function update($Smartphone){
        try{
            $stmt = $this->conn->prepare("UPDATE Smartphone SET S_nome=?,S_marca=?,S_modelo=?,S_codnome=?,S_CPU=?,S_GPU=?,S_Ram=?,S_Armazenamento=?,S_Chipset=?,S_Display=?,S_Rede=? "
                    ." WHERE id = ?");
                    $stmt->bindValue(1, $Smartphone->getS_nome());
                    $stmt->bindValue(2, $Smartphone->getS_marca());
                    $stmt->bindValue(3, $Smartphone->getS_modelo());
                    $stmt->bindValue(4, $Smartphone->getS_codnome());
                    $stmt->bindValue(5, $Smartphone->getS_CPU());
                    $stmt->bindValue(6, $Smartphone->getS_GPU());
                    $stmt->bindValue(7, $Smartphone->getS_Ram());
                    $stmt->bindValue(8, $Smartphone->getS_Armazenamento());
                    $stmt->bindValue(9, $Smartphone->getS_Chipset());
                    $stmt->bindValue(10, $Smartphone->getS_Display());
                    $stmt->bindValue(11, $Smartphone->getS_Rede());          
                    $stmt->bindValue(13, $Smartphone->getS_id());
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em SmartphonePDO->update: " . $ex->getMessage();
            return false;
        }
    }
        public function softdelete($S_id){
        try{
            $sql = 'UPDATE Smartphone SET flgstatus = ?  WHERE id = ?';
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1,  "X");
            $stmt->bindValue(2,  $S_id);
            
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em SmartphonePDO->softdelete: " . $ex->getMessage();
            return false;
        }
    }
            public function reativa($S_id){
        try{
            $sql = 'UPDATE Smartphone SET flgstatus = ?  WHERE id = ?';
            
            $stmt = $this->conn->prepare($sql);
              
            $stmt->bindValue(1,  "C");
            $stmt->bindValue(2,  $S_id);
            
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em SmartphonePDO->reativaSmartphone: " . $ex->getMessage();
            return false;
        }
    }
    public function findAll(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM Smartphone where flgstatus='C' ORDER BY nome ");
            if($stmt->execute()){
                $Smartphones = Array();
                while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    array_push($Smartphones, $this->resultSetToSmartphone($rs));
            }
            
            return $Smartphones;
        }
        } catch (PDOException $ex) {
            echo "\nExceção no findAll da classe SmartphonePDO: " . $ex->getMessage();
            return null;    
        }
        
    }
        public function finddisable(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM Smartphone where flgstatus='X' ORDER BY nome ");
            if($stmt->execute()){
                $Smartphones = Array();
                while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    array_push($Smartphones, $this->resultSetToSmartphone($rs));
            }
            
            return $Smartphones;
        }
        } catch (PDOException $ex) {
            echo "\nExceção no findAll da classe SmartphonePDO: " . $ex->getMessage();
            return null;    
        }
        
    }
    public function findByNome($m_nome){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM Smartphone WHERE lower(nome) LIKE lower(?) and flgstatus='C' ORDER BY nome");
            $stmt->bindValue(1,'%'. $m_nome . '%');
            if ($stmt->execute()) {
                $Smartphones = Array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($Smartphones, $this->resultSetToSmartphone($rs));
                }
                return $Smartphones;
            }
            
        } catch (PDOException $ex) {
            echo "\nExceção no findByNome da classe SmartphonePDO: " . $ex->getMessage();
            return null;    
        }
    }
    
    public function findById($S_id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM Smartphone WHERE id=? and flgstatus='C'");
            $stmt->bindValue(1, $S_id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                if($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    return $this->resultSetToSmartphone($rs);
                }else{
                    return null;
                }
            } else {
                return null;
            }
        } catch (PDOException $ex) {
            echo "\nExceção no findById da classe SmartphonePDO: " . $ex->getMessage();
            return null;
        }
    }
    
    private function resultSetToSmartphone($rs){
        $Smartphone = new Smartphone();
        $Smartphone->setS_id($rs->id);
        $Smartphone->setS_nome($rs->nome);
        $Smartphone->setS_marca($rs->marca);
        $Smartphone->setS_modelo($rs->modelo);
        $Smartphone->setS_codnome($rs->codnome);
        $Smartphone->setS_CPU($rs->CPU);
        $Smartphone->setS_GPU($rs->GPU);
        $Smartphone->setS_Ram($rs->Ram);
        $Smartphone->setS_Armazenamento($rs->Armazenamento);
        $Smartphone->setS_Chipset($rs->Chipset);
        $Smartphone->setS_Display($rs->Display);
        $Smartphone->setS_Rede($rs->Rede);
        
        return $Smartphone;
    }
}