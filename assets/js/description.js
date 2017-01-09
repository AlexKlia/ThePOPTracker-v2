$( function() {

    var dialog, form;

    $('.addFlag').on('click', function() {

        var currentFlag = $(this);

        var confirmAddFlag = $( "#dialog-confirm" ).dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Marquer comme indesirable": function() {
                    addFlag(currentFlag);
                    $( this ).dialog( "close" );
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });

        confirmAddFlag.dialog('open');

    });

    function addFlag(currentFlag) {

        var url = $('.addFlagUrl').attr('value');

        var data = {'id' : currentFlag.attr('data-id')};
        var flagAlert = currentFlag.siblings('.alertFlag');

        $.ajax({
            url: url,
            data: data,
            method: 'post'
        }).done(function() {

            currentFlag.removeClass("addFlag").addClass("flagged");
            flagAlert.show();

            setTimeout(function() {
                flagAlert.fadeOut(500);
            }, 2000);


        }).fail(function(response) {
            console.log(response);
        });
    }

    $('.flagged').on('click', function() {

        var currentFlag = $(this);
        var flagAlert = currentFlag.siblings('.alertFlag');

        flagAlert.show();

        setTimeout(function() {
            flagAlert.fadeOut(500);
        }, 2000);

    });

    $('.stars').on('mouseenter', function() {
        $(this).prevUntil(this).removeClass("glyphicon-star-empty").addClass("glyphicon-star");
        $(this).nextUntil(this).removeClass("glyphicon-star").addClass("glyphicon-star-empty");
        $(this).removeClass("glyphicon-star-empty").addClass("glyphicon-star");

    });

    $('.stars').on('mouseleave', function() {

        $('.stars').each(function() {
            if ($(this).hasClass('active')) {
                $(this).removeClass("glyphicon-star-empty").addClass("glyphicon-star");

            } else {
                $(this).removeClass("glyphicon-star").addClass("glyphicon-star-empty");
            }
        });

    });

    $('.stars').on('click', function() {

        $(this).nextUntil(this).removeClass("active");
        $(this).prevUntil(this).removeClass("glyphicon-star-empty").addClass("glyphicon-star active");
        $(this).removeClass("glyphicon-star-empty").addClass("glyphicon-star active");

        var notation = $(this).attr('value');
        $('.notation').attr('value', notation);

    });

    function addPOP() {
        var dialog,form;
        // fetch where we want to submit the form to
        var url = $('#addPop').attr('action');

        // fetch the data for the form
        var data = $('#addPop').serializeArray();

        // setup the ajax request
        $.ajax({
            url: url,
            data: data,
            method: 'post'
        }).done(function(response) {
            $('#own').removeClass('btn-primary');
            $('#own').addClass('btn-success');

            console.log(response);

            if (response.name)
            {
                $('.modal-title').empty();
                $('.modal-title').append('Succé dévérouillé : ' + response.name+' !');

                $('.content').empty();
                $('.content').append(response.description);
                $('#myModal').modal('toggle');
            }

            // return false so the form does not actually
            // submit to the page
            return false;
        }).fail(function(response) {
            console.log(response);
        });
    }



    $( "#own" ).on( "click", function(event) {
        event.preventDefault();
        dialog.dialog( "open" );
    });

    $( "#wish" ).on( "click", function(event) {
        event.preventDefault();
        // fetch where we want to submit the form to
        var url = $('#wishForm').attr('action');
        console.log(url);

        // fetch the data for the form
        var data = $('#wishForm').serialize();
        console.log(data);

        // setup the ajax request
        $.ajax({
            url: url,
            data: data,
            method: 'post'
        }).done(function(response) {
            $('#wish').removeClass('btn-primary');
            $('#wish').addClass('btn-success');

            // return false so the form does not actually
            // submit to the page
            return false;
        }).fail(function(response) {
            console.log(response);
        }).always(function(r){console.log(r)});
    });

    dialog = $( "#dialog-form" ).dialog({
        autoOpen: false,
        height: 400,
        width: 350,
        modal: true,
        show: {
            effect: "blind",
            duration: 500
        },
        hide: {
            effect: "blind",
            duration: 200
        },
        buttons: {
            "Ajouter": function() {
                addPOP();
                dialog.dialog( "close" );
            },

            Cancel: function() {
                dialog.dialog( "close" );
            }
        },
        close: function() {
            form[ 0 ].reset();
        }
    });

    form = dialog.find( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        addPOP();
    });

    function removeComment(currentComment) {

        var url = $('.removeComment').attr('value');
        var data = {'id' : currentComment.attr('data-id')};

        $.ajax({
            url: url,
            data: data,
            method: 'post'
        }).done(function(r) {

            // @todo
            console.log(r);

        }).fail(function(response) {
            console.log(response);
        });
    }

    $('.remove').on('click',function() {

        var currentComment = $(this);

        var confirmRemove = $( "#dialog-confirm" ).dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Supprimmer Commentaire": function() {
                    removeComment(currentComment);
                    $( this ).dialog( "close" );
                    location.reload(false);
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });

        confirmRemove.dialog('open');
    });

} );