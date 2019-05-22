<div class="card-columns">

    <div class="text-center">

        <?php

            require_once 'banco.php';
            $tabela = 'produto';
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $nprodpage = 10;

            if(isset($_GET['page'])){
                    
                $page = $_GET['page'];

                if(empty($page) || !filter_var($page, FILTER_VALIDATE_INT) || $page < 0){

                    $page = 1;

                }


            }else{

                $page = 1;

            }

            $controle = $page;
            $inicio = $controle - 1;
            $inicio = $inicio * $nprodpage;

            try{

                $ltdquery = "SELECT * FROM $tabela LIMIT $inicio, $nprodpage";
                $query = "SELECT * FROM $tabela";

                $ltd = $pdo->query($ltdquery);
                $total = $pdo->query($query);
                $npages = $total->rowCount();
                $npages = ceil($npages / $nprodpage);

                while($prod = $ltd->fetch(PDO::FETCH_ASSOC)){
        ?>

                    <div class="card mt-2" style="width: 16rem;">
                        
                        <!--- produto --->
                        <img src="<?php echo utf8_encode(explode(';', $prod['foto'])[0]); ?>" class="card-img-top"/>
                        
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