<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\components\MyHelpers;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\DatosUsuarios */
/* @var $cuenta app\models\Usuarios */

$this->title = 'Perfil | MiEspacio';
$this->params['breadcrumbs'][] = $this->title;

$items = [
    [
        'label'=>"<span class='glyphicon glyphicon-edit'></span> Datos de perfil",
        'content'=>$this->render('update', [
            'model'=>$model,
        ]),
        'active'=>true,
    ],
    [
        'label'=>"<span class='glyphicon glyphicon-user'></span> Datos de cuenta",
        'content'=>$this->render('/usuarios/update', [
            'model'=>$model->usuario,
        ]),
    ],
];
?>
<div class="datos-usuarios-view">

    <!-- Nombre de usuario e imagen de perfil -->
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <div class='contenedor'>
                <h2>
                    <span class='label label-primary icono-x3'>
                        <span class='glyphicon glyphicon-user'>
                        </span>
                    </span>

                </h2>
                <h2>
                    <?= Html::encode($model->nombre_completo) ?>
                    <small>
                        <?= Html::encode('(' . $model->usuario->nombre . ')') ?>
                    </small>
                </h2>
                <p>
                    <?= Html::encode($model->descripcion)?>
                </p>
            </div>

        </div>
    </div>
    <br>

    <?= MyHelpers::tabs($items) ?>



</div>
