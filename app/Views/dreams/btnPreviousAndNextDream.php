<?php
if($dream['previousDream'] !== 'notExist') { ?>
    <button id="readDream-previous"><a href="?p=dreams.read.<?= $dream['previousDream'] ?>">Rêve précédent</a></button>

<?php }
if($dream['nextDream'] !== 'notExist') {?>
    <button id="readDream-next"><a href="?p=dreams.read.<?= $dream['nextDream']?>">Rêve suivant</a></button>
<?php } ?>