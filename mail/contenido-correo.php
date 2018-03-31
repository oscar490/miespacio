<?php

/* @ $token_acti app\models\Usuarios */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<?=
    Html::tag(
        'div',
        Html::tag(
            'div',
            Html::tag(
                'h3',
                Html::tag(
                    'strong',
                    Yii::$app->name
                )
            ),
            ['class'=>'cabecera']
        ) .
        Html::tag(
            'div',
            Html::tag(
                'h4',
                'Confirmar el correo electrónico nuevo'
            ) .
            Html::tag(
                'p',
                'Ha enviado una solicitud para añadir el correo
                electrónico a su cuenta.'
            ) .
            Html::a(
                'Haz click aquí para confirmar esta dirección de
                correo electrónico',
                Url::to(['usuarios/validar-correo', 'token_acti'=>$usuario->token_acti], true)
            ),
            ['class'=>'contenido']
        ),
        ['class'=>'contenedor']
    )
?>
