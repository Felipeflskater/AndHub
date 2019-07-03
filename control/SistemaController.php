<?php
include_once '../pdo/SistemaPDO.php';
/**
 * Description of SistemaController
 *
 * @author FelipeFlakster
 */
class SistemaController {
   Private $SistemaPDO;
   function __construct() {
       $this->SistemaPDO = new SistemaPDO();
   }
   public function exibeMenu(){
       $exit = 1;
        while ($exit != 0){
            echo "\n\n--------- Sistema ---------";
            echo "\n1. Inserir Sistema";
            echo "\n2. Alterar Sistema";
            echo "\n3. Excluir Sistema";
            echo "\n4. Listar todos os Sistema";
            echo "\n5. Listar Sistema pelo nome ou codnome";
            echo "\n6. Listar Sistema pelo código";
            echo "\n7. Reativar Sistema";
            echo "\n8. Listar Sistemas Inativos";
            echo "\nOpção (ZERO para sair): "; 
            $exit = fgets(STDIN);
            switch ($exit){
                case 0:
                    break;
                case 1:
                    $this->inserirSistema();
                    break;
                case 2:
                    $this->alterarSistema();
                    break;
                case 3:
                    $this->excluirSistema();
                    break;
                case 4:
                    $this->listarTodosSistemas();
                    break;
                case 5:
                    $this->listarSistemasPeloNome();
                    break;
                case 6:
                    $this->listarSistemaPeloCodigo();
                    break;
                case 7:
                    $this->reativarSistema();
                    break;       
                case 8:
                    $this->listarSistemasInativos();
                    break;
                
                default:
                    echo "\nOpção inexistente.";
            }
        } 
    }
        private function inserirSistema(){
        $Sistema = new Sistema();
        echo"\nNome da Sistema: ";
        $Sistema->setS_nome(rtrim(fgets(STDIN)));
        echo"\n Versao do Sistema: ";
        $Sistema->setS_versao(rtrim(fgets(STDIN)));
        echo"\n Codnome do Sistema: ";
        $Sistema->setS_Codnome(rtrim(fgets(STDIN)));
        if($this->SistemaPDO->insert($Sistema)){
            echo "\nSistema salvo.";
        }else{
            echo "\nErro ao salvar. Contate o administrador do sistema.";
        }
        
    }
        private function alterarSistema(){
        echo "\n Insira o código do Sistema para alteração: ";
        $Sistema = $this->SistemaPDO->findById(rtrim(fgets(STDIN)));
        if($Sistema != null){
            print_r($Sistema);
            echo "\n Digite o nome do Sistema: ";
            $s_nome = fgets(STDIN);
            if($s_nome != "\n"){
                $Sistema->sets_nome(rtrim($s_nome));
            }
            echo"\n Site da Sistema: ";
            $m_site = fgets(STDIN);
            if($m_site != "\n"){
                $Sistema->setM_Site(rtrim($m_site));
            }
            if($this->SistemaPDO->update($Sistema)){
                echo "\n Sistema alterada com sucesso.";
            }else{
                echo "\n Erro ao alterar a Sistema.";
            }
        }else{
            echo "\ Não encontrei essa Sistema.";
        }   
    }
  
    private function excluirSistema(){
        echo "\nDigite o código da Sistema que deseja inativar: ";
        $Sistema = $this->SistemaPDO->findById(rtrim(fgets(STDIN)));
        print_r($Sistema);
        $s_id= $Sistema->gets_id();
        echo "\n Deseja confirmar (s/n)? ";
        $excluir = rtrim(fgets(STDIN));
        
        if(!strcasecmp($excluir, "s")){
            if($this->SistemaPDO->softdelete($s_id)){
                echo "\nSistema excluído.";
            }else{
                echo "\n Não foi possivel excluir a Sistema.";
            }       
        }
        if(!strcasecmp($excluir, "n")){
            echo "\nAbortado.";
        }
    }
    private function listarTodosSistemas(){
        print_r($this->SistemaPDO->findAll());
    }
    private function listarSistemasInativas(){
        print_r($this->SistemaPDO->finddisable());
    }
    
    private function listarSistemasPeloNome(){
        echo "\nDigite o nome do Sistema: ";
        $s_nome = rtrim(fgets(STDIN));   
        print_r($this->SistemaPDO->findByNome($s_nome));
    }
    
    private function listarSistemaPeloCodigo(){
        echo "\nDigite o código do Sistema: ";
        $s_id = rtrim(fgets(STDIN));
        print_r($this->SistemaPDO->findById($s_id));
    }
    
 private function reativarSistema(){
        echo "\nDigite o código da Sistema que deseja Ativar: ";
        $Sistema = $this->SistemaPDO->findById(rtrim(fgets(STDIN)));
        print_r($Sistema);
        $s_id= $Sistema->gets_id();
        echo "\n Deseja confirmar (s/n)? ";
        $excluir = rtrim(fgets(STDIN));
        
        if(!strcasecmp($excluir, "s")){
            if($this->SistemaPDO->reativaSistema($s_id)){
                echo "\nSistema ativado.";
            }else{
                echo "\n Não foi possivel ativar o Sistema.";
            }       
        }
        if(!strcasecmp($excluir, "n")){
            echo "\n Abortado.";
        }
    }
   }