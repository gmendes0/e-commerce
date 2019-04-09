<?php

    include_once 'Pedvenda.php';
    include_once 'Banco.php';

    class DaoPedvenda{

        private static $instance;
        private static $tabela = "pedvenda";

        public static function getInstance()
        {
            if(!isset(self::$instance)){

                self::$instance = new DaoPedvenda();

            }

            return self::$instance;
        }

        public function create(Pedvenda $pedvenda){

            try{

                $sql = "INSERT INTO {self::$tabela}(data, ativo, usuario_idusuario) VALUES(:data, :ativo, :idusuario)";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(":data", $pedvenda->getData());
                $stmt->bindValue(":ativo", $pedvenda->getAtivo());
                $stmt->bindValue(":idusuario", $pedvenda->getFk_idusuario());

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

                $sql = "SELECT * FROM ".self::$tabela." WHERE idpedvenda = :idpedvenda";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':idpedvenda', $id);
                $stmt->execute();

                return $stmt->fetch();

            }catch(PDOException $e){

                echo $e->getMessage();

            }
        }

        public function update(Pedvenda $pedvenda)
        {
            try{

                $sql = "UPDATE {self::$tabela} SET ativo = :ativo WHERE idpedvenda = :idpedvenda";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(":ativo", $pedvenda->getAtivo());
                $stmt->bindValue(":idpedvenda", $pedvenda->getIdpedvenda());

                return $stmt->execute();

            }catch(PDOException $e){

                echo $e->getMessage();

            }
        }

        public function del($id)
        {
            try{

                $sql = "DELETE FROM ".self::$tabela." WHERE idpedvenda = :idpedvenda";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':idpedvenda', $id);

                return $stmt->execute();

            }catch(PDOException $e){

                echo $e->getMessage();

            }
        }

    }