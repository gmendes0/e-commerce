<?php
if(!empty($_POST)){

	header("access-control-allow-origin: https://pagseguro.uol.com.br");
	header("Content-Type: text/html; charset=UTF-8",true);
	date_default_timezone_set('America/Sao_Paulo');

	require_once("PagSeguro.class.php");
	$PagSeguro = new PagSeguro();
		
	// //EFETUAR PAGAMENTO	
	// $venda = array("codigo"=>"1",
	// 			"valor"=>100.00,
	// 			"descricao"=>"VENDA DE NONONONONONO",
	// 			"nome"=>"ggggggg fff",
	// 			"email"=>"ggg@sandbox.pagseguro.com.br",
	// 			"telefone"=>"(19) 99999-9999",
	// 			"rua"=>"dasdasd",
	// 			"numero"=>"66",
	// 			"bairro"=>"dsad",
	// 			"cidade"=>"dsadas",
	// 			"estado"=>"SP", //2 LETRAS MAIÚSCULAS
	// 			"cep"=>"79.070-452",
	// 			"codigo_pagseguro"=>"");

	$venda = array("codigo"=>$idpedvenda,
			"valor"=>$pedvenda->getValortotal(),
			"descricao"=>$p['nome'],
			"nome"=>$user['nome'],
			// "email"=>"aaaxxx@sandbox.pagseguro.com.br",
			"email"=>explode('@', $user['email'])[0].'@sandbox.pagseguro.com.br',
			"telefone"=>mascaraStr("(00) 00000-0000", $user['telefone']),
			"rua"=>$user['endereco'],
			"numero"=>$user['numero'],
			"bairro"=>$user['bairro'],
			"cidade"=>"dsadas",
			"estado"=>$user['uf'], //2 LETRAS MAIÚSCULAS
			"cep"=>mascaraStr("00.000-000", $_POST['destino']),
			"codigo_pagseguro"=>"");
				
	$PagSeguro->executeCheckout($venda,"localhost/e-commerce/site.php".$_GET['codigo']);

	//----------------------------------------------------------------------------


	//RECEBER RETORNO
	if( isset($_GET['transaction_id']) ){
		$pagamento = $PagSeguro->getStatusByReference($_GET['codigo']);
		
		$pagamento->codigo_pagseguro = $_GET['transaction_id'];
		if($pagamento->status==3 || $pagamento->status==4){
			//ATUALIZAR DADOS DA VENDA, COMO DATA DO PAGAMENTO E STATUS DO PAGAMENTO
			
		}else{
			//ATUALIZAR NA BASE DE DADOS
		}
	}
}
?>