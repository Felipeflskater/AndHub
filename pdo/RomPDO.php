<?php
include_once "../model/Rom.php";

include_once "Conexao.php";
/**
 * Description of RomPDO
 *
 * @author FelipeFlakster
 */
class RomPDO extends Conexao {
    private $conn;
    
    public function __construct() {
        $this->conn = parent::getConexao();
    }
    public function insert($Rom){
        try{
            $stmt = $this->conn->prepare("INSERT INTO Rom "
                . "(versao,site,Sistema,Codnome,RomGit,desenvolvedor,Smartphone,link,data,status,atualizacao) "
                . "VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                $stmt->bindValue(1, $Rom->getR_versao());
                $stmt->bindValue(2, $Rom->getR_site());
                $stmt->bindValue(3, $Rom->getR_Sistema());
                $stmt->bindValue(4, $Rom->getR_Codnome());
                $stmt->bindValue(5, $Rom->getR_RomGit());
                $stmt->bindValue(6, $Rom->getR_desenvolvedor());
                $stmt->bindValue(7, $Rom->getR_Smartphone());
                $stmt->bindValue(8, $Rom->getR_link());
                $stmt->bindValue(9, $Rom->getR_data());
                $stmt->bindValue(10, $Rom->getR_status());
                $stmt->bindValue(11, $Rom->getR_atualizacao());      
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em RomPDO->insert: " . $ex->getMessage();
            return false;
        }
    }
    
    public function update($Rom){
        try{
            $stmt = $this->conn->prepare("UPDATE Rom SET versao=?,site=?,Sistema=?,Codnome=?,RomGit=?,desenvolvedor=?,Smartphone=?,link=?,data=?,status=?,atualizacao=? "
                    ." WHERE id = ?");
                    $stmt->bindValue(1, $Rom->getR_versao());
                    $stmt->bindValue(2, $Rom->getR_site());
                    $stmt->bindValue(3, $Rom->getR_Sistema());
                    $stmt->bindValue(4, $Rom->getR_Codnome());
                    $stmt->bindValue(5, $Rom->getR_RomGit());
                    $stmt->bindValue(6, $Rom->getR_desenvolvedor());
                    $stmt->bindValue(7, $Rom->getR_Smartphone());
                    $stmt->bindValue(8, $Rom->getR_link());
                    $stmt->bindValue(9, $Rom->getR_data());
                    $stmt->bindValue(10, $Rom->getR_status());
                    $stmt->bindValue(11, $Rom->getR_atualizacao());         
                    $stmt->bindValue(12, $Rom->getR_id());
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em RomPDO->update: " . $ex->getMessage();
            return false;
        }
    }
        public function softdelete($R_id){
        try{
            $sql = 'UPDATE Rom SET flgstatus = ?  WHERE id = ?';
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1,  "X");
            $stmt->bindValue(2,  $R_id);
            
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em RomPDO->softdelete: " . $ex->getMessage();
            return false;
        }
    }
            public function reativa($r_id){
        try{
            $sql = 'UPDATE Rom SET flgstatus = ?  WHERE id = ?';
            
            $stmt = $this->conn->prepare($sql);
              
            $stmt->bindValue(1,  "C");
            $stmt->bindValue(2,  $r_id);
            
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em RomPDO->reativaRom: " . $ex->getMessage();
            return false;
        }
    }
    public function findAll(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM Rom where flgstatus='C' ORDER BY Codnome ");
            if($stmt->execute()){
                $Roms = Array();
                while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    array_push($Roms, $this->resultSetToRom($rs));
            }
            
            return $Roms;
        }
        } catch (PDOException $ex) {
            echo "\nExceção no findAll da classe RomPDO: " . $ex->getMessage();
            return null;    
        }
        
    }
        public function finddisable(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM Rom where flgstatus='X' ORDER BY Codnome ");
            if($stmt->execute()){
                $Roms = Array();
                while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    array_push($Roms, $this->resultSetToRom($rs));
            }
            
            return $Roms;
        }
        } catch (PDOException $ex) {
            echo "\nExceção no findAll da classe RomPDO: " . $ex->getMessage();
            return null;    
        }
        
    }
    public function findByNome($R_Codnome){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM Rom WHERE lower(Codnome) LIKE lower(?) and flgstatus='C' ORDER BY Codnome");
            $stmt->bindValue(1,'%'. $R_Codnome . '%');
            if ($stmt->execute()) {
                $Roms = Array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($Roms, $this->resultSetToRom($rs));
                }
                return $Roms;
            }
            
        } catch (PDOException $ex) {
            echo "\nExceção no findByNome da classe RomPDO: " . $ex->getMessage();
            return null;    
        }
    }
    
    public function findById($r_id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM Rom WHERE id=? and flgstatus='C'");
            $stmt->bindValue(1, $r_id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                if($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    return $this->resultSetToRom($rs);
                }else{
                    return null;
                }
            } else {
                return null;
            }
        } catch (PDOException $ex) {
            echo "\nExceção no findById da classe RomPDO: " . $ex->getMessage();
            return null;
        }
    }
    
    private function resultSetToRom($rs){
        $Rom = new Rom();
        $Rom->setR_id($rs->id);
        $Rom->setR_versao($rs->versao);
        $Rom->setR_site($rs->site);
        $Rom->setR_Sistema($rs->Sistema);
        $Rom->setR_Codnome($rs->Codnome);
        $Rom->setR_RomGit($rs->RomGit);
        $Rom->setR_desenvolvedor($rs->desenvolvedor);
        $Rom->setR_Smartphone($rs->Smartphone);
        $Rom->setR_link($rs->link);
        $Rom->setR_data($rs->data);
        $Rom->setR_status($rs->status);
        $Rom->setR_atualizacao($rs->atualizacao);
        
        return $Rom;
    }

}
