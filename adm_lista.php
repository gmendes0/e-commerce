<?php

    require_once 'lib/Produto.php';
    require_once 'lib/DaoProduto.php';

    if(!empty($_GET)){

        /* Deletar */
        if(!empty($_GET['del'])){

            DaoProduto::getInstance()->del($_GET['del']);

        }
        /* Fim deletar */

        if(!empty($_GET['edit'])){
        
            $form = true;

            $val = DaoProduto::getInstance()->readOne($_GET['edit']);

            if(!empty($_POST)){

                $produto = new Produto();
                $produto->setIdProduto($val['idproduto']);
                $produto->setNome($_POST['nome']);
                $produto->setValor($_POST['valor']);
                $produto->setDescricao($_POST['descricao']);
                $produto->setDetalhes($_POST['detalhes']);
                $produto->setAtivo($_POST['ativo']);
                DaoProduto::getInstance()->update($produto);

                header('Location: adm_lista.php');

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
        <title>Lista Produtos</title>
    </head>

    <body>
        
        <div>

            <?php if(isset($form)){ ?>
            <div>

                <form method="post">

                    <div>
                        <input type="text" name="nome" value="<?php echo (!empty($val)) ? $val['nome'] : ''; ?>"/>
                        <label>nome</label>
                    </div>

                    <div>
                        <input type="text" name="valor" value="<?php echo (!empty($val)) ? $val['valor'] : ''; ?>"/>
                        <label>valor</label>
                    </div>

                    <div>
                        <input type="text" name="descricao" value="<?php echo (!empty($val)) ? $val['descricao'] : ''; ?>"/>
                        <label>descrição</label>
                    </div>

                    <div>
                        <input type="text" name="detalhes" value="<?php echo (!empty($val)) ? $val['detalhes_tecnicos'] : ''; ?>"/>
                        <label>detalhes técnicos</label>
                    </div>

                    <div>
                        <select name="ativo">
                            <option value="1">sim</option>
                            <option value="0">não</option>
                        </select>
                    </div>

                    <div>
                        <input type="submit" value="enviar"/>
                    </div>

                </form>

            </div>
            <?php } ?>

        <!-- lista -->
            <table>

                <thead>
                    <tr>
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
                    
                        <tr>

                            <td><?php echo $dado['idproduto']; ?></td>
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

    </body>
</html>