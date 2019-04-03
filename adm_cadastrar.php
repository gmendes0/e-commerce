<?php

    if(!empty($_POST)){

        require_once 'lib/Produto.php';
        require_once 'lib/DaoProduto.php';

        /* Insert */
        $produto = new Produto();
        $produto->setNome($_POST['nome']);
        $produto->setValor($_POST['valor']);
        $produto->setDescricao($_POST['descricao']);
        $produto->setDetalhes($_POST['detalhes']);
        $produto->setAtivo($_POST['ativo']);

        DaoProduto::getInstance()->create($produto);
        /* Fim Insert */

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

            <form method="post">

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
                </div>

                <div>
                    <input type="submit" value="enviar"/>
                </div>

            </form>

            <a href="adm_lista.php">lista</a>

        </div>

    </body>
</html>