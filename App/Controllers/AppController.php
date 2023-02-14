<?php 
    namespace App\Controllers;

use Error;
use MF\Controller\Action; 
    use MF\Model\Container;

    class AppController extends Action{
        
        public function timeline(){
            $this->validaAutenticacao();
            $tweet=Container::getModel('tweet');
            $tweet->__set('id_usuario',$_SESSION['id']);
            $usuario = Container::getModel('usuario'); 
            $usuario->__set('id',$_SESSION['id']);
            $this->view->info = $usuario->getInfoUsuario();
            $this->view->tweets = $tweet->getAll();
            $this->render();
        }
        public function tweet(){
            $this->validaAutenticacao();
            $tweet = Container::getModel('tweet');
            $tweet->__set('tweet',$_POST['tweet']);
            $tweet->__set('id_usuario',$_SESSION['id']);
            echo 'ola';
            $tweet->salvar();
            header('Location: /home');
        }
        public function quemSeguir(){
            $this->validaAutenticacao();
            $pesquisarPor = isset($_GET['pesquisarPor'])?$_GET['pesquisarPor']:'';
            if($pesquisarPor){
                $usuario = Container::getModel('usuario');
                $usuario->__set('nome',$pesquisarPor);
                $usuario->__set('id',$_SESSION['id']);
                $usuarios =$usuario->getAll();
                $this->view->usuarios=$usuarios;
            }
            $this->render('layout2');

        }
        public function acao(){
            $this->validaAutenticacao();
            $acao = isset($_GET['acao']) ? $_GET['acao']:'';
            $id_usuario_seguindo = isset($_GET['id_usuario']) ? $_GET['id_usuario']:'';
            $usuario = Container::getModel('usuariosSeguidores');
            $usuario->__set('id_usuario',$_SESSION['id']);
            $usuario->__set('id_usuario_seguindo',$id_usuario_seguindo);
            // print_r($usuario);
            if($acao == 'seguir'){
                $usuario->seguir();
                header('Location: /quem_seguir');

            }else if($acao == 'deixar_de_seguir'){
                $usuario->deixarSeguir();
                header('Location: /quem_seguir');
            }
            
        }
        
        
    }
      
?>