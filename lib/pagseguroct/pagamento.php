<?php

    require_once 'config.php';

    $url = $pre_url_pagseguro."sessions?email={$ps_email}&token={$ps_token}";

    /**
     * requisição do session id
     */
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml; charset=UTF-8'));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $retorno = curl_exec($curl);
    curl_close($curl);

    $xml = simplexml_load_string($retorno);
    echo json_encode($xml);
