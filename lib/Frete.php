<?php

    try{

        $cep_destino = $_POST['cep'];
        $cep_origem = '85960000';

        $servicos = ['sedex' => '04014', 'pac' => '04510'];

        foreach($servicos as $key => $value){
            
            $url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?";
            $url .= "nCdEmpresa=0";
            $url .= "&sDsSenha=0";
            $url .= "&nCdServico=".$value;
            $url .= "&sCepOrigem=".$cep_origem;
            $url .= "&sCepDestino=".$cep_destino;
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
            $xml[$key] = simplexml_load_file($url);

            if(!empty($xml[$key]->cServico->Erro)){
                $aviso = true;
                $erros = $xml[$key]->cServico->MsgErro;
            }else{
                $aviso = false;
            }

        }
?>
        <div class="card mb-3 border-dark">
            <div class="card-header text-center text-white bg-dark">
                Frete
            </div>
            <div class="card-body">
                <?php if($aviso && !empty($erros)){ ?>
                    <h5 class="card-title text-center text-danger">
                        <?php
                            foreach($erros as $value){

                                echo $value;

                            }
                        ?>
                    </h5>
                <?php }else{ ?>
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <td>Serviço</td>
                                <td>Valor</td>
                                <td>Prazo</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($xml as $key => $value){ ?>
                                <?php $$key = $value->cServico; ?>
                                <tr>
                                    <td><?php echo strtoupper($key); ?></td>
                                    <td>R$ <?php echo $$key->Valor; ?></td>
                                    <td><?php echo $$key->PrazoEntrega; ?> dias</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
<?php

    }catch(Exception $th){

        echo $th->getMessage();

    }