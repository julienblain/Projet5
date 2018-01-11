<?php include_once ($this->viewPath. 'dreams/nav.php');?>
<section id="indexDreams">
    <h2>Rêves précendents</h2>

    <ol id="indexDreams-listYears">
    <?php
        $yearArray = array_keys($dreamsYears);
        $yearMax = $yearArray[0];
        $yearOld = count($yearArray);

        for($i=0; $i < $yearOld; $i++) {
            $year = $yearArray[$i];
    ?>
            <li class="indexDreams-year"><?= $year ?>
                <ol class="indexDreams-listMonths">
                    <?php
                        $monthArray = array_keys($dreamsYears[$year]);
                        $monthOld = count($monthArray);
                        for($j=0; $j< $monthOld; $j++) {
                            $month = $monthArray[$j];
                    ?>
                        <li class="indexDreams-mont"><?= $month ?>
                            <ol class="indrexDreams-listDreams">
                                <?php
                                    $dreamArray = array_keys($dreamsYears[$year][$month]);
                                    $dreamOld = count($dreamArray);
                                    for($k=0; $k<$dreamOld; $k++) {
                                    $dream = $dreamsYears[$year][$month][$k];

                                ?>
                                    <li class="indexDreams-dream">
                                        <a href="">
                                            Le <?= $dream->dateDreams ?> à <?= $dream->hourDreams ?>
                                        </a>
                                        <ul class="indexDreams-rud">
                                            <button class="indexDreams-read">
                                                <a href="http://localhost/Projet5/public/index.php?p=dreams.read.<?= $dream->idDreams?>">Lire</a>
                                            </button>
                                            <button class="indexDreams-update">
                                                <a href="http://localhost/Projet5/public/index.php?p=dreams.update.<?= $dream->idDreams?>">Modifier</a>
                                            </button>
                                            <button class="indexDreams-delete">
                                                <a href="http://localhost/Projet5/public/index.php?p=dreams.delete.<?= $dream->idDreams?>">Supprimer</a>
                                            </button>
                                        </ul>
                                    </li>

                                <?php } ?>


                            </ol>

                        </li>
                    <?php } ?>
                </ol>
            </li>

        <?php } ?>







    </ol>
</section>