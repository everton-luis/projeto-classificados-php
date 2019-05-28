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

            $usuarios = new Usuarios();
            $anuncios = new Anuncios();
            $categorias = new Categorias();
            $estado = new Estado(); 


            $id_usuario = '';
            if(isset($_SESSION['logado'])){
                $id_usuario = $_SESSION['logado'];
            }

            $p = 1;
            if(isset($_GET['p'])){
                $p = $_GET['p'];
            }

            $lista_categorias = $categorias->getCategorias();
            $lista_estado = $estado->getEstado();

            $por_pagina = 4;

            $nome_usuario_logado = $usuarios->getNomeUsuario($id_usuario);

            $total_anuncios = $anuncios->getTotalAnuncios();
            $total_paginas = ceil($total_anuncios / $por_pagina);

            
            $lista_anuncios = $anuncios->getAnuncios($p,$por_pagina);
                
            $id_categoria = '';
            $id_estado = '';
            if(!empty($_GET['categoria']) && empty($_GET['estado'])){
                //echo 'teste1';
                $id_categoria = $_GET['categoria'];
                $total_anuncios = $anuncios->getTotalAnunciosCategorias($id_categoria);
                $total_paginas = ceil($total_anuncios / $por_pagina);
                $lista_anuncios = $anuncios->getAnunciosCategorias($id_categoria,$p,$por_pagina);
            }

            if(!empty($_GET['estado']) && empty($_GET['categoria'])){
                //echo 'teste2';
                $id_estado = $_GET['estado'];
                $total_anuncios = $anuncios->getTotalAnunciosEstado($id_estado);
                $total_paginas = ceil($total_anuncios / $por_pagina);
                $lista_anuncios = $anuncios->getAnunciosEstado($id_estado,$p,$por_pagina);
            }

            if(!empty($_GET['categoria']) && !empty($_GET['estado'])){
                //echo 'teste3';
                $id_categoria = $_GET['categoria'];
                $id_estado = $_GET['estado'];
                $total_anuncios = $anuncios->getTotalAnunciosCategoriasEstado($id_categoria,$id_estado);
                $total_paginas = ceil($total_anuncios / $por_pagina);
                $lista_anuncios = $anuncios->getAnunciosCategoriasEstado($id_categoria,$id_estado,$p,$por_pagina);

            }

            if(empty($_GET['categoria']) && empty($_GET['estado'])){
                //echo 'teste4';
                $total_anuncios = $anuncios->getTotalAnuncios();
                $total_paginas = ceil($total_anuncios / $por_pagina);

                
                $lista_anuncios = $anuncios->getAnuncios($p,$por_pagina);
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

            <div class="col-4" style="margin-top: 20px">
                <h2>Pesquisa:</h2>
                <form method="GET">
                    Categoria:<br/>
                    <select name="categoria">
                        <option value="0">Selecionar</option>
                        <?php
                            foreach($lista_categorias as $lista2): ?>
                                <option value="<?php echo $lista2['id']; ?>" 
                                <?php if($lista2['id'] == $id_categoria){
                                    echo 'selected';
                                } ?>><?php echo $lista2['nome_categoria']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br/>
                    Estado:<br/>
                    <select name="estado">
                        <option value="0">Selecionar</option>
                        <?php foreach($lista_estado as $lista3): ?>
                            <option value="<?php echo $lista3['id']; ?>"
                            <?php if($lista3['id'] == $id_estado){
                                echo 'selected';
                            } ?>><?php echo $lista3['nome_estado'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br/><br/>

                    <input class="btn btn-primary" type="submit" value="Pesquisar">

                </form>

            </div>

            <div class="col-8" style="margin-top: 20px">
                <h2>Lista de Produtos</h2>
                
                <table border="1" width="600">
                    
                    <tr>
                        <th>Foto principal</th>
                        <th>Titulo</th>
                        <th>Descricao</th>
                        <th>Valor</th>
                        <th>Categoria</th>
                        <th>Estado</th>
                    </tr>

                    <?php

                        foreach($lista_anuncios as $lista1){
                            echo '<tr>';
                                echo '<td>';
                                    if($lista1['foto_principal'] == ''){
                                        echo '<img src="arquivos/produto-sem-imagem.png" height="50" width="50">';
                                    }else{
                                        echo '<img src="arquivos/'.$lista1['foto_principal'].'" height="50" width="50">';
                                    }
                                    
                                echo '</td>';
                                echo '<td><a href="detalhes_produto.php?id='.$lista1['id'].'& id_usuario='.$lista1['id_usuario'].'">'.$lista1['titulo'].'</a></td>';
                                echo '<td>'.$lista1['descricao'].'</td>';
                                echo '<td>'.$lista1['valor'].'</td>';
                                echo '<td>'.$lista1['nome_categoria'].'</td>';
                                echo '<td>'.$lista1['nome_estado'].'</td>';
                            echo '</tr>';
                        }

                    ?>

                </table>

                <nav aria-label="Navegação de página exemplo">
                    <ul class="pagination">

                        <?php

                            for($q=0; $q<$total_paginas; $q++): ?>

                                <li class="page-item <?php if(($p - 1) == ($q)){
                                    echo 'active';
                                } ?> "><a class="page-link" href="index.php?<?php

                                $w = $_GET;
                                $w['p'] = ($q+1);
                                echo http_build_query($w);

                                ?>"><?php echo ($q+1); ?></a></li>
                            

                            <?php endfor; ?>
                    </ul>
                </nav>
                

            </div>

        </div>
    </div>





    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <body>


</html>