<?php
/* Renderizar formulario de creación de tarjeta */

/* @var $this yii\web\View */
/* @var $model app\models\Tarjetas */
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerJsFile(
    '/js/tarjeta.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$url_create_tarjeta = Url::to(['tarjetas/create']);
$js = <<<EOT
    $(document).ready(function() {
        let form = $("#form_tarjeta_$lista->id");
        let url = '$url_create_tarjeta';

        createTarjeta('$url_create_tarjeta', form);
    })
EOT;

$this->registerJs($js);

?>

<?= $this->render('_form', [
    'model' => $model,
    'lista' => $lista,
    'label'=>'Crear',
    'id'=>"form_tarjeta_$lista->id",
    'action'=>['tarjetas/validate-ajax', 'id'=>$model->id]
]) ?>
