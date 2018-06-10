<?php
/* Vista de contenido de tarjeta */

/* @var $model app\models\Tarjetas */
/* @var $adjunto app\models\Adjuntos */
/* @var $valoraciones app\models\TiposValoraciones */

use yii\helpers\Html;

?>
<?= $this->render('secciones_tarjeta', [
    'model'=>$model,
    'adjunto'=>$adjunto,
    'valoraciones'=>$valoraciones,
    'valoraciones_add'=>$valoraciones_add,

]) ?>
