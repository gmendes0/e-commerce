<?php

    session_start();

    /**
     * Exige login par entrar na página
     */
    if(!isset($_SESSION['usuario'])){

        header('Location: login.php');
        exit;

    }

    /**
     * Verifica se há itens
     */
    if(!empty($_SESSION['venda'])){

        require_once 'lib/DaoProduto.php';
        $subtotal = null;

        if(!empty($_POST)){

            if(isset($_POST['qtd'])){

                foreach($_SESSION['venda'] as $prod => $qtd){

                    $_SESSION['venda'][$prod] = intval($_POST['qtd'][$prod]);

                }

                header('Location: comprar.php'); // Atualiza a página destruindo o $_POST

            }

            /**
             * Se finalizar a compra
             */
            if(!empty($_POST['finalizar'])){

                if(intval($_POST['finalizar'] == 1) && isset($_SESSION['venda'])){

                    require_once 'lib/ItensVenda.php';
                    require_once 'lib/PedVenda.php';
                    require_once 'lib/DaoUsuario.php';
                    require_once 'lib/DaoItensVenda.php';
                    require_once 'lib/DaoPedVenda.php';

                    /**
                     * Salva pedvenda
                     */
                    $pedvenda = new Pedvenda();
                    $pedvenda->setValortotal($_SESSION['subtotal']);
                    $pedvenda->setData(date('Y-m-d H:i:s'));
                    $pedvenda->setAtivo(1);
                    $pedvenda->setFk_idusuario($_SESSION['usuario']);

                    $insertPV = DaoPedvenda::getInstance()->create($pedvenda);

                    if($insertPV){

                        /**
                         * Recupera o ultimo ID do pedido do usuario
                         */
                        try{
                            
                            $idpedvenda = DaoPedvenda::getInstance()->lastIDpedvenda($_SESSION['usuario']);

                            echo "<pre>";   //
                            var_dump($idpedvenda);  //
                            echo "</pre>";  //

                        }catch(PDOException $e){

                            $e->getMessage();

                        }

                        /**
                         * Arrumar: Salvar ID do Usuario + ID Itens Venda
                         */
                        $itensvenda = new Itensvenda();
                    
                        foreach($_SESSION['venda'] as $id => $q){

                            $p = DaoProduto::getInstance()->readOne($id);

                            $itensvenda->setQuantidade($q);
                            $itensvenda->setValorunitario($p['valor']);
                            $itensvenda->setValordesconto(0);
                            $itensvenda->setFk_idproduto($id);
                            $itensvenda->setFk_idpedvenda($idpedvenda['idpedvenda']);

                            DaoItensvenda::getInstance()->create($itensvenda);

                        }

                        unset($_SESSION['subtotal']);
                        unset($_SESSION['venda']);
                        header('Location: site.php');

                    }

                }

            }

        }

    }else{

        header('Location: site.php');
        exit;

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
                        <?php $_SESSION['subtotal'] = $subtotal; ?>
                    </li>
                </ul>

                <ul>
                    <li>
                        <span>Total</span>
                        <span>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></span><!-- somar com o frete -->
                    </li>
                </ul>

            </div>
                
            <form method="post">
                
                <input type="hidden" name="finalizar" value="1"/>
                <input type="submit" value="Finalizar Compra"/>

            </form>

        </div>

    </body>
</html>