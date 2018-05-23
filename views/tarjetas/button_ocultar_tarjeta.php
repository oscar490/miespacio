<?php
/* Vista de botón de ocultar tarjeta */

/* @var $tarjeta app\models\Tarjetas */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;

if (!$tarjeta->esta_oculta) {
    $nombre = ' Ocultar';
    $icon = 'glyphicon glyphicon-eye-close';

} else {
    $nombre = ' Mostrar';
    $icon = 'glyphicon glyphicon-eye-open';
}

$url_ocultar = Url::to(['tarjetas/ocultar', 'id'=>$tarjeta->id]);
$lista = $tarjeta->lista;

$miembro = $lista->tablero->equipo
    ->getMiembros()
    ->where(['usuario_id'=>Yii::$app->user->id])
    ->one();

$js = <<<EOT

    $('#btn_ocultar_tarjeta_$tarjeta->id').on('click', function() {
        sendAjax('$url_ocultar', 'POST', {lista_id: '$lista->id'}, function(data) {
            let nombre = ' Ocultar';
            let icon = 'glyphicon glyphicon-eye-close';
            let mensaje = 'Esta tarjeta se muestra para los miembros';

            $('#btn_ocultar_tarjeta_$tarjeta->id').empty();
            console.log(data);
            if (data) {
                nombre = ' Mostrar';
                icon = 'glyphicon glyphicon-eye-open';
                mensaje = 'Esta tarjeta está oculta para los miembros';
            }

            let btn_nombre = $('<span></span>');
            let btn_icon = $('<span></span>');

            btn_nombre.text(nombre);
            btn_icon.addClass(icon);
            $('#btn_ocultar_tarjeta_$tarjeta->id').append(btn_icon, btn_nombre);

            growl_success(mensaje);
        })
    })

EOT;

$this->registerJs($js);

?>

<?php if ($miembro->esPropietario): ?>
    <?=
        Html::button(
            MyHelpers::icon($icon)
                . ' ' . Html::tag('span', $nombre),
            [
                'class'=>'btn btn-default',
                'id'=>"btn_ocultar_tarjeta_$tarjeta->id"
            ]
        );
    ?>
<?php endif; ?>
