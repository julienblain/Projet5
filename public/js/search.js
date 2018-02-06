var search = {
     word : "",
    from : 0,
    divSearch : document.getElementById('partResultsSearch'),
    nbPage : 0,
    nbTotalPage : 0,
    totalResult : 0,
    resultsByPage : 6, //define in dreamEntity function

    searching : function() {
        if($('#search-txt')) {

            this.word = $("#search-txt").val();

            if (this.word === '') {
                alert('Veuillez entrer un mot pour faire une recherche.');
                return false;
            }
            else {

                //reset values
                this.nbPage = 0;
                this.nbTotalPage = 0;
                this.from = 0;
                this.totalResult =0;

                this.ajaxCountResult();
            }
        }
    },

    ajaxWord : function() {
        var divSearch = this.divSearch;

        $.ajax({
            url : 'http://localhost/Projet5/public/index.php?p=dreams.search',
            type : 'POST',
            data : {'search-txt': this.word,'from' : this.from},

            error : function(status) {

                console.log(status);
            },

            success : function (result) {
                if(document.getElementById('resultsSearch')) {
                    var list = document.getElementById('resultsSearch');
                    list.innerHTML ="";
                }
                else {
                    var list = document.createElement('ol');
                    list.id = 'resultsSearch';
                }


                var datas = JSON.parse(result);

                if(datas.hits.hits.length !== 0) {


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

                    divSearch.appendChild(list);
                }
            }
        });
     },

    //to know the number of page
    ajaxCountResult : function() {

        $.ajax( {
            url : 'http://localhost/Projet5/public/index.php?p=dreams.countSearch',
            type : 'POST',
            data : 'search-txt=' + this.word,

            error : function(status) {
                console.log(status);
            },

            success : function(result) {

                var datas = JSON.parse(result);

                if(datas.count === 0) {
                    search.divSearch.innerHTML = "";

                    var noResults = document.createElement('p');
                    noResults.innerHTML = 'Aucun résultat ne fut trouvé.';
                    search.divSearch.appendChild(noResults);

                    search.arrowDisplay();
                }
                else {
                    search.nbPage ++;
                    search.totalResult = datas.count;

                    search.nbTotalPage = Math.ceil(search.totalResult / search.resultsByPage);

                    search.divSearch.innerHTML = '';

                    var titleBox = document.createElement('div');
                    titleBox.id = 'titleBox';
                    var title = document.createElement('h3');
                    title.innerHTML = 'Résultas : ';

                    var page = document.createElement('p');
                    page.id = 'nbPage';
                    page.innerHTML = 'Page '+ search.nbPage + '/' + search.nbTotalPage;

                    titleBox.appendChild(title);
                    titleBox.appendChild(page);
                    search.divSearch.appendChild(titleBox);

                    search.ajaxWord();
                   search.arrow();

                }
            }
        });
    },

    arrowDisplay : function () {
        $("#arrowLeftSearch").css({"display" : "none"});
        $("#arrowRightSearch").css({"display" : "none"});
    },
    
    arrow : function () {

        $("#arrowLeftSearch").css({"display" : "block"});
        $("#arrowRightSearch").css({"display" : "block"});

        if((this.nbPage > 1) && (this.nbPage <= this.nbTotalPage)) {

            $("#arrowLeftSearch").css({"opacity" : "1"});

        }
        else {
            $("#arrowLeftSearch").css({"opacity" : "0.5"});
        }

        if((this.nbPage < this.nbTotalPage) && (this.nbPage > 0)) {

            $("#arrowRightSearch").css({"opacity" : "1"});
        }
        else {
            $("#arrowRightSearch").css({"opacity" : "0.5"});
        }
    },

    clickingArrowLeft : function () {

        if((this.nbPage > 1) && (this.nbPage <= this.nbTotalPage)) {

            this.from = this.from - this.resultsByPage;
            this.ajaxWord();

            this.nbPage --;
            var page = document.getElementById('nbPage');
            page.innerHTML = 'Page '+ this.nbPage + '/' + this.nbTotalPage;

            this.arrow();

        }
    },

    clickingArrowRight : function () {

        if((this.nbPage < this.nbTotalPage) && (this.nbPage > 0)) {

            this.from = this.from + this.resultsByPage;
            this.ajaxWord();

            this.nbPage ++;
            var page = document.getElementById('nbPage');
            page.innerHTML = 'Page '+ this.nbPage + '/' + this.nbTotalPage;

            this.arrow();
        }
    }
}

