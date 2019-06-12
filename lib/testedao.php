<?php

    session_start();

    require_once 'DaoPagseguro.php';

    $idpagseguro = DaoPagseguro::getInstance()->allWhere(["usuario_id" => "7"], ['id' => 'DESC'], 'LIMIT 1');

    var_dump($idpagseguro[0]->id);

?>