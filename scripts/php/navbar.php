<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">

    <div class="container-fluid">

        <a href="site.php" class="navbar-brand h1 mb-0">Home</a>

        <!-- Navbar Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navSite">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Conteúdo da navbar -->
        <div class="collapse navbar-collapse" id="navSite">

            <!-- conteúdos à esquerda -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="site.php" class="nav-link">Iníco</a></li>
                <li class="nav-item dropdown">
                    <!-- Dropdown Toggler -->
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">ADM</a>
                    <!-- Conteúdo -->
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="adm_cadastrar.php" class="dropdown-item">Novo Produto</a>
                        <a href="adm_fornecedor.php" class="dropdown-item">Novo Fornecedor</a>
                        <a href="adm_lista.php" class="dropdown-item">Produtos</a>
                        <a href="adm_fornecedor_lista.php" class="dropdown-item">Fornecedores</a>
                    </div>
                </li>
            </ul>

            <!-- dropdown -->
            <ul class="navbar-nav ml-auto mr-2">
                <li class="nav-item"><a href="cadastro.php" class="nav-link">crie sua conta</a></li>
                <li class="nav-item"><a href="login.php" class="nav-link">entre</a></li>
                <li class="nav-item"><a href="carrinho.php" class="nav-link">carrinho</a></li>
            </ul>

            <!-- Barra de pesquisa -->
            <form class="form-inline">
                <div class="form-group">
                    <input type="search" class="form-control" placeholder="buscar..."/>
                </div>
                <div class="form-group">
                    <button class="btn btn-dark ml-1" type="submit">go</button>
                </div>
            </form>

        </div>

    </div>

</nav>