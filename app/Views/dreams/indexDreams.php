<?php include_once($this->viewPath . 'dreams/nav.php'); ?>
<section id="indexDreams">

    <?php
    $listMonth = array(
            '01' => 'Janvier',
            '02' => 'Février',
            '03' => 'Mars',
            '04' => 'Avril',
            '05' => 'Mai',
            '06' => 'Juin',
            '07' => 'Juillet',
            '08' => 'Août',
            '09' => 'Septembre',
            '10' => 'Octobre',
            '11' => 'Novembre',
            '12' => 'Décembre'
    );

    if (isset($dreams)) { ?>
    <h2>Rêves précendents</h2>
    <ol id="indexDreams-listYears">

        <?php $dateTime = new DateTime($dreams[0]->dateDreams);
        $yearLastIteration = $dateTime->format('Y');
        $monthLastIteration = $dateTime->format('m');
        ?>
        <li class="indexDreams-year">
            <h3>Année <?= $yearLastIteration ?> </h3>
            <ol>
                <li class="indexDreams-month">
                    <h4><?= $listMonth[$monthLastIteration] ?></h4>
                    <ol>
                        <?php
                        foreach ($dreams as $dream) {
                            $dateTime = new DateTime($dream->dateDreams);
                            $yearFormat = $dateTime->format('Y');

                            if ($yearFormat != $yearLastIteration) {

                                $yearLastIteration = $yearFormat;
                                $monthFormat = $dateTime->format('m');

                                $monthLastIteration = $monthFormat;
                            ?>

                    </ol>
                </li>
           </ol>
        </li>

        <li class="indexDreams-year">
            <h3>Année <?= $yearLastIteration ?></h3>
            <ol>
                <li class="indexDreams-month">
                    <h4><?=  $listMonth[$monthLastIteration]?></h4>
                    <ol>
                        <li><a href='?p=dreams.read.<?=$dream->idDreams?>'><?=$dream->dateDreamsFr ?></a></li>

                            <?php
                            } else {
                                $monthFormat = $dateTime->format('m');

                                if ($monthFormat != $monthLastIteration) {

                                    $monthLastIteration = $monthFormat;
                            ?>
                    </ol>
                </li>

                <li class="indexDreams-month">
                    <h4><?=  $listMonth[$monthLastIteration] ?></h4>
                    <ol>
                        <li><a href='?p=dreams.read.<?=$dream->idDreams?>'><?=$dream->dateDreamsFr?> </a></li>
                            <?php
                                } else {

                                    echo "<li><a href='?p=dreams.read.$dream->idDreams'>$dream->dateDreamsFr </a></li>";
                                }


                        }
        }?>

                    </ol>
                </li>
            </ol>
        </li>
    </ol>

    <?php
    } else {
        echo '<p>Vous n\'avez encore enregistré aucun rêve. </p>';
    }

    ?>


</section>