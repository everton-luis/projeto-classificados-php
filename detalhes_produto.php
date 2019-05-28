<html>

    <head>
        <title>Destalhes produto</title>

        <link rel="stylesheet" href="css/bootstrap.min.css">

        <?php
            include 'config.php';
            include 'classes/anuncios.class.php';
            include 'classes/imagens.class.php';
            include 'classes/usuarios.class.php';

            $anuncios_id = '';
            if(isset($_GET['id'])){
                $anuncios_id = $_GET['id'];
            }

            $id_usuario = '';
            if(isset($_GET['id_usuario'])){
                $id_usuario = $_GET['id_usuario'];
            }

            $anuncios = new Anuncios();
            $imagens = new Imagens();
            $usuarios = new Usuarios();

            $nome_usuario_logado = $usuarios->getNomeUsuario($id_usuario);

            $lista_imagens = $imagens->getImagensIdAnuncios($anuncios_id);


            $dados_anuncios = $anuncios->getDetalhesProduto($anuncios_id);
            $titulo_anuncios = $dados_anuncios['titulo'];
            $descricao_anuncios = $dados_anuncios['descricao'];
            $valor_anuncios = $dados_anuncios['valor'];
            $categoria_anuncios = $dados_anuncios['nome_categoria'];
            $estado_anuncios = $dados_anuncios['nome_estado'];
            $nome_anuncios = $dados_anuncios['nome'];
            $foto_principal_anuncios = $dados_anuncios['foto_principal'];


            

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

                

                

        </div>

        <br/><br/>

        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
                <h1>Detalhes do produto</h1>
                <div class="row">                
                  
                  <br/>
                <div class="col-6">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                        <?php
                            $controle_ativo = 2;
                            
                                foreach($lista_imagens as $lista){

                                    if($controle_ativo == 2){
                                        echo '<div class="carousel-item active">
                                        <img class="d-block w-100" src="arquivos/'.$lista['url'].'" alt="First slide" height="300">
                                        </div>';
                                        $controle_ativo = 1;
                                    }else{
                                        echo '<div class="carousel-item">
                                        <img class="d-block w-100" src="arquivos/'.$lista['url'].'" height="300">
                                        </div>';
                                    }
                                
                                }
                            
                        ?>

                                
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                    </a>
                        </div>

                        
                
                    </div>
                    
                </div>

                  <div class="col-6">
                    Titulo anuncio:<?php echo $titulo_anuncios; ?>
                    <br/><br/>
                    Descricao:<?php echo $descricao_anuncios; ?>
                    <br/><br/>
                    Categoria:<?php echo $categoria_anuncios; ?>
                    <br/><br/>
                    Estado: <?php echo $estado_anuncios; ?>
                    <br/><br/>
                    Nome do Anunciante:<?php echo $nome_anuncios; ?>

                  </div>
                </div>

            </div>

          </div>

        </div>


    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>


</html>