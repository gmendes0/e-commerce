<?php

    session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"/>
        <link rel="stylesheet" href="css/style.css"/>
        <title>Loja</title>
    </head>

    <body>

        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>

        <!-- conteúdo do site -->
        <div class="site">

            <!-- lista -->
            <div class="container">
            
                <?php require_once 'scripts/php/lista.php'; ?>

            </div>

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