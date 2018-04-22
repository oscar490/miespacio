<?php
/* Renderizar formulario de creación de tarjeta */

/* @var $this yii\web\View */
/* @var $model app\models\Tarjetas */
use yii\helpers\Html;

?>

<?= $this->render('_form', [
    'model' => $model,
    'tablero'=>$tablero,
    'label'=>'Crear',
]) ?>
