<?php

    session_start();

    /**
     * verifica se o adm está logado
     */
    if(!isset($_SESSION['adm']) || empty($_SESSION['adm'])){

        echo "<script>window.location='adm_login.php'</script>";
        exit;

    }

    require_once 'lib/Produto.php';
    require_once 'lib/DaoProduto.php';

    if(!empty($_GET)){

        /* Deletar */
        if(!empty($_GET['del'])){

            DaoProduto::getInstance()->del($_GET['del']);
            header('Location: adm_lista.php');

        }
        /* Fim deletar */

        if(!empty($_GET['edit'])){
        
            $form = true;

            $val = DaoProduto::getInstance()->readOne($_GET['edit']);

            if(!empty($_POST)){

                if(!empty($_POST['nome'])){
        
                    if(!empty($_POST['valor'])){
        
                        if(!empty($_POST['descricao'])){
                        
                            if(!empty($_POST['detalhes'])){
                            
                                if(!empty($_POST['ativo'])){
                                    
                                    /* Insert */
                                    $produto = new Produto();
                                    $produto->setIdProduto($val['idproduto']);
                                    $produto->setNome($_POST['nome']);
                                    $produto->setValor($_POST['valor']);
                                    $produto->setDescricao($_POST['descricao']);
                                    $produto->setDetalhes($_POST['detalhes']);
                                    $produto->setAtivo($_POST['ativo']);
                                    DaoProduto::getInstance()->update($produto);

                                    header('Location: adm_lista.php');
                                    /* Fim Insert */

                                }
                            
                            }
                        
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
        <title>Lista Produtos</title>
    </head>

    <body>
        
        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>

        <div class="container">

            <?php if(isset($form)){ ?>
            <div>

                <form method="post">

                    <div class="form-group">
                        <label>nome</label>
                        <input class="form-control" type="text" name="nome" value="<?php echo (!empty($val)) ? $val['nome'] : ''; ?>"/>
                    </div>

                    <div class="form-group">
                        <label>valor</label>
                        <input class="form-control" type="text" name="valor" value="<?php echo (!empty($val)) ? $val['valor'] : ''; ?>"/>
                    </div class="form-group">

                    <div class="form-group">
                        <label>descrição</label>
                        <input class="form-control" type="text" name="descricao" value="<?php echo (!empty($val)) ? $val['descricao'] : ''; ?>"/>
                    </div class="form-group">

                    <div class="form-group">
                        <label>detalhes técnicos</label>
                        <input class="form-control" type="text" name="detalhes" value="<?php echo (!empty($val)) ? $val['detalhes_tecnicos'] : ''; ?>"/>
                    </div>

                    <div class="form-group">
                        <label>ativo</label>
                        <select class="form-control" name="ativo">
                            <option value="1">sim</option>
                            <option value="0">não</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="enviar" class="btn btn-primary"/>
                    </div>

                </form>

            </div>
            <?php } ?>

            <!-- lista -->
            <table class="table">

                <thead class="table-dark">
                    <tr scope="row">
                        <td>id</td>
                        <td>nome</td>
                        <td>valor</td>
                        <td>descrição</td>
                        <td>detalhes</td>
                        <td>ativo</td>
                        <td>editar</td>
                        <td>deletar</td>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    
                        $q = DaoProduto::getInstance()->readAll();
                        foreach($q as $i => $dado){
                    ?>
                    
                        <tr scope="row">

                            <th class=""><?php echo $dado['idproduto']; ?></th>
                            <td><?php echo $dado['nome']; ?></td>
                            <td><?php echo $dado['valor'] ?></td>
                            <td><?php echo $dado['descricao'] ?></td>
                            <td><?php echo $dado['detalhes_tecnicos']; ?></td>
                            <td><?php echo $dado['ativo']; ?></td>
                            <td><a href="?edit=<?php echo $dado['idproduto']; ?>">editar</a></td>
                            <td><a href="?del=<?php echo $dado['idproduto']; ?>">excluir</a></td>

                        </tr>

                    <?php } ?>
                </tbody>

            </table>
            
            <a href="adm_cadastrar.php">novo</a>

        </div>
        
        <script src="js/jquery.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>
</html>