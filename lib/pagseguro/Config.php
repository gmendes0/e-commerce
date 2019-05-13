<?php

    class Config
    {
        /*
         * Ambiente
         * Valores aceitos:
         * sandbox
         * production
         */
        private $envmode = 'sandbox';

        protected $email;
        protected $token_sandbox;
        protected $token_oficial;
        protected $url_retorno;

        protected $url;
        protected $url_redirect;
        protected $url_notificacao;
        protected $url_transactions;

        protected function __construct(){

            $this->setEmail('gmendes230@gmail.com');
            $this->setToken_sandbox('104DFCA078F04636BA6893E158B5623E');
            $this->setToken_oficial('');
            $this->setUrl_retorno('localhost/pagseguro/notificacao.php');

            if(!isset($this->envmode)){

                $this->setEnvmode('sandbox');

            }else{

                if($this->getEnvmode() == 'sandbox'){

                    $this->setUrl('https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/');
                    $this->setUrl_redirect('https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=');
                    $this->setUrl_notificacao('https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/');
                    $this->setUrl_transactions('https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/');

                }else if($this->getEnvmode() == 'production'){

                    $this->setUrl('https://ws.pagseguro.uol.com.br/v2/checkout/');
                    $this->setUrl_redirect('https://pagseguro.uol.com.br/v2/checkout/payment.html?code=');
                    $this->setUrl_notificacao('https://ws.pagseguro.uol.com.br/v2/transactions/notifications/');
                    $this->setUrl_transactions('https://ws.pagseguro.uol.com.br/v2/transactions/');

                }

            }

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
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
            $this->email = $email;

            return $this;
        }

        /**
         * Get the value of token_sandbox
         */ 
        public function getToken_sandbox()
        {
            return $this->token_sandbox;
        }

        /**
         * Set the value of token_sandbox
         *
         * @return  self
         */ 
        public function setToken_sandbox($token_sandbox)
        {
            $this->token_sandbox = $token_sandbox;

            return $this;
        }

        /**
         * Get the value of token_oficial
         */ 
        public function getToken_oficial()
        {
            return $this->token_oficial;
        }

        /**
         * Set the value of token_oficial
         *
         * @return  self
         */ 
        public function setToken_oficial($token_oficial)
        {
            $this->token_oficial = $token_oficial;

            return $this;
        }

        /**
         * Get the value of url_retorno
         */ 
        public function getUrl_retorno()
        {
            return $this->url_retorno;
        }

        /**
         * Set the value of url_retorno
         *
         * @return  self
         */ 
        public function setUrl_retorno($url_retorno)
        {
            $this->url_retorno = $url_retorno;

            return $this;
        }

        /**
         * Get the value of url
         */ 
        public function getUrl()
        {
            return $this->url;
        }

        /**
         * Set the value of url
         *
         * @return  self
         */ 
        public function setUrl($url)
        {
            $this->url = $url;

            return $this;
        }

        /**
         * Get the value of url_redirect
         */ 
        public function getUrl_redirect()
        {
            return $this->url_redirect;
        }

        /**
         * Set the value of url_redirect
         *
         * @return  self
         */ 
        public function setUrl_redirect($url_redirect)
        {
            $this->url_redirect = $url_redirect;

            return $this;
        }

        /**
         * Get the value of url_notificacao
         */ 
        public function getUrl_notificacao()
        {
            return $this->url_notificacao;
        }

        /**
         * Set the value of url_notificacao
         *
         * @return  self
         */ 
        public function setUrl_notificacao($url_notificacao)
        {
            $this->url_notificacao = $url_notificacao;

            return $this;
        }

        /**
         * Get the value of url_transactions
         */ 
        public function getUrl_transactions()
        {
            return $this->url_transactions;
        }

        /**
         * Set the value of url_transactions
         *
         * @return  self
         */ 
        public function setUrl_transactions($url_transactions)
        {
            $this->url_transactions = $url_transactions;

            return $this;
        }

        /**
         * Get /*
         */ 
        public function getEnvmode()
        {
            return $this->envmode;
        }

        /**
         * Set /*
         *
         * @return  self
         */ 
        public function setEnvmode($envmode)
        {
            $this->envmode = $envmode;

            return $this;
        }
    }