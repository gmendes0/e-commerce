<?php
    
    if(!empty($_POST)){

        // Menssagens do formulário de login
        // 0 = nada; 1 = login inexistente; 2 = senha errada; 3 = logado; 4 = campo login vazio; 5 = campo senha vazio;
        $msg = ['','login inválido','senha incorreta','login efetuado com sucesso','preencha o campo login','preencha o campo senha'];

        if(!empty($_POST['login'])){
        
            if(!empty($_POST['senha'])){
            
                require_once 'banco.php';

                $tabela = 'usuario'; // Configurar o nome da tabela
                $logado = false;
                $login = $_POST['login'];
                $senha = $_POST['senha'];

                try {

                    $pdo = Banco::conectar();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $query = $pdo->query("SELECT login, senha FROM $tabela");

                    while ($u = $query->fetch(PDO::FETCH_OBJ)){
                        
                        if($u->login == $login){

                            if($u->senha == $senha){

                                $logado = true;
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

                    if($logado){

                        //  Login efetuado: $msg[3]
                        $n = 3;

                    }

                } catch (PDOException $erro) {

                    //die("Falha na realização da consulta: ".$erro->getMessage());
                    echo "<p class='erro'>Falha na realização da consulta: ".$erro->getMessage()."</h2>";

                }
            
            }else{
            
                //$_POST['senha'] vazio: $msg[5]
                $n = 5;
            
            }
        
        }else{
        
            //$_POST['login'] vazio: $msg[4]
            $n = 4;
        
        }

    }

?>