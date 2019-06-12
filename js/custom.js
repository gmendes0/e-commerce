$('#bankSelect').hide()
$('#cardData').hide()
var amount = $('#amount').val()
var states = [
    {"nome": "Acre", "sigla": "AC"},
    {"nome": "Alagoas", "sigla": "AL"},
    {"nome": "Amapá", "sigla": "AP"},
    {"nome": "Amazonas", "sigla": "AM"},
    {"nome": "Bahia", "sigla": "BA"},
    {"nome": "Ceará", "sigla": "CE"},
    {"nome": "Distrito Federal", "sigla": "DF"},
    {"nome": "Espírito Santo", "sigla": "ES"},
    {"nome": "Goiás", "sigla": "GO"},
    {"nome": "Maranhão", "sigla": "MA"},
    {"nome": "Mato Grosso", "sigla": "MT"},
    {"nome": "Mato Grosso do Sul", "sigla": "MS"},
    {"nome": "Minas Gerais", "sigla": "MG"},
    {"nome": "Pará", "sigla": "PA"},
    {"nome": "Paraíba", "sigla": "PB"},
    {"nome": "Paraná", "sigla": "PR"},
    {"nome": "Pernambuco", "sigla": "PE"},
    {"nome": "Piauí", "sigla": "PI"},
    {"nome": "Rio de Janeiro", "sigla": "RJ"},
    {"nome": "Rio Grande do Norte", "sigla": "RN"},
    {"nome": "Rio Grande do Sul", "sigla": "RS"},
    {"nome": "Rondônia", "sigla": "RO"},
    {"nome": "Roraima", "sigla": "RR"},
    {"nome": "Santa Catarina", "sigla": "SC"},
    {"nome": "São Paulo", "sigla": "SP"},
    {"nome": "Sergipe", "sigla": "SE"},
    {"nome": "Tocantins", "sigla": "TO"}

]

$('#paymentmethod').change(function(){

    reloadFields()
})

function reloadFields(){

    if($('#paymentmethod').val() != 'creditCard'){

        $('#cardData').slideUp()
    }else{

        $('#cardData').slideDown()
    }

    if($('#paymentmethod').val() != 'eft'){

        $('#bankSelect').slideUp()
    }else{

        $('#bankSelect').slideDown()
    }
}

$.each(states, function(i, obj){
    $('#shippingaddressstate').append(`<option value='${obj.sigla}'>${obj.nome}</option>`)
    $('#billingAddressState').append(`<option value='${obj.sigla}'>${obj.nome}</option>`)
})

function pagamento(my_url){
    
    /**
     * Ajax pagamento.php
     */
    $.ajax({
        url: my_url + 'lib/pagseguroct/pagamento.php',
        method: 'post',
        dataType: 'json',
        success: function(retorno){
            PagSeguroDirectPayment.setSessionId(retorno.id)
        },
        error: function(retorno){

        },
        complete: function(retorno){

            /**
             * mostra os meios de pagamento
             */
            metodosDePagamento()

        }
    })
}

/**
 * retorna os metodos de pagamento
 */
function metodosDePagamento(){

    PagSeguroDirectPayment.getPaymentMethods({
        amount: amount,
        success: function(retorno) {

            // Retorna os meios de pagamento disponíveis.

            /**
             * Exibe os bancos para débito online
             */
            $.each(retorno.paymentMethods.ONLINE_DEBIT.options, function(i, obj){
                $('#bankName').append(`<option value='${obj.name}'>${obj.displayName}</option>`)
            })

            // /**
            //  * retorna os cartoes
            //  */
            // $('#payment-methods').append(`<div>Cartões de Crédito</div>`)
            // $.each(retorno.paymentMethods.CREDIT_CARD.options, function(i, val){
            //     $('#payment-methods').append(`<div><img src='https://stc.pagseguro.uol.com.br${val.images.SMALL.path}'></div>`)
            // })

            // /**
            //  * retorna o boleto
            //  */
            // $('#payment-methods').append(`<div>Boleto</div>`)
            // $('#payment-methods').append(`<div><img src='https://stc.pagseguro.uol.com.br${retorno.paymentMethods.BOLETO.options.BOLETO.images.SMALL.path}'></div>`)

            // /**
            //  * retorna o débito online
            //  */
            // $('#payment-methods').append(`<div>Débito Online</div>`)
            // $.each(retorno.paymentMethods.ONLINE_DEBIT.options, function(i, val){
            //     $('#payment-methods').append(`<div><img src='https://stc.pagseguro.uol.com.br${val.images.SMALL.path}'></div>`)
            // })
        },
        error: function(retorno) {
            // Callback para chamadas que falharam.
            getPsModal('Erro', '<p class="text-center">Não foi possível recuperar os métodos de pagamento</p>')
        },
        complete: function(retorno) {
            // Callback para todas chamadas.
        }
    })
}

/**
 * recupera a bandeira do cartão
 */
$('#ncartao').on('keyup', function(){

    var ncartao = $(this).val()
    var qtdNumCartao = ncartao.length

    if(qtdNumCartao > 5){

        PagSeguroDirectPayment.getBrand({

            cardBin: ncartao,
            success: function(retorno){
                //bandeira encontrada
                var recBrand = retorno.brand.name
                // $('#card-brand').html(`<img src='https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/42x20/${retorno.brand.name}.png'/>`)
                // $('#card-brand').prepend('<div>Bandeira</div>')
                $('#bandeiracartao').val(retorno.brand.name)
                // $('#brand-msg').html('')
                recParcelas(recBrand)
            },
            error: function(retorno){
                //tratamento do erro
            },
            complete: function(retorno){
                //tratamento comum para todas chamadas
            }
        })
    }else{

        $('#card-brand').html('')
        $('#brand-msg').html('')
    }
})

/**
 * recupera o valor das parcelas
 */
function recParcelas(bandeira){

    PagSeguroDirectPayment.getInstallments({
        amount: amount,
        maxInstallmentNoInterest: 3,
        brand: bandeira,
        success: function(retorno){

            // Retorna as opções de parcelamento disponíveis
            $('#installments').empty()
            $.each(retorno.installments, function(i, val){

                $.each(val, function(i1, val1){

                    var p_qtd = val1.quantity
                    var p_valor = val1.installmentAmount.toFixed(2)
                    var p_total = val1.totalAmount.toFixed(2)
                    $('#installments').append(`<option value='${p_qtd}' data-installment='${p_valor}'>${p_qtd}x de R$ ${p_valor.replace('.', ',')} - R$ ${p_total.replace('.', ',')}</option>`)
                })
            })
        },
        error: function(retorno) {
            // callback para chamadas que falharam.
            getPsModal('Erro', '<p>Não foi possível recuperar a quantidade de parcelas</p>')
        },
        complete: function(retorno){
            // Callback para todas chamadas.
        }
    })
}

/**
 * seleciona o valor das parcelas
 */
$('#installments').change(function(){
    $('#valorParcelas').val($(this).find(':selected').attr('data-installment'))
})

/**
 * recupera o hash
 */
$('#formFinalizarCompra').on('submit', function(event){

    event.preventDefault()
    var paymentMethod = $('#paymentmethod').find(':selected').val()

    if(paymentMethod == 'boleto'){

        recHash()
    }else if(paymentMethod == 'creditCard'){

        var ncartao = $('#ncartao').val()
        var bandeiracartao = $('#bandeiracartao').val()
        var cvv = $('#cvv').val()
        var mes = $('#mesvalidade').val()
        var ano = $('#anovalidade').val()
    
        /**
         * recupera o token do cartão
         */
        PagSeguroDirectPayment.createCardToken({
    
            cardNumber: ncartao, // Número do cartão de crédito
            brand: bandeiracartao, // Bandeira do cartão
            cvv: cvv, // CVV do cartão
            expirationMonth: mes, // Mês da expiração do cartão
            expirationYear: ano, // Ano da expiração do cartão, é necessário os 4 dígitos.
            success: function(retorno){
    
                // Retorna o cartão tokenizado.
                $('#tokencartao').val(retorno.card.token)
                recHash()
            },
            error: function(retorno){
                // Callback para chamadas que falharam.
            },
            complete: function(retorno){
                // Callback para todas chamadas.
            }
        })
    }else if(paymentMethod == 'eft'){
        
        recHash()
    }

})

/**
 * recupera o hash do cartao
 */
function recHash(){

    PagSeguroDirectPayment.onSenderHashReady(function(retorno){

        if(retorno.status == 'error'){
            
            console.log(retorno.message);
            return false;
        }else{

            //Hash estará disponível nesta variável.
            var hash = retorno.senderHash;
            $('#hash').val(hash)
            var dados = $('#formFinalizarCompra').serialize()
            console.log(dados)

            var my_url = $('#myurl').attr('data-myurl')

            $.ajax({
                method: 'post',
                url: my_url + 'lib/pagseguroct/processingps.php',
                data: dados,
                dataType: 'json',
                timeout: 30000,
                success: function(response){

                    if(response.dados.error){
                        getPsModal('Erro', '<p class="text-center text-danger">Não foi possível realizar a compra</p>')
                    }else{
                        getPsModal('Sucesso', '<p class="text-center text-success">Compra realizada com sucesso</p>')

                        $('.psModalDismiss').on('click', function(){

                            window.location = 'site.php';
                        })
                    }
                    console.log('sucesso: ' + JSON.stringify(response))
                    // débito - link: response.dados.paymentLink
                },
                error: function(response){
                    
                    getPsModal('Erro', '<p class="text-center text-danger">Não foi possível realizar a compra</p>')
                    console.log('erro: ' + JSON.stringify(response))
                }
            })
        }

    })
}

/**
 * submit do formulário
 */
$('#finalizar').on('click', function(event){

    $('#formFinalizarCompra').submit()
    event.preventDefault()
})

/**
 * modal
 */
function getPsModal(title, body){

    $('#psModal #psModalTitle').html()
    $('#psModal #psModalBody').html()

    $('#psModal #psModalTitle').html(title)
    $('#psModal #psModalBody').html(body)

    $('#psModal').modal('show')
}