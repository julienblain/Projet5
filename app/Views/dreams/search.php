<section id="search">
    <?php 
    $p = $_GET['p'];

    ?>
    <form action="?p=<?= $p?>.search" id="truc" method="post">

        <label for="search-txt">Rechercher :
            <input type="text" name="search-txt" id="search-txt">
        </label>

        <label for="search-phrase">Expression exacte :
            <input type="checkbox" name="search-phrase" id="search-phrase" value="checked">
        </label>
        <button type="submit" id="search-btnSubmit">Valider</button>
    </form>
</section>