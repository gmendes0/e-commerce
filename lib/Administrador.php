<?php

    class Administrador{

        public $id;
        public $nome;
        public $login;
        public $senha;
        public $ativo;

        /**
         * Get the value of id
         */ 
        public function getId()
        {
            return $this->id;
        }

        /**
         * Set the value of id
         */ 
        public function setId($id)
        {
            $this->id = $id;
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
         * Get the value of login
         */ 
        public function getLogin()
        {
            return $this->login;
        }

        /**
         * Set the value of login
         */ 
        public function setLogin($login)
        {
            $this->login = $login;
        }

        /**
         * Get the value of senha
         */ 
        public function getSenha()
        {
            return $this->senha;
        }

        /**
         * Set the value of senha
         */ 
        public function setSenha($senha)
        {
            $this->senha = $senha;
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
    }