<?php

    require_once 'DAO.php';
    require_once 'Pagseguro.php';

    class DaoPagseguro extends DAO
    {
        protected static $tabela = 'pagseguro_info';
        protected static $pk = 'id';
        public static $instance;

        public function __construct(){
            DAO::$tabela = 'pagseguro_info';
            DAO::$pk = 'id';
        }

        public static function getInstance()
        {

            if(!isset(self::$instance)){

                self::$instance = new DaoPagseguro();

            }

            return self::$instance;

        }

        public function create(Pagseguro $pagseguro)
        {

            try{

                $sql = "INSERT INTO ".self::$tabela."(`code`, `date`, `paymentLink`, `paymentMethod`, `usuario_id`, `installmentCount`, `senderName`, ";
                $sql .= "`senderEmail`, `senderAreaCode`, `senderFoneNumber`, `shippingStreet`, `shippingNumber`, `shippingComplement`, ";
                $sql .= "`shipingDistrict`, `shippingCity`, `shippingState`, `shippingCountry`, `shippingPostalCode`, `shippingType`, `shippingCost`, ";
                $sql .= " `netAmount`, `feeAmount`, `grossAmount`, `discountAmount`, `extraAmount`)";
                $sql .= " VALUES(:code, :date, :paymentLink, :paymentMethod, :usuario_id, :installmentCount, :senderName, ";
                $sql .= ":senderEmail, :senderAreaCode, :senderFoneNumber, :shippingStreet, :shippingNumber, :shippingComplement, ";
                $sql .= ":shipingDistrict, :shippingCity, :shippingState, :shippingCountry, :shippingPostalCode, :shippingType, :shippingCost, :netAmount, :feeAmount, :grossAmount, :discountAmount, :extraAmount)";
                $stmt = Banco::getInstance()->prepare($sql);
    
                $stmt->bindValue(':code', $pagseguro->getCode());
                $stmt->bindValue(':date', $pagseguro->getDate());
                $stmt->bindValue(':paymentLink', $pagseguro->getPaymentlink());
                $stmt->bindValue(':paymentMethod', $pagseguro->getPaymentMethod());
                $stmt->bindValue(':usuario_id', $pagseguro->getUsuarioid());
                $stmt->bindValue(':installmentCount', $pagseguro->getInstallmentCount());
                $stmt->bindValue(':senderName', $pagseguro->getSenderName());
                $stmt->bindValue(':senderEmail', $pagseguro->getSenderEmail());
                $stmt->bindValue(':senderAreaCode', $pagseguro->getSenderAreaCode());
                $stmt->bindValue(':senderFoneNumber', $pagseguro->getSenderFoneNumber());
                $stmt->bindValue(':shippingStreet', $pagseguro->getShippingStreet());
                $stmt->bindValue(':shippingNumber', $pagseguro->getShippingNumber());
                $stmt->bindValue(':shippingComplement', $pagseguro->getShippingComplement());
                $stmt->bindValue(':shipingDistrict', $pagseguro->getShipingDistrict());
                $stmt->bindValue(':shippingCity', $pagseguro->getShippingCity());
                $stmt->bindValue(':shippingState', $pagseguro->getShippingState());
                $stmt->bindValue(':shippingCountry', $pagseguro->getShippingCountry());
                $stmt->bindValue(':shippingPostalCode', $pagseguro->getShippingPostalCode());
                $stmt->bindValue(':shippingType', $pagseguro->getShippingType());
                $stmt->bindValue(':shippingCost', $pagseguro->getShippingCost());
                $stmt->bindValue(':netAmount', $pagseguro->getNetAmount());
                $stmt->bindValue(':feeAmount', $pagseguro->getFeeAmount());
                $stmt->bindValue(':grossAmount', $pagseguro->getGrossAmount());
                $stmt->bindValue(':discountAmount', $pagseguro->getDiscountAmount());
                $stmt->bindValue(':extraAmount', $pagseguro->getExtraAmount());
    
                return $stmt->execute();

            }catch(PDOException $th){

                echo $th->getMessage();

            }

        }

        public function update(Pagseguro $pagseguro)
        {

            try{

                $sql = "UPDATE ".self::$tabela."SET `code` = :code, `date` = :date, `paymentLink` = :paymentLink, ";
                $sql .= "`paymentMethod` = :paymentMethod, `usuario_id` = :usuario_id, `installmentCount` = :installmentCount, ";
                $sql .= "`senderName` = :senderName, `senderEmail` = :senderEmail, `senderAreaCode` = :senderAreaCode, `senderFoneNumber` = :senderFoneNumber, ";
                $sql .= "`shippingComplement` = :shippingComplement, `shipingDistrict` = :shipingDistrict, `shippingCity` = :shippingCity, ";
                $sql .= "`shippingState` = :shippingState, `shippingCountry` = :shippingCountry, `shippingPostalCode` = :shippingPostalCode, `shippingType` = :shippingType, `shippingCost` = :shippingCost, ";
                $sql .= "`netAmount` = :netAmount, `feeAmount` = :feeAmount, `grossAmount` = :grossAmount, `discountAmount` = :discountAmount, `extraAmount` = :extraAmount) WHERE ".self::$pk." = :id";
                $stmt = Banco::getInstance()->prepare($sql);
    
                $stmt->bindValue(':code', $pagseguro->getCode());
                $stmt->bindValue(':date', $pagseguro->getDate());
                $stmt->bindValue(':paymentMethod', $pagseguro->getPaymentMethod());
                $stmt->bindValue(':paymentLink', $pagseguro->getPaymentlink());
                $stmt->bindValue(':usuario_id', $pagseguro->getUsuarioid());
                $stmt->bindValue(':installmentCount', $pagseguro->getInstallmentCount());
                $stmt->bindValue(':senderName', $pagseguro->getSenderName());
                $stmt->bindValue(':senderEmail', $pagseguro->getSenderEmail());
                $stmt->bindValue(':senderAreaCode', $pagseguro->getSenderAreaCode());
                $stmt->bindValue(':senderFoneNumber', $pagseguro->getSenderFoneNumber());
                $stmt->bindValue(':shippingStreet', $pagseguro->getShippingStreet());
                $stmt->bindValue(':shippingNumber', $pagseguro->getShippingNumber());
                $stmt->bindValue(':shippingComplement', $pagseguro->getShippingComplement());
                $stmt->bindValue(':shipingDistrict', $pagseguro->getShipingDistrict());
                $stmt->bindValue(':shippingCity', $pagseguro->getShippingCity());
                $stmt->bindValue(':shippingState', $pagseguro->getShippingState());
                $stmt->bindValue(':shippingCountry', $pagseguro->getShippingCountry());
                $stmt->bindValue(':shippingPostalCode', $pagseguro->getShippingPostalCode());
                $stmt->bindValue(':shippingType', $pagseguro->getShippingType());
                $stmt->bindValue(':shippingCost', $pagseguro->getShippingCost());
                $stmt->bindValue(':netAmount', $pagseguro->getNetAmount());
                $stmt->bindValue(':feeAmount', $pagseguro->getFeeAmount());
                $stmt->bindValue(':grossAmount', $pagseguro->getGrossAmount());
                $stmt->bindValue(':discountAmount', $pagseguro->getDiscountAmount());
                $stmt->bindValue(':extraAmount', $pagseguro->getExtraAmount());
                $stmt->bindValue(':id', $pagseguro->getId());
    
                return $stmt->execute();

            }catch(PDOException $th){

                echo $th->getMessage();

            }

        }
    }