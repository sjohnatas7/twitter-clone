<?php

namespace App\Models;

use Error;
use MF\Model\Model;
use PDO;
use PDOException;

class Usuario extends Model{
    private $id;
    private $senha;
    private $nome;
    private $email;
    private $arroba;

    public function __get($atr){
        return $this->$atr;
    }public function __set($atr,$value){
        $this->$atr=$value;
        return $this;
    }

    public function salvar(){
        $query = "insert into usuarios(senha,nome,email,arroba)values(?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$this->__get('senha'));
        $stmt->bindValue(2,$this->__get('nome'));
        $stmt->bindValue(3,$this->__get('email'));
        $stmt->bindValue(4,$this->__get('arroba'));
        $stmt->execute();
        return $this;
    }
    public function validarCadastro(){
        $valido = true;
        print_r($this);
        try{
            if(strlen($this->__get('nome'))<3||strlen($this->__get('senha'))<3||strlen($this->__get('email'))<3){
                $valido = false;
            }
            if(count($this->getUsuarioPorEmail())>0){
                $valido = false;
                echo count($this->getUsuarioPorEmail());
            }
            return $valido;
        }catch(Error $e){
            echo $e->getMessage();
        }
    }
    public function getUsuarioPorEmail(){
        try{
            $query = 'select nome, email from usuarios where email = ? or arroba = ?' ;
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1,$this->__get('email'));
            $stmt->bindValue(2,$this->__get('arroba'));
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function getAll(){
        $query = "select u.id, u.nome, u.email,(select count(*) from usuarios_seguidores as us where us.id_usuario = ? and us.id_usuario_seguindo = u.id) as seguindo_sn from usuarios as u where u.nome like ? and u.id != ?";// or email like ?
        $stmt=$this->db->prepare($query);
        $stmt->BindValue(1,$this->__get('id'));
        $stmt->BindValue(2,'%'. $this->__get('nome').'%');
        $stmt->BindValue(3,$this->__get('id'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getInfoUsuario(){
        $query = "select nome, arroba from usuarios where id = ?";
        $stmt= $this->db->prepare($query);
        $stmt->bindValue(1,$this->__get('id',$this->__get('id')));
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function getTotalTweets(){
        $query = "select count(*) as total from tweets where id_usuario = ?";
        $stmt= $this->db->prepare($query);
        $stmt->bindValue(1,$this->__get('id',$this->__get('id')));
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function getTotalSeguindo(){
        $query = "select count(*) as total from usuario_seguidores where id_usuario = ?";
        $stmt= $this->db->prepare($query);
        $stmt->bindValue(1,$this->__get('id',$this->__get('id')));
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function getTotalSeguidores(){
        $query = "select count(*) as total from usuario_seguidores where id_usuario_seguindo = ?";
        $stmt= $this->db->prepare($query);
        $stmt->bindValue(1,$this->__get('id',$this->__get('id')));
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function autenticar(){
        $query = 'select id, nome,email,senha,arroba from usuarios where email =? AND senha = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$this->__get('email'));
        $stmt->bindValue(2,$this->__get('senha'));
        $stmt->execute();
        $usuario =$stmt->fetch(\PDO::FETCH_ASSOC);
        print_r($usuario);
        if(isset($usuario['id'])){
           $this->__set('id',$usuario['id']);
           $this->__set('nome',$usuario['nome']);
        }else{
            print_r($this);
            header('Location: /?erro=entrar');
        }
        return $this;
    }
    
}