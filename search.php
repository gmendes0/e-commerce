<?php

    if(isset($_POST['busca'])){

        require_once 'lib/Banco.php';
        $busca = $_POST['busca'];
        $sql = "SELECT * FROM `produto` WHERE `nome` LIKE '%$busca%'";
        $stmt = Banco::getInstance()->prepare($sql);
        $stmt->execute();

        $resultado['n'] = $stmt->rowCount();

        if($resultado['n'] > 0){

            $resultado['display'] = '<p class="text-center text-muted h6">Resultado da pesquisa<p>';
            $resultado['display'] .= '<div class="card-columns mt-5 mb-5">';
            
            while($dado = $stmt->fetch(PDO::FETCH_OBJ)){
                
                
                $resultado['display'] .= '<div class="card mt-2" style="width: 16rem;">';
                $resultado['display'] .= '<img src="'.explode(';', $dado->foto)[0].'" class="card-img-top"/>';
                $resultado['display'] .= '<div class="card-body">';
                $resultado['display'] .= "<a href='produto.php?id_prod=$dado->idproduto'>$dado->nome</a>";
                $resultado['display'] .= "<p>R$ $dado->valor</p>";
                $resultado['display'] .= "<a href='site.php?id_prod=$dado->idproduto&add=true' class='btn btn-primary'>adicionar para o carrinho</a>";
                $resultado['display'] .= '</div>';
                $resultado['display'] .= '</div>';
                
            }

            $resultado['display'] .= '</div>';
            $resultado['display'] .= '<hr/>';
            
        }else{

            $resultado['erro'] = 'nenhum produto encontrado';

        }

        echo json_encode($resultado);

    }