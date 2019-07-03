<?php

/**
 * Description of conexao
 *
 * @author FelipeFlakster
 */
class Conexao{
    
    protected function getConexao(){
        try {
            $conn = new PDO('mysql:host=localhost;dbname=andhub', 'root', '');
            $conn->setAttribute(PDO::ATTR_ERRMODE, 
                    PDO::ERRMODE_EXCEPTION); 
             //print_r($conn);
             //print_r($conn->getAvailableDrivers());
            
            return $conn;
                    
        } catch (PDOException $ex) {
            echo $ex->getFile() . ' ### ' . $ex->getLine() . ' ### ' . $ex->getMessage() . ' ### ' . $ex->getCode();
            return null;
        }
    }
}



