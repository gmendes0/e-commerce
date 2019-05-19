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
        <script>
            $(document).ready(function(){
                if(typeof sucesso != 'undefined' && sucesso){
                    $('#cadfornecedores')[0].reset();
                    $('#modal1').modal('show');
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
                            <h5 class="modal-title" id="modal1title">Cadastrado com sucesso</h5>
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

                <div class="form-group">
                    <label>nome</label>
                    <input class="form-control" type="text" name="nome" value="<?php echo (isset($_POST['nome'])) ? $_POST['nome'] : ''; ?>"/>
                </div>

                <div class="form-group">
                    <label>endereço</label>
                    <input class="form-control" type="text" name="endereco" value="<?php echo (isset($_POST['endereco'])) ? $_POST['endereco'] : ''; ?>"/>
                </div>

                <div class="form-group">
                    <label>número</label>
                    <input class="form-control" type="text" name="numero" value="<?php echo (isset($_POST['numero'])) ? $_POST['numero'] : ''; ?>"/>
                </div>

                <div class="form-group">
                    <label>bairro</label>
                    <input class="form-control" type="text" name="bairro" value="<?php echo (isset($_POST['bairro'])) ? $_POST['bairro'] : ''; ?>"/>
                </div>

                <div class="form-group">
                    <label>cidade</label>
                    <input class="form-control" type="text" name="cidade" value="<?php echo (isset($_POST['cidade'])) ? $_POST['cidade'] : ''; ?>"/>
                </div>

                <div class="form-group">
                    <label>estado</label>
                    <select class="form-control" name="uf">
                        <?php foreach($estados as $uf => $estado){ ?>
                            <option value="<?php echo $uf; ?>" <?php echo (isset($_POST['uf']) && $_POST['uf'] == $uf) ? 'selected' : ''; ?>><?php echo $estado; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>telefone</label>
                    <input class="form-control" type="text" name="telefone" value="<?php echo (isset($_POST['telefone'])) ? $_POST['telefone'] : ''; ?>"/>
                </div>

                <div class="form-group">
                    <label>email</label>
                    <input class="form-control" type="text" name="email" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ''; ?>"/>
                </div>

                <div class="form-group">
                    <label>cnpj</label>
                    <input class="form-control" type="text" name="cnpj" value="<?php echo (isset($_POST['cnpj'])) ? $_POST['cnpj'] : ''; ?>"/>
                </div>

                <div class="form-group">
                    <label>site</label>
                    <input class="form-control" type="text" name="site" value="<?php echo (isset($_POST['site'])) ? $_POST['site'] : ''; ?>"/>
                </div>

                <div class="form-group">
                    <label>ativo</label>
                    <select class="form-control" name="ativo">
                        <option value="1" <?php echo (isset($_POST['ativo']) && $_POST['ativo'] == 1) ? 'selected' : ''; ?>>sim</option>
                        <option value="0" <?php echo (isset($_POST['ativo']) && $_POST['ativo'] == 0) ? 'selected' : ''; ?>>não</option>
                    </select>
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