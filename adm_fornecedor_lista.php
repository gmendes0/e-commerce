<?php

    require_once 'lib/DaoFornecedor.php';

    $fornecedores = DaoFornecedor::getInstance()->readAll();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <link rel="stylesheet" href="css/style.css">
        <title>Fornecedores - Lista</title>
    </head>

    <body>
        
        <div>

            <table>

                <thead>

                    <tr>
                        <td>ID</td>
                        <td>nome</td>
                        <td>endereço</td>
                        <td>nº</td>
                        <td>bairro</td>
                        <td>estado</td>
                        <td>telefone</td>
                        <td>email</td>
                        <td>site</td>
                        <td>ativo</td>
                    </tr>

                </thead>

                <tbody>

                    <?php foreach($fornecedores as $fornecedor){ ?>

                        <tr>
                            <td><?php echo $fornecedor['id']; ?></td>
                            <td><?php echo $fornecedor['nome']; ?></td>
                            <td><?php echo $fornecedor['endereco']; ?></td>
                            <td><?php echo $fornecedor['numero']; ?></td>
                            <td><?php echo $fornecedor['bairro']; ?></td>
                            <td><?php echo $fornecedor['uf']; ?></td>
                            <td><?php echo $fornecedor['telefone']; ?></td>
                            <td><?php echo $fornecedor['email']; ?></td>
                            <td><?php echo $fornecedor['site']; ?></td>
                            <td><?php echo $fornecedor['ativo']; ?></td>
                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </body>
</html>