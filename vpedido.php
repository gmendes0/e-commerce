<?php

    session_start();

    if(!isset($_GET['ped']) || !filter_var($_GET['ped'], FILTER_VALIDATE_INT)){

        header('Location: pedidos.php');
        exit;

    }else{

        require_once 'lib/Validacao.php';
        $validar = new Validacao;

        if(!isset($_SESSION['adm'])){

            $validar->isLoggedIn();

        }

        require_once 'lib/DaoPedvenda.php';
        require_once 'lib/DaoItensvenda.php';
        require_once 'lib/DaoProduto.php';
        require_once 'lib/DaoUsuario.php';

        $pedido = DaoPedvenda::getInstance()->readOne($_GET['ped']);
        $itens = DaoItensvenda::getInstance()->readAllWhere('pedvenda_idpedvenda', $_GET['ped']);
        $usuario = DaoUsuario::getInstance()->readOne($pedido['usuario_idusuario']);

    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"/>
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/style.css">
        <title>Pedido #<?php echo (isset($_GET['ped'])) ? $_GET['ped'] : '0000' ?></title>
        <script src="js/jquery.js"></script>
    </head>

    <body>
        <?php require_once 'scripts/php/navbar.php'; ?>

        <div class="container">

        <div class="card">
            <div class="card-header text-center h6">
                Pedido #<?php echo $_GET['ped']; ?>
            </div>
            <div class="card-body">
                <h6 class="card-title text-center"><span class="text-muted">Usuário:</span> <?php echo $usuario['nome'] ?></h6>
                <?php
                    foreach($itens as $key => $item){
                        $produto =  DaoProduto::getInstance()->readOne($item['produto_idproduto']);
                ?>
                    <h6 class="card-title text-center">
                        <span class="text-muted">Item <?php echo $key.': x'.$item['quantidade'].' '.$item['valorunitario'] ?></span> <?php echo $produto['nome'] ?>
                    </h6>
                <?php } ?>
            </div>
        </div>

        </div>

        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>