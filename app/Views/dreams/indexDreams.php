<?php include_once($this->viewPath . 'dreams/nav.php'); ?>
<section id="indexDreams">
    <h1 id="indexDreamsTitle" title="Cliquer pour fermer ou ouvrir les onglets">Rêves précendents</h1>
    <?php

    if (isset($dreams)) { ?>
        <ol id="indexDreams-list">
            <?php
            $yearLastIteration = 0;
            $monthLastIteration = 0;
            $i = 0; //for li color
            foreach ($dreams as $dream) {
                if ($dream->yearFr != $yearLastIteration) {
                    echo '
                        <li class="indexDreams-3title" title="Cliquer pour fermer ou ouvrir les onglets de l\'année">
                            <h2 class="indexDreams-year">Année ' . $dream->yearFr . '</h2>
                        </li>';
                    $yearLastIteration = $dream->yearFr;
                    echo '
                           <li class="indexDreams-4title" title="Cliquer pour fermer ou ouvrir les onglets du mois">
                            <h3 class="indexDreams-month">' . ucfirst($dream->monthFr) . '</h3>
                           </li> ';
                    $monthLastIteration = $dream->monthFr;
                    echo '<li class="indexDreams-dateTime.' . $i . '">
                            <a href ="?p=dreams.read.' . $dream->id . '" title="Cliquer pour accéder au rêve"> 
                                <p>' . $dream->dayFr . '</p>
                                <p>' . $dream->hour . ' </p>
                            </a>
                        </li>';
                } else {
                    if ($dream->monthFr != $monthLastIteration) {
                        echo '
                            <li class="indexDreams-4title" title="Cliquer pour fermer ou ouvrir les onglets du mois">
                                <h3 class="indexDreams-month">' . ucfirst($dream->monthFr) . '</h3> 
                            </li>';
                        $monthLastIteration = $dream->monthFr;
                        echo '<li class="indexDreams-dateTime.' . $i . '">
                                 <a href ="?p=dreams.read.' . $dream->id . '" title="Cliquer pour accéder au rêve">
                                    <p>' . $dream->dayFr . '</p>
                                    <p>' . $dream->hour . ' </p>
                                </a>
                            </li>';
                    } else {
                        echo '<li class="indexDreams-dateTime.' . $i . '">
                                 <a href ="?p=dreams.read.' . $dream->id . '" title="Cliquer pour accéder au rêve">
                                    <p>' . $dream->dayFr . '</p>
                                    <p>' . $dream->hour . ' </p>
                                </a>
                        </li>';
                    }
                }
                $i++;
            }
            ?>
        </ol>
    <?php } else {
        echo '<h2>Vous n\'avez encore enregistré aucun rêve. </h2>';
    }
    ?>
</section>