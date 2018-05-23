<?php
/* Elementos del adjunto, la imágen y el texto */

/* @var $model app\models\Adjuntos */

use app\components\MyHelpers;
use yii\helpers\Html;

?>

<!-- Imágen del Adjunto -->
<div id='content_img_<?= $model->id ?>' class='col-xs-3 col-md-2'>
    <?=
        Html::img(
            'images/cargando.gif',
            [
                'alt'=>'adjunto',
                'class'=>'img-rounded image-link'
            ]
        )
    ?>
</div>

<!-- Nombre del adjunto -->
<div class='col-xs-5 col-md-6'>
    <?php
        if ($model->nombre !== null) {
            $nombre = $model->nombre;
        } else {
            $nombre = $model->url_direccion;
        }
    ?>
    <p>
        <!-- Nombre -->
        <strong>
            <?= Html::encode($nombre) ?>
        </strong>

        <!-- Intervalo -->
        <small>
            <?=
                Yii::$app->formatter->asRelativeTime($model->created_at);
            ?>
        </small>
    </p>
</div>
