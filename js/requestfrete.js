$(document).ready(function(){

    $('#btn-calc').click(function(){
        
        var cep = $('#in-destino').val().replace(/\D/g, '');

        if(cep.length == 8){

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
                                
                                $('#freteResultado').html('');
                                $('#freteResultado').append($('#frete-tipo').val().toUpperCase() + ' : <span id="Valor"></span> - Prazo: <span id="Prazo"></span> dias.');
                                $('#freteResultado #Valor').html('R$ ' + array_data['cServico']['Valor']);
                                $('#freteResultado #Prazo').html(array_data['cServico']['PrazoEntrega']);
                                $('#freteResultado').removeClass('text-danger');
                                $('#freteModal').modal('show');
            
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

        }else{

            $('#freteModal').modal('show');
            $('#freteResultado').html('CEP Inválido');
            $('#freteResultado').addClass('text-danger');

        }

    });

});    
