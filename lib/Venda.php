<?php

    class Venda{

        private $idvenda;
        private $quantidade;
        private $ativo;
        private $fkusuario;
        private $fkproduto;

        /**
         * Get the value of idvenda
         */ 
        public function getIdvenda()
        {
            return $this->idvenda;
        }

        /**
         * Set the value of idvenda
         */ 
        public function setIdvenda($idvenda)
        {
            $this->idvenda = $idvenda;
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
         * Get the value of ativo
         */ 
        public function getAtivo()
        {
            return $this->ativo;
        }

        /**
         * Set the value of ativo
         */ 
        public function setAtivo($ativo)
        {
            $this->ativo = $ativo;
        }

        /**
         * Get the value of fkusuario
         */ 
        public function getFkusuario()
        {
            return $this->fkusuario;
        }

        /**
         * Set the value of fkusuario
         */ 
        public function setFkusuario($fkusuario)
        {
            $this->fkusuario = $fkusuario;
        }

        /**
         * Get the value of fkproduto
         */ 
        public function getFkproduto()
        {
            return $this->fkproduto;
        }

        /**
         * Set the value of fkproduto
         */ 
        public function setFkproduto($fkproduto)
        {
            $this->fkproduto = $fkproduto;
        }

    }