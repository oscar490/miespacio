<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EquiposSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $tablero yii\data\ActiveDataProvider */
/* @var $equipo app\models\Equipos */

$this->title = 'Tableros | MiEspacio';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipos-index">

    <?= ListView::widget([
        'dataProvider'=>$dataProvider,
        'itemView'=>'_equipo',
        'summary'=>'',
    ])?>
</div>

<div class='row'>
    <div class='col-md-4'>
        <div class='panel panel-primary'>
            <div class='panel-heading'>
                <?= Html::encode('Crear nuevo equipo') ?>
            </div>
            <div class='panel-body'>
                <?php $form = ActiveForm::begin([
                    'action'=>['equipos/create'],
                ]) ?>

                    <?= $form->field($equipo, 'denominacion') ?>

                    <?= $form->field($equipo, 'descripcion')->textarea([
                        'rows'=>3,
                    ])?>

                    <?= Html::hiddenInput('usuario_id', Yii::$app->user->id) ?>

                    <?= Html::submitButton('Crear nuevo equipo', ['class'=>'btn btn-success'])?>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>
