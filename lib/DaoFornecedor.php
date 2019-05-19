<?php

    require_once 'Fornecedor.php';
    require_once 'Banco.php';

    class DaoFornecedor{

        private static $instance;
        private static $tabela = 'fornecedor';

        public static function getInstance(){

            if(!isset(self::$instance)){

                self::$instance = new DaoFornecedor();

            }

            return self::$instance;

        }


        public function create(Fornecedor $fornecedor)
        {
            
            try{
                
                $sql = "INSERT INTO ".self::$tabela."(nome, endereco, telefone, email, cnpj, site, numero, bairro, cidade, uf, ativo, datacadastro) VALUES(:nome, :endereco, :telefone, :email, :cnpj, :site, :numero, :bairro, :cidade, :uf, :ativo, :datacadastro)";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':nome', $fornecedor->getNome());
                $stmt->bindValue(':endereco', $fornecedor->getEndereco());
                $stmt->bindValue(':telefone', $fornecedor->getTelefone());
                $stmt->bindValue(':email', $fornecedor->getEmail());
                $stmt->bindValue(':cnpj', $fornecedor->getCnpj());
                $stmt->bindValue(':site', $fornecedor->getSite());
                $stmt->bindValue(':numero', $fornecedor->getNumero());
                $stmt->bindValue(':bairro', $fornecedor->getBairro());
                $stmt->bindValue(':cidade', $fornecedor->getCidade());
                $stmt->bindValue(':uf', $fornecedor->getUf());
                $stmt->bindValue(':ativo', $fornecedor->getAtivo());
                $stmt->bindValue(':datacadastro', $fornecedor->getDatacadastro());

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
                
                $sql = "SELECT * FROM ".self::$tabela." WHERE idfornecedor = :idfornecedor";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':idfornecedor', $id);
                $stmt->execute();

                return $stmt->fetch();

            }catch(PDOException $e){

                echo $e->getMessage();

            }

        }

        public function readFieldAll($fields){

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

        public function update(Fornecedor $fornecedor)
        {
            
            try{
                
                $sql = "UPDATE ".self::$tabela." SET nome = :nome, endereco = :endereco, telefone = :telefone, email = :email, cnpj = :cnpj, site = :site, numero = :numero, bairro = :bairro, cidade = :cidade, uf = :uf, ativo = :ativo WHERE idfornecedor = :idfornecedor";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':nome', $fornecedor->getNome());
                $stmt->bindValue(':endereco', $fornecedor->getEndereco());
                $stmt->bindValue(':telefone', $fornecedor->getTelefone());
                $stmt->bindValue(':email', $fornecedor->getEmail());
                $stmt->bindValue(':cnpj', $fornecedor->getCnpj());
                $stmt->bindValue(':site', $fornecedor->getSite());
                $stmt->bindValue(':numero', $fornecedor->getNumero());
                $stmt->bindValue(':bairro', $fornecedor->getBairro());
                $stmt->bindValue(':cidade', $fornecedor->getCidade());
                $stmt->bindValue(':uf', $fornecedor->getUf());
                $stmt->bindValue(':ativo', $fornecedor->getAtivo());
                $stmt->bindValue(':idfornecedor', $fornecedor->getIdfornecedor());

                return $stmt->execute();

            }catch(PDOException $e){

                echo $e->getMessage();

            }

        }

        public function del($id)
        {
            
            try{
                
                $sql = "DELETE FROM ".self::$tabela." WHERE idfornecedor = :idfornecedor";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':idfornecedor', $id);

                return $stmt->execute();

            }catch(PDOException $e){

                echo $e->getMessage();

            }

        }

    }