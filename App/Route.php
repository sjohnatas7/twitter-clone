<?php
namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap{    
    protected function initRoutes(){
        $routes['index']= array(
            'route'=>'/',
            'controller'=>'indexController',
            'action'=>'index'
        );
        $routes['inscreverse']= array(
            'route'=>'/inscreverse',
            'controller'=>'indexController',
            'action'=>'inscreverse'
        );
        $routes['registrar']= array(
            'route'=>'/registrar',
            'controller'=>'IndexController',
            'action'=>'registrar'
        );
        $routes['login']= array(
            'route'=>'/login',
            'controller'=>'AuthController',
            'action'=>'login'
        );
        $routes['autenticar']= array(
            'route'=>'/autenticar',
            'controller'=>'AuthController',
            'action'=>'autenticar'
        );
        $routes['sair']= array(
            'route'=>'/sair',
            'controller'=>'AuthController',
            'action'=>'sair'
        );
        $routes['home']= array(
            'route'=>'/home',
            'controller'=>'AppController',
            'action'=>'timeline'
        );
        $routes['tweet']= array(
            'route'=>'/tweet',
            'controller'=>'AppController',
            'action'=>'tweet'
        );
        $routes['quem_seguir']= array(
            'route'=>'/quem_seguir',
            'controller'=>'AppController',
            'action'=>'quemSeguir'
        );
        $routes['acao']= array(
            'route'=>'/acao',
            'controller'=>'AppController',
            'action'=>'acao'
        );
        $routes['user']= array(
            'route'=>'/user',
            'controller'=>'UserController',
            'action'=>'user'
        );
        $this->setRoutes($routes);
    }
}

?>