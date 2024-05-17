$(document).ready(function () {
    // Mostrar/ocultar contraseña
    $('#show_password').click(function () {
        Password('password');
    });

    // Mostrar/ocultar confirmación de contraseña
    $('#show_password_confirm').click(function () {
        Password_Confirm('password_confirm');
    });

    function Password(inputId) {
        var cambio = $('#' + inputId);
        if (cambio.attr('type') == 'password') {
            cambio.attr('type', 'text');
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        } else {
            cambio.attr('type', 'password');
            $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    }
    function Password_Confirm(inputId) {
        var cambio = $('#' + inputId);
        if (cambio.attr('type') == 'password') {
            cambio.attr('type', 'text');
            $('.icon_confirm').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        } else {
            cambio.attr('type', 'password');
            $('.icon_confirm').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    }
});