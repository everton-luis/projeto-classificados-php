<html>

    <head>
        <title>Index</title>

        <link rel="stylesheet" href="css/bootstrap.min.css">

        <?php
            include 'config.php';
            include 'classes/usuarios.class.php';

            $id_usuario = '';
            if(isset($_SESSION['logado'])){
                $id_usuario = $_SESSION['logado'];
            }

            echo $id_usuario;

            $usuarios = new Usuarios();
            $nome_usuario_logado = $usuarios->getNomeUsuario($id_usuario);
            $nome_usuario = $usuarios->getNomeUsuario($id_usuario);
            $email_usuario = $usuarios->getEmailUsuario($id_usuario);
            $telefone_usuario = $usuarios->getTelefoneUsuario($id_usuario);
            
            if(isset($_POST['nome'])){

                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = md5($_POST['senha']);
                $telefone = $_POST['telefone'];

                $usuarios->alterarUsuarios($nome,$email,$telefone,$senha,$id_usuario);

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
                <h1>Editar usuarios</h1>

                <form method="POST">
                    
                    Nome:<br/>
                    <input type="text" name="nome" value="<?php echo $nome_usuario; ?>">
                    <br/><br/>
                    Email:<br/>
                    <input type="email" name="email" value="<?php echo $email_usuario; ?>">
                    <br/><br/>
                    Telefone:<br/>
                    <input type="text" name="telefone" value="<?php echo $telefone_usuario; ?>">
                    <br/><br/>
                    Senha:<br/>
                    <input type="password" name="senha">
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