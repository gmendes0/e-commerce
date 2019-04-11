<?php

    session_start();

    if(!empty($_SESSION['venda'])){

        if(!empty($_POST)){

            if(isset($_POST['qtd'])){

                foreach($_SESSION['venda'] as $prod => $qtd){

                    $_SESSION['venda'][$prod] = intval($_POST['qtd'][$prod - 1]);
                    //

                }

            }

        }

    }

    echo '<pre>';
    print_r($_SESSION['venda']);
    print_r($_POST);
    echo '</pre>';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>Comprar</title>
    </head>

    <body>
        
    </body>
</html>