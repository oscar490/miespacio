<?php
/* Vista parcial de un equipo */
/* Se muestra un listado de los tableros que pertenecen a un equipo. */

/* @var $model app\models\Equipos */
/* @var $tablero_crear app\models\Tableros */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\Tableros;

$imagen = $model->url_imagen;

$js = <<<EOT
    $(document).ready(function() {
        $('#imagen_equipo_$model->id img').attr('src', '$imagen');
    })
EOT;

$this->registerJs($js);
$this->registerCssFile('/css/equipo.css');
?>


<div class='row'>
    <!-- Imágen del equipo -->
    <?=
        Html::tag(
            'div',
            Html::img(
                'images/cargando.gif',
                ['class'=>'img-circle logo-equipo']
            ),
            [
                'class'=>'col-xs-3 col-md-1 col-lg-1 img_equipo',
                'id' => "imagen_equipo_$model->id"
            ]
        )
    ?>

    <!-- Nombre del equipo -->
    <div id='texto_equipo' class='col-xs-8 col-md-11 col-lg-11'>

        <h4>
            <strong>
                <?= Html::encode($model->denominacion) ?>
            </strong>
        </h4>

    </div>

</div>


<!-- Tableros del equipo -->
<?= $this->render('tableros_equipo', [
    'tableros'=>new ActiveDataProvider([
        'query'=>$model->getTableros(),
    ]),
    'equipo'=>$model,
    'tablero_crear'=>$tablero_crear,
]) ?>


<!-- Enlace a los tableros del equipo actual -->
<?=
    Html::a(
        "<span class='glyphicon glyphicon-menu-hamburger'></span> Tableros",
        ['equipos/view', 'id'=>$model->id],
        ['class'=>'btn btn-info']
    )
?>

<hr>
