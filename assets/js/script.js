$(function(){
var availableTags=[];
var i=0;

    window.onload = function()
    {
        ajaxFunction();
    }

    function ajaxFunction(){
        url=$('#url_hidden').val();

        $.ajax({
            url: url,
            method:'POST'
        })
            .done(function(response){
                response.forEach(function(j){
                    availableTags[i]=j.name;
                    i++;
                })
            })

            .fail(function(response){
                console.log('fail');
                console.log(response.responseText);
            })
    }

    $( "#allPopSearch" ).autocomplete({
        source: availableTags
    });


})