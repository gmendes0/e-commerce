<?php

    session_start();
    require_once 'lib/Validacao.php';
    $validar = new Validacao;
    $validar->isLoggedIn();
    //apos verificação
    require_once 'lib/DaoUsuario.php';
    $user = new DaoUsuario;
    $user = $user->getInstance()->readOne($_SESSION['usuario']);

    if(!empty($_GET)){

        if(isset($_GET['id'])){

            header('Location: e_perfil.php?id='.$_GET['id']);

        }

    }

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
        <script src="js/jquery.js"></script>
        <script src="js/perfil.js"></script>
    </head>

    <body>
        <?php require_once 'scripts/php/navbar.php'; ?>
        <div class="container">

            <h2 class="text-center">Informações</h2>
            <div class="card text-center mt-5 mb-5">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#cd-perfil" id="perfil">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#cd-dados" id="dados">Dados pessoais</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#cd-endereco" id="endereco">Endereço</a>
                        </li>
                        <li class="nav-item ml-auto">
                            <a href="?id=<?php echo $user['idusuario']; ?>" class="btn btn-outline-danger">Editar</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body" id="cd-perfil">
                    <!---->
                    <h6 class="card-title">Nome: </h5>
                    <p class="card-text text-muted"><?php echo $user['nome']; ?></p>
                    <!---->
                    <h6 class="card-title">Email: </h5>
                    <p class="card-text text-muted"><?php echo $user['email']; ?></p>
                    <!---->
                    <h6 class="card-title">Nascimento: </h5>
                    <p class="card-text text-muted"><?php echo $user['nascimento']; ?></p>
                </div>

                <div class="card-body" id="cd-dados">
                    <!---->
                    <h6 class="card-title">Nome: </h5>
                    <p class="card-text text-muted"><?php echo $user['nome']; ?></p>
                    <!---->
                    <h6 class="card-title">CPF: </h5>
                    <p class="card-text text-muted"><?php echo $user['cpf']; ?></p>
                    <!---->
                    <h6 class="card-title">Nascimento: </h5>
                    <p class="card-text text-muted"><?php echo $user['nascimento']; ?></p>
                    <!---->
                    <h6 class="card-title">Telefone: </h5>
                    <p class="card-text text-muted"><?php echo $user['telefone']; ?></p>
                </div>

                <div class="card-body" id="cd-endereco">
                    <!---->
                    <h6 class="card-title">Rua: </h5>
                    <p class="card-text text-muted"><?php echo $user['endereco']; ?></p>
                    <!---->
                    <h6 class="card-title">Número: </h5>
                    <p class="card-text text-muted"><?php echo $user['numero']; ?></p>
                    <!---->
                    <h6 class="card-title">Bairro: </h5>
                    <p class="card-text text-muted"><?php echo $user['bairro']; ?></p>
                    <!---->
                    <h6 class="card-title">Cidade: </h5>
                    <p class="card-text text-muted"><?php echo $user['cidade']; ?></p>
                    <!---->
                    <h6 class="card-title">Estado: </h5>
                    <p class="card-text text-muted"><?php echo $user['estado']; ?></p>
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
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>