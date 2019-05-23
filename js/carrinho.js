var qtd = {};
var sub = {};
var total = 0;

setPreco = (id) => (
    preco[id] = parseFloat($('#preco'+id).html())
);

atualizar = (id) => (
    qtd[id] = parseInt($('#inqtd'+id).val()),
    $('#sub'+id).html((preco[id] * qtd[id]).toFixed(2)),
    sub[id] = parseFloat($('#sub'+id).html())
);

function mais(id){

    qtd[id] = parseInt($('#inqtd'+id).val());
    sub[id] = parseFloat($('#sub'+id).html());
    $('#inqtd'+id).val(qtd[id] + 1);
    atualizar(id);

}

function menos(id){
    qtd[id] = parseInt($('#inqtd'+id).val());
    sub[id] = parseFloat($('#sub'+id).html());
    if(parseInt($('#inqtd'+id).val()) > 1){

        $('#inqtd'+id).val(qtd[id] - 1);
        $('#sub'+id).html(sub[id] * qtd[id]);

    }
    atualizar(id);
}

$(document).ready(function(){

    $('#total').html(Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'}).format(parseFloat($('#total').html())));

    $('button').click(function(){

        if(nprod > 1){

            for(var i = 0; i < nprod; i++){
    
                total = sub[i - 1] + sub[i];
    
            }

        }else{

            total = sub[0];

        }

        $('#total').html(Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'}).format(total.toFixed(2)));

    });

});