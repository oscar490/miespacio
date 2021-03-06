<?php

/** Contenido de la tarjeta */

/* @var $tarjeta app\models\Tarjetas */
/* @var $adjunto app\models\Adjuntos */

use app\components\MyHelpers;
use yii\helpers\Html;
use app\models\Miembros;
use yii\helpers\Url;

$miembro = Miembros::find()
    ->where([
        'equipo_id'=>$tarjeta->lista
            ->tablero->equipo->id,
        'usuario_id'=>Yii::$app->user->id
    ])->one();

$url_render = Url::to(['tarjetas/view', 'id'=>$tarjeta->id]);

$css = <<<EOT
    div[id^='modal_view_tarjeta'] div.modal-body {
        display: none;
    }
EOT;

// $this->registerCss($css);
$js = <<<EOT

    $("#modal_view_tarjeta_$tarjeta->id").on('shown.bs.modal', function() {

            sendAjax('$url_render', 'GET', {}, function(data) {
                let contenedor = $("#modal_view_tarjeta_$tarjeta->id div.modal-body");
                contenedor.html(data);
            });
    });
    $("#modal_view_tarjeta_$tarjeta->id").on('hidden.bs.modal', function() {
        let contenedor = $("#modal_view_tarjeta_$tarjeta->id div.modal-body");
        contenedor.empty();
        let imagen = $('<img>');
        let content = $('<div></div>');
        content.addClass('centrado');

        imagen.attr('src', 'images/cargando.gif');
        imagen.addClass('logo-x2');
        content.append(imagen);

        contenedor.append(content);
    })


EOT;

$this->registerJs($js);
?>
<!-- Modal contenido tarjeta -->
<?php MyHelpers::modal_begin(
        MyHelpers::icon('glyphicon glyphicon-info-sign') .
        ' ' . '<strong>Contenido de tarjeta</strong>',
        MyHelpers::icon('glyphicon glyphicon-eye-open'),
        'btn btn-xs btn-default',
        "modal_view_tarjeta_$tarjeta->id"
); ?>
    <div class='centrado'>
        <?=
            Html::img(
                'images/cargando.gif',
                ['class'=>'logo-x2']
            );
        ?>
    </div>

<?php MyHelpers::modal_end() ?>

<?php if ($miembro->esPropietario): ?>
    <!-- Botón de eliminar tarjeta -->
    <?=
        Html::button(
            MyHelpers::icon('glyphicon glyphicon-remove'),
            [
                'class'=>'btn btn-xs btn-default',
                'id'=>"btn_delete_tarjeta_$tarjeta->id",
            ]
        );
    ?>

<?php endif; ?>
