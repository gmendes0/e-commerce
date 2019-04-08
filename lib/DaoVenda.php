<?php

    require_once 'Venda.php';

    class DaoVenda{

        private static $instance;
        private static $tabela = 'venda';

        public static function getInstance(){

            if(!isset(self::$instance)){

                self::$instance = new DaoVenda();

            }

            return self::$instance;

        }

        public function create(Venda $venda){

            try{

                $sql = "INSERT INTO ".self::$tabela."(quantidade, ativo, usuario_idusuario, produto_idproduto) VALUES(:qtd, :ativo, :idusuario, :idproduto)";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':qtd', $venda->getQuantidade());
                $stmt->bindValue(':ativo', $venda->getAtivo());
                $stmt->bindValue(':idusuario', $venda->getFkusuario());
                $stmt->bindValue(':idproduto', $venda->getFkproduto());
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

                $sql = "SELECT * FROM ".self::$tabela." WHERE idvenda = :idvenda";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':idvenda', $id);
                
                return $stmt->execute();

            }catch(PDOException $e){
        
                echo $e->getMessage();
        
            }

        }

        public function update(Venda $venda){

            try{

                $sql = "UPDATE ".self::$tabela." SET quantidade = :qtd, ativo = :ativo, produto_idproduto = :idproduto WHERE idvenda = :idvenda";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':qtd', $venda->getQuantidade());
                $stmt->bindValue(':ativo', $venda->getAtivo());
                $stmt->bindValue(':idproduto', $venda->getFkproduto());
                $stmt->bindValue(':idvenda', $venda->getIdvenda());
                return $stmt->execute();

            }catch(PDOException $e){

                echo $e->getMessage();

            }

        }

        public function del($id){

            try{

                $sql = "DELETE FROM ".self::$tabela."WHERE idvenda = :idvenda";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':idvenda', $id);

                return $stmt->execute();

            }catch(PDOException $e){

                echo $e->getMessage();

            }

        }

    }

    try{



    }catch(PDOException $e){

        echo $e->getMessage();

    }