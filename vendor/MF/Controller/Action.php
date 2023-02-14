<?php

namespace MF\Controller;

use Error;
use Exception;
use stdClass;

abstract class Action{
    protected $view; 

    public function __construct(){
        $this->view= new \stdClass();
    }
    
    protected function render($layout='layout'){
        if(file_exists("../App/Views/$layout.phtml")){
            require_once "../App/Views/$layout.phtml";
        }else{
            require_once "../App/Views/layout1.phtml";
        }
    }

    protected function content($con = "",$contentGlobal=true){
        $classAtual = get_class($this);
        $classAtual = str_replace('App\\Controllers\\','',$classAtual);
        $classAtual = str_replace('Controller','',$classAtual);
        $classAtual = strtolower($classAtual);
        try{
                
                if(file_exists("../App/Views/$classAtual/" . $con .".phtml")){
                    require_once "../App/Views/$classAtual/" . $con .".phtml";
                }
        }catch(Exception $e){
            $e->getMessage();
        }
    }
    protected function validaAutenticacao(){
        session_start();
        if(!isset($_SESSION['id'])||$_SESSION['id']==''||!isset($_SESSION['nome'])||$_SESSION['nome']==''){
            header('Location: /');
        }   
    }
}