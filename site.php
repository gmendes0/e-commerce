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
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/style.css">
        <title>Loja</title>
        <script src="js/jquery.js"></script>
        <script src="js/pesquisa.js"></script>
    </head>

    <body class="bg-light">

        <?php $page = 'index'; ?>
        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>

        <!-- Carousel -->
        <?php include_once 'carousel.php'; ?>

        <!-- conteúdo do site -->
        <div class="site">

            <!-- lista -->
            <div class="container">

                <div id="pesquisado" class="text-center"></div>
            
                <div id="siteindex"><?php require_once 'scripts/php/lista.php'; ?></div>

                <nav class="mt-5 mb-5">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                            <a href="site.php?page=<?php echo ($page > 1) ? $page - 1 : '1'; ?>" class="page-link">
                                <span>&laquo</span>
                            </a>
                        </li>
                        <?php for($i = 0; $i < $npages; $i++){ ?>
                            <li class="page-item">
                                <a class="page-link" href="site.php?page=<?= $i + 1; ?>"><?= $i + 1; ?></a>
                            </li>
                        <?php } ?>
                        <li class="page-item <?php echo ($page >= $npages) ? 'disabled' : ''; ?>">
                            <a href="site.php?page=<?php echo ($page < $npages) ? $page + 1 : $npages; ?>" class="page-link">
                                <span>&raquo</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>

        </div>

        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>

</html>