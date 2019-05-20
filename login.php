<?php

    session_start();

    if(!empty($_SESSION['usuario'])){

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
        
        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>

        <div class="container">

            <h2 class="mt-5 mb-5">Login</h2>

            <?php if(!empty($n)){?>
                <div class="alert alert-primary" role="alert">

                    <?= $msg[$n]; ?>

                </div>
            <?php } ?>

            <form method="post">
            
                <div class="form-group row">
                    <label for="login" class="col-sm-1 col-form-label">Login</label>
                    <div class="col-sm-4">
                        <input id="login" class="form-control" type="text" name="login" required/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="senha" class="col-sm-1 col-form-label">Senha</label>
                    <div class="col-sm-4">
                        <input id="senha" class="form-control" type="password" name="senha" required/>
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