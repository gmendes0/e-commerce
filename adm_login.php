<?php

    session_start();

    if(empty($_SESSION['adm'])){

        if(!empty($_POST)){

            $msgs = [
                '',
                'O campo login deve ser preechido',
                'O campo senha deve ser preechido',
                'Login inválido',
                'Senha incorreta'
            ];

            if(empty($_POST['login'])){

                /**
                 * O campo login deve ser preechido
                 */
                $errors[] = $msgs[1];

            }else if(empty($_POST['senha'])){

                /**
                 * O campo senha deve ser preechido
                 */
                $errors = $msgs[2];

            }else{

                /**
                 * 
                 * Criar o método existeLogin
                 * retornar true se existir
                 * 
                 * 
                 */
                require_once 'lib/DaoAdministrador.php';

                $logado = false;

                if(DaoAdministrador::getInstance()->allFieldsWhere(['login'], ['login' => $_POST['login']])){

                    /**
                     * Login inválido
                     */
                    $errors = $msgs[3];
                    
                }else{
                    
                    /**
                     * tentar login:
                     * 
                     * **************************************************************************************
                     * SELECT `idadmnistrador` FROM admnistrador WHERE `login` = :login AND `senha` = :senha;
                     * 
                     * bindValue(':login', $_POST['login']);
                     * bindValue(':senha', $_POST['senha']);
                     * 
                     * execute();
                     * fetch();
                     * **************************************************************************************
                     * 
                     */

                }

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
            <pre><?php var_dump($errors); ?></pre>
            <h2 class="mt-5">Entrar como admnistrador</h2>

            <form class="mt-5" method="POST">
            
                <div class="form-group row">
                    <label class="col-sm-1 col-form-label">Login:</label>
                    <div class="col-sm-3">
                        <input type="text" name="login" class="form-control"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-1 col-form-label">Senha:</label>
                    <div class="col-sm-3">
                        <input type="password" name="senha" class="form-control"/>
                    </div>
                </div>

                <input type="submit" value="entrar" class="btn btn-primary"/>
            
            </form>
        
        </div>

    </body>
</html>
