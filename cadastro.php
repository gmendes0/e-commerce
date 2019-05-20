<?php

    session_start();

    if(!empty($_SESSION['usuario'])){

        echo "<script>window.location='site.php'</script>";
        exit;

    }else{

        define('INCLUIDA', true);
        require_once 'scripts/php/db_cadastro.php';

    }

    $estados = array(
        "AC" => "Acre",
        "AL" => "Alagoas",
        "AP" => "Amapá",
        "AM" => "Amazonas",
        "BA" => "Bahia",
        "CE" => "Ceará",
        "DF" => "Distrito Federal",
        "ES" => "Espírito Santo",
        "GO" => "Goiás",
        "MA" => "Maranhão",
        "MT" => "Mato Grosso",
        "MS" => "Mato Grosso do Sul",
        "MG" => "Minas Gerais",
        "PA" => "Pará",
        "PB" => "Paraíba",
        "PR" => "Paraná",
        "PE" => "Pernambuco",
        "PI" => "Piauí",
        "RJ" => "Rio de Janeiro",
        "RN" => "Rio Grande do Norte",
        "RS" => "Rio Grande do Sul",
        "RO" => "Rondônia",
        "RR" => "Roraima",
        "SC" => "Santa Catarina",
        "SP" => "São Paulo",
        "SE" => "Sergipe",
        "TO" => "Tocantins"
    );
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <title>Cadastro</title>
        <script src="js/jquery.js"></script>
        <script>
            $(document).ready(function(){

                $('#cep').blur(function(){

                    var cep = $('#cep').val().replace(/\D/g, '');

                    if(cep != ""){

                        $.getJSON('https://viacep.com.br/ws/'+cep+'/json/', function(dados){
                        
                            if(!dados.erro){

                                $('#endereco').val("");
                                $('#bairro').val("");
                                $('#cidade').val("");
                                $('#estado option').each(function(){
                                    $(this).removeAttr('selected');
                                });

                                $('#endereco').val(dados.logradouro);
                                $('#bairro').val(dados.bairro);
                                $('#cidade').val(dados.localidade);
                                $('#estado option[value='+dados.uf+']').attr('selected', 'selected');

                            }else{

                                $('#modal1').modal('show');

                            }

                        });

                    }

                });

            });
        </script>
    </head>
    
    <body>
        
        <!-- navbar -->
        <?php include_once 'scripts/php/navbar.php'; ?>

        <div class="container">

            <h2 class="mb-5 mt-5">Cadastrar</h2>

            <?php if(isset($validar) && !empty($validar->getErrors())){?>

                <?php foreach($validar->getErrors() as $key => $value){ ?>

                    <div class="alert alert-primary" role="alert">

                        <?= $value; ?>
                        
                    </div>

                <?php } ?>

            <?php }?>

            <?php
                if(isset($msg) && !empty($msg)){

                    foreach($msg as $key => $value){
            ?>
                        <div class="alert <?= ($key == 'success') ? 'alert-success' : 'alert-primary'; ?>" role="alert">
                            <?= $value; ?>
                        </div>
            <?php
                }}
            ?>
            
            <!-- Modal -->
            <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal1title">Erro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body text-center text-danger">
                            CEP Inválido
                        </div>
                    </div>
                </div>
            </div>

            <form method="post" class="mt-5 mb-5">
            
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="nome">nome</label>
                    <div class="col-sm-8">
                        <input id="nome" class="form-control" type="text" name="nome" value="<?php echo !empty($_POST['nome']) ? $_POST['nome'] : ''; ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="datanascimento">data de nascimento</label>
                    <div class="col-sm-8">
                        <input id="datanascimento" class="form-control" type="date" name="datanascimento" value="<?php echo !empty($_POST['datanascimento']) ? $_POST['datanascimento'] : ''; ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="login">login</label>
                    <div class="col-sm-8">
                        <input id="login" class="form-control" type="text" name="login" value="<?php echo !empty($_POST['login']) ? $_POST['login'] : ''; ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="senha">senha</label>
                    <div class="col-sm-8">
                        <input id="senha" class="form-control" type="password" name="senha"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="confirmacao">confirmar senha</label>
                    <div class="col-sm-8">
                        <input id="confirmacao" class="form-control" type="password" name="confirmacao"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="email">email</label>
                    <div class="col-sm-8">
                        <input id="email" class="form-control" type="text" name="email" value="<?php echo !empty($_POST['email']) ? $_POST['email'] : ''; ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="telefone">telefone</label>
                    <div class="col-sm-8">
                        <input id="telefone" class="form-control" type="text" name="telefone" value="<?php echo !empty($_POST['telefone']) ? $_POST['telefone'] : ''; ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="cpf">cpf</label>
                    <div class="col-sm-8">
                        <input id="cpf" class="form-control" type="text" name="cpf" value="<?php echo !empty($_POST['cpf']) ? $_POST['cpf'] : ''; ?>"/>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="cep">cep</label>
                    <div class="col-sm-8">
                        <input id="cep" class="form-control" type="text" name="cep" value="<?php echo !empty($_POST['cep']) ? $_POST['cep'] : ''; ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="endereco">endereço</label>
                    <div class="col-sm-8">
                        <input id="endereco" class="form-control" type="text" name="endereco" value="<?php echo !empty($_POST['endereco']) ? $_POST['endereco'] : ''; ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="numero">numero</label>
                    <div class="col-sm-8">
                        <input id="numero" class="form-control" type="text" name="numero" value="<?php echo !empty($_POST['numero']) ? $_POST['numero'] : ''; ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="bairro">bairro</label>
                    <div class="col-sm-8">
                        <input id="bairro" class="form-control" type="text" name="bairro" value="<?php echo !empty($_POST['bairro']) ? $_POST['bairro'] : ''; ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="cidade">cidade</label>
                    <div class="col-sm-8">
                        <input id="cidade" class="form-control" type="text" name="cidade" value="<?php echo !empty($_POST['cidade']) ? $_POST['cidade'] : ''; ?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="estado">estado</label>
                    <div class="col-sm-8">
                        <select id="estado" class="form-control" name="estado">
                            <?php foreach($estados as $uf => $es_nome){ ?>
                                <option value="<?php echo $uf ?>" <?php echo (!empty($_POST['estado']) && $_POST['estado'] == $uf) ? 'selected' : ''; ?>><?php echo $es_nome; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <input class="btn btn-primary" type="submit" value="cadastrar"/>
                </div>

            </form>

        </div>

        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>
</html>