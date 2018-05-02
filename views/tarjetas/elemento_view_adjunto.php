<?php
/* Vista de elemento de botón para mostrar el contenido del adjunto */

/* @var $adjunto app\models\Adjuntos */

use yii\helpers\Html;
use app\components\MyHelpers;

$js = <<<EOT

    $("#btn_adjunto_view_$adjunto->id").on('click', function() {
        alert('hola $adjunto->id')
    })
EOT;


//  Se modifica la dirección URL para ver el Contenido
//  del adjunto.
$cadena = $adjunto->url_direccion;
$direccion = substr($cadena, 0, strlen($cadena) - 1);
$direccion .= '0';

$icono = MyHelpers::icon('glyphicon glyphicon-eye-open');
$class = 'btn btn btn-default';

?>

<?= Html::a(
    $icono,
    (!$adjunto->es_imagen)
        ? $adjunto->url_direccion : $direccion,
    [
        'class'=>$class,
        'target'=>'_blank'
    ])
?>
