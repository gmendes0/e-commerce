<?php

    session_start();

    if(!empty($_SESSION['nome'])){

        echo "<script>window.location='site.php'</script>";
        exit;

    }else{

        define('REQUERIDO', true);

        require_once 'scripts/php/db_login.php';

    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"/>
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <title>Login</title>
    </head>

    <body>
        
        <div class="container">

            <?php if(!empty($n)){?><h2><?= $msg[$n]; ?></h2><?php }?>
            <form method="post">
            
                <div class="form-group row">
                    <label>Login</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="login" required/>
                    </div>
                </div>

                <div class="form-group row">
                    <label>Senha</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="password" name="senha" required/>
                    </div>
                </div>

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="entrar"/>
                </div>

                <a href="cadastro.php">Cadastre-se</a>

            </form>

            <script src="js/jquery.js"></script>
            <script src="js/popper.js"></script>
            <script src="js/bootstrap.js"></script>

        </div>
    </body>
</html>