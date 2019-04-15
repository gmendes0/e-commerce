<?php

    require_once 'lib/DaoFornecedor.php';

    $fornecedores = DaoFornecedor::getInstance()->readFieldAll(['idfornecedor','nome']);

    if(!empty($_POST)){

        if(!empty($_POST['nome'])){
            
            if(!empty($_POST['valor'])){

                if(!empty($_POST['descricao'])){
                
                    if(!empty($_POST['detalhes'])){
                    
                        if(!empty($_POST['ativo'])){

                            if($_FILES['miniatura']['name']){
                                // Verifica se há arquivo
                        
                                if(!$_FILES['miniatura']['error']){
                                    //Verifica se não há erro
                                
                                    $nome_arquivo = strtolower($_FILES['miniatura']['name']);
                                    $caminho = 'fotage/';
                                    
                                    move_uploaded_file($_FILES['miniatura']['tmp_name'], $caminho.$nome_arquivo);
                        
                                }
                        
                            }

                            require_once 'lib/Produto.php';
                            require_once 'lib/DaoProduto.php';

                            /* Insert */
                            $produto = new Produto();
                            $produto->setNome($_POST['nome']);
                            $produto->setValor($_POST['valor']);
                            $produto->setDescricao($_POST['descricao']);
                            $produto->setDetalhes($_POST['detalhes']);
                            $produto->setAtivo($_POST['ativo']);
                            $produto->setFornecedor($_POST['fornecedor']);
                            $produto->setFoto($caminho.$nome_arquivo);

                            DaoProduto::getInstance()->create($produto);
                            /* Fim Insert */
                        
                        }
                    
                    }
                
                }

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
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <title>Cadastrar Produto</title>
    </head>

    <body>

        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>

        <!-- Formulario Produto -->
        <div class="container">

            <h2 class="text-center">Novo Produto</h2>

            <form method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label>nome</label>
                    <input class="form-control" type="text" name="nome">
                </div>

                <div class="form-group">
                    <label>valor</label>
                    <input class="form-control" type="text" name="valor">
                </div>

                <div class="form-group">
                    <label>descrição</label>
                    <input class="form-control" type="text" name="descricao">
                </div>

                <div class="form-group">
                    <label>detalhes técnicos</label>
                    <input class="form-control" type="text" name="detalhes">
                </div>

                <div class="form-group">
                    <label>ativo</label>
                    <select class="form-control" name="ativo">
                        <option value="1">sim</option>
                        <option value="0">não</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>fornecedor</label>
                    <select class="form-control" name="fornecedor">
                        <?php foreach($fornecedores as $fornecedor){ ?>
                            <option value="<?php echo $fornecedor['idfornecedor']; ?>"><?php echo $fornecedor['nome']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>imagem</label>
                    <input class="form-control-file" type="file" name="miniatura"/>
                </div>

                <div class="form-group">
                    <input type="submit" value="enviar" class="btn btn-primary"/>
                </div>

            </form>

            <a href="adm_lista.php">lista</a>
            <a href="adm_fornecedor.php">novo fornecedor</a>

        </div>

        <script src="js/jquery.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>
</html>