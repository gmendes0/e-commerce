<nav class="navbar">
        
    <ul>
        
        <li><a href="site.php">home</a></li>
        <li><a href="carrinho.php">carrinho</a></li>

        <?php

            /**
             * Se Logado
             */
            if(isset($_SESSION['usuario'])){

                if(!empty($_SESSION['usuario'])){

        ?>

                    <li><a href="<?php echo $_SERVER['REQUEST_URI']; ?>?sair=1">sair</a></li>

        <?php

                    if(isset($_GET['sair'])){

                        if(!empty($_GET['sair']) && intval($_GET['sair']) == 1){

                            /**
                             * Realiza o logout
                             */

                            unset($_SESSION['usuario']);
                            unset($_GET['sair']);
                            header("Location: site.php");

                        }

                    }

                }

            }else{

        ?>

                <li><a href="cadastro.php">crie sua conta</a></li>
                <li><a href="login.php">entre</a></li>

        <?php

            }

        ?>

    </ul>
    
</nav>