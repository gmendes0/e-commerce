$(document).ready(function(){

    $('#cd-dados').css('display', 'none');
    $('#cd-endereco').css('display', 'none');

    $('#perfil').click(function(){

        $(this).addClass('active');
        $('#dados').removeClass('active');
        $('#endereco').removeClass('active');
        $('#cd-dados').css('display', 'none');
        $('#cd-endereco').css('display', 'none');
        $('#cd-perfil').removeAttr('style');

    });

    $('#dados').click(function(){

        $(this).addClass('active');
        $('#perfil').removeClass('active');
        $('#endereco').removeClass('active');
        $('#cd-perfil').css('display', 'none');
        $('#cd-endereco').css('display', 'none');
        $('#cd-dados').removeAttr('style');

    });

    $('#endereco').click(function(){

        $(this).addClass('active');
        $('#perfil').removeClass('active');
        $('#dados').removeClass('active');
        $('#cd-perfil').css('display', 'none');
        $('#cd-dados').css('display', 'none');
        $('#cd-endereco').removeAttr('style');

    });

});