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

$css= <<<EOT
    .panel-info {
        display: none;
    }
EOT;

$js = <<<EOT
    $('#crear-equipo').on('click', function() {
        $('.panel-info').fadeIn();
        $(this).hide();
    })

    $('#cancelar-crear').on('click', function() {
        $(this).closest('.panel-info').hide();
        $('#crear-equipo').fadeIn();
    })
EOT;
$this->registerCss($css);
$this->registerJs($js);
?>
<div class="equipos-index">

    <?= ListView::widget([
        'dataProvider'=>$equipos,
        'itemView'=>'_equipo',
        'viewParams'=>[
            'tableroCrear'=>$tableroCrear,
        ],
        'summary'=>'',
    ])?>
</div>

<?= Html::button('Crear un equipo nuevo', [
    'class'=>'btn btn-info',
    'id'=>'crear-equipo',
])?>

<div class='row'>
    <div class='col-md-4'>
        <div class='panel panel-info'>
            <div class='panel-heading'>
                <?= Html::encode('Crear un nuevo equipo') ?>
            </div>
            <div class='panel-body'>
                <?php $form = ActiveForm::begin([
                    'action'=>['equipos/create'],
                    'enableAjaxValidation' => true,
                    'id'=>'form-crear-equipo',
                ]) ?>

                    <?= $form->field($equipoCrear, 'denominacion', ['enableAjaxValidation' => true]) ?>

                    <?= $form->field($equipoCrear, 'descripcion')->textarea([
                        'row'=>5,
                    ]) ?>

                    <?= Html::submitButton('Crear', ['class'=>'btn btn-success'])?>
                    <?= Html::button('Cancelar', [
                        'class'=>'btn btn-default',
                        'id'=>'cancelar-crear',
                    ])?>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>
