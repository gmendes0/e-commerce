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
        <title><?php echo $prod['nome']; ?></title>
    </head>
    
    <body>
        
    </body>
</html>