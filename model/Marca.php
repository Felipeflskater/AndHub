<?php

/**
 * Description of Marca
 *
 * @author FelipeFlakster
 */
class Marca {
    private $m_id;
    private $m_nome;
    private $m_site;
    function __construct() {

    }
    function getM_id() {
        return $this->m_id;
    }

    function getM_nome() {
        return $this->m_nome;
    }

    function getM_site() {
        return $this->m_site;
    }
    function setM_id($m_id) {
        $this->m_id = $m_id;
    }

    function setM_nome($m_nome) {
        $this->m_nome = $m_nome;
    }

    function setM_site($m_site) {
        $this->m_site = $m_site;
    }
    public function __toString() {
        return "Marca[id=$this->m_id,nome=$this->m_nome,site=$this->m_site]";
    }


}
