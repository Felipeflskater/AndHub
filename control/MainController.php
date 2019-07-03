<?php
include_once 'MarcaController.php';
include_once 'SistemaController.php';
include_once 'SmartphoneController.php';
include_once 'RomController.php';
class MainController {
    private $marcaController;
    private $sistemaController;
    private $romController;
    private $smartphoneController;
    
    public function __construct() {
        $this->marcaController = new MarcaController();
        $this->sistemaController = new SistemaController();
        $this->romController = new RomController();
        $this->smartphoneController = new SmartphoneController();
    }
 public function exibeMenu(){
            $exit = 1;
        while ($exit != 0){
            echo "\n\n--------- Opções ---------";
            echo "\n1. Manter Marca";
            echo "\n2. Manter Sistema";
            echo "\n3. Manter Rom";
            echo "\n4. Manter Smartphone";
            echo "\nOpção (ZERO para sair): "; 
            $exit = fgets(STDIN);
            switch ($exit){
                case 0:
                    break;
                case 1:
                    $this->marcaController->exibeMenu();
                    break;
                case 2:
                    $this->sistemaController->exibeMenu();
                    break;
                case 3:
                    $this->romController->exibeMenu();
                    break;
                case 4:
                    $this->smartphoneController->exibeMenu();
                    break;
                default:
                    echo "\nOpção não encontrada.";
            }
        } 
 }
}
$mainController = new MainController();
$mainController->exibeMenu();