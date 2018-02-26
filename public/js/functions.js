$(document).ready(function() {

    // events manager to searched word form, object js search
    $("#search-btnSubmit").click(function () {
        search.searching();
    });

    $("#search-txt").keydown(function (event) {

        var code = event.which || event.keyCode;

        if (code === 13) {

           event.preventDefault();
            search.searching();
        }
    });

    // scrolling search data pagination
    if(document.getElementById('boxArrowSearch')) {
        $("#arrowLeftSearch").click(function () {
            search.clickingArrowLeft();
        });

        $("#arrowRightSearch").click(function () {
            search.clickingArrowRight();
        });
    }

    // toggle homeLogged
    if(document.getElementById('moreElements')) {

        $("#elaborationTxt").click(function() {
            if($("#previousEventsWrite").css('display') !== 'none') {
               // $("#previousEventsTxt").click();
                $("#previousEventsWrite").toggle(200);
            }
            $("#elaborationTextarea").delay(200).toggle(200);
        });

        $("#previousEventsTxt").click(function() {

            if($("#elaborationTextarea").css('display') !== 'none') {
               // $("#elaborationTxt").click();
                $("#elaborationTextarea").toggle(200);
            }
            $("#previousEventsWrite").delay(200).toggle(200);
        });
    }

    // delete Account
    if(document.getElementById('deleteAccount')) {
        $('#deleteAccount').click(function () {
            if (confirm('Êtes-vous sûr·e de vouloir votre compte ?')) {
                return true;
            }
            else {
                return false;
            }
        });
    }

    //delete Dream
    if ((document.getElementsByClassName('btnDelete')) && (!document.getElementById('deleteAccount'))) {
        $('.btnDelete').click(function () {
            if(confirm('Êtes-vous sûr·e de vouloir supprimer ce rêve ?')) {
                return true;
            }
            else {
                return false;
            }
        });
    }

    //notification
    if(document.getElementsByClassName('notification')) {
        $(".notification").delay(2000).fadeOut('slow');
    }

    //home login
    if(document.getElementById('nav-login')) {
        $("#nav-login").click(function () {
            $("#home-login").toggle(200);
        });
    }
    if(document.getElementById('home-login-forgetPass')) {
        $("#home-login-forgetPass").click(function () {
            $("#forgetPassBox").toggle(200);
        });
    }

    //home register
    if (document.getElementById('home-createAccount')) {
        $("#nav-register").click(function () {
            $("#home-createAccount").toggle(200);
        });
    }

    if (document.getElementById('home-createAccount')) {
        $("#home-register").click(function () {
            $("#home-createAccount").toggle(200);
        });
    }

});

// convert date in french
function dateFr(datas) {

   var days = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
   var months = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];

   var date = new Date(datas);
   var dateFr = days[date.getDay()] + ' ';
   dateFr += date.getDate() + ' ';
   dateFr += months[date.getMonth()] + ' ';
   dateFr += date.getFullYear();

   return dateFr;
}




