<section id="search">
    <form id="searchForm" method="post">
        <label for="search-txt">Rechercher :
            <input type="text" name="search-txt" id="search-txt" required>
        </label>

        <button type="button" id="search-btnSubmit" class="btn btnSearch" title="Valider">
            <i class="fa icon-search"></i>
        </button>
    </form>
</section>

<aside id = 'partResultsSearch'>
    <!-- results by js function -->
</aside>

<div id="boxArrowSearch">
    <button id="arrowLeftSearch" class="btn btnPreviousNext" title="Résultats précédents">
        <i class="fa icon-arrow-left"></i>
    </button>
    <button id="arrowRightSearch" class="btn btnPreviousNext" title="Résultats suivants">
        <i class="fa icon-arrow-right"></i>
    </button>
</div>