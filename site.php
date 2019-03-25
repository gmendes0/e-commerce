<?php

    session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>Loja</title>
    </head>

    <body>
        
        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>

        <!-- lista -->
        <div class="container">
        
            <?php require_once 'scripts/php/lista.php'; ?>

        </div>

    </body>
</html>

<?php

    /*

        $c = 0;

        while(true){

            if($c > 2){

                $c = 0;

            }
            
            if($c == 0){

                // <div> linha

            }

            // <div> coluna



            // </div> coluna

            if($c == 0){

                // </div> linha

            }

            $c++;

        }

    */

?>