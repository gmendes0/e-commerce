<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-5">

    <div class="container-fluid">

        <a href="site.php" class="navbar-brand h1 mb-0">Master Tech</a>

        <!-- Navbar Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navSite">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Conteúdo da navbar -->
        <div class="collapse navbar-collapse" id="navSite">

            <!-- conteúdos à esquerda -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="site.php" class="nav-link">Início</a></li>
                <?php if(isset($_SESSION['adm'])){ ?>
                    <li class="nav-item dropdown">
                        <!-- Dropdown Toggler -->
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">ADM</a>
                        <!-- Conteúdo -->
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="adm_cadastrar.php" class="dropdown-item">Novo Produto</a>
                            <a href="adm_fornecedor.php" class="dropdown-item">Novo Fornecedor</a>
                            <a href="adm_lista.php" class="dropdown-item">Produtos</a>
                            <a href="adm_fornecedor_lista.php" class="dropdown-item">Fornecedores</a>
                            <a href="pedidos.php" class="dropdown-item">Pedidos</a>
                            <a href="<?php echo !empty($_GET) ? $_SERVER['REQUEST_URI'].'&' : $_SERVER['REQUEST_URI'].'?'; ?>a_sair=1" class="dropdown-item">Sair</a>
                        </div>
                    </li>
                <?php

                        if(isset($_GET['a_sair'])){

                            unset($_SESSION['adm']);
                            unset($_GET['a_sair']);
                            header("Location: site.php");

                        }

                    }
                ?>
            </ul>

            <!-- Direita -->
            <ul class="navbar-nav ml-auto mr-2">
                <li class="nav-item"><a href="carrinho.php" class="nav-link">Carrinho</a></li>
                <?php

                    /**
                     * Se Logado
                     */
                    if(isset($_SESSION['usuario'])){

                        if(!empty($_SESSION['usuario'])){

                            //

                ?>
                            <!-- Se Logado -->
                            <li class="nav-item dropdown">
                                <!-- Dropdown Toggler -->
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['nome']; ?></a>
                                <!-- Conteúdo -->
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="perfil.php" class="dropdown-item">Perfil</a>
                                    <a href="pedidos.php" class="dropdown-item">Pedidos</a>
                                    <a href="<?php echo !empty($_GET) ? $_SERVER['REQUEST_URI'].'&' : $_SERVER['REQUEST_URI'].'?'; ?>sair=1" class="dropdown-item">Sair</a>
                                    <!-- Se Logado -->
                                </div>
                            </li>

                <?php

                            if(isset($_GET['sair'])){

                                if(!empty($_GET['sair']) && intval($_GET['sair']) == 1){

                                    /**
                                     * Realiza o logout
                                     */
                                    unset($_GET['sair']);
                                    if(isset($_SESSION['adm'])){
                                        $adm = $_SESSION['adm'];
                                    }

                                    $_SESSION = array();
                                    $_SESSION['adm'] = $adm;
                                    
                                    header("Location: site.php");

                                }

                            }

                        }

                    }else{

                ?>

                        <li class="nav-item"><a href="cadastro.php" class="nav-link">Crie sua Conta</a></li>
                        <li class="nav-item"><a href="login.php" class="nav-link">login </a></li>

                <?php

                    }

                ?>
            </ul>

            <div class="form-inline ">
                <!-- Barra de pesquisa -->
                <?php if(isset($page) && $page == 'index'){ ?>
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Buscar..." id="busca"/>
                        <!-- <div class="input-group-append">
                            <button class="btn btn-dark" type="submit" id="go">go</button>
                        </div> -->
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>

</nav>