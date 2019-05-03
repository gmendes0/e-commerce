<?php

    require_once 'DAO.php';
    require_once 'Administrador.php';

    class DaoAdministrador extends DAO
    {

        protected static $tabela = 'administrador';
        protected static $pk = 'idadministrador';
        public static $instance;

        public function __construct(){
            DAO::$tabela = 'administrador';
            DAO::$pk = 'idadministrador';
        }

        public static function getInstance()
        {

            if(!isset(self::$instance)){

                self::$instance = new DaoAdministrador();

            }

            return self::$instance;

        }

        public function create(Administrador $administrador)
        {

            try{

                $sql = "INSERT INTO ".self::$tabela."(`nome`, `login`, `senha`, `ativo`) VALUES(:nome, :login, :senha, :ativo)";
                $stmt = Banco::getInstance()->prepare($sql);
    
                $stmt->bindValue(':nome', $administrador->getNome());
                $stmt->bindValue(':login', $administrador->getLogin());
                $stmt->bindValue(':senha', $administrador->getSenha());
                $stmt->bindValue(':ativo', $administrador->getAtivo());
    
                return $stmt->execute();

            }catch(PDOException $th){

                echo $th->getMessage();

            }

        }

        public function update(Administrador $administrador)
        {

            try{

                $sql = "UPDATE ".self::$tabela."SET `nome` = :nome, `login` = :login, `senha` = :senha, `ativo` = :ativo) WHERE ".self::$pk." = :id";
                $stmt = Banco::getInstance()->prepare($sql);
    
                $stmt->bindValue(':nome', $administrador->getNome());
                $stmt->bindValue(':login', $administrador->getLogin());
                $stmt->bindValue(':senha', $administrador->getSenha());
                $stmt->bindValue(':ativo', $administrador->getAtivo());
                $stmt->bindValue(':id', $administrador->getId());
    
                return $stmt->execute();

            }catch(PDOException $th){

                echo $th->getMessage();

            }

        }
    }