<?php

    session_start();

    require_once 'DaoPagseguro.php';

    $idpagseguro = DaoPagseguro::getInstance()->allWhere(["usuario_id = ".$_SESSION['usuario']], ['id' => 'DESC']);

    var_dump($idpagseguro);

?>