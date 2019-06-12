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

                $sql = "INSERT INTO ".self::$tabela."(valortotal, data, ativo, usuario_idusuario, pagseguro_id) VALUES(:valortotal, :data, :ativo, :idusuario, :pagseguro_id)";
                $stmt = Banco::getInstance()->prepare($sql);

                $stmt->bindValue(":valortotal", $pedvenda->getValortotal());
                $stmt->bindValue(":data", $pedvenda->getData());
                $stmt->bindValue(":ativo", $pedvenda->getAtivo());
                $stmt->bindValue(":idusuario", $pedvenda->getFk_idusuario());
                $stmt->bindValue(":pagseguro_id", $pedvenda->getPagseguro_id());

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

                return $stmt->fetchAll();

            }catch(PDOException $e){

                echo $e->getMessage();

            }

        }

        public function readAllWhere($index, $id)
        {

            try{

                $sql = "SELECT * FROM ".self::$tabela." WHERE $index = $id";
                $stmt = Banco::getInstance()->query($sql);

                return $stmt->fetchAll();

            }catch(PDOException $e){

                echo $e->getMessage();

            }

        }

        public function readFieldWhere($fields, $index, $id)
        {

            try{

                if(count($fields) > 1){

                    $field = implode(',',$fields);

                }else{

                    $field = $fields[0];
                }

                $sql = "SELECT $field FROM ".self::$tabela." WHERE $index = $id";
                $stmt = Banco::getInstance()->query($sql);

                return $stmt->fetchAll();

            }catch(PDOException $e){

                echo $e->getMessage();

            }

        }

        public function lastIDpedvenda($idusuario)
        {

            try{

                $sql = "SELECT idpedvenda FROM ".self::$tabela." WHERE usuario_idusuario = $idusuario ORDER BY idpedvenda DESC LIMIT 1";
                $stmt = Banco::getInstance()->query($sql);

                return $stmt->fetch();

            }catch(PDOException $e){

                echo $e->getMessage();

            }

        }
        public function update(Pedvenda $pedvenda)
        {

            try{

                $sql = "UPDATE ".self::$tabela." SET ativo = :ativo WHERE idpedvenda = :idpedvenda";
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