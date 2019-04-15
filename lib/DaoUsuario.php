<?php

    require_once 'Usuario.php';
    require_once 'Banco.php';

    class DaoUsuario{

        private static $instance;
        private static $tabela = 'usuario';

        public static function getInstance()
        {
            if(!isset(self::$instance)){

                self::$instance = new DaoUsuario();

            }

            return self::$instance;
        }

        public function create(Usuario $usuario)
        {
            try{

                $sql = "INSERT INTO {self::$tabela}(login, senha, nome, email, cpf, nascimento, endereco, numero, bairro, cidade, estado, telefone, ativo, datacadastro) VALUES(:login, :senha, :nome, :email, :cpf, :nascimento, :endereco, :numero, :bairro, :cidade, :estado, :telefone, :ativo, :datacadastro)";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue("login", $usuario->getLogin());
                $stmt->bindValue(":senha", $usuario->getSenha());
                $stmt->bindValue(":nome", $usuario->getNome());
                $stmt->bindValue(":email", $usuario->getEmail());
                $stmt->bindValue(":cpf", $usuario->getCpf());
                $stmt->bindValue(":nascimento", $usuario->getNascimento());
                $stmt->bindValue(":endereco", $usuario->getEndereco());
                $stmt->bindValue(":numero", $usuario->getNumero());
                $stmt->bindValue(":bairro", $usuario->getBairro());
                $stmt->bindValue(":cidade", $usuario->getCidade());
                $stmt->bindValue(":estado", $usuario->getEstado());
                $stmt->bindValue(":telefone", $usuario->getTelefone());
                $stmt->bindValue(":ativo", $usuario->getAtivo());
                $stmt->bindValue(":datacadastro", $usuario->getDatacadastro());

                return $stmt->execute();

            }catch(PDOException $e){

                echo $e->getMessage();

            }
        }

        public function readAll()
        {
            try{

                $sql = "SELECT * FROM ".self::$tabela;

                $stmt = Banco::getInstance()->query($sql);
                return $stmt->fetchAll();

            }catch(PDOException $e){

                echo $e->getMessage();

            }
        }

        public function readOne($id)
        {
            try{

                $sql = "SELECT * FROM ".self::$tabela." WHERE idusuario = :idusuario";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(":idusuario", $id);
                $stmt->execute();

                return $stmt->fetch();

            }catch(PDOException $e){

                echo $e->getMessage();

            }
        }

        public function readFieldAll($fields)
        {

            try{

                if(count($fields) > 1){

                    $field = implode(',',$fields);

                }else{

                    $field = $fields;

                }

                $sql = "SELECT $field FROM ".self::$tabela;

                $stmt = Banco::getInstance()->query($sql);

                return $stmt->fetchAll();;

            }catch(PDOException $e){

                echo $e->getMessage();

            }

        }

        public function update(Usuario $usuario)
        {
            try{

                $sql = "UPDATE {self::$tabela} SET login = :login, senha = :senha, nome = :nome, email = :email, cpf = :cpf, nascimento = :nascimento, endereco = :endereco, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, telefone = :telefone, ativo = :ativo, datacadastro = :datacadastro WHERE idusuario = :idusuario";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue("login", $usuario->getLogin());
                $stmt->bindValue(":senha", $usuario->getSenha());
                $stmt->bindValue(":nome", $usuario->getNome());
                $stmt->bindValue(":email", $usuario->getEmail());
                $stmt->bindValue(":cpf", $usuario->getCpf());
                $stmt->bindValue(":nascimento", $usuario->getNascimento());
                $stmt->bindValue(":endereco", $usuario->getEndereco());
                $stmt->bindValue(":numero", $usuario->getNumero());
                $stmt->bindValue(":bairro", $usuario->getBairro());
                $stmt->bindValue(":cidade", $usuario->getCidade());
                $stmt->bindValue(":estado", $usuario->getEstado());
                $stmt->bindValue(":telefone", $usuario->getTelefone());
                $stmt->bindValue(":ativo", $usuario->getAtivo());
                $stmt->bindValue(":idusuario", $usuario->getIdusuario());

                return $stmt->execute();

            }catch(PDOException $e){

                echo $e->getMessage();

            }
        }

        public function del($id)
        {
            try{

                $sql = "DELETE FROM ".self::$tabela." WHERE idusuario = :idusuario";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':idusuario', $id);

                return $stmt->execute();

            }catch(PDOException $e){

                echo $e->getMessage();

            }
        }

    }