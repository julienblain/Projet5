<?php
if($dream[0]->previousDream !== 'notExist') { ?>
    <button id="readDream-previous"><a href="?p=dreams.read.<?= $dream[0]->previousDream ?>">Rêve précédent</a></button>

<?php }
if($dream[0]->nextDream !== 'notExist') {?>
    <button id="readDream-next"><a href="?p=dreams.read.<?= $dream[0]->nextDream ?>">Rêve suivant</a></button>
<?php } ?>