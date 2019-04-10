<?php

    require_once 'Banco.php';
    require_once 'Itensvenda.php';

    class DaoItensvenda{

        private static $instance;
        private static $tabela = 'itensvenda';

        public static function getInstance(){

            if(!isset(self::$instance)){

                self::$instance = new DaoItensvenda();

            }

            return self::$instance;

        }

        public function create(Itensvenda $itensvenda)
        {

            try{

                $sql = "INSERT INTO ".self::$tabela."(quantidade, valorunitario, valordesconto, produto_idproduto, pedvenda_idpedvenda) VALUES(:qtd, :valorunitario, :valordesconto, :idproduto, :idpedvenda)";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':qtd', $itensvenda->getQuantidade());
                $stmt->bindValue(':valorunitario', $itensvenda->getValorunitario());
                $stmt->bindValue(':valordesconto', $itensvenda->getValordesconto());
                $stmt->bindValue(':idproduto', $itensvenda->getFk_idproduto());
                $stmt->bindValue(':idpedvenda', $itensvenda->getFk_idpedvenda());

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

                $sql = "SELECT * FROM ".self::$tabela." WHERE iditensvenda = :iditensvenda";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':iditensvenda', $id);
                
                return $stmt->execute();

            }catch(PDOException $e){
        
                echo $e->getMessage();
        
            }

        }

        public function update(Itensvenda $itensvenda)
        {

            try{

                $sql = "UPDATE ".self::$tabela." SET quantidade = :qtd, valorunitario = :valorunitario, valordesconto = :valordesconto, produto_idproduto = :idproduto, pedvenda_idpedvenda = :idpedvenda WHERE iditensvenda = :iditensvenda";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':qtd', $itensvenda->getQuantidade());
                $stmt->bindValue(':valorunitario', $itensvenda->getValorunitario());
                $stmt->bindValue(':valordesconto', $itensvenda->getValordesconto());
                $stmt->bindValue(':idproduto', $itensvenda->getFk_idproduto());
                $stmt->bindValue(':idpedvenda', $itensvenda->getFk_idpedvenda());
                $stmt->bindValue(':iditensvenda', $itensvenda->getIditensvenda());

                return $stmt->execute();

            }catch(PDOException $e){
                
                echo $e->getMessage();

            }

        }

        public function del($id)
        {

            try{

                $sql = "DELETE FROM ".self::$tabela."WHERE iditensvenda = :iditensvenda";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':iditensvenda', $id);

                return $stmt->execute();

            }catch(PDOException $e){

                echo $e->getMessage();

            }

        }

    }