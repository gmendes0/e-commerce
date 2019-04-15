<?php

    if(!empty($_POST)){

        // Menssagens do formulário de login
        // 0 = nada; 1 = login inexistente; 2 = senha errada; 3 = logado; 4 = campo login vazio; 5 = campo senha vazio;
        $msg = ['','login inválido','senha incorreta','login efetuado com sucesso','preencha o campo login','preencha o campo senha'];

        if(!empty($_POST['login'])){

            if(!empty($_POST['senha'])){
            
                require_once "lib/DaoUsuario.php";

                $usuario = new Usuario();
                $usuario->setLogin($_POST['login']);
                $usuario->setSenha($_POST['senha']);

                $query = DaoUsuario::getInstance()->readFieldAll(['login','senha','idusuario']);

                foreach($query as $user){

                    if($user['login'] == $usuario->getLogin()){

                        if($user['senha'] == $usuario->getSenha()){

                            //  Login efetuado: $msg[3]
                            $n = 3;
                            $dados = DaoUsuario::getInstance()->readOne($user['idusuario']);
                            $_SESSION['usuario'] = intval($dados['idusuario']);
                            echo "<meta http-equiv='refresh' content='3;url=site.php'/>";
                            break;

                        }else{

                            // Senha Incorreta: $msg[2]
                            $n = 2;

                        }

                    }else{

                        if(empty($n)){

                            // Login inválido: $msg[1]
                            $n = 1;

                        }

                    }

                }
            
            }else{
            
                // $_POST['senha'] vazio
                $n = 5;
            
            }

        }else{

            //$_POST['login'] vazio: $msg[4]
            $n = 4;

        }

    }

?>