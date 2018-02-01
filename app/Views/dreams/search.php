<section id="search">
    <?php 
    //$p = $_GET['p'];

    ?>
    <form id="searchForm" action="" method="post">

        <label for="search-txt">Rechercher :
            <input type="text" name="search-txt" id="search-txt" required>
        </label>

        <button type="button" id="search-btnSubmit" class="btn btnSearch">
            <i class="fa fa-search"></i>
        </button>
    </form>
</section>

<aside id = 'partResultsSearch'>
    <!-- results by js function -->
</aside>