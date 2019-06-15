<?php

    session_start();

    // require_once 'conexao.php';
    require_once 'lib/pagseguroct/config.php';
    require_once 'lib/Validacao.php';

    $validacao = new Validacao;
    $validacao->isLoggedIn();

    /**
     * Verifica se há itens
     */
    if(!empty($_SESSION['venda'])){

        require_once 'lib/DaoProduto.php';
        require_once 'lib/DaoFornecedor.php';
        $subtotal = null;

        if(!empty($_POST)){

            if(isset($_POST['qtd'])){

                foreach($_SESSION['venda'] as $prod => $qtd){
                    
                    $_SESSION['venda'][$prod] = intval($_POST['qtd'][$prod]);
                }

                /**
                 * Atualiza a página destruindo o $_POST
                 */
                echo "<script>window.location='checkout.php'</script>";
                exit;
            }
        }else{

            $produtos_no_carrinho = 0;
            $to_checkout = array();
            /**
             * Exibição de itens
             */
            foreach($_SESSION['venda'] as $prod => $qtd){

                /**
                 * Contador de itens no carrinho
                 */
                $produtos_no_carrinho++;
                $produto = DaoProduto::getInstance()->readOne($prod);
                $subtotal += $produto['valor'] * $qtd;

            }
            unset($produto);
        }

    }else{

        echo "<script>window.location='site.php'</script>";
        exit;
    }

    $total_venda = number_format($subtotal, 2, '.', '');
    $carrinho_id = 1;

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Teste - PagSeguro</title>
    </head>

    <body>
        
        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>

        <div class="row h-100 align-items-center p-5 titulo-bg mb-5">
            <div class="col-12">
                <h2 class="text-center">Checkout</h2>
            </div>
        </div>

        <div class="container mt-5 mb-5">

            <!-- <div class="text-center py-5">
                <h2>Checkout</h2>
            </div> -->
            
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Seu carrinho</span>
                        <span class="badge badge-secondary badge-pill"><?php echo $produtos_no_carrinho; ?></span>
                    </h4>

                    <ul class="list-group mb-3">
                        <!-- Produtos -->
                        <?php
                            foreach($_SESSION['venda'] as $prod => $qtd){

                                $produto = DaoProduto::getInstance()->readOne($prod);
                                $fornecedor = DaoFornecedor::getInstance()->readOne($produto['fornecedor_idfornecedor']);
                        ?>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0"><?php echo $produto['nome']; ?></h6>
                                    <small class="text-muted"><?php echo $fornecedor['nome']; ?> - x<span><?php echo $qtd; ?></span></small>
                                </div>
                                <span class="text-muted">
                                    <span>R$ <?php echo number_format($produto['valor'] * $qtd, 2, ',', '.'); ?></span>
                                </span>
                            </li>
                        <?php } ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Subtotal (BRL)</span>
                            <strong>
                                <span>R$ </span><span id="subtotal"><?php echo $subtotal; ?></span>
                                <?php $_SESSION['subtotal'] = $subtotal; ?>
                            </strong>
                        </li>

                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-danger">
                                <h6 class="my-0">Frete (BRL)</h6>
                                <small id="cepsmall">00000000</small>
                            </div>
                            <span id="valfrete" class="text-danger"></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (BRL)</span>
                            <strong>
                                <span>R$ </span><span id="total"><?php echo $subtotal; ?></span>
                            </strong>
                        </li>
                    </ul>
                </div>

                <div class="col-md-8 order-md-1">

                    <form id="formFinalizarCompra" method="post">

                        <!-- Form -->
                        <h4 class="text-muted mb-3">Dados pessoais</h4>
                        
                        <div class="mb-3">
                            <label for="sendername">Nome Completo</label>
                            <input type="text" name="senderName" id="sendername" class="form-control"/>
                        </div>

                        <div class="mb-3">
                            <label for="sendercpf">CPF</label>
                            <input type="text" name="senderCPF" id="sendercpf" class="form-control"/>
                        </div>

                        <div class="row">
                            <div class="col-3 col-md-2 mb-3">
                                <label for="senderareacode">DDD</label>
                                <input type="text" name="senderAreaCode" id="senderareacode" class="form-control" maxlength="2"/>
                            </div>
                            
                            <div class="col-9 col-md-10 mb-3">
                                <label for="senderphone">Telefone</label>
                                <input type="text" name="senderPhone" id="senderphone" class="form-control" maxlength="9"/>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="senderemail">Email</label>
                            <input type="text" name="senderEmail" id="senderemail" class="form-control"/>
                        </div>

                        <h4 class="text-muted mt-5 mb-3">Endereço de entrega</h4>

                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label for="shippingaddresspostalcode">CEP</label>
                                <input type="text" name="shippingAddressPostalCode" id="shippingaddresspostalcode" class="form-control" maxlength="8"/>
                            </div>
    
                            <div class="col-5 col-md-2 mb-3">
                                <label for="shippingaddresscountry">País</label>
                                <select name="shippingAddressCountry" id="shippingaddresscountry" class="form-control">
                                    <option value="BRA">Brasil</option>
                                </select>
                            </div>

                            <div class="col-7 col-md-4 mb-3">
                                <label for="shippingaddressstate">Estado</label>
                                <select name="shippingAddressState" id="shippingaddressstate" class="form-control">
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-9 col-md-10 mb-3">
                                <label for="shippingaddressstreet">Endereço</label>
                                <input type="text" name="shippingAddressStreet" id="shippingaddressstreet" class="form-control"/>
                            </div>
    
                            <div class="col-3 col-md-2 mb-3">
                                <label for="shippingaddressnumber">Número</label>
                                <input type="text" name="shippingAddressNumber" id="shippingaddressnumber" class="form-control"/>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="shippingaddresscomplement">Complemento</label>
                            <input type="text" name="shippingAddressComplement" id="shippingaddresscomplement" class="form-control"/>
                        </div>
                        
                        <div class="mb-3">
                            <label for="shippingaddressdistrict">Bairro</label>
                            <input type="text" name="shippingAddressDistrict" id="shippingaddressdistrict" class="form-control"/>
                        </div>

                        <div class="mb-3">
                            <label for="shippingaddresscity">Cidade</label>
                            <input type="text" name="shippingAddressCity" id="shippingaddresscity" class="form-control"/>
                        </div>

                        <div class="mb-3">
                            <label for="shippingtype">Serviço de frete</label>
                            <select name="shippingType" id="shippingtype" class="form-control">
                                <option value="3">Selecione</option>
                                <option value="1">PAC</option>
                                <option value="2">SEDEX</option>
                            </select>
                        </div>

                        <hr class="mt-5 mb-5">

                        <h4 class="text-muted mt-5 mb-3">Método de pagamento</h4>

                        <div class="mb-3">
                            <select name="paymentMethod" id="paymentmethod" class="form-control">
                                <option value="boleto">Boleto</option>
                                <option value="creditCard">Cartão de crédito</option>
                                <option value="eft">Débito online</option>
                            </select>
                        </div>

                        <div id="bankSelect">
                            <div class="mb-3">
                                <label for="bankName">Banco</label>
                                <select name="bankName" id="bankName" class="form-control">
                                    <option value="">Selecione</option>
                                </select>
                            </div>
                        </div>

                        <div id="cardData">
                            <h4 class="text-muted mt-5 mb-3">Dados do cartão</h4>

                            <div class="row">
                                <div class="col-8 col-md-9 mb-3">
                                    <label for="ncartao">Número do cartão</label>
                                    <input type="text" name="nCartao" id="ncartao" class="form-control"/>
                                </div>

                                <div class="col-4 col-md-3 mb-3">
                                    <label for="cvv">CVV</label>
                                    <input type="text" name="cvv" id="cvv" class="form-control" maxlength="3"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4 col-md-4 mb-3">
                                    <label for="bandeiracartao">Bandeira</label>
                                    <input type="text" name="bandeiraCartao" id="bandeiracartao" class="form-control" readonly/>
                                </div>

                                <div class="col-4 col-md-4 mb-3">
                                    <label for="mesvalidade">Validade/mês</label>
                                    <input type="text" name="mesvalidade" id="mesvalidade" class="form-control" maxlength="2"/>
                                </div>
    
                                <div class="col-4 col-md-4 mb-3">
                                    <label for="anovalidade">Validade/ano</label>
                                    <input type="text" name="anovalidade" id="anovalidade" class="form-control" maxlength="4"/>
                                </div>
                            </div>

                            <div class="mb-3" id='parcelamento'>
                                <label for="installments">Parcelamento</label>
                                <select name="parcelas" id="installments" class="form-control">
                                    <option value="">Parcelas</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="creditCardHolderName">Nome do titular</label>
                                <input type="text" name="creditCardHolderName" id="creditCardHolderName" class="form-control"/>
                            </div>

                            <div class="mb-3">
                                <label for="creditCardHolderCPF">CPF do titular</label>
                                <input type="text" name="creditCardHolderCPF" id="creditCardHolderCPF" class="form-control"/>
                            </div>

                            <div class="mb-3">
                                <label for="creditCardHolderBirthDate">Data de nascimento</label>
                                <input type="text" name="creditCardHolderBirthDate" id="creditCardHolderBirthDate" class="form-control"/>
                            </div>

                            <div class="row">
                                <div class="col-3 col-md-2 mb-3">
                                    <label for="creditCardHolderAreaCode">DDD</label>
                                    <input type="text" name="creditCardHolderAreaCode" id="creditCardHolderAreaCode" class="form-control" maxlength="2"/>
                                </div>

                                <div class="col-9 col-md-10 mb-3">
                                    <label for="creditCardHolderPhone">Telefone do titular</label>
                                    <input type="text" name="creditCardHolderPhone" id="creditCardHolderPhone" class="form-control" maxlength="9"/>
                                </div>
                            </div>

                            <h4 class="text-muted mt-5 mb-3">Endereço do titular</h4>

                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="billingAddressPostalCode">CEP</label>
                                    <input type="text" name="billingAddressPostalCode" id="billingAddressPostalCode" class="form-control"/>
                                </div>

                                <div class="col-5 col-md-2 mb-3">
                                    <label for="billingAddressCountry">País</label>
                                    <select name="billingAddressCountry" id="billingAddressCountry" class="form-control">
                                        <option value="BRA">Brasil</option>
                                    </select>
                                </div>

                                <div class="col-7 col-md-4 mb-3">
                                    <label for="billingAddressState">Estado</label>
                                    <select name="billingAddressState" id="billingAddressState" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-9 col-md-10 mb-3">
                                    <label for="billingAddressStreet">Endereço</label>
                                    <input type="text" name="billingAddressStreet" id="billingAddressStreet" class="form-control"/>
                                </div>
    
                                <div class="col-3 col-md-2 mb-3">
                                    <label for="billingAddressNumber">Número</label>
                                    <input type="text" name="billingAddressNumber" id="billingAddressNumber" class="form-control"/>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="billingAddressComplement">Complemento</label>
                                <input type="text" name="billingAddressComplement" id="billingAddressComplement" class="form-control"/>
                            </div>

                            <div class="mb-3">
                                <label for="billingAddressDistrict">Bairro</label>
                                <input type="text" name="billingAddressDistrict" id="billingAddressDistrict" class="form-control"/>
                            </div>

                            <div class="mb-3">
                                <label for="billingAddressCity">Cidade</label>
                                <input type="text" name="billingAddressCity" id="billingAddressCity" class="form-control"/>
                            </div>

                        </div>

                        <input type="hidden" name="extraAmount" id="extraamount"/>
                        <input type="hidden" name="valorParcelas" id="valorParcelas"/>
                        <input type="hidden" name="amount" id="amount" value="<?php echo $total_venda; ?>"/>
                        <input type="hidden" name="reference" id="reference" value="<?php echo $carrinho_id; ?>"/>
                        <input type="hidden" name="shippingAddressRequired" id="shippingaddressrequired" value="true"/>
                        <input type="hidden" name="shippingCost" id="shippingcost" value="0.00"/>
                        <input type="hidden" name="tokenCartao" id="tokencartao"/>
                        <input type="hidden" name="hash" id="hash"/>
                    </form>
                </div>
            </div>

            <button id="finalizar" class="btn btn-success mt-5 mb-5">Finalizar compra</button>
            <span id="myurl" data-myurl="<?php echo $my_url; ?>"></span>
        </div>

            <!-- Modal -->
        <div class="modal fade" id="psModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="psModalTitle"></h5>
                        <button type="button" class="close psModalDismiss" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="psModalBody">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary psModalDismiss" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/jquery.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="<?php echo $script_pagseguro; ?>"></script>
        <script src="js/viacepct.js"></script>
        <script src="js/fretect.js"></script>
        <script src="js/custom.js"></script>
        <script>pagamento('<?php echo $my_url; ?>')</script>
    </body>
</html>