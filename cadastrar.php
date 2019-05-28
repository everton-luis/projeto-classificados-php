<html>

    <head>
        <title>Cadastrar Usuarios</title>

        <link rel="stylesheet" href="css/bootstrap.min.css">

        <?php

            include 'config.php';
            include 'classes/usuarios.class.php';

            if(isset($_POST['nome']) && (empty($_POST['nome']) == false)){
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = md5($_POST['senha']);
                $telefone = $_POST['telefone'];

                $usuarios = new Usuarios();

                if($usuarios->verificarCadastro($nome,$email)){
                    $usuarios->cadastrarUsuario($nome,$email,$senha,$telefone);
                    header("Location: index.php");
                }else{
                    echo 'usuario ja cadastrado';
                }
                
                

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
                        <form class="form-inline my-2 my-lg-0">
                        <a href="login.php" class="btn btn-primary" style="margin-right: 10px;">Login</a>
                        <a href="cadastrar.php" class="btn btn-primary">Cadastrar</a>
                        </form>
                    </div>
                </nav>
            </div>
            

            <div class="col-12">
                <h1>Cadastro Usuarios</h1>
                <br/><br/>

                <form method="POST">
                    <div class="form-group row">
                        <label for="nome" class="col-sm-1 col-form-label">Nome</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome Completo">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-1 col-form-label">Email</label>
                        <div class="col-sm-5">
                        <input type="email" class="form-control" name="email" id="email" placeholder="exemplo@provedor.com">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telefone" class="col-sm-1 col-form-label">Telefone</label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="telefone" id="telefone" placeholder="(dd)xxxxxxxx">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-1 col-form-label">Senha</label>
                        <div class="col-sm-8">
                        <input type="password" class="form-control" name="senha" id="inputPassword" placeholder="Senha">
                        </div>
                    </div>

                    <br/><br/>

                    <input class="btn btn-primary" type="submit" value="Enviar">

                </form>
            </div>


            </div>
        </div>
    </div>





    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <body>


</html>