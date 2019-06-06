$(document).ready(function(){
    $(window).on('scroll', function(){
        var top = $(window).scrollTop()
        if(top > 300){
            $('.navbar').removeClass('shadow-sm')
            $('.navbar').addClass('shadow')
        }else{
            $('.navbar').removeClass('shadow')
            $('.navbar').addClass('shadow-sm')
        }
    })
})