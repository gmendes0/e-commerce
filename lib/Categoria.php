<?php

    class Categoria{

        private $idcategoria;
        private $nome;

        /**
         * Get the value of idcategoria
         */ 
        public function getIdcategoria()
        {
                return $this->idcategoria;
        }

        /**
         * Set the value of idcategoria
         */ 
        public function setIdcategoria($idcategoria)
        {
            $this->idcategoria = $idcategoria;
        }

        /**
         * Get the value of nome
         */ 
        public function getNome()
        {
                return $this->nome;
        }

        /**
         * Set the value of nome
         */ 
        public function setNome($nome)
        {
            $this->nome = $nome;
        }
    }