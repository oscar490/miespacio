<?php
/* Lista de tarjetas */

/* @var $lista app\models\Listas */

use yii\helpers\Html;

$tarjetas = $lista->getTarjetas()->orderBy(['created_at'=>SORT_DESC])->all();
?>
<ul id="lista_<?= $lista->id ?>"  data-key="<?= $lista->id ?>"
        class='contenedor'>
    <?php foreach ( $tarjetas as $elem): ?>

        <?= $this->render('_tarjeta', [
            'tarjeta'=>$elem
        ]) ?>

    <?php endforeach; ?>
</ul>
