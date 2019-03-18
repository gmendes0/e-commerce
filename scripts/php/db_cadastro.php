<?php

    if(!defined('INCLUIDA')){

        header('Location: ../../cadastro.php');
        exit;

    }

    if(!empty($_POST)){
        
        $tabela = 'usuario';

        $msg = [
            '',
            'preencha todos os campos',
            'este login já existe',
            'as senhas não coincidem',
            'cadastrado com sucesso'
        ];

        $cad = [
            'nome' => $_POST['nome'],
            'login' => $_POST['login'],
            'senha' => $_POST['senha'],
            'confirm' => $_POST['confirmacao'],
            'dnasc' => $_POST['datanascimento'],
            'dcad' => date('Y-m-d H-i-s')
        ];

        // verifica se todos os campos estão preenchidos
        if(count(array_filter($cad)) < 5){

            // Campo não preenchido
            $n = 1;

        }else{

            require_once 'banco.php';
            $inexistente = true;

            try{

                $pdo = Banco::conectar();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query = $pdo->query("SELECT login FROM $tabela");

                // Verificar se  o login já existe
                while($u = $query->fetch(PDO::FETCH_OBJ)){

                    if($u->login == $cad['login']){

                        $inexistente = false;
                        break;

                    }

                }

                Banco::desconectar();
                unset($pdo, $query, $u);

            }catch(PDOExeption $e){

                $db_error = $e->getMessage();

            }

            if($inexistente){
                
                if($cad['senha'] == $cad['confirm']){

                    try{

                        $pdo = Banco::conectar();
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $query = "INSERT INTO $tabela(login, senha, nome, nascimento, datacadastro) VALUES(?, ?, ?, ?, ?)";
                        $q = $pdo->prepare($query);
                        $q->execute(array($cad['login'],$cad['senha'],$cad['nome'],$cad['dnasc'],$cad['dcad']));
                        Banco::desconectar();
                        echo "<meta http-equiv='refresh' content='3;url=login.php'/>";
                        $n = 4; // Cadastrado com sucesso

                    }catch(PDOException $e){

                        $db_error = $e->getMessage();

                    }

                }else{

                    // senhas diferentes
                    $n = 3;

                }

            }else{

                // login existente
                $n = 2;

            }

        }
    
    }

?>

<?php
    /*
    $tabela = 'usuario';

    if(!empty($_POST)){
    
        $msg = [
            '',
            'insira um nome',
            'insira um login',
            'este login já existe',
            'insira uma senha',
            'as senhas não coincidem'
        ];

        if(!empty($_POST['nome'])){
        
            if(!empty($_POST['login'])){

                require_once 'banco.php';
                $inexistente = true;

                try{

                    $pdo = Banco::conectar();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $query = $pdo->query("SELECT login FROM $tabela");

                    // Verificar se  o login já existe
                    while($u = $query->fetch(PDO::FETCH_OBJ)){

                        if($u->login == $_POST['login']){

                            $inexistente = false;
                            break;

                        }

                    }

                    Banco::desconectar();

                }catch(PDOExeption $e){

                    $db_error = $e->getMessage();

                }
            
                if($inexistente){

                    if(!empty($_POST['senha'])){
                    
                        if($_POST['senha'] == $_POST['confirmacao']){

                            if(!empty($_POST['datanascimento'])){
                            
                                
                            
                            }else{
                            
                                // $_POST['datanascimento'] vazio
                            
                            }

                        }else{

                            // Senhas diferentes
                            $n = 5;

                        }
                    
                    }else{
                    
                        // $_POST['senha'] vazio
                        $n = 4;
                    
                    }

                }else{

                    // Login existente
                    $n = 3;

                }
            
            }else{
            
                // $_POST['login'] vazio
                $n = 2;
            
            }
        
        }else{
        
            // $_POST['nome'] vazio
            $n = 1;
        
        }
    
    }
    */

?>