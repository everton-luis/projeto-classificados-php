<?php

    class Imagens {

        public function inserirDados($id_usuario,$id_anuncios,$url){
            
            global $pdo;

            $sql = "insert into imagens set id_usuarios=:id_usuarios, id_anuncios=:id_anuncios, url=:url";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id_usuarios",$id_usuario);
            $sql->bindValue(":id_anuncios",$id_anuncios);
            $sql->bindValue(":url",$url);
            $sql->execute();

        }

        public function getImagensIdAnuncios($id_anuncios){

            global $pdo;

            $sql = "select * from imagens where id_anuncios=:id_anuncios";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id_anuncios",$id_anuncios);
            $sql->execute();

            $array = array();

            if($sql->rowCount() > 0){
                $sql = $sql->fetchAll();
                $array = $sql;
            }

            return $array;

        }

        public function deletarImagemId($id){

            global $pdo;

            $sql = "delete from imagens where id=:id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id",$id);
            $sql->execute();

        }

        


    }



?>