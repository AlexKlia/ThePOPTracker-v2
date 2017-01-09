
//script ajout avatar
$(function () {

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

//owl carousel
$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            600:{
                items:3,
                nav:false
            },
            1000:{
                items:4,
                nav:false,
                loop:false
            }
        }
    })


    $('.owl-stage').css('background-color' ,'white');

});

