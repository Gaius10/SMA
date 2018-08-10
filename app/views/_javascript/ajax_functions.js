$(function () {
    var inSubmit = false;

    // funcao que faz com que o botao de submit volte ao seu estado
    // natural
    function voltaSubmit(btnText, submitBtn) {
        submitBtn.removeAttr('disabled');
        submitBtn.val(btnText);
        inSubmit = false;
    }

    // Verificacao de login
    $('#formLogin').submit(function () {
        var obj = this;
        var form = $(obj);
        var submitBtn = $('#btnLogin');

        var dados = form.serialize();

        if (!inSubmit) {
            // Enviar dados
            $.ajax({
                beforeSend: function () {
                    inSubmit = true;
                    submitBtn.attr('disabled', true);
                    submitBtn.val('Entrando...');
                },

                url: form.attr('action'),
                type: 'POST',
                data: dados,
                cache: false,

                success: function (data) {
                    voltaSubmit('Entrar', submitBtn);
                    if (data == "OK") {
                        window.location.reload();
                    } else {
                        $('#feedback').text(data);
                    }
                },

                error: function (request, status, error) {
                    voltaSubmit('Entrar', submitBtn);
                    alert(request.responseText + '. Contate o suporte.');
                }
            });

            return false;
        }
    });

    // Verificacao para cadastro
    $('#cadastre_se').submit(function () {
        var obj = this;
        var form = $(obj);
        var submitBtn = $('#btnCadastrar');

        var dados = form.serialize();

        if (!inSubmit) {
            // Enviar dados
            $.ajax({
                beforeSend: function () {
                    inSubmit = true;
                    submitBtn.attr('disabled', true);
                    submitBtn.val('Enviando dados...');
                },

                url: form.attr('action'),
                type: 'POST',
                data: dados,
                cache: false,

                success: function (data) {
                    voltaSubmit('Entrar', submitBtn);
                    if (data == 'OK') {
                        $('#contentMsg').text('Obrigado por se cadastrar.');
                        $('#msgModal').modal('open');
                    } else {
                        $('#contentMsg').text(data);
                        $('#cadastre_se').modal('close');
                        $('#msgModal').modal('open');
                    }
                },

                error: function (request, status, error) {
                    voltaSubmit('Entrar', submitBtn);
                    alert(request.responseText + '. Contate o suporte.');
                }
            });

            return false;
        }
    });
});
