<?php
/* Lista de tarjetas */

/* @var $lista app\models\Listas */

use yii\helpers\Html;
use app\models\Miembros;

$tarjetas = $lista->getTarjetas()->orderBy(['created_at'=>SORT_DESC])->all();
$miembro = Miembros::find()
    ->where([
        'usuario_id'=>Yii::$app->user->id,
        'equipo_id'=>$lista->tablero->equipo->id,
    ])->one();
?>
<ul id="lista_<?= $lista->id ?>"  data-key="<?= $lista->id ?>"
        class='contenedor'>
    <?php foreach ( $tarjetas as $elem):
        if ($elem->esta_oculta && !$miembro->esPropietario) {
            continue;
        }
    ?>

        <?= $this->render('_tarjeta', [
            'tarjeta'=>$elem,
            'adjunto'=>$adjunto,
        ]) ?>

    <?php endforeach; ?>
</ul>
