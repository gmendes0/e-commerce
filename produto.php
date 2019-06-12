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

        unset($q, $query);

        $query = "SELECT `nome` FROM fornecedor WHERE idfornecedor = ?";
        $q = $pdo->prepare($query);
        $q->bindParam(1, $prod['fornecedor_idfornecedor']);
        $q->execute();
        $fornecedor = $q->fetch(PDO::FETCH_OBJ); // fornecedor

        if(isset($_GET['add'])){
            
            if($_GET['add'] == null || $_GET['add'] != 'true'){
                
                unset($_GET['add']);
                // header('Location: produto.php?id_prod='.$prod['idproduto']);
                echo "<script>window.location='produto.php?id_prod=".$prod['idproduto']."'</script>";
                exit;
        
            }else{
                
                $_SESSION['venda'][$_GET['id_prod']] = 1;
                // header('Location: carrinho.php');
                echo "<script>window.location='carrinho.php'</script>";
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
        <link rel="stylesheet" href="css/style.css">
        <title><?php echo $prod['nome']; ?></title>
        <script src="js/jquery.js"></script>
        <script src="js/requestfrete.js"></script>
    </head>

    <body>

        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>

        <!-- conteúdo do site -->
        <div class="container mb-5 mt-5">

            <div class="row mt-5">

                <div class="col-sm-1">

                    <?php
                        $img = explode(';', $prod['foto']);
                        foreach ($img as $key => $image){
                    ?>

                        <img src="<?php echo $image; ?>" class="img-thumbnail mb-3 cursor-pointer" 
                        data-target="#produtoImage" data-slide-to="<?php echo $key; ?>" role="buuton"/>

                    <?php } ?>

                </div>

                <div class="figure col-md-5">

                    <div id="produtoImage" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                                foreach ($img as $key => $image){
                            ?>
                                    <div class="carousel-item <?php echo $key == 0 ? 'active' : ''; ?>">
                                        <img class="d-block w-100" src="<?php echo $image; ?>" alt="First slide"/>
                                    </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">

                    <h1 class="h3 text-normal"><?php echo $prod['nome']; ?></h1>
                    <span class="h4 d-block text-muted">R$ <?php echo $prod['valor']; ?></span>
                    <p class="h5 mt-3">fabricante</p>
                    <p class="h6 text-muted"><?php echo $fornecedor->nome; ?></p>
                    <p class="h6">descrição</p>
                    <p><?php echo $prod['descricao']; ?></p>
                    <a class="btn btn-primary" href="produto.php?id_prod=<?php echo $prod['idproduto']; ?>&add=true">adicionar ao carrinho</a>

                </div>

            </div>

            <div class="col-sm-3 mt-3 mb-3">
                <label class="text-muted">Consultar Frete:</label>
                <select name="tipo" id="frete-tipo" class="form-control mb-3">
                    <option value="pac">PAC</option>
                    <option value="sedex">SEDEX</option>
                </select>
                <div class="input-group">
                    <input id="in-destino" type="text" name="cep" class="form-control" maxlength="8" placeholder="Digite seu CEP"/>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" id="btn-calc">
                            <span id="spinner-cep" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span> calcular
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-4" id="frete"></div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="freteModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Frete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="freteResultado" class="text-center text-danger"></p>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>
</html>