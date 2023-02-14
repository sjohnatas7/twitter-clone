<?php 
    namespace App\Controllers;

use Error;
use MF\Controller\Action; 
    use MF\Model\Container;

    class AuthController extends Action{
        
        public function login(){
            $this->view->login = isset($_GET['erro']) ? $_GET['erro'] : '';
            $this->render('auth','layout2');
        }
        
        public function autenticar(){
            $usuario = Container::getModel('usuario');
            $usuario->__set('email',$_POST['email']);
            $usuario->__set('senha',md5($_POST['senha']));
            echo $_POST['email'].'<br>';
            print_r($_POST);
            print_r($_GET);
            print_r($usuario);
            $usuario->autenticar();
            if(!empty($usuario->__get('id'))&& !empty($usuario->__get('nome'))){
                session_start();
                $_SESSION['id']=$usuario->__get('id');
                $_SESSION['nome']=$usuario->__get('nome');
                header('Location: /home');
            }
        }
        
        public function sair(){
            session_start();
            $_SESSION['id']='';
            $_SESSION['nome']='';
            header('Location: /');
        }
        
        
        
    }
      
?>