<?php 
    namespace App\Controllers;

use Error;
use MF\Controller\Action; 
    use MF\Model\Container;

    class UserController extends Action{
        
        
        public function user(){
            $this->validaAutenticacao();
            if(isset($_GET['id'])){
                $tweet = Container::getModel('tweet');
                $tweet->__set('id_usuario', $_GET['id']);
                $this->view->tweets = $tweet->getUser();

                $usuario_conteudo = Container::getModel('usuario');
                $usuario_conteudo->__set('id',$_GET['id']);
                print_r($usuario_conteudo);
                $this->view->totalTweets = $usuario_conteudo->getTotalTweets();
                $this->view->info_user = $usuario_conteudo->getInfoUsuario();
                
                $usuario = Container::getModel('usuario');
                $usuario->__set('id',$_SESSION['id']);
                $this->view->info = $usuario->getInfoUsuario();

                $this->render();
            }
            
        }
    }
      
?>