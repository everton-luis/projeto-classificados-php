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

            $id_imagem = '';
            if(isset($_GET['id'])){
                $id_imagem = $_GET['id'];
            }

            $url_imagem = '';
            if(isset($_GET['url_imagem'])){
                $url_imagem = $_GET['url_imagem'];
            }

            //echo $url_imagem;

            $id_anuncios = '';
            if(isset($_GET['id_anuncios'])){
                $id_anuncios = $_GET['id_anuncios'];
            }
            //echo $id_anuncios;

            $anuncios = new Anuncios();
            $anuncios1 = $anuncios->getAnunciosId($id_anuncios);
            $foto_principal_anuncio = $anuncios1['foto_principal'];
            //echo '<br/>';
            //echo $foto_principal_anuncio;

            $usuarios = new Usuarios();
            $nome_usuario_logado = $usuarios->getNomeUsuario($id_usuario);

            $imagens = new Imagens();
            $imagens->deletarImagemId($id_imagem);


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
            <br/><br/>
            <div class="col-6">
                <h2>Foto deletada com sucesso</h2>
                <br/>
                <?php
                    if($url_imagem == $foto_principal_anuncio){
                        $anuncios->deletarFoto_Principal($id_anuncios);
                        echo 'Tambem sera deletado a foto principal devido esta foto ser a Foto principal';
                    }
                ?>
                <br/>

                <a href="inserir_deletar_fotos.php?id_anuncios=<?php echo $id_anuncios; ?>" class="btn btn-primary">Voltar Inserir ou deletar fotos</a>


            </div>

        </div>
    </div>





    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <body>


</html>