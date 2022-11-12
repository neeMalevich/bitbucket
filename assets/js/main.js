$(document).ready(function () {

    $('#login-btn').click(function () {
        // e.preventDefault();

        let login = $('input[name="login"]').val(),
            password = $('input[name="password"]').val();

        $.ajax({
            type: 'POST',
            url: '/click-media/auth/login',
            dataType: 'json',
            data: {
                login: login,
                password: password
            },
            success: function (data) {
                if (data.success) {
                    location.reload();
                } else {
                    $('#login-errors').html(data.message).show();
                }
                $('#login-success').html('').hide();
                $('#login-form')[0].reset();
            }
        });
    });

    $('#register-button').click(function () {
        // e.preventDefault();

        let login = $('input[name="login"]').val(),
            password = $('input[name="password"]').val(),
            email = $('input[name="email"]').val(),
            name = $('input[name="name"]').val();

        $.ajax({
            type: 'POST',
            url: '/click-media/auth/register',
            dataType: 'json',
            data: {
                login: login,
                password: password,
                email: email,
                name: name,
            },
            success: function (data) {
                if (data.success) {
                    $('#register-errors').html(data.message).hide();
                    $('#register-success').html(data.message).show();

                } else {
                    $('#register-errors').html(data.message).show();
                    $('#register-success').html(data.message).hide();
                }
                $('#sign_in_form')[0].reset();
            }
        });
    });

});