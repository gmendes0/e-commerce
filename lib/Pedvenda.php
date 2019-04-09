<?php

    class Pedvenda{

        private $idpedvenda;
        private $data;
        private $ativo;
        private $fk_idusuario;

        /**
         * Get the value of idpedvenda
         */ 
        public function getIdpedvenda()
        {
            return $this->idpedvenda;
        }

        /**
         * Set the value of idpedvenda
         */ 
        public function setIdpedvenda($idpedvenda)
        {
            $this->idpedvenda = $idpedvenda;
        }

        /**
         * Get the value of data
         */ 
        public function getData()
        {
            return $this->data;
        }

        /**
         * Set the value of data
         */ 
        public function setData($data)
        {
            $this->data = $data;
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
         * Get the value of fk_idusuario
         */ 
        public function getFk_idusuario()
        {
            return $this->fk_idusuario;
        }

        /**
         * Set the value of fk_idusuario
         */ 
        public function setFk_idusuario($fk_idusuario)
        {
            $this->fk_idusuario = $fk_idusuario;
        }
    }