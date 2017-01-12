$( function() {

    $('#loginBtn').on('click', function(e){

        if ($(this).hasClass('disabled')) {
            e.preventDefault();
        } else {
            $(this).toggleClass('disabled');
            $('#sign-inBtn').toggleClass('disabled')

            $('#sign-in').toggleClass('hide');
            $('#login').toggleClass('hide');
        }

    });

    $('#sign-inBtn').on('click', function(e){

        if ($(this).hasClass('disabled')) {
            e.preventDefault();
        } else {
            $(this).toggleClass('disabled');
            $('#loginBtn').toggleClass('disabled')

            $('#login').toggleClass('hide');
            $('#sign-in').toggleClass('hide');
        }
    });
});