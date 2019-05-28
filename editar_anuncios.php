<html>

    <head>
        <title>Index</title>

        <link rel="stylesheet" href="css/bootstrap.min.css">

        <?php
            include 'config.php';
            include 'classes/usuarios.class.php';
            include 'classes/anuncios.class.php';
            include 'classes/categorias.class.php';
            include 'classes/estado.class.php';

            $id_usuario = '';
            if(isset($_SESSION['logado'])){
                $id_usuario = $_SESSION['logado'];
            }

            $id_anuncios = '';
            if(isset($_GET['id_anuncios'])){
                $id_anuncios = $_GET['id_anuncios'];
            }

            //echo $id_anuncios;

            $usuarios = new Usuarios();
            $nome_usuario_logado = $usuarios->getNomeUsuario($id_usuario);

            $categorias = new Categorias();
            $getCategorias = $categorias->getCategorias();

            $estado = new Estado();
            $getEstado = $estado->getEstado();


            $anuncios = new Anuncios();
            $anunciosId = $anuncios->getAnunciosId($id_anuncios);
            $titulo_anuncio_id = $anunciosId['titulo'];
            $id_categoria_id = $anunciosId['id_categoria'];
            $descricao_id = $anunciosId['descricao'];
            $valor_id = $anunciosId['valor'];
            $estado_id = $anunciosId['id_estado'];
            
            if(isset($_POST['titulo'])){
                $titulo = $_POST['titulo'];
                $id_categoria = $_POST['id_categoria'];
                $descricao = $_POST['descricao'];
                $valor = $_POST['valor'];
                $id_estado = $_POST['id_estado'];

                $anuncios->editarAnuncios($id_categoria,$titulo,$descricao,$valor,$id_estado,$id_anuncios);

                header("Location: index_usuarios.php");
            }

        ?>

    </head>

    <body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12" style="background-color: gray; padding-top:20px; padding-bottom: 20px;">
            <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
                <a class="navbar-brand" href="index.php">Projeto Classificados</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(página atual)</span></a>
                    </li>
                    
                    </ul>
                    <?php
                            if(isset($_SESSION['logado'])){
                                echo '
                                    <form class="form-inline my-2 my-lg-0">
                                        <div style="color: white; margin-right: 5px">
                                            Usuarios logado:'.$nome_usuario_logado.'
                                        </div>
                                        <div style="margin-right: 5px">
                                            <a href="index_usuarios.php" class="btn btn-primary">Minha conta</a>
                                        </div>
                                        <a href="sair.php" class="btn btn-primary">Sair</a>
                                    </form>
                                ';
                            }else{
                                echo '
                                    <form class="form-inline my-2 my-lg-0">
                                    <a href="login.php" class="btn btn-primary" style="margin-right: 10px;">Login</a>
                                    <a href="cadastrar.php" class="btn btn-primary">Cadastrar</a>
                                    </form>
                                ';
                            }

                    ?>

                </div>
                </nav>
            </div>

            <div class="col-12">
                <h1>Editar Anuncios</h1>
                
                <form method="POST">
                
                    Titulo Produto:<br/>
                    <input type="text" name="titulo" value="<?php echo $titulo_anuncio_id; ?>"><br/>
                    <br/>
                    
                    Categoria Produto:<br/>
                    <select name="id_categoria">
                        <option>Selecionar</option>
                        <?php

                            foreach($getCategorias as $lista_categorias):
                            ?>
                                <option value="<?php echo $lista_categorias['id'] ?>" 
                                <?php if($lista_categorias['id'] == $id_categoria_id){
                                    echo 'selected';
                                } ?>><?php echo $lista_categorias['nome_categoria'] ?></option>
        
                            <?php endforeach; ?>

                    </select>
                    <br/><br/>
                    
                    Descricao:<br/>
                    <textarea rows="5" cols="30" name="descricao"><?php echo $descricao_id; ?></textarea>
                    <br/><br/>
                    
                    Valor:<br/>
                    <input type="text" name="valor" value="<?php echo $valor_id; ?>">
                    <br/><br/>

                    Estado:<br/>
                    <select name="id_estado">
                        <option>Selecionar</option>
                        <?php
                            foreach($getEstado as $lista_estado): ?>

                                <option value="<?php echo $lista_estado['id'] ?>"
                                <?php if($lista_estado['id'] == $estado_id){
                                    echo 'selected';
                                } ?>><?php echo $lista_estado['nome_estado'] ?></option>

                            <?php endforeach; ?>

                    </select>

                    <br/><br/>

                    <input class="btn btn-primary" type="submit" value="Editar">
                


                </form>
    
            </div>

        </div>
    </div>





    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <body>


</html>