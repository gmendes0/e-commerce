<?php

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

        /* Insert */
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
        $fornecedor->setDatacadastro(date('Y-m-d H-i-s'));

        DaoFornecedor::getInstance()->create($fornecedor);
        /* Fim Insert */
    
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
    </head>

    <body>

        <!-- Formulário Fornecedor -->
        <div class="container">

            <h2 class="text-center">Novo Fornecedor</h2>

            <form method="post">

                <div class="form-group">
                    <label>nome</label>
                    <input class="form-control" type="text" name="nome"/>
                </div>

                <div class="form-group">
                    <label>endereço</label>
                    <input class="form-control" type="text" name="endereco"/>
                </div>

                <div class="form-group">
                    <label>número</label>
                    <input class="form-control" type="text" name="numero"/>
                </div>

                <div class="form-group">
                    <label>bairro</label>
                    <input class="form-control" type="text" name="bairro"/>
                </div>

                <div class="form-group">
                    <label>estado</label>
                    <select class="form-control" name="uf">
                        <?php foreach($estados as $uf => $estado){ ?>
                            <option value="<?php echo $uf; ?>"><?php echo $estado; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>telefone</label>
                    <input class="form-control" type="text" name="telefone"/>
                </div>

                <div class="form-group">
                    <label>email</label>
                    <input class="form-control" type="text" name="email"/>
                </div>

                <div class="form-group">
                    <label>cnpj</label>
                    <input class="form-control" type="text" name="cnpj"/>
                </div>

                <div class="form-group">
                    <label>site</label>
                    <input class="form-control" type="text" name="site"/>
                </div>

                <div class="form-group">
                    <label>ativo</label>
                    <select class="form-control" name="ativo">
                        <option value="1">sim</option>
                        <option value="0">não</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="cadastrar"/>
                </div>
            </form>
            
            <a href="adm_fornecedor_lista.php">lista de fornecedores</a>

        </div>
        
        <script src="js/jquery.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>
</html>