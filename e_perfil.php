<?php

    session_start();
    //apos verificação
    require_once 'lib/DaoUsuario.php';
    $user = new DaoUsuario;
    $user = $user->getInstance()->readOne($_SESSION['usuario']);

    if(!empty($_POST)){

        if(!empty($_POST['editar'])){

            if($_POST['editar'] == $user['idusuario']){

                //exibir o foemulario de edição
                $visualizar = true;

            }else{

                header('Location: perfil.php');

            }

        }

    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"/>
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/style.css">
        <title>Editar - <?php echo $user['nome']; ?></title>
        <script src="js/jquery.js"></script>
    </head>

    <body>
        <div class="container">
            <!------------------------------------------------------------------------------------------>
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Aviso</h4>
                    <p>Deseja mesmo alterar os dados? Esta ação é irreversível.</p>
                    <hr>
                    <a class="btn btn-secondary" href="perfil.php?stats=s">sim</a>
                    <a class="btn btn-secondary" href="perfil.php?stats=n">não</a>
                </div>
            <!-------------------------------------------------------------------------------------------->
            <?php if($visualizar){ ?>
                <!-- form -->
            <?php } ?>
        </div>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>