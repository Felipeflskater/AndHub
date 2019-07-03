<?php
/**
 * Description of Sistema
 *
 * @author FelipeFlakster
 */
class Sistema {
private $S_id;
private $S_versao;
private $S_Codnome;
private $S_nome;
function __construct() {
    
}
function getS_id() {
    return $this->S_id;
}

function getS_versao() {
    return $this->S_versao;
}

function getS_Codnome() {
    return $this->S_Codnome;
}

function getS_nome() {
    return $this->S_nome;
}

function setS_id($S_id) {
    $this->S_id = $S_id;
}

function setS_versao($S_versao) {
    $this->S_versao = $S_versao;
}

function setS_Codnome($S_Codnome) {
    $this->S_Codnome = $S_Codnome;
}

function setS_nome($S_nome) {
    $this->S_nome = $S_nome;
}

public function __toString() {
    return "Sistema[id=$this->S_id,versao=$this->S_versao,codnome=$this->S_Codnome,nome=$this->S_nome]";
}


}
