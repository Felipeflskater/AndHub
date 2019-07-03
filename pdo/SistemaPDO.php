<?php
include_once "../model/sistema.php";

include_once "Conexao.php";
/**
 * Description of SistemaPDO
 *
 * @author FelipeFlakster
 */
class SistemaPDO extends Conexao {
    private $conn;
    
    public function __construct() {
        $this->conn = parent::getConexao();
    }
    public function insert($sistema){
        try{
            $stmt = $this->conn->prepare("INSERT INTO sistema "
                . "(nome, Codnome, versao) "
                . "VALUES (?, ?, ?)");
            $stmt->bindValue(1, $sistema->getS_nome());
            $stmt->bindValue(2, $sistema->getS_Codnome());
            $stmt->bindValue(3, $sistema->getS_versao());
                    
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em SistemaPDO->insert: " . $ex->getMessage();
            return false;
        }
    }
    
    public function update($sistema){
        try{
            $stmt = $this->conn->prepare("UPDATE sistema SET versao=?,Codnome=?,nome=?, "
                    ." WHERE id = ?");
            $stmt->bindValue(1, $sistema->getS_nome());
            $stmt->bindValue(2, $sistema->getS_Codnome());
            $stmt->bindValue(3, $sistema->getS_versao());        
            $stmt->bindValue(4, $sistema->getS_id());
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em SistemaPDO->update: " . $ex->getMessage();
            return false;
        }
    }
    
    public function findAll(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM sistema ORDER BY nome");
            if($stmt->execute()){
                $clientes = Array();
                while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    array_push($sistemas, $this->resultSetTosistema($rs));
            }
            
            return $clientes;
        }
        } catch (PDOException $ex) {
            echo "\nExceção no findAll da classe SistemaPDO: " . $ex->getMessage();
            return null;    
        }
        
    }
    
    public function findByNome($S_nome){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM sistema WHERE lower(nome) LIKE lower(?) or lower(codnome) LIKE lower(?) ORDER BY nome");
            $stmt->bindValue(1,'%'. $S_nome . '%');
            $stmt->bindValue(2,'%'. $S_nome . '%');
            if ($stmt->execute()) {
                $sistemas = Array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($sistemas, $this->resultSetToCliente($rs));
                }
                return $sistemas;
            }
            
        } catch (PDOException $ex) {
            echo "\nExceção no findByNome da classe SistemaPDO: " . $ex->getMessage();
            return null;    
        }
    }
    
    public function findById($S_id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM sistema WHERE id=?");
            $stmt->bindValue(1, $S_id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                if($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    return $this->resultSetTosistema($rs);
                }else{
                    return null;
                }
            } else {
                return null;
            }
        } catch (PDOException $ex) {
            echo "\nExceção no findById da classe SistemaPDO: " . $ex->getMessage();
            return null;
        }
    }
    
        public function softdelete($marca){
        try{
            $sql = 'UPDATE marca SET flgstatus = ?  WHERE id = ?';
            
            $stmt = $this->conn->prepare($sql);
              
        
            
            $stmt->bindValue(1,  "X");
            $stmt->bindValue(2,  $marca);
            
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em SistemaPDO->softdelete: " . $ex->getMessage();
            return false;
        }
    }
            public function reativa($s_id){
        try{
            $sql = 'UPDATE marca SET flgstatus = ?  WHERE id = ?';
            
            $stmt = $this->conn->prepare($sql);
              
            $stmt->bindValue(1,  "C");
            $stmt->bindValue(2,  $s_id);
            
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em SistemaPDO->reativa: " . $ex->getMessage();
            return false;
        }
    }
    private function resultSetTosistema($rs){
        $sistema = new sistema();
        $sistema->setS_Id($rs->id);
        $sistema->setS_nome($rs->nome);
        $sistema->setS_Codnome($rs->Codnome);
        $sistema->setS_versao($rs->versao);
        
        return $sistema;
    }

}
