<?php
/* Renderizar formulario de creación de tarjeta */

/* @var $this yii\web\View */
/* @var $model app\models\Tarjetas */
use yii\helpers\Html;
use yii\helpers\Url;

$url_create_tarjeta = Url::to(['tarjetas/create']);
$js = <<<EOT
    $(document).ready(function() {
        let form = $("#form_tarjeta_$lista->id");
        let url = '$url_create_tarjeta';
        let selector = $("div[data-key='$lista->id'] div.contenido_lista");
        let input = form.find('#denominacion');

        validarForm(form, url, 'POST', selector, input);

    })
EOT;

$this->registerJs($js);

?>

<?= $this->render('_form', [
    'model' => $model,
    'lista' => $lista,
    'label'=>'Crear',
]) ?>
