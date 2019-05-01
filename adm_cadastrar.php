<?php

    session_start();

    /**
     * verifica se o adm está logado
     */
    if(!isset($_SESSION['adm']) || empty($_SESSION['adm'])){

        echo "<script>window.location='adm_login.php'</script>";
        exit;

    }

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
        <title>Cadastrar Produto</title>
    </head>

    <body>

        <!-- Formulario Produto -->
        <div>

            <h2>Novo Produto</h2>

            <form method="post" enctype="multipart/form-data">

                <div>
                    <input type="text" name="nome">
                    <label>nome</label>
                </div>

                <div>
                    <input type="text" name="valor">
                    <label>valor</label>
                </div>

                <div>
                    <input type="text" name="descricao">
                    <label>descrição</label>
                </div>

                <div>
                    <input type="text" name="detalhes">
                    <label>detalhes técnicos</label>
                </div>

                <div>
                    <select name="ativo">
                        <option value="1">sim</option>
                        <option value="0">não</option>
                    </select>
                    <label>ativo</label>
                </div>

                <div>
                    <select name="fornecedor">
                        <?php foreach($fornecedores as $fornecedor){ ?>
                            <option value="<?php echo $fornecedor['idfornecedor']; ?>"><?php echo $fornecedor['nome']; ?></option>
                        <?php } ?>
                    </select>
                    <label>fornecedor</label>
                </div>

                <div>
                    <input type="file" name="miniatura"/>
                    <label>imagem</label>
                </div>

                <div>
                    <input type="submit" value="enviar"/>
                </div>

            </form>

            <a href="adm_lista.php">lista</a>
            <a href="adm_fornecedor.php">novo fornecedor</a>

        </div>

    </body>
</html>