<section id="search">
    <?php var_dump($_GET);
    $p = $_GET['p'];
    echo $p;
    ?>
    <form action="?p=<?= $p?>.search" id="truc" method="post">

        <label for="search">Rechercher :
            <input type="text" name="search" id="search-txt">
        </label>

        <button type="submit" id="search-btnSubmit">Valider</button>
    </form>
</section>