<html>

    <head>
        <title>Login Usuarios</title>

        <link rel="stylesheet" href="css/bootstrap.min.css">

        <?php

            include 'config.php';
            include 'classes/usuarios.class.php';
            include 'classes/anuncios.class.php';
        
            $id_usuario = '';
            if(isset($_SESSION['logado'])){
                $id_usuario = $_SESSION['logado'];
            }else{
                header("Location: index.php");
                exit;
            }

            $usuarios = new Usuarios();
            $nome_usuario_logado = $usuarios->getNomeUsuario($id_usuario);
            $email_usuario_logado = $usuarios->getEmailUsuario($id_usuario);
            $telefone_usuario_logado = $usuarios->getTelefoneUsuario($id_usuario);

            $anuncios = new Anuncios();
            $lista_anuncios_usuario = $anuncios->getAnunciosUsuario($id_usuario);

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
            <h1>Dados pessoais</h1>

                Nome:<?php echo $nome_usuario_logado; ?><br/>
                Email: <?php echo $email_usuario_logado; ?><br/>
                Telefone: <?php echo $telefone_usuario_logado; ?><br/>

                <a href="editar_usuarios.php?id_usuario=<?php echo $id_usuario ?>">Editar</a>

                <br/><br/>

                <a href="cadastrar_anuncios.php?id_usuario=<?php echo $id_usuario; ?>">Cadastrar anuncios</a>

                <br/><br/>

                <h1>Meus Anuncios</h1>
                
                <table border="1" width="1300">
                    <tr>
                        <th>Foto Principal</th>
                        <th>Titulo</th>
                        <th>Categoria</th>
                        <th>Descricao</th>
                        <th>Estado</th>
                        <th>Valor</th>
                        <th>Acoes</th>

                    </tr>

                    <?php

                        foreach($lista_anuncios_usuario as $lista1){
                            echo '<tr>';
                                echo '<td>';
                                    
                                    if($lista1['foto_principal'] == ''){
                                        echo '<img src="arquivos/produto-sem-imagem.png" width="200" height="100">';
                                    }else{
                                        echo '<img src="arquivos/'.$lista1['foto_principal'].'" width="200" height="100">';
                                    }
                                echo '</td>';
                                echo '<td>'.$lista1['titulo'].'</td>';
                                echo '<td>'.$lista1['nome_categoria'].'</td>';
                                echo '<td>'.$lista1['descricao'].'</td>';
                                echo '<td>'.$lista1['nome_estado'].'</td>';
                                echo '<td>'.$lista1['valor'].'</td>';
                                echo '<td>';
                                    echo '<a href="inserir_deletar_fotos.php?id_anuncios='.$lista1['id'].'&id_usuario='.$lista1['id_usuario'].'">Inserir ou deletar fotos</a>';
                                    echo ' - ';
                                    echo '<a href="editar_anuncios.php?id_anuncios='.$lista1['id'].'">Editar anuncio</a>';
                                    echo ' - ';
                                    echo '<a href="deletar_anuncios.php?id_anuncios='.$lista1['id'].'">Deletar anuncio</a>';
                                    echo ' - ';
                                    echo '<a href="foto_principal.php?id_anuncios='.$lista1['id'].'">Foto principal</a>';

                                echo '</td>';
                            echo '</tr>';
                        }

                    ?>


                </table>


    
            </div>


            
        </div>
    </div>





    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <body>


</html>