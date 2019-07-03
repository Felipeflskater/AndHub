<?php
include_once '../pdo/RomPDO.php';
/**
 * Description of RomController
 *
 * @author FelipeFlakster
 */
class RomController {
   Private $RomPDO;
   function __construct() {
       $this->RomPDO = new RomPDO();
   }
   public function exibeMenu(){
       $exit = 1;
        while ($exit != 0){
            echo "\n\n--------- Rom ---------";
            echo "\n1. Inserir Rom";
            echo "\n2. Alterar Rom";
            echo "\n3. Excluir Rom";
            echo "\n4. Listar todos as Rom";
            echo "\n5. Listar Rom pelo nome";
            echo "\n6. Listar Rom pelo código";
            echo "\n7. Reativar Rom";
            echo "\n8. Listar Roms Inativas";
            echo "\nOpção (ZERO para sair): "; 
            $exit = fgets(STDIN);
            switch ($exit){
                case 0:
                    break;
                case 1:
                    $this->inserirRom();
                    break;
                case 2:
                    $this->alterarRom();
                    break;
                case 3:
                    $this->excluirRom();
                    break;
                case 4:
                    $this->listarTodasRoms();
                    break;
                case 5:
                    $this->listarRomsPeloNome();
                    break;
                case 6:
                    $this->listarRomPeloCodigo();
                    break;
                case 7:
                    $this->reativarRom();
                    break;       
                case 8:
                    $this->listarRomsInativas();
                    break;
                
                default:
                    echo "\nOpção inexistente.";
            }
        } 
    }
        private function inserirRom(){
        $Rom = new Rom();
        echo"\n versao da Rom: ";
        $Rom->setR_versao(rtrim(fgets(STDIN)));
        echo"\n site da Rom: ";
        $Rom->setR_site(rtrim(fgets(STDIN)));
        echo"\n Sistema da Rom: ";
        $Rom->setR_Sistema(rtrim(fgets(STDIN)));
        echo"\n Codnome da Rom: ";
        $Rom->setR_Codnome(rtrim(fgets(STDIN)));
        echo"\n RomGit da Rom: ";
        $Rom->setR_RomGit(rtrim(fgets(STDIN)));
        echo"\n desenvolvedor da Rom: ";
        $Rom->setR_desenvolvedor(rtrim(fgets(STDIN)));
        echo"\n Smartphone da Rom: ";
        $Rom->setR_Smartphone(rtrim(fgets(STDIN)));
        echo"\n link da Rom: ";
        $Rom->setR_link(rtrim(fgets(STDIN)));
        echo"\n data da Rom: ";
        $Rom->setR_data(rtrim(fgets(STDIN)));
        echo"\n status da Rom: ";
        $Rom->setR_status(rtrim(fgets(STDIN)));
        echo"\n atualizacao da Rom: ";
        $Rom->setR_atualizacao(rtrim(fgets(STDIN)));
        if($this->RomPDO->insert($Rom)){
            echo "\nRom Salvo.";
        }else{
            echo "\nErro ao Salvar.";
        }
        
    }

    private function alterarRom() {
        echo "\n Insira o código do Rom para alteração: ";
        $Rom = $this->RomPDO->findById(rtrim(fgets(STDIN)));
        if ($Rom != null) {
            print_r($Rom);
            echo"\n versao da Rom: ";
            $r_versao = fgets(STDIN);
            if ($r_versao != "\n") {
                $Rom->setR_versao(rtrim($r_versao));
            }
            echo"\n site da Rom: ";
            $r_site = fgets(STDIN);
            if ($r_site != "\n") {
                $Rom->setR_site(rtrim($r_site));
            }
            echo"\n Sistema da Rom: ";
            $r_Sistema = fgets(STDIN);
            if ($r_Sistema != "\n") {
                $Rom->setR_Sistema(rtrim($r_Sistema));
            }
            echo"\n Codnome da Rom: ";
            $r_Codnome = fgets(STDIN);
            if ($r_Codnome != "\n") {
                $Rom->setR_Codnome(rtrim($r_Codnome));
            }
            echo"\n RomGit da Rom: ";
            $r_RomGit = fgets(STDIN);
            if ($r_RomGit != "\n") {
                $Rom->setR_RomGit(rtrim($r_RomGit));
            }
            echo"\n desenvolvedor da Rom: ";
            $r_desenvolvedor = fgets(STDIN);
            if ($r_desenvolvedor != "\n") {
                $Rom->setR_desenvolvedor(rtrim($r_desenvolvedor));
            }
            echo"\n Smartphone da Rom: ";
            $r_Smartphone = fgets(STDIN);
            if ($r_Smartphone != "\n") {
                $Rom->setR_Smartphone(rtrim($r_Smartphone));
            }
            echo"\n link da Rom: ";
            $r_link = fgets(STDIN);
            if ($r_link != "\n") {
                $Rom->setR_link(rtrim($r_link));
            }
            echo"\n data da Rom: ";
            $r_data = fgets(STDIN);
            if ($r_data != "\n") {
                $Rom->setR_data(rtrim($r_data));
            }
            echo"\n status da Rom: ";
            $r_status = fgets(STDIN);
            if ($r_status != "\n") {
                $Rom->setR_status(rtrim($r_status));
            }
            echo"\n atualizacao da Rom: ";
            $r_atualizacao = fgets(STDIN);
            if ($r_atualizacao != "\n") {
                $Rom->setR_atualizacao(rtrim($r_atualizacao));
            }
            if ($this->RomPDO->update($Rom)) {
                echo "\n Rom alterada com sucesso.";
            } else {
                echo "\n Erro ao alterar a Rom.";
            }
        } else {
            echo "\ Não encontrei essa Rom.";
        }
    }
    private function excluirRom(){
        echo "\nDigite o código da Rom que deseja inativar: ";
        $Rom = $this->RomPDO->findById(rtrim(fgets(STDIN)));
        print_r($Rom);
        $r_id= $Rom->getR_id();
        echo "\n Deseja confirmar (s/n)? ";
        $excluir = rtrim(fgets(STDIN));
        
        if(!strcasecmp($excluir, "s")){
            if($this->RomPDO->softdelete($r_id)){
                echo "\nRom excluído.";
            }else{
                echo "\n Não foi possivel excluir a Rom.";
            }       
        }
        if(!strcasecmp($excluir, "n")){
            echo "\nAbortado.";
        }
    }
    private function listarTodasRoms(){
        print_r($this->RomPDO->findAll());
    }
    private function listarRomsInativas(){
        print_r($this->RomPDO->finddisable());
    }
    
    private function listarRomsPeloNome(){
        echo "\nDigite o nome da Rom: ";
        $m_nome = rtrim(fgets(STDIN));   
        print_r($this->RomPDO->findByNome($m_nome));
    }
    
    private function listarRomPeloCodigo(){
        echo "\nDigite o código da Rom: ";
        $r_id = rtrim(fgets(STDIN));
        print_r($this->RomPDO->findById($r_id));
    }
    
 private function reativarRom(){
        echo "\nDigite o código da Rom que deseja Ativar: ";
        $Rom = $this->RomPDO->findById(rtrim(fgets(STDIN)));
        print_r($Rom);
        $r_id= $Rom->getR_id();
        echo "\n Deseja confirmar (s/n)? ";
        $excluir = rtrim(fgets(STDIN));
        
        if(!strcasecmp($excluir, "s")){
            if($this->RomPDO->reativa($r_id)){
                echo "\nRom ativada.";
            }else{
                echo "\n Não foi possivel ativada a Rom.";
            }       
        }
        if(!strcasecmp($excluir, "n")){
            echo "\n Abortado.";
        }
    }
   }