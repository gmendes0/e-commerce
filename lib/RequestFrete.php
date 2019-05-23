<?php

    if(!empty($_POST)){

        $origem = "85960000";
        $destino = $_POST['destino'];
        $servicos = ['sedex' => '04014', 'pac' => '04510'];
        $servico = strtolower($_POST['servico']);
    
        $url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?";
        $url .= "nCdEmpresa=0";
        $url .= "&sDsSenha=0";
        $url .= "&nCdServico=".$servicos[$servico];
        $url .= "&sCepOrigem=".$origem;
        $url .= "&sCepDestino=".$destino;
        $url .= "&nVlPeso=2";
        $url .= "&nCdFormato=1";
        $url .= "&nVlComprimento=17";
        $url .= "&nVlAltura=16";
        $url .= "&nVlLargura=21";
        $url .= "&nVlDiametro=11";
        $url .= "&sCdMaoPropria=S";
        $url .= "&nVlValorDeclarado=0";
        $url .= "&sCdAvisoRecebimento=S";
        $url .= "&StrRetorno=xml";
        $url .= "&nIndicaCalculo=3";
    
        //setting the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1500);
        $data = curl_exec($ch);
        curl_close($ch);
    
        //convert the XML result into array
        // $array_data = json_decode(json_encode(simplexml_load_string($data)), true);
        $array_data = json_encode(simplexml_load_string($data));
        echo $array_data;
    
        // print_r('<pre>');
        // print_r($array_data);
        // print_r('</pre>');

    }

?>