<?php

    session_start();
    //apos verificação
    require_once 'lib/DaoUsuario.php';
    $user = new DaoUsuario;
    $user = $user->getInstance()->readOne($_SESSION['usuario']);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"/>
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/style.css">
        <title><?php echo $user['nome']; ?></title>
    </head>

    <body>
        <?php require_once 'scripts/php/navbar.php'; ?>
        <div class="container">
            <div class="card text-center mt-5">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Dados pessoais</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <!---->
                    <h6 class="card-title">Nome: </h5>
                    <p class="card-text text-muted"><?php echo $user['nome']; ?></p>
                    <!---->
                    <h6 class="card-title">Email: </h5>
                    <p class="card-text text-muted"><?php echo $user['email']; ?></p>
                    <!---->
                    <h6 class="card-title">Nascimento: </h5>
                    <p class="card-text text-muted"><?php echo $user['nascimento']; ?></p>
                    <a href="#" class="btn btn-primary">Editar</a>
                </div>
                <div class="card-footer text-muted">
                    <!-- <?php echo $user['datacadastro'] - date('Y-m-d H-i-s'); ?>
                    <?php echo date_diff($user['datacadastro'], date('Y-m-d H:i:s')); ?> -->
                    <?php

                        $cad = new DateTime($user['datacadastro']);
                        $hoje = new DateTime(date('Y-m-d H:i:s'));

                        echo $hoje->diff($cad)->days.' atrás';

                    ?>
                </div>
            </div>
        </div>
    </body>
</html>