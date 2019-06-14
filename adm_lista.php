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
            // header('Location: adm_lista.php');
            echo "<script>window.location='adm_lista.php'</script>";

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

                                    // header('Location: adm_lista.php');
                                    echo "<script>window.location='adm_lista.php'</script>";
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
        <link rel="stylesheet" href="css/style.css"/>
        <title>Lista Produtos</title>
    </head>

    <body>
        
        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>

        <div class="row h-100 align-items-center p-5 titulo-bg mb-5">
            <div class="col-12">
                <h2 class="text-center">Produtos</h2>
            </div>
        </div>

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
                        <label>imagem</label>
                        <select name="imagem" class="form-control">
                            
                            <?php
                                $linha = null;
                                $imagens = DaoProduto::getInstance()->readFieldAll('foto');
                                foreach($imagens as $foto){
                            ?>
                                    <option value="<?php echo $foto['foto']; ?>">
                                        <?php

                                            $img = explode('fotage/', $foto['foto']);

                                            if(count($img) > 1){

                                                echo$img[1];

                                            }else{

                                                echo '--- --- --- --- --- --- --- --- --- --- --- ---';

                                            }

                                        ?>
                                    </option>
                            <?php } ?>

                        </select>
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

            <div class="table-responsive">
                <!-- lista -->
                <table class="table">
    
                    <thead class="table-dark">
                        <tr scope="row">
                            <td>id</td>
                            <td>nome</td>
                            <td>valor</td>
                            <td>ativo</td>
                            <td class="text-center">detalhes</td>
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
                                <td><?php echo $dado['ativo']; ?></td>
                                <td class="text-center"><a href="detalhes.php?pdetalhes=<?php echo $dado['idproduto']; ?>">Detalhes</a></td>
                                <td><a href="?edit=<?php echo $dado['idproduto']; ?>" class="btn btn-warning mb-1">editar</a></td>
                                <td><a href="?del=<?php echo $dado['idproduto']; ?>" class="btn btn-danger mb-1">excluir</a></td>
    
                            </tr>
    
                        <?php } ?>
                    </tbody>
    
                </table>
            </div>
            
            <a href="adm_cadastrar.php">novo</a>

        </div>
        
        <script src="js/jquery.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>
</html>