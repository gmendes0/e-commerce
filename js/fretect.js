$('#shippingaddresspostalcode').blur(function(){
    
    var shippingcep = $('#shippingaddresspostalcode').val().replace(/\D/g, '')

    if(shippingcep.length == 8){

        if(shippingcep != ""){

            $('#cepsmall').html()
            $('#cepsmall').html(shippingcep)

            $.getJSON('https://viacep.com.br/ws/'+shippingcep+'/json/', function(dados){

                if(!dados.erro){

                    var freteoptions = {
    
                        '1': 'pac',
                        '2': 'sedex'
                    }

                    $('#shippingtype').change(function(){
                    
                        if($('#shippingtype').val() == '1' || $('#shippingtype').val() == '2'){
        
                            var request = $.ajax({

                                method: 'POST',
                                url: 'lib/RequestFrete.php',
                                data: {destino: shippingcep, servico: freteoptions[$('#shippingtype').val()]},
                                dataType: 'json',
                                beforeSend: function(){

                                    // $('#spinner-cep').removeAttr('style');
                                },
                                success: function(array_data){
                                    
                                    var frete = Number.parseFloat(array_data['cServico']['Valor'].replace(',', '.')).toFixed(2)
                                    $('#valfrete').html();
                                    $('#valfrete').html('+R$ ' + frete);
                                    var subtotal = Number.parseFloat($('#subtotal').html()).toFixed(2);
                                    var total = Number.parseFloat(subtotal) + Number.parseFloat(frete);
                                    $('#total').html(total.toFixed(2));
                                    $('#shippingcost').val(frete);
                                },
                                error: function(){
                
                                    // $('#freteResultado').html('Não foi possível realizar a consulta');
                                    // $('#freteResultado').addClass('text-danger');
                                    // $('#freteModal').modal('show');
                                }
                            })
                        }
                    })
                }else{
    
                    $('#freteResultado').html('CEP Inválido');
                    $('#freteResultado').addClass('text-danger');
                    $('#freteModal').modal('show');
                }
            })
        }
    }

})

/*
$(document).ready(function(){
    $('#form').on('input', function(e){
        if($('#shippingaddresspostalcode').val().length == 8){
            var cep = $('#shippingaddresspostalcode').val().replace(/\D/g, '');
            if(cep != ""){

                $.getJSON('https://viacep.com.br/ws/'+cep+'/json/', function(dados){
                
                    if(!dados.erro){
    
                        var request = $.ajax({
                            method: 'POST',
                            url: 'lib/RequestFrete.php',
                            data: {destino: cep, servico: $('#frete-tipo').val()},
                            dataType: 'json',
                            beforeSend: function(){
                                $('#spinner-cep').removeAttr('style');
                            },
                            success: function(array_data){
                                
                                $('#frete').html(array_data['cServico']['Valor']);
                                var subtotal = parseFloat($('#subtotal').html());
                                var total = subtotal + parseFloat((array_data['cServico']['Valor']).replace(',', '.'));
                                $('#total').html((total).toFixed(2));
            
                            },
                            error: function(){
            
                                $('#freteResultado').html('Não foi possível realizar a consulta');
                                $('#freteResultado').addClass('text-danger');
                                $('#freteModal').modal('show');
            
                            }
                        });
            
                        request.done(function(){
                            $('#spinner-cep').css('display', 'none');
                        });
    
                    }else{
    
                        $('#freteResultado').html('CEP Inválido');
                        $('#freteResultado').addClass('text-danger');
                        $('#freteModal').modal('show');
    
                    }
                });
            }
        }
    });
});
*/