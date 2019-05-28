<?php

    class Usuarios {

        public function cadastrarUsuario($nome,$email,$senha,$telefone){
            global $pdo;

            $sql = "insert into usuarios set nome=:nome, email=:email, senha=:senha, telefone=:telefone";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":nome",$nome);
            $sql->bindValue(":email",$email);
            $sql->bindValue(":senha",$senha);
            $sql->bindValue(":telefone",$telefone);
            $sql->execute();

        }

        public function verificarCadastro($nome,$email){

            global $pdo;

            $sql = "select * from usuarios where nome=:nome and email=:email";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":nome",$nome);
            $sql->bindValue(":email",$email);
            
            $sql->execute();

            if($sql->rowCount() > 0){
                return false;
            }

            return true;
        }

        public function fazerLogin($nome,$email,$senha){

            global $pdo;
            
            $sql = "select * from usuarios where nome=:nome and email=:email and senha=:senha";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":nome",$nome);
            $sql->bindValue(":email",$email);
            $sql->bindValue(":senha",$senha);
            $sql->execute();

            if($sql->rowCount() > 0){
                $sql = $sql->fetch();
                $_SESSION['logado'] = $sql['id'];
                return true;
            }

            return false;
        }

        public function getNomeUsuario($id){
            global $pdo;

            $sql = "select * from usuarios where id=:id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id",$id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $sql = $sql->fetch();
                $info_nome = $sql['nome'];
                return $info_nome;
            }

        }

        

        public function getEmailUsuario($id){
            global $pdo;

            $sql = "select * from usuarios where id=:id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id",$id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $sql = $sql->fetch();
                $info_email = $sql['email'];
                return $info_email;
            }

        }

        public function getTelefoneUsuario($id){
            global $pdo;

            $sql = "select * from usuarios where id=:id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id",$id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $sql = $sql->fetch();
                $info_telefone = $sql['nome'];
                return $info_telefone;
            }

        }

        public function getSenhaUsuario($id){
            global $pdo;

            $sql = "select * from usuarios where id=:id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id",$id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $sql = $sql->fetch();
                $info_senha = $sql['senha'];
                return $info_senha;
            }

        }

        public function alterarUsuarios($nome,$email,$telefone,$senha,$id_usuario){

            global $pdo;

            $sql = "update usuarios set nome=:nome, email=:email, senha=:senha, telefone=:telefone where id=:id_usuario";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":nome",$nome);
            $sql->bindValue(":email",$email);
            $sql->bindValue(":senha",$senha);
            $sql->bindValue(":telefone",$telefone);
            $sql->bindValue(":id_usuario",$id_usuario);
            $sql->execute();

        }


    }


?>