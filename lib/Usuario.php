<?php

    class Usuario{

        private $idusuario;
        private $login;
        private $nome;
        private $cpf;
        private $nascimento;
        private $email;
        private $telefone;
        private $endereco;
        private $numero;
        private $bairro;
        private $cidade;
        private $estado;
        private $ativo;
        private $datacadastro;

        /**
         * Get the value of idusuario
         */ 
        public function getIdusuario()
        {
            return $this->idusuario;
        }

        /**
         * Set the value of idusuario
         */ 
        public function setIdusuario($idusuario)
        {
            $this->idusuario = $idusuario;
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
         * Get the value of cpf
         */ 
        public function getCpf()
        {
            return $this->cpf;
        }

        /**
         * Set the value of cpf
         */ 
        public function setCpf($cpf)
        {
            $this->cpf = $cpf;
        }

        /**
         * Get the value of nascimento
         */ 
        public function getNascimento()
        {
            return $this->nascimento;
        }

        /**
         * Set the value of nascimento
         */ 
        public function setNascimento($nascimento)
        {
            $this->nascimento = $nascimento;
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
         * Get the value of cidade
         */ 
        public function getCidade()
        {
            return $this->cidade;
        }

        /**
         * Set the value of cidade
         */ 
        public function setCidade($cidade)
        {
            $this->cidade = $cidade;
        }

        /**
         * Get the value of estado
         */ 
        public function getEstado()
        {
            return $this->estado;
        }

        /**
         * Set the value of estado
         */ 
        public function setEstado($estado)
        {
            $this->estado = $estado;
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