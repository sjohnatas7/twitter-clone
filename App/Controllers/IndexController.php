<?php 
    namespace App\Controllers;

use Error;
use MF\Controller\Action; 
    use MF\Model\Container;

    class IndexController extends Action{
        
        public function index(){
            $this->render();
        }
        public function inscreverse(){
            $this->view->erroCadastro=false;
            $this->render();
        }
        public function registrar(){
            $usuario = Container::getModel('usuario');
            
            $usuario->__set('nome', $_POST['nomeRegistrar']);
            $usuario->__set('senha', md5($_POST['senhaRegistrar']));
            $usuario->__set('email', $_POST['emailRegistrar']);
            $usuario->__set('arroba', $_POST['arrobaRegistrar']);
            if($usuario->validarCadastro()){
                $usuario->salvar();
                $this->render();
            }else{
            }
        }
        
        
    }
      
?>