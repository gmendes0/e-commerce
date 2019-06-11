<?php

    /**
     * Determina se o ambiente de trabalho é o sandbox
     */
    $sandbox = true;

    /**
     * Url do site
     */
    $my_url = 'http://localhost/ecommerce/';

    if($sandbox){

        /**
         * URL em ambiente de teste
         */
        $pre_url_pagseguro = 'https://ws.sandbox.pagseguro.uol.com.br/v2/';

        /**
         * Biblioteca JS testes
         */
        $script_pagseguro = 'https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js';

        /**
         * Credenciais do pagseguro
         */
        $ps_email = 'gmendes230@gmail.com';
        $ps_token = '104DFCA078F04636BA6893E158B5623E';

        /**
         * Email de suporte pós venda
         */
        $ps_support_email = 'gmendes230@gmail.com';

        /**
         * Moeda utilizada
         */
        $ps_moeda_pagamento = 'BRL';

        /**
         * Url de notificação
         */
        $ps_url_notificacao = $my_url.'notificacao.php';

    }else{

        /**
         * URL em ambiente de produção
         */
        $pre_url_pagseguro = 'https://ws.pagseguro.uol.com.br/v2/';

        /**
         * Biblioteca JS produção
         */
        $script_pagseguro = 'https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js';

        /**
         * Credenciais do pagseguro
         */
        $ps_email = null;
        $ps_token = null;

        /**
         * Email de suporte pós venda
         */
        $ps_support_email = null;

        /**
         * Moeda utilizada
         */
        $ps_moeda_pagamento = null;

        /**
         * Url de notificação
         */
        $ps_url_notificacao = null;
    }