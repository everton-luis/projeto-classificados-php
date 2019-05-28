<html>

    <head>
        <title>Cadastrar Anuncios</title>

        <link rel="stylesheet" href="css/bootstrap.min.css">

        <?php

            include 'config.php';
            include 'classes/usuarios.class.php';
            include 'classes/categorias.class.php';
            include 'classes/estado.class.php';
            include 'classes/anuncios.class.php';


            $id_usuario = '';
            if(!isset($_SESSION['logado'])){
                header("Location: login.php");
                exit;
            }

            if(isset($_GET['id_usuario'])){
                $id_usuario = $_GET['id_usuario'];
            }



            $usuarios = new Usuarios();
            $nome_usuario_logado = $usuarios->getNomeUsuario($id_usuario);
            
            $categorias = new Categorias();
            $lista_categorias = $categorias->getCategorias();

            $estado = new Estado();
            $lista_estado = $estado->getEstado();

            if(isset($_POST['titulo']) && (empty($_POST['titulo']) == false)){
                $titulo = $_POST['titulo'];
                $id_categoria = $_POST['id_categoria'];
                $descricao = $_POST['descricao'];
                $valor = $_POST['valor'];
                $id_estado = $_POST['id_estado'];

                $anuncios = new Anuncios();
                $anuncios->inserirDados($id_usuario,$id_categoria,$titulo,$descricao,$valor,$id_estado);
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
                <h1>Cadastrar Anuncios</h1>
                
                <form method="POST">
                
                    Titulo Produto:<br/>
                    <input type="text" name="titulo"><br/>
                    <br/>
                    
                    Categoria Produto:<br/>
                    <select name="id_categoria">
                        <option>Selecionar</option>
                        <?php

                            foreach($lista_categorias as $lista1){
                                echo '<option value="'.$lista1['id'].'">'.$lista1['nome_categoria'].'</option>';
                            }

                        ?>

                    </select>
                    <br/><br/>
                    
                    Descricao:<br/>
                    <textarea rows="5" cols="30" name="descricao"></textarea>
                    <br/><br/>
                    
                    Valor:<br/>
                    <input type="text" name="valor">
                    <br/><br/>

                    Estado:<br/>
                    <select name="id_estado">
                        <option>Selecionar</option>
                        <?php
                            foreach($lista_estado as $lista2){
                                echo '<option value="'.$lista2['id'].'">'.$lista2['nome_estado'].'</option>';
                            }
                        ?>

                    </select>

                    <br/><br/>

                    <input class="btn btn-primary" type="submit" value="Cadastrar">
                


                </form>
    
            </div>


            
        </div>
    </div>





    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <body>


</html>