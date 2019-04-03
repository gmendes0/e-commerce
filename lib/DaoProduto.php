<?php

    require_once 'Banco.php';
    require_once 'Produto.php';

    class DaoProduto{

        private static $instance;
        private static $tabela = 'produto';

        public static function getInstance(){

            if(!isset(self::$instance)){

                self::$instance = new DaoProduto();

            }

            return self::$instance;

        }

        public function create(Produto $produto){

            try{

                $sql = "INSERT INTO ".self::$tabela."(nome, valor, descricao, detalhes_tecnicos, ativo) VALUES(:nome, :valor, :descricao, :detalhes, :ativo)";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':nome', $produto->getNome());
                $stmt->bindValue(':valor', $produto->getValor());
                $stmt->bindValue(':descricao', $produto->getDescricao());
                $stmt->bindValue(':detalhes', $produto->getDetalhes());
                $stmt->bindValue(':ativo', $produto->getAtivo());
                return $stmt->execute();

            }catch(PDOException $e){

                echo $e->getMessage();

            }

        }

        public function readAll(){

            try{

                $sql = "SELECT * FROM ".self::$tabela;

                $stmt = Banco::getInstance()->query($sql);
                return $stmt->fetchAll();

            }catch(PDOException $e){

                echo $e->getMessage();

            }

        }

        public function readOne($id){

            try{

                $sql = "SELECT * FROM ".self::$tabela." WHERE idproduto = :idproduto";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':idproduto', $id);
                $stmt->execute();

                return $stmt->fetch();

            }catch(PDOException $e){

                echo $e->getMessage();

            }

        }

        public function update(Produto $produto){

            try{

                $sql = "UPDATE ".self::$tabela." SET nome = :nome, valor = :valor, descricao = :descricao, detalhes_tecnicos = :detalhes, ativo = :ativo WHERE idproduto = :idproduto";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':nome', $produto->getNome());
                $stmt->bindValue(':valor', $produto->getValor());
                $stmt->bindValue(':descricao', $produto->getDescricao());
                $stmt->bindValue(':detalhes', $produto->getDetalhes());
                $stmt->bindValue(':ativo', $produto->getAtivo());
                $stmt->bindValue(':idproduto', $produto->getIdProduto());

                return $stmt->execute();

            }catch(PDOException $e){

                echo $e->getMessage();

            }

        }

        public function del($id){

            try{

                $sql = "DELETE FROM ".self::$tabela." WHERE idproduto = :idproduto";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':idproduto', $id);

                return $stmt->execute();

            }catch(PDOException $e){

                echo $e->getMessage();

            }

        }

    }