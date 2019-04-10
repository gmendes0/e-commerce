<?php

    class Itensvenda{

        private $iditensvenda;
        private $quantidade;
        private $valorunitario;
        private $valordesconto;
        private $fk_idproduto;
        private $fk_idpedvenda;

        /**
         * Get the value of iditensvenda
         */ 
        public function getIditensvenda()
        {
            return $this->iditensvenda;
        }

        /**
         * Set the value of iditensvenda
         */ 
        public function setIditensvenda($iditensvenda)
        {
            $this->iditensvenda = $iditensvenda;
        }

        /**
         * Get the value of quantidade
         */ 
        public function getQuantidade()
        {
            return $this->quantidade;
        }

        /**
         * Set the value of quantidade
         */ 
        public function setQuantidade($quantidade)
        {
            $this->quantidade = $quantidade;
        }

        /**
         * Get the value of valorunitario
         */ 
        public function getValorunitario()
        {
            return $this->valorunitario;
        }

        /**
         * Set the value of valorunitario
         */ 
        public function setValorunitario($valorunitario)
        {
            $this->valorunitario = $valorunitario;
        }

        /**
         * Get the value of valordesconto
         */ 
        public function getValordesconto()
        {
            return $this->valordesconto;
        }

        /**
         * Set the value of valordesconto
         */ 
        public function setValordesconto($valordesconto)
        {
            $this->valordesconto = $valordesconto;
        }

        /**
         * Get the value of fk_idproduto
         */ 
        public function getFk_idproduto()
        {
            return $this->fk_idproduto;
        }

        /**
         * Set the value of fk_idproduto
         */ 
        public function setFk_idproduto($fk_idproduto)
        {
            $this->fk_idproduto = $fk_idproduto;
        }

        /**
         * Get the value of fk_idpedvenda
         */ 
        public function getFk_idpedvenda()
        {
            return $this->fk_idpedvenda;
        }

        /**
         * Set the value of fk_idpedvenda
         */ 
        public function setFk_idpedvenda($fk_idpedvenda)
        {
            $this->fk_idpedvenda = $fk_idpedvenda;
        }
    }