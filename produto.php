<?php

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

    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"/>
        <link rel="stylesheet" href="css/style.css"/>
        <title><?php echo $prod['nome']; ?></title>
    </head>

    <body>

        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>

        <!-- conteúdo do site -->
        <div class="site">

            <h1><?php echo $prod['nome']; ?></h1>
            <p>R$ <?php echo $prod['valor']; ?></p>
            <button>comprar</button>
            <img src="<?php echo $prod['foto']; ?>"/>

        </div>

    </body>
</html>