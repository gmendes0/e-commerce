<?php

    session_start();

    require_once 'config.php';
    require_once '../Banco.php';
    require_once '../DaoProduto.php';

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $array_data = [

        'email' => $ps_email,
        'token' => $ps_token,
        'paymentMode' => 'default',
        'paymentMethod' => $data['paymentMethod'],
    ];

    if($array_data['paymentMethod'] == 'eft'){

        $array_data += [

            'bankName' => $data['bankName'],
        ];
    }

    $array_data += [

        'receiverEmail' => $ps_support_email,
        'currency' => $ps_moeda_pagamento,
        'extraAmount' => $data['extraAmount'],
    ];

    $i = 0;

    foreach($_SESSION['venda'] as $prod => $qtd){

        $produto = DaoProduto::getInstance()->readOne($prod);
        $array_data += [
    
            'itemId'.($i+1) => $produto['idproduto'],
            'itemDescription'.($i+1) => $produto['nome'],
            'itemAmount'.($i+1) => number_format($produto['valor'], 2, '.', ''),
            'itemQuantity'.($i+1) => $qtd,
        ];

        $i++;
    }

    $array_data += [

        'notificationURL' => $ps_url_notificacao,
        'reference' => $data['reference'],
        'senderName' => $data['senderName'],
        // 'senderCPF' => $data['senderCPF'],
        'senderCPF' => str_replace('-', '', filter_var($data['senderCPF'], FILTER_SANITIZE_NUMBER_INT)),
        'senderAreaCode' => $data['senderAreaCode'],
        // 'senderPhone' => $data['senderPhone'],
        'senderPhone' => str_replace('-', '', $data['senderPhone']),
        
    ];

    if($sandbox){

        $array_data += [

            'senderEmail' => "c39949256028777466933@sandbox.pagseguro.com.br",
        ];
    }else{

        $array_data += [

            'senderEmail' => $data['senderEmail'],
        ];
    }
    
    $array_data += [

        'senderHash' => $data['hash'],
        'shippingAddressRequired' => $data['shippingAddressRequired'],
        'shippingAddressStreet' => $data['shippingAddressStreet'],
        'shippingAddressNumber' => $data['shippingAddressNumber'],
        'shippingAddressComplement' => $data['shippingAddressComplement'],
        'shippingAddressDistrict' => $data['shippingAddressDistrict'],
        'shippingAddressPostalCode' => $data['shippingAddressPostalCode'],
        'shippingAddressCity' => $data['shippingAddressCity'],
        'shippingAddressState' => $data['shippingAddressState'],
        'shippingAddressCountry' => $data['shippingAddressCountry'],
        'shippingType' => $data['shippingType'],
        'shippingCost' => $data['shippingCost'],
    ];

    if($array_data['paymentMethod'] == 'creditCard'){

        $array_data += [

            'creditCardToken' => $data['tokenCartao'],
            'installmentQuantity' => $data['parcelas'],
            'installmentValue' => $data['valorParcelas'],
            'noInterestInstallmentQuantity' => 3,
            'creditCardHolderName' => $data['creditCardHolderName'],
            'creditCardHolderCPF' => $data['creditCardHolderCPF'],
            'creditCardHolderBirthDate' => $data['creditCardHolderBirthDate'],
            'creditCardHolderAreaCode' => $data['creditCardHolderAreaCode'],
            'creditCardHolderPhone' => $data['creditCardHolderPhone'],
            'billingAddressStreet' => $data['billingAddressStreet'],
            'billingAddressNumber' => $data['billingAddressNumber'],
            'billingAddressComplement' => $data['billingAddressComplement'],
            'billingAddressDistrict' => $data['billingAddressDistrict'],
            'billingAddressPostalCode' => $data['billingAddressPostalCode'],
            'billingAddressCity' => $data['billingAddressCity'],
            'billingAddressState' => $data['billingAddressState'],
            'billingAddressCountry' => $data['billingAddressCountry'],
        ];
    }
    
    $query_build = http_build_query($array_data);
    $url = $pre_url_pagseguro.'transactions';

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, Array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $query_build);
    $response = curl_exec($curl);
    curl_close($curl);

    $xml = simplexml_load_string($response);
    
    if(!isset($xml->error)){

        require_once '../DaoPagseguro.php';
        require_once '../Pagseguro.php';

        $newinfo = new Pagseguro;
        $newinfo->setDate($xml->date);
        $newinfo->setCode($xml->code);
        $newinfo->setPaymentMethod($array_data['paymentMethod']);
        if(!empty($xml->paymentLink)){
            $newinfo->setPaymentlink($xml->paymentLink);
        }
        $newinfo->setUsuarioid($_SESSION['usuario']);
        $newinfo->setInstallmentCount($xml->installmentCount);
        $newinfo->setSenderName($xml->sender->name);
        $newinfo->setSenderEmail($xml->sender->email);
        $newinfo->setSenderAreaCode($xml->sender->phone->areaCode);
        $newinfo->setSenderFoneNumber($xml->sender->phone->number);
        $newinfo->setShippingStreet($xml->shipping->address->street);
        $newinfo->setShippingNumber($xml->shipping->address->number);
        $newinfo->setShippingComplement($xml->shipping->address->complement);
        $newinfo->setShipingDistrict($xml->shipping->address->district);
        $newinfo->setShippingCity($xml->shipping->address->city);
        $newinfo->setShippingState($xml->shipping->address->state);
        $newinfo->setShippingCountry($xml->shipping->address->country);
        $newinfo->setShippingPostalCode($xml->shipping->address->postalCode);

        $insert_infos = DaoPagseguro::getInstance()->create($newinfo);

        if($insert_infos){

            require_once '../ItensVenda.php';
            require_once '../PedVenda.php';
            require_once '../DaoUsuario.php';
            require_once '../DaoItensVenda.php';
            require_once '../DaoPedVenda.php';

            $user = DaoUsuario::getInstance()->readOne($_SESSION['usuario']);
            
            /**
             * Salva pedvenda
             */
            // $total = $_SESSION['subtotal'] + $freteval;
            $total = $_SESSION['subtotal'];
            $pedvenda = new Pedvenda();
            $pedvenda->setValortotal($total);
            $pedvenda->setData(date('Y-m-d H:i:s'));
            $pedvenda->setAtivo(1);
            /**
             * recupera o id do pagseguro
             */
            $idpagseguro = DaoPagseguro::getInstance()->allWhere(["usuario_id" => $_SESSION['usuario']], ['id' => 'DESC'], 'LIMIT 1');
            $pedvenda->setPagseguro_id($idpagseguro[0]->id);
            $pedvenda->setFk_idusuario($_SESSION['usuario']);
            $insertPV = DaoPedvenda::getInstance()->create($pedvenda);

            if($insertPV){

                /**
                 * Recupera o ultimo ID do pedido do usuario
                 */
                try{
                    
                    $idpedvenda = DaoPedvenda::getInstance()->lastIDpedvenda($_SESSION['usuario']);

                }catch(PDOException $e){

                    $e->getMessage();

                }

                /**
                 * preparação para salvar itens
                 */
                $itensvenda = new Itensvenda();
            
                foreach($_SESSION['venda'] as $id => $q){

                    $p = DaoProduto::getInstance()->readOne($id);
                    $itensvenda->setQuantidade($q);
                    $itensvenda->setValorunitario($p['valor']);
                    $itensvenda->setValordesconto(0);
                    $itensvenda->setFk_idproduto($id);
                    $itensvenda->setFk_idpedvenda($idpedvenda['idpedvenda']);
                    DaoItensvenda::getInstance()->create($itensvenda);

                }

                unset($_SESSION['subtotal']);
                unset($_SESSION['venda']);
            }

        }

    }
    
    $response = [
        'erro' => false,
        'array_data' => $array_data,
        'dados' => $xml
    ];
    

    echo json_encode($response);