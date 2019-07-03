<?php
/**
 * Description of Smartphone
 *
 * @author FelipeFlakster
 */
class Smartphone {
private $S_id;
private $S_marca;
private $S_modelo;
private $S_codnome;
private $S_CPU;
private $S_GPU;
private $S_Ram;
private $S_Armazenamento;
private $S_Chipset;
private $S_Display;
private $S_Rede;
private $S_nome;
function __construct() {
    
}
function getS_id() {
    return $this->S_id;
}

function getS_marca() {
    return $this->S_marca;
}

function getS_modelo() {
    return $this->S_modelo;
}

function getS_codnome() {
    return $this->S_codnome;
}

function getS_CPU() {
    return $this->S_CPU;
}

function getS_GPU() {
    return $this->S_GPU;
}

function getS_Ram() {
    return $this->S_Ram;
}

function getS_Armazenamento() {
    return $this->S_Armazenamento;
}

function getS_Chipset() {
    return $this->S_Chipset;
}

function getS_Display() {
    return $this->S_Display;
}

function getS_Rede() {
    return $this->S_Rede;
}

function getS_nome() {
    return $this->S_nome;
}

function setS_id($S_id) {
    $this->S_id = $S_id;
}

function setS_marca($S_marca) {
    $this->S_marca = $S_marca;
}

function setS_modelo($S_modelo) {
    $this->S_modelo = $S_modelo;
}

function setS_codnome($S_codnome) {
    $this->S_codnome = $S_codnome;
}

function setS_CPU($S_CPU) {
    $this->S_CPU = $S_CPU;
}
function setS_GPU($S_GPU) {
    $this->S_GPU = $S_GPU;
}
function setS_Ram($S_Ram) {
    $this->S_Ram = $S_Ram;
}
function setS_Armazenamento($S_Armazenamento) {
    $this->S_Armazenamento = $S_Armazenamento;
}
function setS_Chipset($S_Chipset) {
    $this->S_Chipset = $S_Chipset;
}
function setS_Display($S_Display) {
    $this->S_Display = $S_Display;
}
function setS_Rede($S_Rede) {
    $this->S_Rede = $S_Rede;
}
function setS_nome($S_nome) {
    $this->S_nome = $S_nome;
}
public function __toString() {
    return "Smartphone[id=$this->S_id,marca=$this->S_marca,modelo=$this->S_modelo,codnome=$this->S_codnome,CPU=$this->S_CPU,GPU=$this->S_GPU,Ram=$this->S_Ram,Armazenamento=$this->S_Armazenamento,Chipset=$this->S_Chipset,Display=$this->S_Display,Rede=$this->S_Rede,nome=$this->S_nome]";
}
}