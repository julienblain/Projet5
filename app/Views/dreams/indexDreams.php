<?php include_once($this->viewPath . 'dreams/nav.php');?>
<section id="indexDreams">

    <?php

    if (isset($dreams)) { ?>
        <ol id="indexDreams-list">
            <h2><p>Rêves précendents</p></h2>
            <?php
            $yearLastIteration = 0;
            $monthLastIteration = 0;
            $i = 0; //for li color
            foreach($dreams as $dream) {
                if($dream->yearFr != $yearLastIteration) {
                    echo '<h3 class="indexDreams-year"><p>Année '.$dream->yearFr .'</p></h3>';
                    $yearLastIteration = $dream->yearFr;
                    echo '<h4 class="indexDreams-month"><p>'. ucfirst($dream->monthFr).'</p></h4>';
                    $monthLastIteration = $dream->monthFr;
                    echo '<li class="indexDreams-dateTime.'.$i.'">
                            <a href ="?p=dreams.read.'.$dream->id.'"> 
                                <p>'.$dream->dayFr.'</p>
                                <p>'.$dream->hour.' </p>
                            </a>
                        </li>';
                }
                else {
                    if($dream->monthFr != $monthLastIteration) {
                        echo '<h4 class="indexDreams-month"><p>'. ucfirst($dream->monthFr).'</p></h4>';
                        $monthLastIteration = $dream->monthFr;
                        echo '<li class="indexDreams-dateTime.'.$i.'">
                                 <a href ="?p=dreams.read.'.$dream->id.'">
                                    <p>'.$dream->dayFr.'</p>
                                    <p>'.$dream->hour.' </p>
                                </a>
                        </li>';
                    }
                    else {
                        echo '<li class="indexDreams-dateTime.'.$i.'">
                                 <a href ="?p=dreams.read.'.$dream->id.'">
                                    <p>'.$dream->dayFr.'</p>
                                    <p>'.$dream->hour.' </p>
                                </a>
                        </li>';
                    }
                }
                $i ++;
            }
            ?>
        </ol>
    <?php }
    else {
        echo '<h2>Vous n\'avez encore enregistré aucun rêve. </h2>';
    }
    ?>

</section>