<?php
include_once '../pdo/MarcaPDO.php';
/**
 * Description of MarcaController
 *
 * @author FelipeFlakster
 */
class MarcaController {
   Private $MarcaPDO;
   function __construct() {
       $this->MarcaPDO = new MarcaPDO();
   }
   public function exibeMenu(){
       $exit = 1;
        while ($exit != 0){
            echo "\n\n--------- Marca ---------";
            echo "\n1. Inserir Marca";
            echo "\n2. Alterar Marca";
            echo "\n3. Excluir Marca";
            echo "\n4. Listar todos as Marca";
            echo "\n5. Listar Marca pelo nome";
            echo "\n6. Listar Marca pelo código";
            echo "\n7. Reativar Marca";
            echo "\n8. Listar Marcas Inativas";
            echo "\nOpção (ZERO para sair): "; 
            $exit = fgets(STDIN);
            switch ($exit){
                case 0:
                    break;
                case 1:
                    $this->inserirMarca();
                    break;
                case 2:
                    $this->alterarMarca();
                    break;
                case 3:
                    $this->excluirMarca();
                    break;
                case 4:
                    $this->listarTodasMarcas();
                    break;
                case 5:
                    $this->listarMarcasPeloNome();
                    break;
                case 6:
                    $this->listarMarcaPeloCodigo();
                    break;
                case 7:
                    $this->reativarMarca();
                    break;       
                case 8:
                    $this->listarMarcasInativas();
                    break;
                
                default:
                    echo "\nOpção inexistente.";
            }
        } 
    }
        private function inserirMarca(){
        $marca = new Marca();
        echo"\nNome da Marca: ";
        $marca->setM_Nome(rtrim(fgets(STDIN)));
        echo"\nSite da Marca: ";
        $marca->setM_Site(rtrim(fgets(STDIN)));
        if($this->MarcaPDO->insert($marca)){
            echo "\nMarca salvo.";
        }else{
            echo "\nErro ao salvar. Contate o administrador do sistema.";
        }
        
    }
        private function alterarMarca(){
        echo "\n Insira o código do Marca para alteração: ";
        $marca = $this->MarcaPDO->findById(rtrim(fgets(STDIN)));
        if($marca != null){
            print_r($marca);
            echo "\n Digite o nome do Marca: ";
            $m_nome = fgets(STDIN);
            if($m_nome != "\n"){
                $marca->setM_Nome(rtrim($m_nome));
            }
            echo"\n Site da Marca: ";
            $m_site = fgets(STDIN);
            if($m_site != "\n"){
                $marca->setM_Site(rtrim($m_site));
            }
            if($this->MarcaPDO->update($marca)){
                echo "\n Marca alterada com sucesso.";
            }else{
                echo "\n Erro ao alterar a Marca.";
            }
        }else{
            echo "\ Não encontrei essa Marca.";
        }   
    }
  
    private function excluirMarca(){
        echo "\nDigite o código da marca que deseja inativar: ";
        $marca = $this->MarcaPDO->findById(rtrim(fgets(STDIN)));
        print_r($marca);
        $m_id= $marca->getM_id();
        echo "\n Deseja confirmar (s/n)? ";
        $excluir = rtrim(fgets(STDIN));
        
        if(!strcasecmp($excluir, "s")){
            if($this->MarcaPDO->softdelete($m_id)){
                echo "\nmarca excluído.";
            }else{
                echo "\n Não foi possivel excluir a marca.";
            }       
        }
        if(!strcasecmp($excluir, "n")){
            echo "\nAbortado.";
        }
    }
    private function listarTodasMarcas(){
        print_r($this->MarcaPDO->findAll());
    }
    private function listarMarcasInativas(){
        print_r($this->MarcaPDO->finddisable());
    }
    
    private function listarMarcasPeloNome(){
        echo "\nDigite o nome da Marca: ";
        $m_nome = rtrim(fgets(STDIN));   
        print_r($this->MarcaPDO->findByNome($m_nome));
    }
    
    private function listarMarcaPeloCodigo(){
        echo "\nDigite o código da Marca: ";
        $m_id = rtrim(fgets(STDIN));
        print_r($this->MarcaPDO->findById($m_id));
    }
    
 private function reativarMarca(){
        echo "\nDigite o código da marca que deseja Ativar: ";
        $marca = $this->MarcaPDO->findById(rtrim(fgets(STDIN)));
        print_r($marca);
        $m_id= $marca->getM_id();
        echo "\n Deseja confirmar (s/n)? ";
        $excluir = rtrim(fgets(STDIN));
        
        if(!strcasecmp($excluir, "s")){
            if($this->MarcaPDO->reativa($m_id)){
                echo "\nmarca ativada.";
            }else{
                echo "\n Não foi possivel ativada a marca.";
            }       
        }
        if(!strcasecmp($excluir, "n")){
            echo "\n Abortado.";
        }
    }
   }