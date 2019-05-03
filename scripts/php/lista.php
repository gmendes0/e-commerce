<div class="card-columns">
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

            <div class="card" style="width: 18rem;">
                
                <!-- produto -->
                <img src="<?php echo $prod['foto']; ?>" class="card-img-top"/>
                
                <div class="card-body">
                    <a href="produto.php?id_prod=<?php echo $prod['idproduto']; ?>"><?php echo $prod['nome']; ?></a><!-- link para a página do produto -->
                    <p><?php echo "R$ ".$prod['valor']; ?></p>
                    <a href="#" class="btn btn-primary">adicionar para o carrinho</a>
                </div>

            </div>

<?php

        }

        Banco::desconectar();

    }catch(PDOException $e){

        $db_erro = $e->getMessage();

    }

?>
</div>