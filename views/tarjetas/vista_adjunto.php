<?php
/* Vista del contenido del Adjunto */

/* @var $adjunto app\models\Adjuntos */

use yii\helpers\Html;

?>

<?=
    Html::img(
        $adjunto->url_direccion,
        ['alt'=>'content']
    );
?>
