$(document).ready(function () {

    // Fechamento de modais
    $('.close').click(function () {
        $('.modal').style.transformX = "0";
        $('.modal').fadeOut("fast");
        return false;
    });

});

