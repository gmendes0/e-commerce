<?php

    class Fornecedor{

        private $idfornecedor;
        private $nome;
        private $endereco;
        private $telefone;
        private $email;
        private $cnpj;
        private $site;
        private $numero;
        private $bairro;
        private $uf;
        private $ativo;
        private $datacadastro;

        /**
         * Get the value of idfornecedor
         */ 
        public function getIdfornecedor()
        {
            return $this->idfornecedor;
        }

        /**
         * Set the value of idfornecedor
         */ 
        public function setIdfornecedor($idfornecedor)
        {
            $this->idfornecedor = $idfornecedor;
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

        /**
         * Get the value of endereco
         */ 
        public function getEndereco()
        {
            return $this->endereco;
        }

        /**
         * Set the value of endereco
         */ 
        public function setEndereco($endereco)
        {
            $this->endereco = $endereco;
        }

        /**
         * Get the value of telefone
         */ 
        public function getTelefone()
        {
            return $this->telefone;
        }

        /**
         * Set the value of telefone
         */ 
        public function setTelefone($telefone)
        {
            $this->telefone = $telefone;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * Set the value of email
         */ 
        public function setEmail($email)
        {
            $this->email = $email;
        }

        /**
         * Get the value of cnpj
         */ 
        public function getCnpj()
        {
            return $this->cnpj;
        }

        /**
         * Set the value of cnpj
         */ 
        public function setCnpj($cnpj)
        {
            $this->cnpj = $cnpj;
        }

        /**
         * Get the value of site
         */ 
        public function getSite()
        {
            return $this->site;
        }

        /**
         * Set the value of site
         */ 
        public function setSite($site)
        {
            $this->site = $site;
        }

        /**
         * Get the value of numero
         */ 
        public function getNumero()
        {
            return $this->numero;
        }

        /**
         * Set the value of numero
         */ 
        public function setNumero($numero)
        {
            $this->numero = $numero;
        }

        /**
         * Get the value of bairro
         */ 
        public function getBairro()
        {
            return $this->bairro;
        }

        /**
         * Set the value of bairro
         */ 
        public function setBairro($bairro)
        {
            $this->bairro = $bairro;
        }

        /**
         * Get the value of uf
         */ 
        public function getUf()
        {
            return $this->uf;
        }

        /**
         * Set the value of uf
         */ 
        public function setUf($uf)
        {
            $this->uf = $uf;
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
         * Get the value of datacadastro
         */ 
        public function getDatacadastro()
        {
            return $this->datacadastro;
        }

        /**
         * Set the value of datacadastro
         */ 
        public function setDatacadastro($datacadastro)
        {
            $this->datacadastro = $datacadastro;
        }
        
    }