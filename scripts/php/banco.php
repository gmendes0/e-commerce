<?php

    class Banco{

        public static function conectar(){

            $host = 'den1.mysql5.gear.host'; // Host
            $dbn = 'tcc3';  // Nome do banco
            $user = 'tcc3'; // Usuario do DB
            $senha = '	Gm6yd3~2_vuW'; // Senha do DB

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