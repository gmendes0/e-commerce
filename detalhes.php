<?php

    session_start();

    function inicio()
    {
        // header('Location: site.php');
        echo "<script>window.location='site.php'</script>";
        exit;
    }

    function admlogin()
    {
        // header('Location: adm_login.php');
        echo "<script>window.location='adm_login.php'</script>";
        exit;
    }

    function admFornecedorLista()
    {
        // header('Location: adm_fornecedor_lista.php');
        echo "<script>window.location='adm_fornecedor_lista.php'</script>";
        exit;
    }

    function admProdutoLista()
    {
        // header('Location: adm_lista.php');
        echo "<script>window.location='adm_lista.php'</script>";
        exit;
    }

    if(empty($_GET)){

        inicio();

    }else if(!empty($_GET['fdetalhes'])){

        if(empty($_SESSION['adm'])){

            admlogin();

        }else if(filter_var($_GET['fdetalhes'], FILTER_VALIDATE_INT)){

            $title = 'Fornecedor';
            $id = $_GET['fdetalhes'];
            require_once 'lib/DaoFornecedor.php';
            $dados = DaoFornecedor::getInstance()->readOne(intval($_GET['fdetalhes']));
            $title .= " - {$dados['nome']}";

        }else{

            admFornecedorLista();

        }

    }else if(!empty($_GET['pdetalhes'])){

        if(empty($_SESSION['adm'])){

            admlogin();

        }else if(filter_var($_GET['pdetalhes'], FILTER_VALIDATE_INT)){

            $title = 'Produto';
            $id = $_GET['pdetalhes'];
            require_once 'lib/DaoProduto.php';
            $dados = DaoProduto::getInstance()->readOne(intval($_GET['pdetalhes']));

            $title .= " - {$dados['nome']}";

        }else{

            admProdutoLista();

        }

    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"/>
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/style.css">
        <title><?= (!empty($title)) ? $title : 'Indisponível'; ?></title>
        <script src="js/jquery.js"></script>
    </head>

    <body>
        <?php require_once 'scripts/php/navbar.php'; ?>

        <div class="container">
            <h3 class="mt-5 mb-5 text-center"><?= $title; ?></h3>
            <div class="card mt-5 mb-5">
                <div class="card-header">
                    <!-- link edit -->
                    <a href="<?= (isset($_GET['fdetalhes'])) ? "adm_fornecedor_lista.php?edit=$id" : "adm_lista.php?edit=$id"; ?>" class="btn btn-outline-warning">editar</a>
                    <!-- link delete -->
                    <a href="<?= (isset($_GET['fdetalhes'])) ? "adm_fornecedor_lista.php?del=$id" : "adm_lista.php?del=$id"; ?>" class="btn btn-outline-danger">apagar</a>
                </div>
                <div class="card-body">
                    <?php foreach ($dados as $key => $value){ ?>
                        <?php if(!filter_var($key, FILTER_VALIDATE_INT) && !empty($key)){ ?>
                            <h6 class="card-title text-center text-muted"><?= ucwords($key); ?></h6>
                            <?php if($key == 'site'){ ?>
                                <div class="text-center"><a href="<?= $value; ?>"><?= $value; ?></a></div>
                            <?php }else{ ?>
                                <p class="card-text text-center">
                                    <?php
                                    
                                        if(!empty($value) && $key != 'ativo'){

                                            if($key == 'datacadastro' || $key == 'datanascimento' || $key == 'nascimento'){
                                                $date = new DateTime($value);
                                                echo $date->format('d/m/Y H:i:s');
                                            }else if($key == 'foto'){

                                                if(!empty($value)){

                                                    $arrfoto = explode(';', $value);
                                                
                                                    if(is_array($arrfoto)){

                                                        foreach ($arrfoto as $ufoto){
    
                                                            echo '<p class="text-center">'.$ufoto.'</p>';
    
                                                        }
    
                                                    }else{
    
                                                        echo $arrfoto;
    
                                                    }

                                                }else{

                                                    echo 'Idisponível';

                                                }
                                            }else{
                                                echo $value;
                                            }

                                        }else if($key == 'ativo'){

                                            echo ($value == 1) ? 'sim' : 'não';

                                        }else{

                                            echo 'Indisponível';

                                        }
                                    
                                    ?>
                                </p>
                            <?php } ?>
                            <hr>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>

        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>