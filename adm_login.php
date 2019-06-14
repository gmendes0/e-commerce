<?php

    session_start();

    if(isset($_SESSION['adm']) && !empty($_SESSION['adm'])){

        echo "<script>window.location='site.php'</script>";
        exit;

    }

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

            }
            if(empty($_POST['senha'])){

                /**
                 * O campo senha deve ser preechido
                 */
                $errors[] = $msgs[2];

            }else{

                require_once 'lib/DaoAdministrador.php';

                $existe = DaoAdministrador::getInstance()->allFieldsWhere(['login'], ['login' => $_POST['login']]);

                if(empty($existe->login)){

                    /**
                     * Login inválido
                     */
                    $errors[] = $msgs[3];
                    
                }else{
                    
                    $infos = DaoAdministrador::getInstance()->allFieldsWhere(['idadministrador', 'login', 'senha'], ['login' => $_POST['login'], 'senha' => $_POST['senha']]);

                    if(!$infos){

                        /**
                         * Senha inválida
                         */
                        $errors[] = $msgs[4];

                    }else{

                        /**
                         * logado
                         */
                        $adm = $infos;
                        $_SESSION['adm'] = $infos->idadministrador;
                        // header('Location: site.php');
                        echo "<script>window.location='site.php'</script>";

                    }

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
        
        <div class="row h-100 align-items-center p-5 titulo-bg mb-5">
            <div class="col-12">
                <h2 class="text-center">Entrar como admnistrador</h2>
            </div>
        </div>

        <div class="container">

            <!-- <h2 class="mt-5">Entrar como admnistrador</h2> -->

            <?php

                if(isset($errors) && count($errors) > 0){

                    foreach($errors as $erro){
            ?>
                        <div class="row justify-content-center">
                            <div class="col-sm-4 alert alert-danger text-center"><?php echo $erro; ?></div>
                        </div>
            <?php
                    }

                }

            ?>

            <form class="mt-3" method="POST">
            
                <div class="row justify-content-center">
                    <div class="col-10 col-sm-3 mb-3">
                        <label>Login</label>
                        <input type="text" name="login" class="form-control"/>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-10 col-sm-3 mb-3">
                        <label>Senha</label>
                        <input type="password" name="senha" class="form-control"/>
                    </div>
                </div>

                <div class="text-center">
                    <input type="submit" value="entrar" class="btn btn-success mt-3"/>
                </div>
            
            </form>
        
        </div>

    </body>
</html>
