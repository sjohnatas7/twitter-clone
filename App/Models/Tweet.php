<?php

namespace App\Models;

use Error;
use MF\Model\Model;
use PDOException;

class Tweet extends Model{
    private $id;
    private $id_usuario;
    private $tweet;
    private $data;

    public function __get($atr){
        return $this->$atr;
    }
    public function __set($atr,$value){
        $this->$atr=$value;
        return $this;
    }
    public function salvar(){
        try{
            $query = 'insert into tweets (id_usuario,tweet) Values(? , ?)';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1,$this->__get('id_usuario'));
            $stmt->bindValue(2,$this->__get('tweet'));
            $stmt->execute();
            header("Location: /home");
            return $this;
        }catch(\PDOException $e){
            echo $e->getMessage();
        }
    }
    public function getAll(){
        $query="
            select 
                t.id,t.id_usuario,t.tweet,Date_format(t.data, '%d/%m/%y') as data, u.nome
            from 
                tweets as t
                left join usuarios u on(t.id_usuario=u.id)
            where 
                t.id_usuario = ?
                or t.id_usuario in (select id_usuario_seguindo from usuarios_seguidores where id_usuario = ?)
            order by
                t.data desc";
        $stmt=$this->db->prepare($query);
        $stmt->bindValue(1,$this->__get('id_usuario'));
        $stmt->bindValue(2,$this->__get('id_usuario'));
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getUser(){
        $query = "select 
                    t.id,t.id_usuario,t.tweet,Date_format(t.data, '%d/%m/%y') as data, u.nome
                from 
                    tweets as t
                    left join usuarios u on(t.id_usuario=u.id)
                where 
                    t.id_usuario = ?
                order by
                    t.data desc";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$this->__get('id_usuario'));
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}