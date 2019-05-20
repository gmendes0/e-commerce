<?php

    session_start();
    require_once 'lib/Validacao.php';
    $validar = new Validacao();
    $validar->isLoggedIn();
    //apos verificação
    require_once 'lib/DaoUsuario.php';
    $user = new DaoUsuario;
    $user = $user->getInstance()->readOne($_SESSION['usuario']);

    if(!empty($_GET)){

        if(!empty($_GET['id'])){

            if($_GET['id'] == $user['idusuario']){

                //exibir o foemulario de edição
                $visualizar = true;
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

                if(!empty($_POST)){

                    /**
                     * Validação de formulário
                     * Adicionar validação de data
                     * Adicionar validação de senha + confirmação
                     */
                    $validar->validation([

                        'nome' => 'required|smin:3|smax:45',
                        'login' => 'required|smin:3|smax:50',
                        'senha' => 'required|smin:3|smax:50',
                        'confirmacao' => 'required|smin:3|smax:50',
                        'email' => 'required|email|smin:3|smax:45',
                        'telefone' => 'required',
                        'cpf' => 'required',
                        'endereco' => 'required|smin:3|smax:45',
                        'numero' => 'required|min:0|max:999',
                        'bairro' => 'required|smin:3|smax:45',
                        'cidade' => 'required|smin:3|smax:45',
                        'estado' => 'required|smin:2|smax:2'

                    ]);

                    /**
                     * Se passar a validação
                     */
                    if($validar->getValido()){
                        
                        $usuario = new Usuario;
                        $usuario->setIdusuario($_GET['id']);
                        $usuario->setNome($_POST['nome']);
                        $usuario->setNascimento($_POST['nascimento']);
                        $usuario->setLogin($_POST['login']);
                        $usuario->setSenha($_POST['senha']);
                        $usuario->setEmail($_POST['email']);
                        $usuario->setTelefone($_POST['telefone']);
                        $usuario->setCpf($_POST['cpf']);
                        $usuario->setEndereco($_POST['endereco']);
                        $usuario->setNumero($_POST['numero']);
                        $usuario->setBairro($_POST['bairro']);
                        $usuario->setCidade($_POST['cidade']);
                        $usuario->setEstado($_POST['estado']);
                        $usuario->setAtivo(1);
                        $update = DaoUsuario::getInstance()->update($usuario);

                        if($update){
                            header('Location: perfil.php');
                        }

                    }

                }

            }else{

                header('Location: perfil.php');

            }

        }

    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"/>
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/style.css">
        <title>Editar - <?php echo $user['nome']; ?></title>
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
        <?php require_once 'scripts/php/navbar.php'; ?>

        <div class="container">
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
            <?php if(isset($visualizar) && $visualizar){ ?>
                <?php
                
                    if(isset($validar) && !empty($validar->getErrors())){

                        foreach($validar->getErrors() as $value){

                ?>

                            <div class="alert alert-danger col-sm-7"><?php echo $value; ?></div>

                <?php }} ?>
                <h2 class="text-muted">Editar dados</h2>
                <!-- form -->
                <form method="post" class="mt-5 mb-5">
            
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">nome</label>
                        <div class="col-sm-6">
                            <input id="nome" class="form-control" type="text" name="nome" value="<?php echo (isset($user['nome'])) ? $user['nome'] : ''; ?>"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">nascimento</label>
                        <div class="col-sm-6">
                            <input id="nascimento" class="form-control" type="date" name="nascimento" value="<?php echo (isset($user['nascimento'])) ? $user['nascimento'] : ''; ?>"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">login</label>
                        <div class="col-sm-6">
                            <input id="login" class="form-control" type="text" name="login" value="<?php echo (isset($user['login'])) ? $user['login'] : ''; ?>"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">senha</label>
                        <div class="col-sm-6">
                            <input id="senha" class="form-control" type="password" name="senha" value="<?php echo (isset($user['senha'])) ? $user['senha'] : ''; ?>"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">confirmar senha</label>
                        <div class="col-sm-6">
                            <input id="confirmacao" class="form-control" type="password" name="confirmacao" value="<?php echo (isset($user['senha'])) ? $user['senha'] : ''; ?>"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">email</label>
                        <div class="col-sm-6">
                            <input id="email" class="form-control" type="text" name="email" value="<?php echo (isset($user['email'])) ? $user['email'] : ''; ?>"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">telefone</label>
                        <div class="col-sm-6">
                            <input id="telefone" class="form-control" type="text" name="telefone" value="<?php echo (isset($user['telefone'])) ? $user['telefone'] : ''; ?>"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">cpf</label>
                        <div class="col-sm-6">
                            <input id="cpf" class="form-control" type="text" name="cpf" value="<?php echo (isset($user['cpf'])) ? $user['cpf'] : ''; ?>"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label" for="cep">cep</label>
                        <div class="col-sm-6">
                            <input id="cep"class="form-control" type="text" name="cep" value="<?php echo !empty($_POST['cep']) ? $_POST['cep'] : ''; ?>"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">endereço</label>
                        <div class="col-sm-6">
                            <input id="endereco" class="form-control" type="text" name="endereco" value="<?php echo (isset($user['endereco'])) ? $user['endereco'] : ''; ?>"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">Número</label>
                        <div class="col-sm-6">
                            <input id="numero" class="form-control" type="text" name="numero" value="<?php echo (isset($user['numero'])) ? $user['numero'] : ''; ?>"/>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">bairro</label>
                        <div class="col-sm-6">
                            <input id="bairro" class="form-control" type="text" name="bairro" value="<?php echo (isset($user['bairro'])) ? $user['bairro'] : ''; ?>"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">cidade</label>
                        <div class="col-sm-6">
                            <input id="cidade" class="form-control" type="text" name="cidade" value="<?php echo (isset($user['cidade'])) ? $user['cidade'] : ''; ?>"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">estado</label>
                        <div class="col-sm-6">
                            <select id="estado" class="form-control" name="estado">
                                <?php foreach($estados as $uf => $es_nome){ ?>
                                    <option value="<?php echo $uf ?>" <?php echo (isset($user['estado']) && $user['estado'] == $uf) ? 'selected' : ''; ?>>
                                        <?php echo $es_nome; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="editar">
                    </div>

                </form>
            <?php } ?>
        </div>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>