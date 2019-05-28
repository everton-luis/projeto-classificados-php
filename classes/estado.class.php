<?php

    class Estado{

        public function getEstado(){

            global $pdo;

            $sql = "select * from estado";
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