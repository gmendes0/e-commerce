<?php

    if(!defined('INCLUIDA')){

        header('Location: ../../cadastro.php');
        exit;

    }

    if(!empty($_POST)){
        
        require_once 'lib/Validacao.php';
        $validar = new Validacao;

        $tabela = 'usuario';

        // $msg = [
        //     '',
        //     'preencha todos os campos',
        //     'este login já existe',
        //     'as senhas não coincidem',
        //     'cadastrado com sucesso'
        // ];

        $cad = [
            'nome' => $_POST['nome'],
            'dnasc' => $_POST['datanascimento'],
            'login' => $_POST['login'],
            'senha' => $_POST['senha'],
            'confirm' => $_POST['confirmacao'],
            'email' => $_POST['email'],
            'telefone' => $_POST['telefone'],
            'cpf' => $_POST['cpf'],
            'endereco' => $_POST['endereco'],
            'numero' => $_POST['numero'],
            'bairro' => $_POST['bairro'],
            'cidade' => $_POST['cidade'],
            'estado' => $_POST['estado'],
            'dcad' => date('Y-m-d H-i-s')
        ];

        /**
         * validação de formulário
         */
        $validar->validation([
            'nome' => 'required|words:2|smin:3|smax:45',
            'datanascimento' => 'required|date',
            'login' => 'required|smin:3|smax:50',
            'senha' => 'required|smin:3|smax:50',
            'confirmacao' => 'required|smin:3|smax:50',
            'email' => 'required|smin:3|smax:50|email',
            'telefone' => 'required|smin:3|smax:13',
            'cpf' => 'required|smin:3|smax:14',
            'endereco' => 'required|smin:3|smax:45',
            'numero' => 'required|numeric|min:0|max:99999',
            'bairro' => 'required|smin:3|smax:45',
            'cidade' => 'required|smin:3|smax:45',
            'estado' => 'required|smin:2|smax:2'
        ]);

        if($validar->getValido()){
            
            require_once 'banco.php';
            $inexistente = true;

            /**
             * verifica se o login já existe
             */
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

            /**
             * se o login não existir
             */
            if($inexistente){

                /**
                 * verifica se as senhas conferem
                 */
                if($validar->confirmarSenha($_POST['senha'], $_POST['confirmacao'])){

                    $cad = [
                        'nome' => $_POST['nome'],
                        'dnasc' => $_POST['datanascimento'],
                        'login' => $_POST['login'],
                        'senha' => $_POST['senha'],
                        'confirm' => $_POST['confirmacao'],
                        'email' => $_POST['email'],
                        'telefone' => $_POST['telefone'],
                        'cpf' => $_POST['cpf'],
                        'endereco' => $_POST['endereco'],
                        'numero' => $_POST['numero'],
                        'bairro' => $_POST['bairro'],
                        'cidade' => $_POST['cidade'],
                        'estado' => $_POST['estado'],
                        'dcad' => date('Y-m-d H-i-s'),
                        'ativo' => 1
                    ];

                    try{

                        $pdo = Banco::conectar();
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $query = "INSERT INTO $tabela(login, senha, nome, email, telefone, cpf, endereco, numero, bairro, cidade, estado, nascimento, datacadastro, ativo) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $q = $pdo->prepare($query);
                        $q->execute(array(
                            $cad['login'],
                            $cad['senha'],
                            $cad['nome'],
                            $cad['email'],
                            $cad['telefone'],
                            $cad['cpf'],
                            $cad['endereco'],
                            $cad['numero'],
                            $cad['bairro'],
                            $cad['cidade'],
                            $cad['estado'],
                            $cad['dnasc'],
                            $cad['dcad'],
                            $cad['ativo'],
                        ));
                        Banco::desconectar();
                        echo "<meta http-equiv='refresh' content='3;url=login.php'/>";
                        $msg['success'] = 'cadastrado com sucesso';

                    }catch(PDOException $e){

                        $db_error = $e->getMessage();
                        echo $db_error;

                    }

                }else{

                    $msg['error'] = 'a senha deve ser igual a confirmação';

                }

            }

        }

        // // verifica se todos os campos estão preenchidos
        // if(count(array_filter($cad)) < 5){

        //     // Campo não preenchido
        //     $n = 1;

        // }else{

        //     require_once 'banco.php';
        //     $inexistente = true;

        //     try{

        //         $pdo = Banco::conectar();
        //         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //         $query = $pdo->query("SELECT login FROM $tabela");

        //         // Verificar se  o login já existe
        //         while($u = $query->fetch(PDO::FETCH_OBJ)){

        //             if($u->login == $cad['login']){

        //                 $inexistente = false;
        //                 break;

        //             }

        //         }

        //         Banco::desconectar();
        //         unset($pdo, $query, $u);

        //     }catch(PDOExeption $e){

        //         $db_error = $e->getMessage();

        //     }

        //     if($inexistente){
                
        //         if($cad['senha'] == $cad['confirm']){

        //             try{

        //                 $pdo = Banco::conectar();
        //                 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //                 $query = "INSERT INTO $tabela(login, senha, nome, email, telefone, cpf, endereco, numero, bairro, cidade, estado, nascimento, datacadastro) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        //                 $q = $pdo->prepare($query);
        //                 $q->execute(array(
        //                     $cad['login'],
        //                     $cad['senha'],
        //                     $cad['nome'],
        //                     $cad['email'],
        //                     $cad['telefone'],
        //                     $cad['cpf'],
        //                     $cad['endereco'],
        //                     $cad['numero'],
        //                     $cad['bairro'],
        //                     $cad['cidade'],
        //                     $cad['estado'],
        //                     $cad['dnasc'],
        //                     $cad['dcad']
        //                 ));
        //                 Banco::desconectar();
        //                 echo "<meta http-equiv='refresh' content='3;url=login.php'/>";
        //                 $n = 4; // Cadastrado com sucesso

        //             }catch(PDOException $e){

        //                 $db_error = $e->getMessage();
        //                 echo $db_error;

        //             }

        //         }else{

        //             // senhas diferentes
        //             $n = 3;

        //         }

        //     }else{

        //         // login existente
        //         $n = 2;

        //     }

        // }
    
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