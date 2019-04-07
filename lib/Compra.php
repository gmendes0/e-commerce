<?php

    class Compra{

        private $cart;

        public function cartAdd($id){

            $cart = $this->getCart();
            $cart[$id] = 1; // venda[produto] = qtd;

        }

        public function setCart($cart){

            $this->cart = $cart;

        }

        public function getCart(){

            return $this->cart;

        }

        public function removeItemFromCart($id){

            unset($this->getCart()[$id]);
            // unset($_SESSION['venda'][$id]);

        }

    }