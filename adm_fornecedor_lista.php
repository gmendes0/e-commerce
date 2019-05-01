<?php

    /**
     * verifica se o adm está logado
     */
    if(!isset($_SESSION['adm']) || empty($_SESSION['adm'])){

        echo "<script>window.location='adm_login.php'</script>";
        exit;

    }

    require_once 'lib/DaoFornecedor.php';

    $fornecedores = DaoFornecedor::getInstance()->readAll();

    /* Deletar */
    if(!empty($_GET['del'])){

        DaoFornecedor::getInstance()->del($_GET['del']);
        header('Location: adm_fornecedor_lista.php');

    }
    /* Fim deletar */

    /* Editar */
    
    if(!empty($_GET['edit'])){

        $estados = array(
            "AC" => "Acre",
            "AL" => "Alagoas",
            "AP" => "Amapá",
            "AM" => "Amazonas",
            "BA" => "Bahia",
            "CE" => "Ceará",
            "DF" => "Distrito Federal",
            "ES" => "Espírito Santo",
            "GO" => "Goiás",
            "MA" => "Maranhão",
            "MT" => "Mato Grosso",
            "MS" => "Mato Grosso do Sul",
            "MG" => "Minas Gerais",
            "PA" => "Pará",
            "PB" => "Paraíba",
            "PR" => "Paraná",
            "PE" => "Pernambuco",
            "PI" => "Piauí",
            "RJ" => "Rio de Janeiro",
            "RN" => "Rio Grande do Norte",
            "RS" => "Rio Grande do Sul",
            "RO" => "Rondônia",
            "RR" => "Roraima",
            "SC" => "Santa Catarina",
            "SP" => "São Paulo",
            "SE" => "Sergipe",
            "TO" => "Tocantins"
        );

        $form = true;

        $val = DaoFornecedor::getInstance()->readOne($_GET['edit']);

        if(!empty($_POST)){

            include_once 'lib/Fornecedor.php';

            $fornecedor = new Fornecedor();
            $fornecedor->setNome($_POST['nome']);
            $fornecedor->setEndereco($_POST['endereco']);
            $fornecedor->setNumero($_POST['numero']);
            $fornecedor->setBairro($_POST['bairro']);
            $fornecedor->setUf($_POST['uf']);
            $fornecedor->setTelefone($_POST['telefone']);
            $fornecedor->setEmail($_POST['email']);
            $fornecedor->setCnpj($_POST['cnpj']);
            $fornecedor->setSite($_POST['site']);
            $fornecedor->setAtivo($_POST['ativo']);
            $fornecedor->setIdfornecedor($val['idfornecedor']);

            DaoFornecedor::getInstance()->update($fornecedor);
            header('Location: adm_fornecedor_lista.php');

        }

    }

    /* Fim Editar */

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

            <?php if(isset($form) && $form){ ?>

                <div>

                    <form method="post">

                        <div>
                            <input type="text" name="nome" value="<?php echo (!empty($val)) ? $val['nome'] : ''; ?>"/>
                            <label>nome</label>
                        </div>

                        <div>
                            <input type="text" name="endereco" value="<?php echo (!empty($val)) ? $val['endereco'] : ''; ?>"/>
                            <label>endereço</label>
                        </div>

                        <div>
                            <input type="text" name="numero" value="<?php echo (!empty($val)) ? $val['numero'] : ''; ?>"/>
                            <label>número</label>
                        </div>

                        <div>
                            <input type="text" name="bairro" value="<?php echo (!empty($val)) ? $val['bairro'] : ''; ?>"/>
                            <label>bairro</label>
                        </div>

                        <div>
                            <select name="uf">
                                <?php foreach($estados as $uf => $estado){ ?>
                                    <option value="<?php echo $uf; ?>" <?php if(!empty($val) && $val['uf'] == $uf){ echo 'selected'; }?> ><?php echo $estado; ?></option>
                                <?php } ?>
                            </select>
                            <label>estado</label>
                        </div>

                        <div>
                            <input type="text" name="telefone" value="<?php echo (!empty($val)) ? $val['telefone'] : ''; ?>"/>
                            <label>telefone</label>
                        </div>

                        <div>
                            <input type="text" name="email" value="<?php echo (!empty($val)) ? $val['email'] : ''; ?>"/>
                            <label>email</label>
                        </div>

                        <div>
                            <input type="text" name="cnpj" value="<?php echo (!empty($val)) ? $val['cnpj'] : ''; ?>"/>
                            <label>cnpj</label>
                        </div>

                        <div>
                            <input type="text" name="site" value="<?php echo (!empty($val)) ? $val['site'] : ''; ?>"/>
                            <label>site</label>
                        </div>

                        <div>
                            <select name="ativo">
                                <option value="1">sim</option>
                                <option value="0">não</option>
                            </select>
                            <label>ativo</label>
                        </div>

                        <div>
                            <input type="submit" value="atualizar"/>
                        </div>

                    </form>

                </div>

            <?php } ?>

            <table>

                <thead>

                    <tr>
                        <td>ID</td>
                        <td>nome</td>
                        <td>cnpj</td>
                        <td>endereço</td>
                        <td>nº</td>
                        <td>bairro</td>
                        <td>estado</td>
                        <td>telefone</td>
                        <td>email</td>
                        <td>site</td>
                        <td>ativo</td>
                        <td>ações</td>
                    </tr>

                </thead>

                <tbody>

                    <?php foreach($fornecedores as $fornecedor){ ?>

                        <tr>
                            <td><?php echo $fornecedor['idfornecedor']; ?></td>
                            <td><?php echo $fornecedor['nome']; ?></td>
                            <td><?php echo $fornecedor['cnpj']; ?></td>
                            <td><?php echo $fornecedor['endereco']; ?></td>
                            <td><?php echo $fornecedor['numero']; ?></td>
                            <td><?php echo $fornecedor['bairro']; ?></td>
                            <td><?php echo $fornecedor['uf']; ?></td>
                            <td><?php echo $fornecedor['telefone']; ?></td>
                            <td><?php echo $fornecedor['email']; ?></td>
                            <td><a target="blank" href="<?php echo $fornecedor['site']; ?>"><?php echo $fornecedor['site']; ?></a></td>
                            <td><?php echo $fornecedor['ativo']; ?></td>
                            <td>
                                <p><a href="?edit=<?php echo $fornecedor['idfornecedor']; ?>">editar</a></p>
                                <p><a href="?del=<?php echo $fornecedor['idfornecedor']; ?>">apagar</a></p>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>

            </table>

            <a href="adm_fornecedor.php">novo fornecedor</a>

        </div>

    </body>
</html>