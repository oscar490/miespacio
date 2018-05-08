<?php

/* @var $equipo app\models\Equipos */

use yii\helpers\Html;
use yii\helpers\Url;

$datos = $equipo->usuario->datosUsuarios;

$css = <<<EOT
    #contenido {
        background-color: #0266a0;
        color: white;
        padding: 25px 25px 25px 25px;
        display: table-cell;
        border-radius: 4px;
    }

    #titulo {
        padding: 25px 25px 25px 25px;
        display: table-cell;
    }

    img {
        width: 50px;
        height: 50px;
    }

    #enlace {
        background-color: #4cae4c;
        color: white;
        padding: 10px 10px 10px 10px;
        display: table-cell;
        border-radius: 4px;
    }

    #enlace > a {
        display: none;
    }
EOT;
$this->registerCss($css);
?>


<div id='contenido'>
    <p>
        <strong>
            <?= $datos->nombre_completo ?> <?= $datos->apellidos ?>, con nombre
            de usuario <?= $equipo->usuario->nombre ?>, te ha añadido a su equipo
            <?= $equipo->denominacion ?>.

            <div id='enlace'>
                <?=
                    Html::a(
                        'Pincha aquí para acceder',
                        Url::to(['equipos/view', 'id'=>$equipo->id], true),
                        ['class'=>'btn btn-success']
                    )
                ?>
            </div>
        </strong>
    </p>
</div>
