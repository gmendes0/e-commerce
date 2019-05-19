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

                    $user = DaoUsuario::getInstance()->readOne($_SESSION['usuario']);

                    /**
                     * Salva pedvenda
                     */
                    $pedvenda = new Pedvenda();
                    $pedvenda->setValortotal($_SESSION['total']);
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

                        require_once 'lib/pagseguro/checkout.php';

                        // unset($_SESSION['subtotal']);
                        // unset($_SESSION['venda']);
                        // header('Location: site.php');

                    }

                }

            }

        }

    }else{

        header('Location: site.php');
        exit;

    }

?>
<!-- Exigir o Login -->
<!DOCTYPE html>

<html>

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"/>
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <title>Comprar</title>
        <script src="js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $('#form').on('input', function(e){
                    if($('#cep').val().length == 8){
                        $.post('lib/Frete.php', {cep:$('#cep').val(), servico:$('#servico option:selected').val()}, function(data){
                            $('#frete').html(data);
                            $('#valorfrete').on('input').val(data);
                            var total = parseFloat($('#subtotal').html());
                            total = total + parseFloat((data).replace(',', '.'));
                            $('#total').html((total).toFixed(2));
                        });
                    }
                });
            });
        </script>
    </head>

    <body>

        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>
        <div class="container">

            <div class="col-lg-6 order-lg-2 mb-9 mb-lg-0">

                <div class="mb-4">

                    <h2 class="h2">Seu Pedido</h2>

                </div>

                <div class="card shadow-sm mb-5">

                    <div class="card-body p-5">

                        <!-- produtos -->
                        <?php
                            foreach ($_SESSION['venda'] as $prod => $qtd) {
                                $produto = DaoProduto::getInstance()->readOne($prod);
                                $subtotal += $produto['valor'] * $qtd;
                        ?>

                            <div class="media align-items-center mb-5">

                                <div class="media-body">
                                    <h2 class="h6 mb-0"><?php echo $produto['nome']; ?></h2>
                                    <small class="d-block text-secondary">x<?php echo $qtd; ?></small>
                                </div>

                                <div class="media-body text-right">
                                    <span>R$ <?php echo number_format($produto['valor'] * $qtd, 2, ',', '.'); ?></span>
                                </div>

                            </div>

                        <?php } ?>
                        <!-- Fim produtos -->

                        <hr class="my-5" />

                        <!-- Subtotal + Frete -->
                        <div class="media align-items-center">

                            <h3 class="h6 text-secondary mr-3">Subtotal</h3>

                            <div class="media-body text-right">

                                <span>R$ </span><span id="subtotal"><?php echo $subtotal; ?></span>

                                <?php $_SESSION['subtotal'] = $subtotal; ?>

                            </div>

                        </div>
                        <!-- FIM Subtotal -->

                        <!-- Frete -->
                        <div class="media align-items-center">

                            <h3 class="h6 text-secondary mr-3">Frete</h3>

                            <div class="media-body text-right">

                                <span>R$ <span id="frete">--,--</span></span>

                            </div>

                        </div>
                        <!-- Fim Frete -->

                        <hr class="my-5" />

                        <!-- Total -->
                        <div class="media align-items-center">

                            <h3 class="h6 text-secondary mr-3">Total</h3>

                            <div class="media-body text-right">

                                <span>R$ </span><span id="total"><?php echo $subtotal; ?></span>

                            </div>

                        </div>
                        <!-- Fim Total -->

                    </div>

                </div>

            </div>

            <form method="post" name="final" id="form">
                
                <div class="form-group row">
                    <label class="col-sm-1 col-form-label" for="cep">CEP</label>
                    <div class="col-sm-2">
                        <input type="text" name="cep" id="cep" class="form-control" maxlength="8"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-1 col-form-label" for="servico">Entrega</label>
                    <div class="col-sm-2">
                        <select name="servico" id="servico" class="form-control">
                            <option value="04014">SEDEX</option>
                            <option value="04510">PAC</option>
                        </select>
                    </div>
                </div>

                <input type="hidden" name="finalizar" value="1"/>
                <input type="hidden" name="valorfrete" id="valorfrete"/>

                <div class="form-group">

                    <input class="btn btn-success" type="submit" value="Finalizar Compra"/>

                </div>

            </form>

        </div>

        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>

</html>