<?php

    class Produto{

        private $idproduto;
        private $nome;
        private $valor;
        private $descricao;
        private $detalhes;
        private $ativo;
        private $foto;
        private $fornecedor;

        public function setIdProduto($idproduto){
        
            $this->idproduto = $idproduto;
        
        }
        
        public function getIdProduto(){
        
            return $this->idproduto;
        
        }

        public function setNome($nome){
        
            $this->nome = $nome;
        
        }
        
        public function getNome(){
        
            return $this->nome;
        
        }
        
        public function setValor($valor){
        
            $this->valor = $valor;
        
        }
        
        public function getValor(){
        
            return $this->valor;
        
        }
        
        public function setDescricao($descricao){
        
            $this->descricao = $descricao;
        
        }
        
        public function getDescricao(){
        
            return $this->descricao;
        
        }
        
        public function setDetalhes($detalhes){
        
            $this->detalhes = $detalhes;
        
        }
        
        public function getDetalhes(){
        
            return $this->detalhes;
        
        }
        
        public function setAtivo($ativo){
        
            $this->ativo = $ativo;
        
        }
        
        public function getAtivo(){
        
            return $this->ativo;
        
        }

        public function setFoto($foto){

            $this->foto = $foto;

        }

        public function getFoto(){

            return $this->foto;

        }

        public function setFornecedor($fornecedor){

            $this->fornecedor = $fornecedor;

        }

        public function getFornecedor(){

            return $this->fornecedor;

        }

    }