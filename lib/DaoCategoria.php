<?php

    require_once 'Categoria.php';
    require_once 'Banco.php';

    class DaoCategoria{

        private static $instance;
        private static $tabela = 'categoria';

        public static function getInstance(){

            if(!isset(self::$instance)){

                self::$instance = new DaoCategoria();

            }

            return self::$instance;

        }

        public function create(Categoria $categoria){

            try{
                
                $sql = "INSERT INTO ".self::$tabela."(nome) VALUES(:nome)";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':nome', $categoria->getNome());

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
                
                $sql = "SELECT * FROM ".self::$tabela." WHERE idcategoria = :idcategoria";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':idcategoria',$id);
                $stmt->execute();

                return $stmt->fetch();

            }catch(PDOException $e){
                
                echo $e->getMessage();

            }

        }

        public function update(Categoria $categoria){

            try{
                
                $sql = "UPDATE ".self::$tabela." SET nome = :nome WHERE idcategoria = :idcategoria";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':nome', $categoria->getNome());
                $stmt->bindValue(':idcategoria', $categoria->getIdcategoria());

                return $stmt->execute();


            }catch(PDOException $e){
                
                echo $e->getMessage();

            }

        }

        public function del($id){

            try{
                
                $sql = "DELETE FROM".self::$tabela." WHERE idcategoria = :idcategoria";

                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':idcategoria',$id);

                return $stmt->execute();

            }catch(PDOException $e){
                
                echo $e->getMessage();

            }

        }

    }