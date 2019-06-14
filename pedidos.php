<?php

    session_start();
    require_once 'lib/Validacao.php';
    $validar = new Validacao;
    
    if(!isset($_SESSION['adm'])){
        
        $validar->isLoggedIn();
        $admmode = false;
        require_once 'lib/DaoPedvenda.php';
        $pedidos = DaoPedvenda::getInstance()->readFieldWhere(['idpedvenda', 'valortotal', 'data', 'ativo'], 'usuario_idusuario', $_SESSION['usuario']);

    }else{

        $admmode = true;
        require_once 'lib/DaoPedvenda.php';
        require_once 'lib/DaoUsuario.php';
        $pedidos = DaoPedvenda::getInstance()->readAll();

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
        <title><?php echo ($admmode) ? 'Pedidos' : 'Meus Pedidos' ?></title>
        <script src="js/jquery.js"></script>
    </head>

    <body>
        <?php require_once 'scripts/php/navbar.php'; ?>

        <div class="row h-100 align-items-center p-5 titulo-bg mb-5">
            <div class="col-12">
                <h2 class="text-center">Pedidos</h2>
            </div>
        </div>

        <div class="container">

            <!-- <h2 class="text-center mt-5 mb-5">Pedidos</h2> -->

            <div class="table-responsive mt-5 mb-5">
                <table class="table shadow-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Pedido</th>
                            <?php if($admmode){ ?><th class="text-center">Usuario</th><?php } ?>
                            <th>Total</th>
                            <th>Data</th>
                            <th>Ativo</th>
                            <th class="text-right">Visualizar</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($pedidos as $pedido){ ?>
                            <tr>
                                <th class="text-center"><?php echo $pedido['idpedvenda']; ?></th>
                                <?php if($admmode){ ?>
                                    <td class="text-center">
                                        #
                                        <?php
                                            echo $pedido['usuario_idusuario'].' - ';
                                            $usuario = DaoUsuario::getInstance()->readOne($pedido['usuario_idusuario']);
                                            echo $usuario['nome'];
                                        ?>
                                    </td>
                                <?php } ?>
                                <td><?php echo $pedido['valortotal']; ?></td>
                                <td><?php echo $pedido['data']; ?></td>
                                <td><?php echo $pedido['ativo']; ?></td>
                                <td class="text-right">
                                    <a href="vpedido.php?ped=<?php echo $pedido['idpedvenda']; ?>" class="btn btn-info">visualizar</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>

        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>