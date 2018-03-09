<?php

use yii\helpers\Html;
use yii\helpers\Url;



$this->registerCss($css);

?>

<div class='contenedor'>
    <div class='cabecera'>
        <?=
            Html::tag(
                'h3',
                 Yii::$app->name
            );

        ?>
    </div>
    <div>
        <?=
            Html::tag(
                'p',
                'Ha enviado una solicitud para añadir
                 el correo electrónico a su cuenta'
            )
        ?>

        <?=
            Html::a('Click aqui', ['site/index'])
        ?>
    </div>
</div>
