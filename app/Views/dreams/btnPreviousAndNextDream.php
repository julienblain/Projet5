
<?php
if($dream[0]->previousDream !== 'notExist') { ?>
    <button id="previous" class="btn btnPreviousNext">
        <a href="?p=dreams.read.<?= $dream[0]->previousDream ?>">
            <i class="fa fa-arrow-left"></i>
        </a>
    </button>

<?php }
if($dream[0]->nextDream !== 'notExist') {?>
    <button id="next" class="btn btnPreviousNext">
        <a href="?p=dreams.read.<?= $dream[0]->nextDream ?>">
            <i class="fa fa-arrow-right"></i>
        </a>
    </button>
<?php } ?>

