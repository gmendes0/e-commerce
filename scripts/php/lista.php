<?php

    require_once 'banco.php';

    try{

        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM produto";
        $q = $pdo->query($query);

        while($prod = $q->fetch(PDO::FETCH_ASSOC)){
?>

    <div>
        
        <!-- produto -->
        <img src="#"/>
        <a href="produto.php?id_prod=<?php echo $prod['idproduto']; ?>"><?php echo $prod['nome']; ?></a><!-- link para a página do produto -->
        <p><?php echo "R$ ".$prod['valor']; ?></p>

    </div>

<?php

        }

        Banco::desconectar();

    }catch(PDOException $e){

        $db_erro = $e->getMessage();

    }

?>