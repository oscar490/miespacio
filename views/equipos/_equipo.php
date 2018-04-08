<?php
/* Vista parcial de un equipo */
/* Se muestra un listado de los tableros que pertenecen a un equipo. */

/* @var $model app\models\Equipos */
/* @var $tablero_crear app\models\Tableros */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\Tableros;

$css = <<<EOT
    .logo-equipo {
        width: 56px;
        height: 47px;
    }

    #imagen_equipo {
        padding-right: 0px;
        width: 75px;
    }

    #texto_equipo {
        padding-left: 0px;
    }
EOT;

$this->registerCss($css);
?>

<!-- Nombre del equipo -->
<div class='row'>
    <div id='imagen_equipo' class='col-xs-1 col-md-1 col-lg-1'>
        <?=
            Html::img(
                $model->url_imagen,
                ['class'=>'img-circle logo-equipo']
            )
        ?>
    </div>
    <div id='texto_equipo' class='col-xs-8 col-md-11 col-lg-11'>

        <h4>
            <strong>
                <?= Html::encode($model->denominacion) ?>
            </strong>
        </h4>

    </div>

</div>


<!-- Tableros de cada equipo -->
<?= $this->render('tableros_equipo', [
    'tableros'=>new ActiveDataProvider([
        'query'=>$model->getTableros(),
    ]),
    'equipo'=>$model,
    'tablero_crear'=>$tablero_crear,
]) ?>
<hr>
