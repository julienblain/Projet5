<?php
if ($dream[0]->previousDream !== 'notExist') { ?>
    <a id="previous" class="btn btnPreviousNext" href="?p=dreams.read.<?= $dream[0]->previousDream ?>"
       title="Rêve précédent">
        <i class="fas icon-arrow-left"></i>
    </a>
<?php }

if ($dream[0]->nextDream !== 'notExist') { ?>
    <a id="next" class="btn btnPreviousNext" href="?p=dreams.read.<?= $dream[0]->nextDream ?>" title="Rêve suivant">
        <i class="fa icon-arrow-right"></i>
    </a>
<?php } ?>
