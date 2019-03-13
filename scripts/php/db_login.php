<?php

    if(!empty($_POST)){

        if(!empty($_POST['login'])){
        
            if(!empty($_POST['senha'])){
            
                require_once 'banco.php';

                $tabela = 'usuario'; // Configurar o nome da tabela
                $logado = false;
                $l_erro = 'login inválido';
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

                                // Senha Incorreta
                                $l_erro = "Senha Incorreta";

                            }

                        }

                    }

                    if($logado){

                        //  Login efetuado
                        echo "logado";

                    }else{

                        // Login não efetuado
                        echo $l_erro;

                    }

                } catch (PDOException $erro) {

                    die("Falha na realização da consulta: ".$erro->getMessage());

                }
            
            }else{
            
                //$_POST['senha'] vazio
            
            }
        
        }else{
        
            //$_POST['login'] vazio
        
        }

    }

?>