<?php
include_once '../pdo/SmartphonePDO.php';
/**
 * Description of SmartphoneController
 *
 * @author FelipeFlakster
 */
class SmartphoneController {
   Private $SmartphonePDO;
   function __construct() {
       $this->SmartphonePDO = new SmartphonePDO();
   }
   public function exibeMenu(){
       $exit = 1;
        while ($exit != 0){
            echo "\n\n--------- Smartphone ---------";
            echo "\n1. Inserir Smartphone";
            echo "\n2. Alterar Smartphone";
            echo "\n3. Excluir Smartphone";
            echo "\n4. Listar todos as Smartphone";
            echo "\n5. Listar Smartphone pelo nome";
            echo "\n6. Listar Smartphone pelo código";
            echo "\n7. Reativar Smartphone";
            echo "\n8. Listar Smartphones Inativas";
            echo "\nOpção (ZERO para sair): "; 
            $exit = fgets(STDIN);
            switch ($exit){
                case 0:
                    break;
                case 1:
                    $this->inserirSmartphone();
                    break;
                case 2:
                    $this->alterarSmartphone();
                    break;
                case 3:
                    $this->excluirSmartphone();
                    break;
                case 4:
                    $this->listarTodasSmartphones();
                    break;
                case 5:
                    $this->listarSmartphonesPeloNome();
                    break;
                case 6:
                    $this->listarSmartphonePeloCodigo();
                    break;
                case 7:
                    $this->reativarSmartphone();
                    break;       
                case 8:
                    $this->listarSmartphonesInativas();
                    break;
                
                default:
                    echo "\nOpção inexistente.";
            }
        } 
    }
        private function inserirSmartphone(){
        $smartphone = new Smartphone();
        echo"\n nome do Smartphone: ";  
        $smartphone->setS_nome(rtrim(fgets(STDIN)));
        echo"\n Codigo da marca do Smartphone: ";  
        $smartphone->setS_marca(rtrim(fgets(STDIN)));
        echo"\n modelo do Smartphone: ";  
        $smartphone->setS_modelo(rtrim(fgets(STDIN)));
        echo"\n codnome do Smartphone: ";  
        $smartphone->setS_codnome(rtrim(fgets(STDIN)));
        echo"\n CPU do Smartphone: ";  
        $smartphone->setS_CPU(rtrim(fgets(STDIN)));
        echo"\n GPU do Smartphone: ";  
        $smartphone->setS_GPU(rtrim(fgets(STDIN)));
        echo"\n Ram do Smartphone: ";  
        $smartphone->setS_Ram(rtrim(fgets(STDIN)));
        echo"\n Armazenamento do Smartphone: ";  
        $smartphone->setS_Armazenamento(rtrim(fgets(STDIN)));
        echo"\n Chipset do Smartphone: ";  
        $smartphone->setS_Chipset(rtrim(fgets(STDIN)));
        echo"\n Display do Smartphone: ";  
        $smartphone->setS_Display(rtrim(fgets(STDIN)));
        echo"\n Rede do Smartphone: ";  
        $smartphone->setS_Rede(rtrim(fgets(STDIN)));
        if($this->SmartphonePDO->insert($smartphone)){
            echo "\nSmartphone salvo.";
        }else{
            echo "\nErro ao salvar. Contate o administrador do sistema.";
        }
        
    }
        private function alterarSmartphone(){
        echo "\n Insira o código do Smartphone para alteração: ";
        $smartphone = $this->SmartphonePDO->findById(rtrim(fgets(STDIN)));
        if($smartphone != null){
            print_r($smartphone);
            echo"\n nome do Smartphone: ";
            $S_nome = fgets(STDIN);
            if ($S_nome != "\n") {
                $smartphone->setS_nome(rtrim($S_nome));
            }
            echo"\n marca do Smartphone: ";
            $S_marca = fgets(STDIN);
            if ($S_marca != "\n") {
                $smartphone->setS_marca(rtrim($S_marca));
            }
            echo"\n modelo do Smartphone: ";
            $S_modelo = fgets(STDIN);
            if ($S_modelo != "\n") {
                $smartphone->setS_modelo(rtrim($S_modelo));
            }
            echo"\n codnome do Smartphone: ";
            $S_codnome = fgets(STDIN);
            if ($S_codnome != "\n") {
                $smartphone->setS_codnome(rtrim($S_codnome));
            }
            echo"\n CPU do Smartphone: ";
            $S_CPU = fgets(STDIN);
            if ($S_CPU != "\n") {
                $smartphone->setS_CPU(rtrim($S_CPU));
            }
            echo"\n GPU do Smartphone: ";
            $S_GPU = fgets(STDIN);
            if ($S_GPU != "\n") {
                $smartphone->setS_GPU(rtrim($S_GPU));
            }
            echo"\n Ram do Smartphone: ";
            $S_Ram = fgets(STDIN);
            if ($S_Ram != "\n") {
                $smartphone->setS_Ram(rtrim($S_Ram));
            }
            echo"\n Armazenamento do Smartphone: ";
            $S_Armazenamento = fgets(STDIN);
            if ($S_Armazenamento != "\n") {
                $smartphone->setS_Armazenamento(rtrim($S_Armazenamento));
            }
            echo"\n Chipset do Smartphone: ";
            $S_Chipset = fgets(STDIN);
            if ($S_Chipset != "\n") {
                $smartphone->setS_Chipset(rtrim($S_Chipset));
            }
            echo"\n Display do Smartphone: ";
            $S_Display = fgets(STDIN);
            if ($S_Display != "\n") {
                $smartphone->setS_Display(rtrim($S_Display));
            }
            echo"\n Rede do Smartphone: ";
            $S_Rede = fgets(STDIN);
            if ($S_Rede != "\n") {
                $smartphone->setS_Rede(rtrim($S_Rede));
            }

            if($this->SmartphonePDO->update($smartphone)){
                echo "\n Smartphone alterada com sucesso.";
            }else{
                echo "\n Erro ao alterar a Smartphone.";
            }
        }else{
            echo "\ Não encontrei esse Smartphone.";
        }   
    }
  
    private function excluirSmartphone(){
        echo "\nDigite o código da Smartphone que deseja inativar: ";
        $Smartphone = $this->SmartphonePDO->findById(rtrim(fgets(STDIN)));
        print_r($Smartphone);
        $s_id= $Smartphone->getS_id();
        echo "\n Deseja confirmar (s/n)? ";
        $excluir = rtrim(fgets(STDIN));
        
        if(!strcasecmp($excluir, "s")){
            if($this->SmartphonePDO->softdelete($s_id)){
                echo "\nSmartphone excluído.";
            }else{
                echo "\n Não foi possivel excluir a Smartphone.";
            }       
        }
        if(!strcasecmp($excluir, "n")){
            echo "\nAbortado.";
        }
    }
    private function listarTodasSmartphones(){
        print_r($this->SmartphonePDO->findAll());
    }
    private function listarSmartphonesInativas(){
        print_r($this->SmartphonePDO->finddisable());
    }
    
    private function listarSmartphonesPeloNome(){
        echo "\nDigite o nome da Smartphone: ";
        $s_nome = rtrim(fgets(STDIN));   
        print_r($this->SmartphonePDO->findByNome($s_nome));
    }
    
    private function listarSmartphonePeloCodigo(){
        echo "\nDigite o código da Smartphone: ";
        $s_id = rtrim(fgets(STDIN));
        print_r($this->SmartphonePDO->findById($s_id));
    }
    
    private function reativarSmartphone(){
        echo "\nDigite o código da Smartphone que deseja inativar: ";
        $Smartphone = $this->SmartphonePDO->findById(rtrim(fgets(STDIN)));
        print_r($Smartphone);
        $s_id= $Smartphone->getS_id();
        echo "\n Deseja confirmar (s/n)? ";
        $ativar = rtrim(fgets(STDIN));
        
        if(!strcasecmp($ativar, "s")){
            if($this->SmartphonePDO->reativa($s_id)){
                echo "\nSmartphone ativo.";
            }else{
                echo "\n Não foi possivel ativar o Smartphone.";
            }       
        }
        if(!strcasecmp($ativar, "n")){
            echo "\nAbortado.";
        }
    }
   }