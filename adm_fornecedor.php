<?php

    session_start();

    /**
     * verifica se o adm está logado
     */
    if(!isset($_SESSION['adm']) || empty($_SESSION['adm'])){

        echo "<script>window.location='adm_login.php'</script>";
        exit;

    }

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

    if(!empty($_POST)){
    
        require_once 'lib/DaoFornecedor.php';
        require_once 'lib/Fornecedor.php';
        require_once 'lib/Validacao.php';

        if(isset($_POST['ativo'])){

            $_POST['ativo'] = intval($_POST['ativo']);

        }

        $validar = new Validacao;
        /**
         * Validação de formulário
         */
        $validar->validation([
            'nome' => 'required|smin:3|smax:50',
            'cnpj' => 'required|smin:3|smax:45',
            'site' => 'required|smin:3|smax:50',
            'email' => 'required|smin:3|smax:45',
            'telefone' => 'required|smin:3|smax:13',
            'endereco' => 'required|smin:3|smax:50',
            'numero' => 'required|numeric|min:0|max:9999',
            'bairro' => 'required|smin:3|smax:50',
            'cidade' => 'required|smin:3|smax:45',
            'uf' => 'required|smin:2|smax:2',
            'ativo' => 'required|numeric|min:0|max:1'
        ]);

        /**
         * se for válido
         */
        if($validar->getValido()){

            /* Insert */
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
            $fornecedor->setDatacadastro(date('Y-m-d H-i-s'));

            $insert = DaoFornecedor::getInstance()->create($fornecedor);

            if($insert){

                echo "<script>var sucesso = true;</script>";

            }
            /* Fim Insert */

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
        <title>Cadastrar - Fornecedor</title>
        <script src="js/jquery.js"></script>
        <script src="js/cep.js"></script>
        <script>
            $(document).ready(function(){
                if(typeof sucesso != 'undefined' && sucesso){
                    $('#cadfornecedores')[0].reset();
                    $('#modal2').modal('show');
                    $('#lf').on('click', function(){
                        window.location = 'adm_fornecedor_lista.php';
                    });
                    $('#np').on('click', function(){
                        window.location = 'adm_cadastrar.php';
                    });
                    $('#nf').on('click', function(){
                        window.location = 'adm_fornecedor.php';
                    })
                }
            });
        </script>
    </head>

    <body>

        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>

        <!-- Formulário Fornecedor -->
        <div class="container" id="container1">

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

            <!-- Modal -->
            <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal2title">Cadastrado com sucesso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body text-center">
                            O que deseja fazer?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="lf">Listar Fornecedores</button>
                            <button type="button" class="btn btn-primary" id="np">Novo Produto</button>
                            <button type="button" class="btn btn-primary" id="nf">Novo Fornecedor</button>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="text-center">Novo Fornecedor</h2>

            <!-- erros de validação -->
            <?php if(isset($validar)){ echo $validar->bootstrapGetErrors('danger', 'col-sm-5'); } ?>

            <form method="post" id="cadfornecedores">

                <div class="form-group row">
                    <label for="nome" class="col-sm-1 col-form-label">nome</label>
                    <div class="col-sm-6">
                        <input id="nome" class="form-control" type="text" name="nome" value="<?php echo (isset($_POST['nome'])) ? $_POST['nome'] : ''; ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="cnpj" class="col-sm-1 col-form-label">cnpj</label>
                    <div class="col-sm-6">
                        <input id="cnpj" class="form-control" type="text" name="cnpj" value="<?php echo (isset($_POST['cnpj'])) ? $_POST['cnpj'] : ''; ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="site" class="col-sm-1 col-form-label">site</label>
                    <div class="col-sm-6">
                        <input id="site" class="form-control" type="text" name="site" value="<?php echo (isset($_POST['site'])) ? $_POST['site'] : ''; ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-1 col-form-label">email</label>
                    <div class="col-sm-6">
                        <input id="email" class="form-control" type="text" name="email" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ''; ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="telefone" class="col-sm-1 col-form-label">telefone</label>
                    <div class="col-sm-6">
                        <input id="telefone" class="form-control" type="text" name="telefone" value="<?php echo (isset($_POST['telefone'])) ? $_POST['telefone'] : ''; ?>"/>
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
                        <input id="endereco" class="form-control" type="text" name="endereco" value="<?php echo (isset($_POST['endereco'])) ? $_POST['endereco'] : ''; ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="numero" class="col-sm-1 col-form-label">número</label>
                    <div class="col-sm-6">
                        <input id="numero" class="form-control" type="text" name="numero" value="<?php echo (isset($_POST['numero'])) ? $_POST['numero'] : ''; ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="bairro" class="col-sm-1 col-form-label">bairro</label>
                    <div class="col-sm-6">
                        <input id="bairro" class="form-control" type="text" name="bairro" value="<?php echo (isset($_POST['bairro'])) ? $_POST['bairro'] : ''; ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="cidade" class="col-sm-1 col-form-label">cidade</label>
                    <div class="col-sm-6">
                        <input id="cidade" class="form-control" type="text" name="cidade" value="<?php echo (isset($_POST['cidade'])) ? $_POST['cidade'] : ''; ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="estado" class="col-sm-1 col-form-label">estado</label>
                    <div class="col-sm-6">
                        <select id="estado" class="form-control" name="uf">
                            <?php foreach($estados as $uf => $estado){ ?>
                                <option value="<?php echo $uf; ?>" <?php echo (isset($_POST['uf']) && $_POST['uf'] == $uf) ? 'selected' : ''; ?>><?php echo $estado; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ativo" class="col-sm-1 col-form-label">ativo</label>
                    <div class="col-sm-6">
                        <select id="ativo" class="form-control" name="ativo">
                            <option value="1" <?php echo (isset($_POST['ativo']) && $_POST['ativo'] == 1) ? 'selected' : ''; ?>>sim</option>
                            <option value="0" <?php echo (isset($_POST['ativo']) && $_POST['ativo'] == 0) ? 'selected' : ''; ?>>não</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="cadastrar"/>
                </div>
            </form>
            
            <a href="adm_fornecedor_lista.php">lista de fornecedores</a>

        </div>
        
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>
</html>