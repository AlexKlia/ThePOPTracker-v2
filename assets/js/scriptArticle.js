$( function() {
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
});