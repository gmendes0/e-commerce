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
        // header('Location: adm_fornecedor_lista.php');
        echo "<script>window.location='adm_fornecedor_lista.php'</script>";

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

            require_once 'lib/Validacao.php';
            include_once 'lib/Fornecedor.php';

            $validar = new Validacao;
            /**
             * Validação de formulário
             */
            $validar->validation([
                'nome' => 'required|smin:3|smax:50',
                'endereco' => 'required|smin:3|smax:50',
                'numero' => 'required|numeric|min:0|max:9999',
                'bairro' => 'required|smin:3|smax:50',
                'cidade' => 'required|smin:3|smax:45',
                'uf' => 'required|smin:2|smax:2',
                'telefone' => 'required|smin:3|smax:13',
                'email' => 'required|smin:3|smax:45',
                'cnpj' => 'required|smin:3|smax:45',
                'site' => 'required|smin:3|smax:50',
                'ativo' => 'required|numeric|min:0|max:1'
            ]);

            if($validar->getValido()){

                $fornecedor = new Fornecedor();
                $fornecedor->setNome($_POST['nome']);
                $fornecedor->setEndereco($_POST['endereco']);
                $fornecedor->setNumero($_POST['numero']);
                $fornecedor->setBairro($_POST['bairro']);
                $fornecedor->setCidade($_POST['cidade']);
                $fornecedor->setUf($_POST['uf']);
                $fornecedor->setTelefone($_POST['telefone']);
                $fornecedor->setEmail($_POST['email']);
                $fornecedor->setCnpj($_POST['cnpj']);
                $fornecedor->setSite($_POST['site']);
                $fornecedor->setAtivo($_POST['ativo']);
                $fornecedor->setIdfornecedor($val['idfornecedor']);
    
                DaoFornecedor::getInstance()->update($fornecedor);
                // header('Location: adm_fornecedor_lista.php');
                echo "<script>window.location='adm_fornecedor_lista.php'</script>";

            }

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
        <link rel="stylesheet" href="css/style.css">
        <title>Fornecedores - Lista</title>
        <script src="js/jquery.js"></script>
        <script src="js/cep.js"></script>
    </head>

    <body>
        
        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>

        <div class="row h-100 align-items-center p-5 titulo-bg mb-5">
            <div class="col-12">
                <h2 class="text-center">Fornecedores</h2>
            </div>
        </div>

        <div class="container">

            <!-- Modal -->
            <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal1title">Erro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body text-center text-danger">
                            CEP Inválido
                        </div>
                    </div>
                </div>
            </div>

            <?php if(isset($form) && $form){ ?>

                <div>

                    <h2>Editar Fornecedor</h2>

                    <?php if(isset($validar) && !empty($validar->getErrors())){ ?>
                        <?php echo $validar->bootstrapGetErrors('danger', 'col-sm-6'); ?>
                    <?php } ?>

                    <form method="post">

                        <div class="form-group row">
                            <label for="nome" class="col-sm-1 col-form-label">nome</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" id="nome" name="nome" value="<?php echo (!empty($val)) ? $val['nome'] : ''; ?>"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label" for="cep">cep</label>
                            <div class="col-sm-6">
                                <input id="cep" class="form-control" type="text" name="cep" value="<?php echo !empty($_POST['cep']) ? $_POST['cep'] : ''; ?>"/>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="endereco" class="col-sm-1 col-form-label">endereço</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" id="endereco" name="endereco" value="<?php echo (!empty($val)) ? $val['endereco'] : ''; ?>"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="numero" class="col-sm-1 col-form-label">número</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" id="numero" name="numero" value="<?php echo (!empty($val)) ? $val['numero'] : ''; ?>"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bairro" class="col-sm-1 col-form-label">bairro</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" id="bairro" name="bairro" value="<?php echo (!empty($val)) ? $val['bairro'] : ''; ?>"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cidade" class="col-sm-1 col-form-label">cidade</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" id="cidade" name="cidade" value="<?php echo (!empty($val)) ? $val['cidade'] : ''; ?>"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="estado" class="col-sm-1 col-form-label">estado</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="estado" name="uf">
                                    <?php foreach($estados as $uf => $estado){ ?>
                                        <option value="<?php echo $uf; ?>" <?php if(!empty($val) && $val['uf'] == $uf){ echo 'selected'; }?> ><?php echo $estado; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefone" class="col-sm-1 col-form-label">telefone</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" id="telefone" name="telefone" value="<?php echo (!empty($val)) ? $val['telefone'] : ''; ?>"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-1 col-form-label">email</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" id="email" name="email" value="<?php echo (!empty($val)) ? $val['email'] : ''; ?>"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cnpj" class="col-sm-1 col-form-label">cnpj</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" id="cnpj" name="cnpj" value="<?php echo (!empty($val)) ? $val['cnpj'] : ''; ?>"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="site" class="col-sm-1 col-form-label">site</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" id="site" name="site" value="<?php echo (!empty($val)) ? $val['site'] : ''; ?>"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ativo" class="col-sm-1 col-form-label">ativo</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="ativo" name="ativo">
                                    <option value="1">sim</option>
                                    <option value="0">não</option>
                                </select>
                            </div>
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
                            <th>ativo</th>
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
                                <td><?php echo $fornecedor['ativo'] == 1 ? 'sim' : 'não'; ?></td>
                                <td class="text-center"><a href="detalhes.php?fdetalhes=<?php echo $fornecedor['idfornecedor']; ?>">Detalhes</a></td>
                                <td class="text-right">
                                    <a href="?edit=<?php echo $fornecedor['idfornecedor']; ?>" class="btn btn-warning mb-1">editar</a>
                                    <a href="?del=<?php echo $fornecedor['idfornecedor']; ?>" class="btn btn-danger">apagar</a>
                                </td>
                            </tr>
    
                        <?php } ?>
    
                    </tbody>
    
                </table>
            </div>

            <a href="adm_fornecedor.php">novo fornecedor</a>

        </div>

        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>
</html>