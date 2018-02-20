<?php include_once($this->viewPath . 'dreams/nav.php');?>
<section id="indexDreams">

    <?php

    if (isset($dreams)) { ?>
        <ol id="indexDreams-list">
            <li class="indexDreams-2title"><h2>Rêves précendents</h2></li>
            <?php
            $yearLastIteration = 0;
            $monthLastIteration = 0;
            $i = 0; //for li color
            foreach($dreams as $dream) {
                if($dream->yearFr != $yearLastIteration) {
                    echo '<li class="indexDreams-3title"><h3 class="indexDreams-year">Année ' . $dream->yearFr . '</h3></li>';
                    $yearLastIteration = $dream->yearFr;
                    echo '<li class="indexDreams-4title"><h4 class="indexDreams-month">' . ucfirst($dream->monthFr) . '</h4></li> ';
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
                        echo '<li class="indexDreams-4title" > <h4 class="indexDreams-month">' . ucfirst($dream->monthFr) . '</h4> </li>';
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