<?php
/* Botones de acción sobre el mensaje */

/* @var $mensaje app\models\Mensajes */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;

$url_read = Url::to(['mensajes/read-mensaje', 'id'=>$mensaje->id]);

//  Lectura de mensaje.
$js = <<<EOT
    $("#view_contenido_$mensaje->id").on('shown.bs.modal', function() {

        if ($(`#mensaje_item_$mensaje->id`).hasClass('mensaje_sin_leer')) {
            sendAjax('$url_read', 'POST', {}, function(data) {
                $(`#mensaje_item_$mensaje->id`).removeClass('mensaje_sin_leer');
                $('span.badge').text(data);
            })
        }

    })
EOT;

$this->registerJs($js);

?>

<!-- Botón de modal de contenido de mensaje -->
<?php
    MyHelpers::modal_begin(
        MyHelpers::icon('glyphicon glyphicon-envelope')
            . ' ' . '<strong>Mensaje</strong>',
        MyHelpers::icon('glyphicon glyphicon-new-window'),
        'btn btn-default',
        "view_contenido_$mensaje->id"
    )
?>
    <?= $this->render('contenido_mensaje', [
        'mensaje'=>$mensaje,
    ]) ?>

<?php MyHelpers::modal_end() ?>
