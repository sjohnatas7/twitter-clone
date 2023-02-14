<?php

namespace App\Models;

use Error;
use MF\Model\Model;
use PDOException;

class UsuariosSeguidores extends Model{
    private $id;
    private $id_usuario;
    private $id_usuario_seguindo;

    public function __get($atr){
        return $this->$atr;
    }
    public function __set($atr,$value){
        $this->$atr=$value;
        return $this;
    }
    public function seguir(){
        $query = "insert into usuarios_seguidores(id_usuario,id_usuario_seguindo)values(?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$this->__get('id_usuario'));
        $stmt->bindValue(2,$this->__get('id_usuario_seguindo'));
        $stmt->execute();
        return true;
    }
    public function deixarSeguir(){
        $query = "delete from usuarios_seguidores where id_usuario = ? and id_usuario_seguindo = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$this->__get('id_usuario'));
        $stmt->bindValue(2,$this->__get('id_usuario_seguindo'));
        $stmt->execute();
        return true;
    }
}