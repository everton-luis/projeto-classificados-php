<?php

    class Categorias {

        public function getCategorias(){
            global $pdo;

            $sql = "select * from categorias";
            $sql = $pdo->query($sql);   

            $array = array();

            if($sql->rowCount() > 0){
                $sql = $sql->fetchAll();
                $array = $sql;
            }

            return $array;
        }



    }

?>