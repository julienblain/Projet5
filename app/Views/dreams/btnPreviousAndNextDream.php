<?php
if ($dream[0]->previousDream !== 'notExist') { ?>
    <button id="previous" class="btn btnPreviousNext">
        <a href="?p=dreams.read.<?= $dream[0]->previousDream ?>" title="Rêve précédent">
            <i class="fa fa-arrow-left"></i>
        </a>
    </button>

<?php }
if ($dream[0]->nextDream !== 'notExist') { ?>
    <button id="next" class="btn btnPreviousNext">
        <a href="?p=dreams.read.<?= $dream[0]->nextDream ?>" title="Rêve suivant">
            <i class="fa fa-arrow-right"></i>
        </a>
    </button>
<?php } ?>

