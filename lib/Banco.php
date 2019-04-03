<?php

    class Banco{

        private static $instance;

        public static function getInstance(){

            if(!isset(self::$instance)){

                $host = 'localhost';
                $dbname = 'tcc';
                $user = 'root';
                $senha = '';

                try {

                    self::$instance = new PDO("mysql:host=$host;dbname=$dbname", $user, $senha);
                    self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                }catch(PDOException $e){

                    echo $e->getMessage();

                }

            }

            return self::$instance;

        }

    }