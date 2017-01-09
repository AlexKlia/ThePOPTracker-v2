$(function(){


    $('#submitNewsletter').click(function(e){
        e.preventDefault();

        var url = $('#newsletter').val();
        var data = $('#email').val( );

        $.ajax({
            url: url,
            data:
                {
                    'email': data
                },
            method: 'post'
        }).done(function(response) {
            console.log(response);
            for(var i in response){
                if (response.hasOwnProperty(i)){
                    $('#errorsNewsletter').html(response[i]);
                }
            }

        }).fail(function(response){
            console.log('fail');
            console.log(response.responseText);
        })
    })

});