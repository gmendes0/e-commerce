<?php

    session_start();

    if(!empty($_SESSION['venda'])){

        include_once 'lib/DaoProduto.php';
        $subtotal = null;

        if(!empty($_POST)){

            if(isset($_POST['qtd'])){

                foreach($_SESSION['venda'] as $prod => $qtd){

                    $_SESSION['venda'][$prod] = intval($_POST['qtd'][$prod - 1]);
                    //

                }

            }

        }

    }

    echo '<pre>';
    print_r($_SESSION['venda']);
    print_r($_POST);
    echo '</pre>';

?>
<!-- Exigir o Login -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>Comprar</title>
    </head>

    <body>
        
        <div class="site">

            <div class="pedido">

                <h2>Seu Pedido</h2>

                <ul><!-- Lista os produtos pedidos -->
                    <!-- Header -->
                    <li>
                        <p>
                            <span>Produto</span>
                            <span>Total</span>
                        </p>
                    </li>

                    <!-- produtos -->
                    <?php
                        foreach($_SESSION['venda'] as $prod => $qtd){
                            $produto = DaoProduto::getInstance()->readOne($prod);
                            $subtotal += $produto['valor']*$qtd;
                    ?>
                        <li>
                            <span><?php echo $produto['nome']; ?></span><!-- Nome do Produto -->
                            <span>x<?php echo $qtd; ?></span><!-- Quantidade de produtos no pedido -->
                            <span>R$ <?php echo number_format($produto['valor']*$qtd, 2, ',', '.'); ?></span><!-- Valor total em relação a quantidade -->
                        </li>
                    <?php } ?>
                </ul>

                <ul><!-- Subtotal + Frete -->
                    <li>
                        <span>subtotal</span>
                        <span>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></span>
                    </li>
                </ul>

                <ul>
                    <li>
                        <span>Total</span>
                        <span>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></span><!-- somar com o frete -->
                    </li>
                </ul>

            </div>

        </div>

    </body>
</html>