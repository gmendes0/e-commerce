$(document).ready(function(){

    $('#shippingaddresspostalcode').blur(function(){

        var cep = $('#shippingaddresspostalcode').val().replace(/\D/g, '');

        if(cep != ""){

            $.getJSON('https://viacep.com.br/ws/'+cep+'/json/', function(dados){
            
                if(!dados.erro){

                    $('#shippingaddressstreet').val("");
                    $('#shippingaddressdistrict').val("");
                    $('#shippingaddresscity').val("");
                    $('#shippingaddressstate option').each(function(){
                        $(this).removeAttr('selected');
                    });

                    $('#shippingaddressstreet').val(dados.logradouro);
                    $('#shippingaddressdistrict').val(dados.bairro);
                    $('#shippingaddresscity').val(dados.localidade);
                    $('#shippingaddressstate option[value='+dados.uf+']').attr('selected', 'selected');

                }else{

                    $('#modal1').modal('show');

                }

            });

        }

    });

    $('#billingAddressPostalCode').blur(function(){

        var cep1 = $('#billingAddressPostalCode').val().replace(/\D/g, '');

        if(cep1 != ""){

            $.getJSON('https://viacep.com.br/ws/'+cep1+'/json/', function(dados){
            
                if(!dados.erro){

                    $('#billingAddressStreet').val("");
                    $('#billingAddressDistrict').val("");
                    $('#billingAddressCity').val("");
                    $('#billingAddressState option').each(function(){
                        $(this).removeAttr('selected');
                    });

                    $('#billingAddressStreet').val(dados.logradouro);
                    $('#billingAddressDistrict').val(dados.bairro);
                    $('#billingAddressCity').val(dados.localidade);
                    $('#billingAddressState option[value='+dados.uf+']').attr('selected', 'selected');

                }else{

                    $('#modal1').modal('show');

                }

            });

        }

    });

});