<?php
/* Renderización del formulario de modificación de tarjeta */

/* @var $this yii\web\View */
/* @var $model app\models\Tarjetas */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\dialog\Dialog;

$this->registerJsFile(
    '/js/tarjeta.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$url_update_tarjeta = Url::to(['tarjetas/update-ajax', 'id'=>$model->id]);
$url_render_listas = Url::to([
    'listas/render-listas',
    'id_tablero'=>$model->lista->tablero->id]);
$js = <<<EOT
    $(document).ready(function() {
        let form_update_tarjeta = $("#form_update_tarjeta_$model->id");

        updateTarjeta(
            '$url_update_tarjeta',
            form_update_tarjeta,
            '$model->id',
            '$url_render_listas'
        );
    })
EOT;

$this->registerJs($js);
$lista = $model->lista;
?>

<?= $this->render('_form', [
    'model'=>$model,
    'lista'=>$lista,
    'label'=>'Modificar',
    'id'=>"form_update_tarjeta_$model->id",
    'action'=>['tarjetas/update', 'id'=>$model->id],
]) ?>
