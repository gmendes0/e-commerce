<?php

    session_start();

    require_once 'lib/Compra.php';

    if(!empty($_SESSION)){
    
        if(!empty($_SESSION['venda'])){

            include_once 'lib/DaoProduto.php';

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
        <link rel="stylesheet" href="css/style.css"/>
        <title>Carrinho</title>
    </head>

    <body>

        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>

        <!-- conteúdo do site -->
        <div class="site">

            <h1>carrinho</h1>

            <form method="post">
                
                <table>

                    <thead>

                        <tr>
                            <td>produto</td>
                            <td>preço unitário</td>
                            <td>quantidade</td>
                            <td>subtotal</td>
                            <td>ações</td>
                        </tr>

                    </thead>
                    
                    <tbody>
                        <?php 

                            foreach($_SESSION['venda'] as $prod => $qtd){

                                $produto = DaoProduto::getInstance()->readOne($prod);
                        ?>
                            <tr>
                                <td><?php echo $produto['nome']; ?></td>
                                <td><?php echo 'R$ '.$produto['valor']; ?></td>
                                <td><input type="number" name='qtd' min="0" value="<?php echo $qtd; ?>"></td>
                                <td><?php echo 'R$ '.$produto['valor']*$qtd; ?></td>
                                <td><a href="carrinho.php?remove=<?php echo $produto['idproduto']; ?>">remover</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>

            </form>

        </div>

    </body>
</html>