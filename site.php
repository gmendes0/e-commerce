<?php

    session_start();

    if(empty($_SESSION['nome'])){

        echo "<script>window.location='login.php'</script>";
        exit;

    }

?>