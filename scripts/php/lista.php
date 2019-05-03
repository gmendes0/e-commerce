<div class="card-columns">

    <div class="text-center">

        <?php

            require_once 'banco.php';
            $tabela = 'produto';

            try{

                $pdo = Banco::conectar();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query = "SELECT * FROM $tabela";
                $q = $pdo->query($query);

                while($prod = $q->fetch(PDO::FETCH_ASSOC)){
        ?>

                    <div class="card mt-2" style="width: 16rem;">
                        
                        <!-- produto -->
                        <img src="<?php echo explode(';', $prod['foto'])[0]; ?>" class="card-img-top"/>
                        
                        <div class="card-body">
                            <a href="produto.php?id_prod=<?php echo $prod['idproduto']; ?>"><?php echo $prod['nome']; ?></a><!-- link para a página do produto -->
                            <p><?php echo "R$ ".$prod['valor']; ?></p>
                            <a href="site.php?id_prod=<?php echo $prod['idproduto']; ?>&add=true" class="btn btn-primary">adicionar para o carrinho</a>
                        </div>

                    </div>
                    

        <?php

                    if(isset($_GET['add'])){
                                
                        if($_GET['add'] == null || $_GET['add'] != 'true'){
                            
                            unset($_GET['add']);
                            header('Location: site.php');
                            exit;

                        }else{
                            
                            $_SESSION['venda'][$_GET['id_prod']] = 1;
                            echo "<script>alert({$prod['idproduto']})</script>";
                            header('Location: carrinho.php');
                            exit;
                        }
                    }
                }

                Banco::desconectar();

            }catch(PDOException $e){

                $db_erro = $e->getMessage();

            }

        ?>

    </div>

</div>