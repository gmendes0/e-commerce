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