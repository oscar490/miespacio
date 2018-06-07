<?php
/* Vista de contenido de tarjeta */

/* @var $model app\models\Tarjetas */
/* @var $adjunto app\models\Adjuntos */

use yii\helpers\Html;
?>
<?= $this->render('secciones_tarjeta', [
    'model'=>$model,
    'adjunto'=>$adjunto,

]) ?>
