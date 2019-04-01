<?php

    session_start();

    if(!empty($_SESSION['nome'])){

        echo "<script>window.location='site.php'</script>";
        exit;

    }else{

        define('INCLUIDA', true);

        require_once 'scripts/php/db_cadastro.php';

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

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>Cadastro</title>
    </head>
    
    <body>
        
        <?php if(!empty($n)){?><h2><?= $msg[$n];?></h2><?php }?>
        <form method="post">
        
            <div>
                <input type="text" name="nome"/>
                <label>nome</label>
            </div>

            <div>
                <input type="date" name="datanascimento"/>
                <label>data de nascimento</label>
            </div>

            <div>
                <input type="text" name="login"/>
                <label>login</label>
            </div>

            <div>
                <input type="password" name="senha"/>
                <label>senha</label>
            </div>

            <div>
                <input type="password" name="confirmacao"/>
                <label>confirmar senha</label>
            </div>

            <div>
                <input type="text" name="email"/>
                <label>email</label>
            </div>

            <div>
                <input type="text" name="telefone"/>
                <label>telefone</label>
            </div>

            <div>
                <input type="text" name="cpf"/>
                <label>cpf</label>
            </div>

            <div>
                <input type="text" name="endereco"/>
                <label>endereço</label>
            </div>

            <div>
                <input type="text" name="bairro"/>
                <label>bairro</label>
            </div>

            <div>
                <input type="text" name="cidade"/>
                <label>cidade</label>
            </div>

            <div>
                <select name="estado">
                    <?php foreach($estados as $uf => $es_nome){ ?>
                        <option value="<?php echo $uf ?>"><?php echo $es_nome; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div>
                <input type="submit" value="cadastrar">
            </div>

        </form>

    </body>
</html>