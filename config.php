<?php

    session_start();

    try{
        $dsn = "mysql:dbname=banco_de_dados_classificados;host=localhost";
        $dbuser = "root";
        $dbpass = "";
        $pdo = new PDO($dsn,$dbuser,$dbpass);
    }catch(PDOException $e){
        echo 'Erro: '.$e->getMessage();
    }





?>