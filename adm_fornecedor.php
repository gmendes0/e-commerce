<?php

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
        <title>Cadastrar - Fornecedor</title>
    </head>

    <body>

        <!-- Formulário Fornecedor -->
        <div>

            <h2>Novo Fornecedor</h2>

            <form method="post">

                <div>
                    <input type="text" name="nome"/>
                    <label>nome</label>
                </div>

                <div>
                    <input type="text" name="endereco"/>
                    <label>endereço</label>
                </div>

                <div>
                    <input type="text" name="numero"/>
                    <label>número</label>
                </div>

                <div>
                    <input type="text" name="bairro"/>
                    <label>bairro</label>
                </div>

                <div>
                    <select name="uf">
                        <?php foreach($estados as $uf => $estado){ ?>
                            <option value="<?php echo $uf; ?>"><?php echo $estado; ?></option>
                        <?php } ?>
                    </select>
                    <label>estado</label>
                </div>

                <div>
                    <input type="text" name="telefone"/>
                    <label>telefone</label>
                </div>

                <div>
                    <input type="text" name="email"/>
                    <label>email</label>
                </div>

                <div>
                    <input type="text" name="cnpj"/>
                    <label>cnpj</label>
                </div>

                <div>
                    <input type="text" name="site"/>
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
                    <input type="submit" value="cadastrar"/>
                </div>
            </form>
            
            <a href="adm_fornecedor_lista.php">lista de fornecedores</a>

        </div>

    </body>
</html>