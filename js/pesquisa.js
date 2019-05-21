$(document).ready(function(){
    // $('#busca').on('input', function(){
    //     console.log($(this).val().length);
    // });
    $('#busca').keyup(function(){
        if($('#busca').val().length > 1){
            $.ajax({
                method: 'post',
                url: 'search.php',
                data: {busca: $('#busca').val()},
                dataType: 'json',
                success: function(resultado){
                    if(resultado.n >= 1){

                        $('#pesquisado').html(resultado.display);

                    }
                }
            });
        }
    });
    $('#busca').on('input', function(){
        if($('#busca').val().length == 0){
            $('#pesquisado').html('');
        }
    });
});