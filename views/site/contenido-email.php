<?php

use yii\helpers\Html;
use yii\helpers\Url;

$css = <<<EOT

    .contenedor {
        border: solid 3px black;
        width: 500px;
        background-color: #0266a0;
        display: flex;
        flex-direction: column;
        border-radius: 8px;

    }

    .cabecera {
        background-color: #0266a0;
        color: white;
        display: flex;
        justify-content: center;
        border-radius: 8px;
    }

    .contenido {
        background-color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        border-radius: 8px;
    }

    .envio {
        background-color: #48a54e;
        width: 420px;
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .fila {
        display: flex;
        justify-content: center;
    }


    a:hover, a {
        color: white;
        text-decoration: none;
    }

    img {
        width: 60px;
        height: 60px;
    }
EOT;

$this->registerCss($css);

?>

<div class='contenedor'>
    <div class='cabecera'>
        <?=
            Html::img(
                '/images/logotipo.png'
            );
        ?>
        <?=
            Html::tag(
                'h3',
                Html::tag(
                    'strong',
                    Yii::$app->name
                )
            );

        ?>
    </div>
    <div class='contenido'>
        <div class='fila'>
            <?=
                Html::tag(
                    'h4',
                    Html::tag(
                        'strong',
                        'Confirmar el correo electrónico nuevo'
                    )
                );
            ?>
        </div>
        <div class='fila'>
            <?=
                Html::tag(
                    'p',
                    'Ha enviado una solicitud para añadir
                     el correo electrónico a su cuenta'
                )
            ?>
        </div>

        <div class='fila'>
            <?=
                Html::a(
                    Html::tag(
                        'div',
                        'Haz click aquí para confirmar esta dirección de
                         correo electrónico',
                        ['class'=>'envio']
                    ),
                    ['site/index']
                );
            ?>
        </div>
    </div>

</div>
