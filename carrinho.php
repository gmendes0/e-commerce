<?php

    session_start();

    $content = false;

    require_once 'lib/Venda.php';

    if(!empty($_SESSION)){
    
        if(!empty($_SESSION['venda'])){

            include_once 'lib/DaoProduto.php';

            $content = true;

            // session_destroy();

        }
    
    }

    if(isset($_GET['remove'])){

        if(!empty($_GET['remove']) || $_GET['remove'] != null){

            unset($_SESSION['venda'][$_GET['remove']]);
            header('Location: carrinho.php');

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
        <title>Carrinho</title>
    </head>

    <body>

        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>

        <!-- conteúdo do site -->
        <div class="container">

            <h1 class="text-center">carrinho</h1>
                
            <table class="table">

                <thead class="table-dark">

                    <tr scope="row">
                        <td>produto</td>
                        <td>preço unitário</td>
                        <td>quantidade</td>
                        <td>subtotal</td>
                        <td>ações</td>
                    </tr>

                </thead>
                
                <tbody>
                    <?php 

                        if($content){

                            foreach($_SESSION['venda'] as $prod => $qtd){

                            $produto = DaoProduto::getInstance()->readOne($prod);
                    ?>
                        <tr scope="row">
                            <td><?php echo $produto['nome']; ?></td>
                            <td><?php echo 'R$ '.$produto['valor']; ?></td>
                            <td><?php echo $qtd; ?></td>
                            <td><?php echo 'R$ '.$produto['valor']*$qtd; ?></td>
                            <td><a href="carrinho.php?remove=<?php echo $produto['idproduto']; ?>">remover</a></td>
                        </tr>
                    
                    <?php }}else{ ?>

                        <td colspan="5" class="text-center">Nenhum item para mostrar</td>

                    <?php } ?>
                </tbody>

            </table>

            <a href="site.php">continue comprando</a>

        </div>
            
        <script src="js/jquery.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>

</html>