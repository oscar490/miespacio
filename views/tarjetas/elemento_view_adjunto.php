<?php
/* Vista de elemento de botón para mostrar el contenido del adjunto */

/* @var $adjunto app\models\Adjuntos */

use yii\helpers\Html;
use app\components\MyHelpers;




//  Se modifica la dirección URL para ver el Contenido
//  del adjunto.
$cadena = $adjunto->url_direccion;
$direccion = substr($cadena, 0, strlen($cadena) - 1);
$direccion .= '0';

$icono = MyHelpers::icon('glyphicon glyphicon-eye-open');
$class = 'btn btn btn-default';

$js = <<<EOT
    $("#btn_view_file_tarjeta_$adjunto->id").on('click', function(e) {
        e.preventDefault();
        mostrar_imagen('$adjunto->url_direccion');
    })
EOT;

$this->registerJs($js);

?>

<?= Html::button(
    $icono,
    [
        'class'=>$class,
        'target'=>'_blank',
        'id'=>"btn_view_file_tarjeta_$adjunto->id"
    ])
?>
