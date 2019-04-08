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
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <title>Cadastro</title>
    </head>
    
    <body>
        
        <div class="container">

            <?php if(!empty($n)){?><h2><?= $msg[$n];?></h2><?php }?>
            <form method="post">
            
                <div class="form-group">
                    <label>nome</label>
                    <input class="form-control" type="text" name="nome"/>
                </div>

                <div class="form-group">
                    <label>data de nascimento</label>
                    <input class="form-control" type="date" name="datanascimento"/>
                </div>

                <div class="form-group">
                    <label>login</label>
                    <input class="form-control" type="text" name="login"/>
                </div>

                <div class="form-group">
                    <label>senha</label>
                    <input class="form-control" type="password" name="senha"/>
                </div>

                <div class="form-group">
                    <label>confirmar senha</label>
                    <input class="form-control" type="password" name="confirmacao"/>
                </div>

                <div class="form-group">
                    <label>email</label>
                    <input class="form-control" type="text" name="email"/>
                </div>

                <div class="form-group">
                    <label>telefone</label>
                    <input class="form-control" type="text" name="telefone"/>
                </div>

                <div class="form-group">
                    <label>cpf</label>
                    <input class="form-control" type="text" name="cpf"/>
                </div>

                <div class="form-group">
                    <label>endereço</label>
                    <input class="form-control" type="text" name="endereco"/>
                </div>

                <div class="form-group">
                    <label>bairro</label>
                    <input class="form-control" type="text" name="bairro"/>
                </div>

                <div class="form-group">
                    <label>cidade</label>
                    <input class="form-control" type="text" name="cidade"/>
                </div>

                <div class="form-group">
                    <label>estado</label>
                    <select class="form-control" name="estado">
                        <?php foreach($estados as $uf => $es_nome){ ?>
                            <option value="<?php echo $uf ?>"><?php echo $es_nome; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="cadastrar">
                </div>

            </form>

        </div>

        <script src="js/jquery.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>
</html>