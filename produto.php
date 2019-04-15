<?php
    session_start();

    if(!isset($_SESSION['venda'])){

        $_SESSION['venda'] = array();

    }

    if(!isset($_GET['id_prod']) || $_GET['id_prod'] == null){

        echo "<script>window.location='site.php'</script>";
        exit;

    }else{

        require_once 'scripts/php/banco.php';

        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM produto WHERE idproduto = ?";
        $q = $pdo->prepare($query);
        $q->bindParam(1, $_GET['id_prod']);
        $q->execute();
        $prod = $q->fetch(PDO::FETCH_ASSOC); // produto

        if(isset($_GET['add'])){
            
            if($_GET['add'] == null || $_GET['add'] != 'true'){
                
                unset($_GET['add']);
                header('Location: produto.php?id_prod='.$prod['idproduto']);
                exit;
        
            }else{
                
                $_SESSION['venda'][$_GET['id_prod']] = 1;
                header('Location: carrinho.php');
                exit;
            }
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
        <title><?php echo $prod['nome']; ?></title>
    </head>

    <body>

        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>

        <!-- conteúdo do site -->
        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <div class="product-galery">
    
                        <img src="<?php echo $prod['foto']; ?>"/>

                    </div>

                </div>

                <div class="col-md-6">

                    <h1 class="h3 text-normal"><?php echo $prod['nome']; ?></h1>
                    <span class="h4 d-block text-muted">R$ <?php echo $prod['valor']; ?></span>
                    <p class="h6">descrição</p>
                    <p><?php echo $prod['descricao']; ?></p>
                    <a class="btn btn-primary" href="produto.php?id_prod=<?php echo $prod['idproduto']; ?>&add=true">adicionar ao carrinho</a>

                </div>

            </div>

        </div>

        <script src="js/jquery.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>
</html>