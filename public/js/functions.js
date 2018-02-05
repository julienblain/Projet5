$(document).ready(function() {

    // events manager to searched word form
    $("#search-btnSubmit").click(search);

    $("#search-txt").keydown(function (event) {

        var code = event.which || event.keyCode;

        if (code === 13) {
           event.preventDefault();
            search();
        }
    });

    // ajax elasticsearch
    function search() {

        if($('#search-txt')) {

            var word = $("#search-txt").val();

            if(word === '') {
                alert('Veuillez entrer un mot pour faire une recherche.');
                return false;
            }

            $.ajax( {

                url : 'http://localhost/Projet5/public/index.php?p=dreams.search',
                type : 'POST',
                data : 'search-txt=' + word,

                error : function(status) {

                    console.log(status);
                },

                success : function (result) {

                    var datas = JSON.parse(result);
                    var divSearch = document.getElementById('partResultsSearch');
                    divSearch.innerHTML = ''; // delete content if there is one

                    if(datas.hits.hits.length !== 0) {

                        var list = document.createElement('ol');
                        list.id = 'resultsSearch';

                        for (var i = 0; i < datas.hits.hits.length; i++) {

                            var newLi = document.createElement('li');
                            newLi.id = 'resultsSearch-'+i;
                            var newLink = document.createElement('a');
                            newLink.class = 'resultsSearch-link';
                            newLink.href = 'http://localhost/Projet5/public/index.php?p=dreams.read.' + datas.hits.hits[i]._id ;

                            var dateFrench = dateFr(datas.hits.hits[i]._source.date);
                            var time = datas.hits.hits[i]._source.hour.replace(':', 'h');

                            var linkText = document.createTextNode('Le ' + dateFrench + ' à '+ time);
                            newLink.appendChild(linkText);
                            newLi.appendChild(newLink);
                            list.appendChild(newLi);
                        }

                        var title = document.createElement('h3');
                        title.innerHTML = 'Résultas : ';
                        divSearch.appendChild(title);
                        divSearch.appendChild(list);
                    }
                    else {

                        var noResults = document.createElement('p');
                        noResults.innerHTML = 'Aucun résultat ne fut trouvé.';
                        divSearch.appendChild(noResults);
                    }
                }

            });
        }
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
            if(confirm('Êtes-vous sûr·e de vouloir votre compte ?')) {
                return true;
            }
            else {
                return false;
            }
        })
    }

    //delete Dream
    if(document.getElementsByClassName('btnDelete')) {
        $('.btnDelete').click(function () {
            if(confirm('Êtes-vous sûr·e de vouloir supprimer ce rêve ?')) {
                return true;
            }
            else {
                return false;
            }
        })
    }

    //notification
    if(document.getElementsByClassName('notification')) {
        $(".notification").delay(2000).fadeOut('slow');
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




