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
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"/>
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <title>Comprar</title>
    </head>

    <body>
        
        <div class="container">

        <div class="col-lg-6 order-lg-2 mb-9 mb-lg-0">
            
            <div class="mb-4">
                    
                <h2 class="h2">Seu Pedido</h2>

            </div>

            <div class="card shadow-sm mb-5">

                <div class="card-body p-5">
                
                    <!-- produtos -->
                    <?php
                        foreach($_SESSION['venda'] as $prod => $qtd){
                            $produto = DaoProduto::getInstance()->readOne($prod);
                            $subtotal += $produto['valor']*$qtd;
                    ?>

                    <div class="media align-items-center mb-5">

                        <div class="media-body">
                            <h2 class="h6 mb-0"><?php echo $produto['nome']; ?></h2>
                            <small class="d-block text-secondary">x<?php echo $qtd; ?></small>
                        </div>

                        <div class="media-body text-right">
                            <span>R$ <?php echo number_format($produto['valor']*$qtd, 2, ',', '.'); ?></span>
                        </div>

                    </div>

                    <?php } ?>
                    <!-- Fim produtos -->

                    <hr class="my-5"/>

                    <!-- Subtotal + Frete -->
                    <div class="media align-items-center">
                        
                        <h3 class="h6 text-secondary mr-3">Subtotal</h3>

                        <div class="media-body text-right">

                            <span>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></span>

                        </div>

                    </div>
                    <!-- FIM Subtotal -->

                    <!-- Frete -->
                    <div class="media align-items-center">
                        
                        <h3 class="h6 text-secondary mr-3">Frete</h3>

                        <div class="media-body text-right">

                            <span>R$ 0,00</span>

                        </div>

                    </div>
                    <!-- Fim Frete -->

                    <hr class="my-5"/>

                    <!-- Total -->
                    <div class="media align-items-center">
                        
                        <h3 class="h6 text-secondary mr-3">Total</h3>

                        <div class="media-body text-right">

                            <span>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></span>

                        </div>

                    </div>
                    <!-- Fim Total -->

                </div>

            </div>

        </div>

    </div>

        <script src="js/jquery.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>
</html>