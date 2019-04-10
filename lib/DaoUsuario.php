<?php

    require_once 'Usuario.php';

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

                $sql = "";

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

                $sql = "";

            }catch(PDOException $e){

                echo $e->getMessage();

            }
        }

        public function update(Usuario $usuario)
        {
            try{

                $sql = "";

            }catch(PDOException $e){

                echo $e->getMessage();

            }
        }

        public function del($id)
        {
            try{

                $sql = "";

            }catch(PDOException $e){

                echo $e->getMessage();

            }
        }

    }