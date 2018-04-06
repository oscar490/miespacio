<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\MyHelpers;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Equipos */
/* @var $tableros app\models\Tableros */
/* @var $tablero_crear app\models\Tableros */


$this->title = $model->denominacion;
$this->params['breadcrumbs'][] = [
    'label' => 'Tableros | MiEspacio',
    'url' => ['equipos/gestionar-tableros']
];

//  Contenido de pestañas
$items = [
    [
        //  Lista de tableros del equipo.
        'label'=>"<span class='glyphicon glyphicon-align-justify'></span>
                Tableros",
        'content'=> $this->render('tableros_equipo', [
            'tableros'=>$tableros,
            'tablero_crear'=>$tablero_crear,
            'equipo'=>$model,
        ]),
    ],
    [
        //  Modificación del equipo.
        'label'=>"<span class='glyphicon glyphicon-wrench'></span>
                Configuración",
        'content'=> $this->render('update', [
            'equipo'=>$model,
        ]),
    ]
];
$css = <<<EOT
    .contenido {
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }

    .contenido > img {
        width: 233px;
        height: 189px;
    }
EOT;

$this->registerCss($css);

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipos-view">
    <!-- Nombre del equipo e imagen -->
    <div class='row'>
        <div class='contenido'>
                <?=
                    Html::img(
                        $model->url_imagen,
                        ['class'=>'img-circle']
                    );
                ?>
                <h2>
                    <strong>
                        <?= Html::encode($this->title) ?>
                    </strong>
                </h2>
            <br>
            <p><?= Html::encode($model->descripcion) ?></p>
        </div>
    </div>
    <br>

    <!-- Pestañas de selección -->
    <?= MyHelpers::tabs($items) ?>

</div>
