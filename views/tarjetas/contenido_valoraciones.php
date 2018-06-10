<?php
/* Vista de contenido de valoraciones */

/* @var $valoracions yii\db\ActiveRecord */
/* @var $model app\models\Tarjetas */

$css = <<<EOT
    div[id^='view_valoraciones'] {
        height: 400px;
    }
EOT;

$this->registerCss($css);

?>
<div id="view_valoraciones_<?= $tarjeta->id ?>" class='content-scroll'>
    <?= $this->render('valoraciones', [
        'valoraciones'=>$valoraciones,
        'tarjeta'=>$tarjeta,
    ]); ?>
</div>
