<html>

    <head>
        <title>Index</title>

        <link rel="stylesheet" href="css/bootstrap.min.css">

        <?php
            include 'config.php';
            include 'classes/usuarios.class.php';
            include 'classes/imagens.class.php';
            include 'classes/anuncios.class.php';

            $id_usuario = '';
            if(isset($_SESSION['logado'])){
                $id_usuario = $_SESSION['logado'];
            }

            $id_anuncios = '';
            if(isset($_GET['id_anuncios'])){
                $id_anuncios = $_GET['id_anuncios'];
            }
            

            $usuarios = new Usuarios();
            $nome_usuario_logado = $usuarios->getNomeUsuario($id_usuario);

            $imagens = new Imagens();
            $lista_imagens = $imagens->getImagensIdAnuncios($id_anuncios);

            $anuncios = new Anuncios();

            if(isset($_POST['foto_principal'])){

                $foto_principal = $_POST['foto_principal'];
                $anuncios->foto_principal($id_anuncios,$foto_principal);
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
                <h1>Escolher foto principal<h1>
                
                <form method="POST">

                <table border="1" width="600">

                    <tr>
                        <th>Foto</th>
                        <th></th>
                    </tr>
                    
                    <?php

                        foreach($lista_imagens as $lista1){
                            echo '<tr>';
                                echo '<td><img src="arquivos/'.$lista1['url'].'" width="300" height="200"></td>';
                                echo '<td><input type="radio" name="foto_principal" value="'.$lista1['url'].'"></td>';
                            echo '</tr>';
        
                        
                        }

                    ?>
                
                    </table>
                
                <br/><br/>
                
                <input class="btn btn-primary" type="submit" value="Enviar">

                </form>

            </div>

        </div>
    </div>





    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <body>


</html>