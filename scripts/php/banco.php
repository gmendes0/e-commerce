<?php

    class Banco{

        public static function conectar(){

            $host = 'localhost'; // Host
            $dbn = 'tcc3';  // Nome do banco
            $user = 'root'; // Usuario do DB
            $senha = ''; // Senha do DB

            try{

                // Tentar conexão
                $conn = new PDO("mysql:host=$host;dbname=$dbn", $user, $senha);

            }catch(PDOException $erro){

                // Exibir erro
                die("Falha de conexão com o banco de dados: ".$erro->getMessage());

            }

            return $conn;

        }

        public static function desconectar(){

            $conn = null;

        }

    }

?>