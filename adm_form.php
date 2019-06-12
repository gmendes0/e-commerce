<?php

    session_start();

    if(!empty($_POST)){

        $msgs = [
            '',
            'O campo nome deve ser preenchido',
            'O campo nome .. entre 2 a 100 caracteres',
            'O campo login deve ser preechido',
            'O campo login .. entre 2 a 100 caracteres',
            'Este login já existe',
            'O campo senha deve ser preechido',
            'O campo confirmar senha deve ser preechido',
            'O campo senha .. entre 6 a 100 caracteres',
            'As senhas não coincidem',
            'O campo ativo deve ser preenchido',
            'O campo ativo inválido'
        ];

        $valido = true;

        /**
         * Validações do campo nome
         */
        if(empty($_POST['nome'])){

            /**
             * O campo nome deve ser preechido
             */
            $errors[] = $msgs[1];
            $valido = false;

        }else if(strlen($_POST['nome']) < 2 || strlen($_POST['nome']) > 100){

            /**
             * O campo nome deve conter no mínimo 2 e no máximo 100 caracteres
             */
            $errors[] = $msgs[2];
            $valido = false;

        }

        /**
         * Validações do campo login
         */
        if(empty($_POST['login'])){

            /**
             * O campo login deve ser preechido
             */
            $errors[] = $msgs[3];
            $valido = false;

        }else if(strlen($_POST['login']) < 2 || strlen($_POST['login']) > 100){

            /**
             * O campo login deve conter no mínimo 2 e no máximo 100 caracteres
             */
            $errors[] = $msgs[4];
            $valido = false;

        }else{

            require_once 'lib/DaoAdministrador.php';

            $existente = DaoAdministrador::getInstance()->allFieldsWhere(['login'], ['login' => $_POST['login']]);

            if(!empty($existente->login)){

                /**
                 * Este login já existe
                 */
                $errors[] = $msgs[5];
                $valido = false;

            }

        }
        
        /**
         * Validações do campo senha
         */
        if(empty($_POST['senha'])){

            /**
             * O campo senha deve ser preechido
             */
            $errors[] = $msgs[6];
            $valido = false;

        }else if(empty($_POST['confirmacao'])){

            /**
             * O campo confirmar senha deve ser preechido
             */
            $errors[] = $msgs[7];
            $valido = false;

        }else if(strlen($_POST['senha']) < 6 || strlen($_POST['senha']) > 100){

            /**
             * O campo senha .. entre 8 a 100 caracteres,
             */
            $errors[] = $msgs[8];
            $valido = false;

        }else if($_POST['senha'] != $_POST['confirmacao']){

            /**
             * As senhas não coincidem
             */
            $errors[] = $msgs[9];
            $valido = false;

        }

        /**
         * Validações co campo ativo
         */
        if(!isset($_POST['ativo'])){

            /**
             * O campo ativo deve ser preechido
             */
            $errors[] = $msgs[10];
            $valido = false;

        }else if(intval($_POST['ativo']) < 0 && intval($_POST['ativo']) > 1){

            /**
             * O campo ativo inválido
             */
            $errors[] = $msgs[11];
            $valido = false;

        }

        if($valido){

            $newadm = new Administrador;
            $newadm->setNome($_POST['nome']);
            $newadm->setLogin($_POST['login']);
            $newadm->setSenha($_POST['senha']);
            $newadm->setAtivo($_POST['ativo']);
            
            $insert = DaoAdministrador::getInstance()->create($newadm);

            if($insert){

                // header('Location: adm_login.php');
                echo "<script>window.location='adm_login.php'</script>";

            }else{

                $errors[] = 'Falha ao cadastrar';

            }

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
        <link rel="stylesheet" href="css/style.css"/>
        <title>ADM - Login</title>
    </head>

    <body>
        
        <div class="container">

            <h2 class="mt-5">Novo admnistrador</h2>

            <?php

                if(isset($errors) && count($errors) > 0){

                    foreach($errors as $erro){
            ?>
                        <div class="col-sm-4 alert alert-danger"><?php echo $erro; ?></div>
            <?php
                    }

                }

            ?>

            <form class="mt-5" method="POST">
                


                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nome:</label>
                    <div class="col-sm-4">
                        <input type="text" name="nome" class="form-control" value="<?php echo isset($_POST['nome']) ? $_POST['nome'] : '' ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Login:</label>
                    <div class="col-sm-4">
                        <input type="text" name="login" class="form-control" value="<?php echo isset($_POST['login']) ? $_POST['login'] : '' ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Senha:</label>
                    <div class="col-sm-4">
                        <input type="password" name="senha" class="form-control"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Confirmar senha:</label>
                    <div class="col-sm-4">
                        <input type="password" name="confirmacao" class="form-control"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Ativo:</label>
                    <div class="col-sm-4">
                        <select name="ativo" class="form-control">
                            <option value="0" <?php echo (isset($_POST['ativo']) && $_POST['ativo'] == 1) ? 'selected' : ''; ?>>não</option>
                            <option value="1" <?php echo (isset($_POST['ativo']) && $_POST['ativo'] == 1) ? 'selected' : ''; ?>>sim</option>
                        </select>
                    </div>
                </div>

                <input type="submit" value="cadastrar" class="btn btn-primary"/>
            
            </form>
        
        </div>

    </body>
</html>