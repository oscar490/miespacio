<?php

/* @var $equipo app\models\Equipos */

use yii\helpers\Html;
use yii\helpers\Url;

$datos = $equipo->usuario->datosUsuarios;

$css = <<<EOT
    #contenido {
        padding: 25px 25px 25px 25px;
        display: table-cell;
        border-radius: 4px;
        text-align: center;
    }

    #titulo {
        padding: 25px 25px 25px 25px;
        display: table-cell;
    }

    img {
        width: 100px;
        height: 100px;
    }

    #enlace {
        background-color: #4cae4c;
        color: white;
        padding: 10px 10px 10px 10px;
        display: table-cell;
        border-radius: 4px;
    }

    #enlace > a:link {
        text-decotion: none;
        color: white;
    }
EOT;
$this->registerCss($css);
?>


<div id='contenido'>
    <?= Html::img(
        'https://www.dropbox.com/s/ztgomv4squm9vuw/logotipo.png?dl=1'
    ) ?>

    <p>
        <strong>
            <?= $datos->nombre_completo ?> <?= $datos->apellidos ?>, con nombre
            de usuario <?= $equipo->usuario->nombre ?>, te ha añadido a su equipo
            <?= $equipo->denominacion ?>.

            <div id='enlace'>
                <?=
                    Html::a(
                        'Pincha aquí para acceder',
                        Url::to(['equipos/enlace-equipo', 'id'=>$equipo->id], true),
                        ['class'=>'btn btn-success']
                    )
                ?>
            </div>
        </strong>
    </p>
</div>
