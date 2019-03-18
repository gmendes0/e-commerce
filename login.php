<?php

    if(!empty($_SESSION['nome'])){

        echo "<script>window.location='site.php'</script>";
        exit;

    }

    session_start();
    require_once 'scripts/php/db_login.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'/>
        <title>Login</title>
    </head>

    <body>
        
        <?php if(!empty($n)){?><h2><?= $msg[$n]; ?></h2><?php }?>
        <form method="post">
        
            <div>
                <input type="text" name="login" required/>
                <label>Login</label>
            </div>

            <div>
                <input type="password" name="senha" required/>
                <label>Senha</label>
            </div>

            <div>
                <input type="submit" value="entrar"/>
            </div>

            <a href="cadastro.php">Cadastre-se</a>

        </form>

    </body>
</html>