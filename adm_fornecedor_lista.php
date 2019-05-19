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
        <link rel="stylesheet" href="css/bootstrap.css">
        <title>Fornecedores - Lista</title>
    </head>

    <body>
        
        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>

        <div class="container">

            <?php if(isset($form) && $form){ ?>

                <div>

                    <h2>Editar Fornecedor</h2>

                    <form method="post">

                        <div class="form-group">
                            <label>nome</label>
                            <input class="form-control" type="text" name="nome" value="<?php echo (!empty($val)) ? $val['nome'] : ''; ?>"/>
                        </div>

                        <div class="form-group">
                            <label>endereço</label>
                            <input class="form-control" type="text" name="endereco" value="<?php echo (!empty($val)) ? $val['endereco'] : ''; ?>"/>
                        </div>

                        <div class="form-group">
                            <label>número</label>
                            <input class="form-control" type="text" name="numero" value="<?php echo (!empty($val)) ? $val['numero'] : ''; ?>"/>
                        </div>

                        <div class="form-group">
                            <label>bairro</label>
                            <input class="form-control" type="text" name="bairro" value="<?php echo (!empty($val)) ? $val['bairro'] : ''; ?>"/>
                        </div>

                        <div class="form-group">
                            <label>estado</label>
                            <select class="form-control" name="uf">
                                <?php foreach($estados as $uf => $estado){ ?>
                                    <option value="<?php echo $uf; ?>" <?php if(!empty($val) && $val['uf'] == $uf){ echo 'selected'; }?> ><?php echo $estado; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>telefone</label>
                            <input class="form-control" type="text" name="telefone" value="<?php echo (!empty($val)) ? $val['telefone'] : ''; ?>"/>
                        </div>

                        <div class="form-group">
                            <label>email</label>
                            <input class="form-control" type="text" name="email" value="<?php echo (!empty($val)) ? $val['email'] : ''; ?>"/>
                        </div>

                        <div class="form-group">
                            <label>cnpj</label>
                            <input class="form-control" type="text" name="cnpj" value="<?php echo (!empty($val)) ? $val['cnpj'] : ''; ?>"/>
                        </div>

                        <div class="form-group">
                            <label>site</label>
                            <input class="form-control" type="text" name="site" value="<?php echo (!empty($val)) ? $val['site'] : ''; ?>"/>
                        </div>

                        <div class="form-group">
                            <label>ativo</label>
                            <select class="form-control" name="ativo">
                                <option value="1">sim</option>
                                <option value="0">não</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="atualizar"/>
                        </div>

                    </form>

                </div>

            <?php } ?>

            <div class="table-responsive">
                <table class="table">
    
                    <thead class="table-dark">
    
                        <tr scope="row">
                            <th>ID</th>
                            <th>nome</th>
                            <th>cnpj</th>
                            <th class="text-center">detalhes</th>
                            <th class="text-right">ações</th>
                        </tr>
    
                    </thead>
    
                    <tbody>
    
                        <?php foreach($fornecedores as $fornecedor){ ?>
    
                            <tr scope="row">
                                <th><?php echo $fornecedor['idfornecedor']; ?></th>
                                <td><?php echo $fornecedor['nome']; ?></td>
                                <td><?php echo $fornecedor['cnpj']; ?></td>
                                <td class="text-center"><a href="detalhes.php?fdetalhes=<?php echo $fornecedor['idfornecedor']; ?>">Detalhes</a></td>
                                <td class="text-right">
                                    <a href="?edit=<?php echo $fornecedor['idfornecedor']; ?>" class="btn btn-warning">editar</a>
                                    <a href="?del=<?php echo $fornecedor['idfornecedor']; ?>" class="btn btn-danger">apagar</a>
                                </td>
                            </tr>
    
                        <?php } ?>
    
                    </tbody>
    
                </table>
            </div>

            <a href="adm_fornecedor.php">novo fornecedor</a>

        </div>

        <script src="js/jquery.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>
</html>