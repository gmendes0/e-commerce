<?php

    class Pagseguro
    {
        public $id;
        public $code;
        public $date;
        public $paymentMethod;
        public $paymentlink;
        public $installmentCount;
        public $senderName;
        public $senderEmail;
        public $senderAreaCode;
        public $senderFoneNumber;
        public $shippingStreet;
        public $shippingNumber;
        public $shippingComplement;
        public $shipingDistrict;
        public $shippingCity;
        public $shippingState;
        public $shippingCountry;
        public $shippingPostalCode;
        public $usuarioid;
        public $shippingCost;
        public $shippingType;

        /**
         * Get the value of id
         */ 
        public function getId()
        {
            return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * Get the value of code
         */ 
        public function getCode()
        {
            return $this->code;
        }

        /**
         * Set the value of code
         *
         * @return  self
         */ 
        public function setCode($code)
        {
            $this->code = $code;
        }

        /**
         * Get the value of date
         */ 
        public function getDate()
        {
            return $this->date;
        }

        /**
         * Set the value of date
         *
         * @return  self
         */ 
        public function setDate($date)
        {
            $this->date = $date;
        }

        /**
         * Get the value of paymentlink
         */ 
        public function getPaymentlink()
        {
            return $this->paymentlink;
        }

        /**
         * Set the value of paymentlink
         *
         * @return  self
         */ 
        public function setPaymentlink($paymentlink)
        {
            $this->paymentlink = $paymentlink;
        }

        /**
         * Get the value of usuarioid
         */ 
        public function getUsuarioid()
        {
            return $this->usuarioid;
        }

        /**
         * Set the value of usuarioid
         *
         * @return  self
         */ 
        public function setUsuarioid($usuarioid)
        {
            $this->usuarioid = $usuarioid;
        }

        /**
         * Get the value of paymentMethod
         */ 
        public function getPaymentMethod()
        {
            return $this->paymentMethod;
        }

        /**
         * Set the value of paymentMethod
         *
         * @return  self
         */ 
        public function setPaymentMethod($paymentMethod)
        {
            $this->paymentMethod = $paymentMethod;
        }

        /**
         * Get the value of installmentCount
         */ 
        public function getInstallmentCount()
        {
            return $this->installmentCount;
        }

        /**
         * Set the value of installmentCount
         *
         * @return  self
         */ 
        public function setInstallmentCount($installmentCount)
        {
            $this->installmentCount = $installmentCount;

            return $this;
        }

        /**
         * Get the value of senderName
         */ 
        public function getSenderName()
        {
            return $this->senderName;
        }

        /**
         * Set the value of senderName
         *
         * @return  self
         */ 
        public function setSenderName($senderName)
        {
            $this->senderName = $senderName;

            return $this;
        }

        /**
         * Get the value of senderEmail
         */ 
        public function getSenderEmail()
        {
            return $this->senderEmail;
        }

        /**
         * Set the value of senderEmail
         *
         * @return  self
         */ 
        public function setSenderEmail($senderEmail)
        {
            $this->senderEmail = $senderEmail;

            return $this;
        }

        /**
         * Get the value of senderAreaCode
         */ 
        public function getSenderAreaCode()
        {
            return $this->senderAreaCode;
        }

        /**
         * Set the value of senderAreaCode
         *
         * @return  self
         */ 
        public function setSenderAreaCode($senderAreaCode)
        {
            $this->senderAreaCode = $senderAreaCode;

            return $this;
        }

        /**
         * Get the value of senderFoneNumber
         */ 
        public function getSenderFoneNumber()
        {
            return $this->senderFoneNumber;
        }

        /**
         * Set the value of senderFoneNumber
         *
         * @return  self
         */ 
        public function setSenderFoneNumber($senderFoneNumber)
        {
            $this->senderFoneNumber = $senderFoneNumber;

            return $this;
        }

        /**
         * Get the value of shippingStreet
         */ 
        public function getShippingStreet()
        {
            return $this->shippingStreet;
        }

        /**
         * Set the value of shippingStreet
         *
         * @return  self
         */ 
        public function setShippingStreet($shippingStreet)
        {
            $this->shippingStreet = $shippingStreet;

            return $this;
        }

        /**
         * Get the value of shippingNumber
         */ 
        public function getShippingNumber()
        {
            return $this->shippingNumber;
        }

        /**
         * Set the value of shippingNumber
         *
         * @return  self
         */ 
        public function setShippingNumber($shippingNumber)
        {
            $this->shippingNumber = $shippingNumber;

            return $this;
        }

        /**
         * Get the value of shippingComplement
         */ 
        public function getShippingComplement()
        {
            return $this->shippingComplement;
        }

        /**
         * Set the value of shippingComplement
         *
         * @return  self
         */ 
        public function setShippingComplement($shippingComplement)
        {
            $this->shippingComplement = $shippingComplement;

            return $this;
        }

        /**
         * Get the value of shipingDistrict
         */ 
        public function getShipingDistrict()
        {
            return $this->shipingDistrict;
        }

        /**
         * Set the value of shipingDistrict
         *
         * @return  self
         */ 
        public function setShipingDistrict($shipingDistrict)
        {
            $this->shipingDistrict = $shipingDistrict;

            return $this;
        }

        /**
         * Get the value of shippingCity
         */ 
        public function getShippingCity()
        {
            return $this->shippingCity;
        }

        /**
         * Set the value of shippingCity
         *
         * @return  self
         */ 
        public function setShippingCity($shippingCity)
        {
            $this->shippingCity = $shippingCity;

            return $this;
        }

        /**
         * Get the value of shippingState
         */ 
        public function getShippingState()
        {
            return $this->shippingState;
        }

        /**
         * Set the value of shippingState
         *
         * @return  self
         */ 
        public function setShippingState($shippingState)
        {
            $this->shippingState = $shippingState;

            return $this;
        }

        /**
         * Get the value of shippingCountry
         */ 
        public function getShippingCountry()
        {
            return $this->shippingCountry;
        }

        /**
         * Set the value of shippingCountry
         *
         * @return  self
         */ 
        public function setShippingCountry($shippingCountry)
        {
            $this->shippingCountry = $shippingCountry;

            return $this;
        }

        /**
         * Get the value of shippingPostalCode
         */ 
        public function getShippingPostalCode()
        {
            return $this->shippingPostalCode;
        }

        /**
         * Set the value of shippingPostalCode
         *
         * @return  self
         */ 
        public function setShippingPostalCode($shippingPostalCode)
        {
            $this->shippingPostalCode = $shippingPostalCode;

            return $this;
        }

        /**
         * Get the value of shippingCost
         */ 
        public function getShippingCost()
        {
            return $this->shippingCost;
        }

        /**
         * Set the value of shippingCost
         *
         * @return  self
         */ 
        public function setShippingCost($shippingCost)
        {
            $this->shippingCost = $shippingCost;

            return $this;
        }

        /**
         * Get the value of shippingType
         */ 
        public function getShippingType()
        {
            return $this->shippingType;
        }

        /**
         * Set the value of shippingType
         *
         * @return  self
         */ 
        public function setShippingType($shippingType)
        {
            $this->shippingType = $shippingType;

            return $this;
        }
    }