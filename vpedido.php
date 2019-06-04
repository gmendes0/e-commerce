<?php

    session_start();

    function mascaraStr($mask,$str){

        $str = str_replace("","",$str);
    
        for($i=0;$i<strlen($str);$i++){
            $mask[strpos($mask,"0")] = $str[$i];
        }
    
        return $mask;
    
    }

    if(!isset($_GET['ped']) || !filter_var($_GET['ped'], FILTER_VALIDATE_INT)){

        header('Location: pedidos.php');
        exit;

    }else{

        require_once 'lib/Validacao.php';
        $validar = new Validacao;

        if(!isset($_SESSION['adm'])){

            $validar->isLoggedIn();

        }

        require_once 'lib/DaoPedvenda.php';
        require_once 'lib/DaoItensvenda.php';
        require_once 'lib/DaoProduto.php';
        require_once 'lib/DaoUsuario.php';

        $pedido = DaoPedvenda::getInstance()->readOne($_GET['ped']);
        $itens = DaoItensvenda::getInstance()->readAllWhere('pedvenda_idpedvenda', $_GET['ped']);
        $usuario = DaoUsuario::getInstance()->readOne($pedido['usuario_idusuario']);

        if(!empty($_GET['ped']) && !empty($_GET['print'])){

            if($_GET['print'] == 's'){

                require_once 'lib/fpdf181/fpdf.php';

                $titulo_pdf = 'Titulo pdf';

                $pdf = new FPDF('p', 'cm', 'A4');
                $pdf->AddPage();
                $pdf->SetTitle('titulo'); // titulo
                $pdf->SetFont('Arial', 'B', '14');

                $pdf->Cell(0, 2, $titulo_pdf, 0, 1, 'C'); // titulo do pdf

                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(1.5, 1, 'Nome: ', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(0, 1, $usuario['nome'], 0, 1, 'L');

                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(1.5, 1, 'CPF: ', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(0, 1, mascaraStr('000.000.000-00', $usuario['cpf']), 0, 1, 'L');

                $pdf->Ln(1);

                $pdf->SetFont('Arial', '', '12');

                $pdf->Cell(11.5, 1, 'Produto', 1, 0, 'C');
                $pdf->Cell(1.5, 1, 'Qtd', 1, 0, 'C');
                $pdf->Cell(6, 1, 'Valor', 1, 1, 'C');

                $total = null;

                foreach ($itens as $key => $value){

                    $produto =  DaoProduto::getInstance()->readOne($value['produto_idproduto']);

                    $valqtd = $value['valorunitario'] * $value['quantidade'];
                    $total = $total + $valqtd;

                    $pdf->Cell(11.5, 0.7, $produto['nome'], 1, 0, 'C');
                    $pdf->Cell(1.5, 0.7, $value['quantidade'], 1, 0, 'C');
                    $pdf->Cell(6, 0.7, 'R$ '.number_format($valqtd, 2, ',', '.'), 1, 1, 'C');


                }

                $pdf->Cell(13, 1, 'Total', 1, 0, 'C');
                $pdf->Cell(6, 1, 'R$ '.number_format($total, 2, ',', '.'), 1, 0, 'C');

                $pdf->Output();

            }

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
        <title>Pedido #<?php echo (isset($_GET['ped'])) ? $_GET['ped'] : '0000' ?></title>
        <script src="js/jquery.js"></script>
    </head>

    <body>
        <?php require_once 'scripts/php/navbar.php'; ?>

        <div class="container">

        <div class="card">
            <div class="card-header text-center h6">
                Pedido #<?php echo $_GET['ped']; ?>
            </div>
            <div class="card-body">
                <h6 class="card-title text-center"><span class="text-muted">Usuário:</span> <?php echo $usuario['nome'] ?></h6>
                <?php
                    foreach($itens as $key => $item){
                        $produto =  DaoProduto::getInstance()->readOne($item['produto_idproduto']);
                ?>
                    <h6 class="card-title text-center">
                        <span class="text-muted">Item <?php echo $key.': x'.$item['quantidade'].' '.$item['valorunitario'] ?></span> <?php echo $produto['nome'] ?>
                    </h6>
                <?php } ?>
                <h6 class="card-title text-center"><span class="text-muted">Lista:</span> <a href="<?php echo 'vpedido.php?ped='.$_GET['ped'].'&print=s'; ?>">Imprimir</a></h6>
            </div>
        </div>

        </div>

        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>