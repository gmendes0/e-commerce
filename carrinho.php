<?php

    session_start();

    $content = false;

    require_once 'lib/Pedvenda.php';

    if(!empty($_SESSION)){
    
        if(!empty($_SESSION['venda'])){

            include_once 'lib/DaoProduto.php';

            $content = true;

        }
    
    }

    if(isset($_GET['remove'])){

        if(!empty($_GET['remove']) || $_GET['remove'] != null){

            unset($_SESSION['venda'][$_GET['remove']]);
            // header('Location: carrinho.php');
            echo "<script>window.location='carrinho.php'</script>";

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
        <link rel="stylesheet" href="css/style.css"/>
        <title>Carrinho</title>
        <script src="js/jquery.js"></script>
        <script src="js/carrinho.js"></script>
    </head>

    <body>

        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>

        <div class="row h-100 align-items-center titulo-bg p-5">
            <div class="col-12">
                <h2 class="text-center">carrinho</h2>
            </div>
        </div>

        <!-- conteúdo do site -->
        <div class="container mt-5">

            <!-- <form method="post" action="comprar.php"> -->
            <form method="post" action="checkout.php">

                <div class="table-responsive">
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
    
                                    $total = null;
                                    $i_id = 0;
                                    echo "<script>var nprod = null;</script>";
                                    echo "<script>var preco = {};</script>";
    
                                    foreach($_SESSION['venda'] as $prod => $qtd){
    
                                        $produto = DaoProduto::getInstance()->readOne($prod);
                                        $total += $produto['valor']*$qtd;
                            ?>
                                <tr scope="row">
                                    <td><?php echo $produto['nome']; ?></td>
                                    <td><span id="<?= 'preco'.$i_id; ?>"><?php echo $produto['valor']; ?></span></td>
                                    <td>
                                        <div class="input-group col-sm-6">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" onclick="menos(<?= $i_id; ?>)">-</button>
                                            </div>
                                            <input id="<?= 'inqtd'.$i_id; ?>" type="text" name="qtd[<?php echo $prod; ?>]" class="form-control text-center" value="<?= $_SESSION['venda'][$prod]; ?>" readonly/>
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary" type="button" onclick="mais(<?= $i_id; ?>)">+</button>
                                            </div>
                                        </div>
                                        <!-- <input class="form-control col-sm-3" type="number" name="qtd[<?php echo $prod; ?>]" id="qtd" min="1" value="<?php echo $_SESSION['venda'][$prod]; ?>"/> -->
                                    </td>
                                    <td><span id="<?= 'sub'.$i_id; ?>"><?php echo $produto['valor']*$qtd; ?></span></td>
                                    <td><a href="carrinho.php?remove=<?php echo $produto['idproduto']; ?>">remover</a></td>
                                </tr>
                                
                            <?php
                                    echo "<script>nprod = nprod + 1;</script>";
                                    echo "<script>sub[$i_id] = ".$produto['valor']*$qtd."</script>";
                                    echo "<script>preco[$i_id] = ".$produto['valor']."</script>";
                                    $i_id++;
                                }
                            ?>
    
                                <tr>
                                    <td colspan="5" align="right">Total = <span id="total"><?php echo $total; ?></span></td>
                                </tr>
    
                                <tr>
                                    <input type="hidden" name="total" value="<?php echo (isset($total)) ? $total : ''; ?>"/>
                                    <td colspan="5" class="text-right">
                                        <div class="form-group">
                                            <input class="btn btn-success" type="submit" value="comprar"/>
                                        </div>
                                    </td>
                                </tr>
    
                            <?php }else{ ?>
    
                                <td colspan="5" class="text-center">Nenhum item para mostrar</td>
    
                            <?php } ?>
    
                        </tbody>
    
                    </table>
                </div>

            
            </form>

            <a href="site.php">continue comprando</a>

        </div>

        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>

</html>