$( function() {

    var dialog, form;

    function removeFlag(currentFlag) {

        var url = $('.removeFlagUrl').attr('value');

        var data = {'id' : currentFlag.attr('data-id')};

        $.ajax({
            url: url,
            data: data,
            method: 'post'
        }).done(function() {

            location.reload(false);

        }).fail(function(response) {
            console.log(response);
        });
    }

    $('.flagged').on('click', function() {

        var currentFlag = $(this);

        var confirmAddFlag = $( "#dialog-confirm" ).dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Supprimer le flag": function() {
                    removeFlag(currentFlag);
                    $( this ).dialog( "close" );
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });

        confirmAddFlag.dialog('open');

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

    document.getElementById("file").onchange = function () {
        $('#image').removeClass('hidden');
        var reader = new FileReader();

        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("image").src = e.target.result;
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    };

    $('#file').filestyle({

        buttonName : 'btn-info',

        buttonText : 'Ajouter un fichier'

    });

} );