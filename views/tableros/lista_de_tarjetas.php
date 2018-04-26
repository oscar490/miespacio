<?php

use yii\helpers\Html;


?>

<ul id="lista_<?= $lista->id ?>"  data-key="<?= $lista->id ?>"
        class='contenedor'>
    <?php foreach ($lista->getTarjetas()->orderBy(['created_at'=>SORT_DESC])->all() as $elem): ?>
        <?= $this->render('_tarjeta_nueva', [
            'tarjeta'=>$elem
        ]) ?>
    <?php endforeach; ?>
</ul>
