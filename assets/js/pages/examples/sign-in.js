$(function () {
    
    $('#sign_in').validate({
        highlight: function (input) {            
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        rules: {
            username: {
                required: true
            },
            password: {
                required: true,
                minlength: 4
            }
        },
        messages: {
            username: {
                required: "Please enter your username"

            },
            password: {
                required: "Please enter your password"

            }
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
        },
        submitHandler: function (form) {
            var $form = $("#sign_in");
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: $form.serialize(),
                dataType: 'json'
            }).done(function (response) {

                if (response.status == "1")
                {
                    window.location = base_url + "dashboard";
                }
                else
                {
                    $('.bg-red').show();
                    $('.bg-red').html(response.msg);
                    setTimeout(function () {
                        $('.bg-red').hide('slow');
                    }, 4000);
                }
            });
            return false; // required to block normal submit since you used ajax
        }
    });
});