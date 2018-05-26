<?php
/* Vista de elemento de botón para mostrar el contenido del adjunto */

/* @var $adjunto app\models\Adjuntos */

use yii\helpers\Html;
use app\components\MyHelpers;

//  Se modifica la dirección URL para ver el Contenido
//  del adjunto.

if (!$adjunto->esEnlace) {
    $cadena = $adjunto->url_direccion;
    $direccion = substr($cadena, 0, strlen($cadena) - 1);
    $direccion .= '0';

} else {
    $direccion = $adjunto->url_direccion;
}

$icono = MyHelpers::icon('glyphicon glyphicon-eye-open');
$class = 'btn btn btn-default';
$tarjeta = $adjunto->tarjeta;

//  Mostrar imagen ampliada.
$js = <<<EOT
    $("#btn_view_file_tarjeta_$adjunto->id").on('click', function(e) {
        let content = $("#view_imagen_$tarjeta->id");
        content.empty();

        let imagen = $('<img>');
        imagen.attr('src', '$adjunto->url_direccion');
        imagen.hide();
        content.append(imagen);
        imagen.fadeIn();

    })
EOT;

$this->registerJs($js);

?>

<?php if (!$adjunto->esImagen): ?>
    <?= Html::a(
            $icono,
            $direccion,
            ['class'=>$class, 'target'=>'_blank']
        );
    ?>

<?php else: ?>
    <?= Html::button(
        $icono,
        [
            'class'=>$class,
            'id'=>"btn_view_file_tarjeta_$adjunto->id"
        ])
    ?>
<?php endif; ?>
