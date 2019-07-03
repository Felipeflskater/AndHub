<?php
include_once "../model/Marca.php";

include_once "Conexao.php";
/**
 * Description of MarcaPDO
 *
 * @author FelipeFlakster
 */
class MarcaPDO extends Conexao {
    private $conn;
    
    public function __construct() {
        $this->conn = parent::getConexao();
    }
    public function insert($marca){
        try{
            $stmt = $this->conn->prepare("INSERT INTO marca "
                . "(nome, site) "
                . "VALUES (?, ?)");
            $stmt->bindValue(1, $marca->getM_nome());
            $stmt->bindValue(2, $marca->getM_site());          
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em MarcaPDO->insert: " . $ex->getMessage();
            return false;
        }
    }
    
    public function update($marca){
        try{
            $stmt = $this->conn->prepare("UPDATE marca SET nome=?, site=? "
                    ." WHERE id = ?");
            $stmt->bindValue(1, $marca->getM_nome());
            $stmt->bindValue(2, $marca->getM_site());          
            $stmt->bindValue(3, $marca->getM_id());
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em MarcaPDO->update: " . $ex->getMessage();
            return false;
        }
    }
        public function softdelete($m_id){
        try{
            $sql = 'UPDATE marca SET flgstatus = ?  WHERE id = ?';
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1,  "X");
            $stmt->bindValue(2,  $m_id);
            
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em MarcaPDO->softdelete: " . $ex->getMessage();
            return false;
        }
    }
            public function reativa($m_id){
        try{
            $sql = 'UPDATE marca SET flgstatus = ?  WHERE id = ?';
            
            $stmt = $this->conn->prepare($sql);
              
            $stmt->bindValue(1,  "C");
            $stmt->bindValue(2,  $m_id);
            
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em MarcaPDO->reativamarca: " . $ex->getMessage();
            return false;
        }
    }
    public function findAll(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM marca where flgstatus='C' ORDER BY nome ");
            if($stmt->execute()){
                $marcas = Array();
                while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    array_push($marcas, $this->resultSetToMarca($rs));
            }
            
            return $marcas;
        }
        } catch (PDOException $ex) {
            echo "\nExceção no findAll da classe MarcaPDO: " . $ex->getMessage();
            return null;    
        }
        
    }
        public function finddisable(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM marca where flgstatus='X' ORDER BY nome ");
            if($stmt->execute()){
                $marcas = Array();
                while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    array_push($marcas, $this->resultSetToMarca($rs));
            }
            
            return $marcas;
        }
        } catch (PDOException $ex) {
            echo "\nExceção no findAll da classe MarcaPDO: " . $ex->getMessage();
            return null;    
        }
        
    }
    public function findByNome($m_nome){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM marca WHERE lower(nome) LIKE lower(?) and flgstatus='C' ORDER BY nome");
            $stmt->bindValue(1,'%'. $m_nome . '%');
            if ($stmt->execute()) {
                $marcas = Array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($marcas, $this->resultSetToMarca($rs));
                }
                return $marcas;
            }
            
        } catch (PDOException $ex) {
            echo "\nExceção no findByNome da classe MarcaPDO: " . $ex->getMessage();
            return null;    
        }
    }
    
    public function findById($M_id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM marca WHERE id=? and flgstatus='C'");
            $stmt->bindValue(1, $M_id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                if($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    return $this->resultSetToMarca($rs);
                }else{
                    return null;
                }
            } else {
                return null;
            }
        } catch (PDOException $ex) {
            echo "\nExceção no findById da classe MarcaPDO: " . $ex->getMessage();
            return null;
        }
    }
    
    private function resultSetToMarca($rs){
        $marca = new Marca();
        $marca->setM_id($rs->id);
        $marca->setM_Nome($rs->nome);
        $marca->setM_site($rs->site);
        
        return $marca;
    }

}
