<?php
/**
 * Description of Rom
 *
 * @author FelipeFlakster
 */
class Rom {
private $r_id;
private $r_versao;
private $r_site;
private $r_Sistema;
private $r_Codnome;
private $r_RomGit;
private $r_desenvolvedor;
private $r_Smartphone;
private $r_link;
private $r_data;
private $r_status;
private $r_atualizacao;

function __construct() {
    
}

function getR_id() {
    return $this->r_id;
}

function getR_versao() {
    return $this->r_versao;
}

function getR_site() {
    return $this->r_site;
}

function getR_Sistema() {
    return $this->r_Sistema;
}

function getR_Codnome() {
    return $this->r_Codnome;
}

function getR_RomGit() {
    return $this->r_RomGit;
}

function getR_desenvolvedor() {
    return $this->r_desenvolvedor;
}

function getR_Smartphone() {
    return $this->r_Smartphone;
}

function getR_link() {
    return $this->r_link;
}

function getR_data() {
    return $this->r_data;
}

function getR_status() {
    return $this->r_status;
}

function getR_atualizacao() {
    return $this->r_atualizacao;
}

function setR_id($r_id) {
    $this->r_id = $r_id;
}

function setR_versao($r_versao) {
    $this->r_versao = $r_versao;
}

function setR_site($r_site) {
    $this->r_site = $r_site;
}

function setR_Sistema($r_Sistema) {
    $this->r_Sistema = $r_Sistema;
}

function setR_Codnome($r_Codnome) {
    $this->r_Codnome = $r_Codnome;
}

function setR_RomGit($r_RomGit) {
    $this->r_RomGit = $r_RomGit;
}

function setR_desenvolvedor($r_desenvolvedor) {
    $this->r_desenvolvedor = $r_desenvolvedor;
}

function setR_Smartphone($r_Smartphone) {
    $this->r_Smartphone = $r_Smartphone;
}

function setR_link($r_link) {
    $this->r_link = $r_link;
}

function setR_data($r_data) {
    $this->r_data = $r_data;
}

function setR_status($r_status) {
    $this->r_status = $r_status;
}

function setR_atualizacao($r_atualizacao) {
    $this->r_atualizacao = $r_atualizacao;
}

public function __toString() {
    return "Rom[id=$this->r_id,versao=$this->r_versao,site=$this->r_site,Sistema=$this->r_Sistema,Codnome=$this->r_Codnome,RomGit=$this->r_RomGit,desenvolvedor=$this->r_desenvolvedor,Smartphone=$this->r_Smartphone,link=$this->r_link,data=$this->r_data,status=$this->r_status,atualizacao=$this->r_atualizacao]";
}

}
