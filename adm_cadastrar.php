<?php

    session_start();

    /**
     * verifica se o adm está logado
     */
    if(!isset($_SESSION['adm']) || empty($_SESSION['adm'])){

        echo "<script>window.location='adm_login.php'</script>";
        exit;

    }

    require_once 'lib/DaoFornecedor.php';

    $fornecedores = DaoFornecedor::getInstance()->readFieldAll(['idfornecedor','nome']);

    if(!empty($_POST)){

        if(!empty($_POST['nome'])){
            
            if(!empty($_POST['valor'])){

                if(!empty($_POST['descricao'])){
                
                    if(!empty($_POST['detalhes'])){
                    
                        if(!empty($_POST['ativo'])){

                            $img_list = null;

                            for($i = 0; $i < count($_FILES['miniatura']['name']); $i++){

                                if($_FILES['miniatura']['name'][$i]){
                                    // Verifica se há arquivo
                                    if(!$_FILES['miniatura']['error'][$i]){
                            
                                        //Verifica se não há erro

                                        $nome_arquivo = strtolower($_FILES['miniatura']['name'][$i]);
                                        $replace1 = array('/', '|', '\\', ' ');
                                        $replace2 = array("'", ':', '*', '?', '"', '<', '>');
                                        $dir = str_replace($replace1, '_', $_POST['nome']);
                                        $dir = str_replace($replace2, '', $dir);
                                        $caminho = 'fotage/'.$dir.'/';

                                        if(!file_exists(__DIR__.'/fotage/'.$dir)){

                                            mkdir(__DIR__.'/fotage/'.$dir.'/', 0777, true);

                                        }

                                        if(!is_null($img_list)){
                                            $img_list .= ';';
                                        }
                                        
                                        $img_list .= $caminho.$nome_arquivo;
                                        move_uploaded_file($_FILES['miniatura']['tmp_name'][$i], $caminho.$nome_arquivo);
                                            
                                    }
                                        
                                }

                            }

                            require_once 'lib/Produto.php';
                            require_once 'lib/DaoProduto.php';

                            /* Insert */
                            $produto = new Produto();
                            $produto->setNome($_POST['nome']);
                            $produto->setValor($_POST['valor']);
                            $produto->setDescricao($_POST['descricao']);
                            $produto->setDetalhes($_POST['detalhes']);
                            $produto->setAtivo($_POST['ativo']);
                            $produto->setFornecedor($_POST['fornecedor']);
                            $produto->setFoto($img_list);

                            DaoProduto::getInstance()->create($produto);
                            /* Fim Insert */
                        
                        }
                    
                    }
                
                }

            }
        
        }

    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/style.css"/>
        <script src="js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $('#add').click(function(){
                    $('#img-uploads').append("<div class='mb-1'><input class='file' type='file' name='miniatura[]'/><a href='#img-uploads' id='remove' class='btn btn-danger'>x</a></div>");
                });

                $('#img-uploads').on('click', '#remove', function(){
                    $(this).parent('div').remove();
                });
            });
        </script>
        <title>Cadastrar Produto</title>
    </head>

    <body>

        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>

        <div class="row h-100 align-items-center p-5 titulo-bg mb-5">
            <div class="col-12">
                <h2 class="text-center">Novo Produto</h2>
            </div>
        </div>

        <!-- Formulario Produto -->
        <div class="container mb-5">

            <!-- <h2 class="text-center">Novo Produto</h2> -->

            <form method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label>nome</label>
                    <input class="form-control" type="text" name="nome">
                </div>

                <div class="form-group">
                    <label>valor</label>
                    <input class="form-control" type="text" name="valor">
                </div>

                <div class="form-group">
                    <label>descrição</label>
                    <input class="form-control" type="text" name="descricao">
                </div>

                <div class="form-group">
                    <label>detalhes técnicos</label>
                    <input class="form-control" type="text" name="detalhes">
                </div>

                <div class="form-group">
                    <label>ativo</label>
                    <select class="form-control" name="ativo">
                        <option value="1">sim</option>
                        <option value="0">não</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>fornecedor</label>
                    <select class="form-control" name="fornecedor">
                        <?php foreach($fornecedores as $fornecedor){ ?>
                            <option value="<?php echo $fornecedor['idfornecedor']; ?>"><?php echo $fornecedor['nome']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group" id="img-uploads">
                    <label>imagem</label>
                    <div class="row mb-1">
                        <div class="col-sm-10">
                            <input class="file" type="file" name="miniatura[]"/>
                            <a href="#add" class="btn btn-primary mb-2" id='add'>+</a>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" value="enviar" class="btn btn-primary"/>
                </div>

            </form>

            <a href="adm_lista.php">lista</a>
            <a href="adm_fornecedor.php">novo fornecedor</a>

        </div>

        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>
</html>