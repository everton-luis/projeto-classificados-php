<?php

    class Anuncios {

        public function inserirDados($id_usuario,$id_categoria,$titulo,$descricao,$valor,$id_estado){

            global $pdo;

            $sql = "insert into anuncios set id_usuario=:id_usuario, id_categoria=:id_categoria, titulo=:titulo, descricao=:descricao, valor=:valor, id_estado=:id_estado";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id_usuario",$id_usuario);
            $sql->bindValue(":id_categoria",$id_categoria);
            $sql->bindValue(":titulo",$titulo);
            $sql->bindValue(":descricao",$descricao);
            $sql->bindValue(":valor",$valor);
            $sql->bindValue(":id_estado",$id_estado);
            $sql->execute();

        }

        public function getAnunciosUsuario($id){
            global $pdo;
            $sql = "select anuncios.id,anuncios.id_usuario,anuncios.id_categoria,anuncios.titulo,anuncios.descricao, anuncios.valor, anuncios.id_estado,anuncios.foto_principal, categorias.nome_categoria, estado.nome_estado from anuncios inner join categorias on categorias.id=anuncios.id_categoria inner join estado on estado.id=anuncios.id_estado where id_usuario=:id_usuario";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id_usuario",$id);
            $sql->execute();

            $array = array();

            if($sql->rowCount() > 0){
                $sql = $sql->fetchAll();
                $array = $sql;
            }

            return $array;
        }

        

        public function getAnunciosId($id_anuncios){
            
            global $pdo;

            $sql = "select * from anuncios where id=:id_anuncios";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id_anuncios",$id_anuncios);
            $sql->execute();

            if($sql->rowCount() > 0){
                $sql = $sql->fetch();
                $info = $sql;
                return $info;
            }

        }

        public function editarAnuncios($id_categoria,$titulo,$descricao,$valor,$id_estado,$id_anuncios){
            global $pdo;

            $sql = "update anuncios set id_categoria=:id_categoria, titulo=:titulo, descricao=:descricao, valor=:valor, id_estado=:id_estado where id=:id_anuncios";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id_categoria",$id_categoria);
            $sql->bindValue(":titulo",$titulo);
            $sql->bindValue(":descricao",$descricao);
            $sql->bindValue(":valor",$valor);
            $sql->bindValue(":id_estado",$id_estado);
            $sql->bindValue(":id_anuncios",$id_anuncios);
            $sql->execute();

        }
        
        public function foto_principal($id_anuncios,$foto_principal){
            
            global $pdo;

            $sql = "update anuncios set foto_principal=:foto_principal where id=:id_anuncios";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":foto_principal", $foto_principal);
            $sql->bindValue(":id_anuncios",$id_anuncios);
            $sql->execute();
        }

        public function deletarFoto_Principal($id_anuncios){

            global $pdo;

            $sql = "update anuncios set foto_principal='' where id=:id_anuncios";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id_anuncios",$id_anuncios);
            $sql->execute();

        }

        public function getAnuncios($p,$por_pagina){

            global $pdo;

            $p = ($p - 1) * 4;
            

            $sql = "select anuncios.id, anuncios.id_usuario, anuncios.id_categoria, anuncios.titulo, anuncios.descricao, anuncios.valor, anuncios.id_estado, anuncios.foto_principal, categorias.nome_categoria, estado.nome_estado, usuarios.nome from anuncios inner join categorias on categorias.id=anuncios.id_categoria inner join estado on estado.id=anuncios.id_estado inner join usuarios on usuarios.id=anuncios.id_usuario limit $p,$por_pagina";
            $sql = $pdo->query($sql);
            
            $array = array();

            if($sql->rowCount() > 0){
                $sql = $sql->fetchAll();
                $array = $sql;
            }

            return $array;
        }

        public function getTotalAnuncios(){

            global $pdo;

            $sql = "select count(*) as contagem from anuncios";
            $sql = $pdo->query($sql);

            if($sql->rowCount() > 0){
                $sql = $sql->fetch();
                $sql = $sql['contagem'];
                $info = $sql;
                return $info;
            }

        }

        public function getTotalAnunciosCategorias($id_categoria){

            global $pdo;

            $sql = "select count(*) as contagem from anuncios where id_categoria=:id_categoria";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id_categoria",$id_categoria);
            $sql->execute();

            if($sql->rowCount() > 0){
                $sql = $sql->fetch();
                $sql = $sql['contagem'];
                $info = $sql;
                return $info;
            }

        }

        public function getAnunciosCategorias($id_categoria,$p,$por_pagina){
            global $pdo;

            $p = ($p - 1) * 4;
            

            $sql = "select anuncios.id, anuncios.id_usuario, anuncios.id_categoria, anuncios.titulo, anuncios.descricao, anuncios.valor, anuncios.id_estado, anuncios.foto_principal, categorias.nome_categoria, estado.nome_estado, usuarios.nome from anuncios inner join categorias on categorias.id=anuncios.id_categoria inner join estado on estado.id=anuncios.id_estado inner join usuarios on usuarios.id=anuncios.id_usuario where anuncios.id_categoria=:id_categoria limit $p,$por_pagina";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id_categoria",$id_categoria);
            $sql->execute();
            
            $array = array();

            if($sql->rowCount() > 0){
                $sql = $sql->fetchAll();
                $array = $sql;
            }

            return $array;
        }

        public function getTotalAnunciosEstado($id_estado){

            global $pdo;

            $sql = "select count(*) as contagem from anuncios where id_estado=:id_estado";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id_estado",$id_estado);
            $sql->execute();

            if($sql->rowCount() > 0){
                $sql = $sql->fetch();
                $sql = $sql['contagem'];
                $info = $sql;
                return $info;
            }

        }

        

        public function getAnunciosEstado($id_estado,$p,$por_pagina){
            global $pdo;

            $p = ($p - 1) * 4;
            

            $sql = "select anuncios.id, anuncios.id_usuario, anuncios.id_categoria, anuncios.titulo, anuncios.descricao, anuncios.valor, anuncios.id_estado, anuncios.foto_principal, categorias.nome_categoria, estado.nome_estado, usuarios.nome from anuncios inner join categorias on categorias.id=anuncios.id_categoria inner join estado on estado.id=anuncios.id_estado inner join usuarios on usuarios.id=anuncios.id_usuario where anuncios.id_estado=:id_estado limit $p,$por_pagina";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id_estado",$id_estado);
            $sql->execute();
            
            $array = array();

            if($sql->rowCount() > 0){
                $sql = $sql->fetchAll();
                $array = $sql;
            }

            return $array;
        }

        public function getTotalAnunciosCategoriasEstado($id_categoria,$id_estado){

            global $pdo;

            $sql = "select count(*) as contagem from anuncios where id_categoria=:id_categoria and id_estado=:id_estado";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id_categoria",$id_categoria);
            $sql->bindValue(":id_estado",$id_estado);
            $sql->execute();

            if($sql->rowCount() > 0){
                $sql = $sql->fetch();
                $sql = $sql['contagem'];
                $info = $sql;
                return $info;
            }

        }

        public function getAnunciosCategoriasEstado($id_categoria,$id_estado,$p,$por_pagina){
            global $pdo;

            $p = ($p - 1) * 4;
            

            $sql = "select anuncios.id, anuncios.id_usuario, anuncios.id_categoria, anuncios.titulo, anuncios.descricao, anuncios.valor, anuncios.id_estado, anuncios.foto_principal, categorias.nome_categoria, estado.nome_estado, usuarios.nome from anuncios inner join categorias on categorias.id=anuncios.id_categoria inner join estado on estado.id=anuncios.id_estado inner join usuarios on usuarios.id=anuncios.id_usuario where anuncios.id_categoria=:id_categoria and anuncios.id_estado=:id_estado limit $p,$por_pagina";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id_categoria",$id_categoria);
            $sql->bindValue(":id_estado",$id_estado);
            $sql->execute();
            
            $array = array();

            if($sql->rowCount() > 0){
                $sql = $sql->fetchAll();
                $array = $sql;
            }

            return $array;
        }

        public function getDetalhesProduto($anuncios_id){
            
            global $pdo;

            $sql = "select anuncios.id, anuncios.id_usuario, anuncios.id_categoria, anuncios.titulo, anuncios.descricao, anuncios.valor, anuncios.id_estado, anuncios.foto_principal, categorias.nome_categoria, estado.nome_estado, usuarios.nome from anuncios inner join categorias on categorias.id=anuncios.id_categoria inner join estado on estado.id=anuncios.id_estado inner join usuarios on usuarios.id=anuncios.id_usuario where anuncios.id=:anuncios_id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":anuncios_id",$anuncios_id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $sql = $sql->fetch();
                $info = $sql;
                return $info;
            }

        }


    }


?>