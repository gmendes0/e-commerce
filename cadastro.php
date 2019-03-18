<?php

    session_start();

    if(!empty($_SESSION['nome'])){

        echo "<script>window.location='site.php'</script>";
        exit;

    }else{

        require_once 'scripts/php/db_cadastro.php';

    }

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
                <input type="date" name="datanascimento"/>
                <label>data de nascimento</label>
            </div>

            <div>
                <input type="submit" value="cadastrar">
            </div>

        </form>

    </body>
</html>