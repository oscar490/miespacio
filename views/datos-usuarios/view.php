<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use Yii;

/* @var $this yii\web\View */
/* @var $model app\models\DatosUsuarios */

$this->title = 'Perfil | MiEspacio';
$this->params['breadcrumbs'][] = $this->title;

$css = <<<EOT
    #datos-usuario {
        display: none;
    }
EOT;

$js = <<<EOT
    $('#editar').on('click', function() {
        $('#datos-usuario').fadeIn();
        $('.row').first().hide();
        $('#editar').hide();
    });

    $('#cancelar').on('click', function() {
        $('#datos-usuario').hide();
        $('.row').first().show();
        $('#editar').show();
    })
EOT;

$this->registerJs($js);
$this->registerCss($css);
?>
<div class="datos-usuarios-view">

    <div class='row'>
        <div class='col-md-4 col-md-offset-3'>
            <h2>
                <?= Html::encode($model->nombre_completo) ?>
                <small>
                    <?= Html::encode('(' . $model->usuario->nombre . ')') ?>
                </small>
            </h2>
        </div>
    </div>

    <div class='row'>
        <div class='col-md-4 col-md-offset-3'>
            <?=
                Html::button(
                    Html::tag(
                        'span',
                        '',
                        [
                            'class'=>'glyphicon glyphicon-pencil',
                            'aria-hidden'=>true,
                        ]
                    ). ' Editar perfil', [
                        'class'=>'btn btn-default',
                        'id'=>'editar',
                    ]
                )
            ?>
        </div>
    </div>

    <?php $form = ActiveForm::begin(['id'=>'datos-usuario']) ?>

        <div class='row'>
            <div class='col-md-4 col-md-offset-3'>
                <?= $form->field($model, 'nombre_completo') ?>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-4 col-md-offset-3'>
                <?= $form->field($model->usuario,'nombre')?>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-4 col-md-offset-3'>
                <?= $form->field($model, 'iniciales') ?>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-7 col-md-offset-3'>
                <?= $form->field($model, 'descripcion')->textarea([
                    'rows'=>2,
                ]) ?>
            </div>
        </div>

        <?= Html::hiddeninput('usuario_id', Yii::$app->user->id)?>

        <div class='row'>
            <div class='col-md-7 col-md-offset-3'>
                <?= Html::submitButton('Guardar', ['class'=>'btn btn-success'])?>
                <?= Html::button('Cancelar', [
                    'class'=>'btn btn-primary',
                    'id'=>'cancelar',
                ])?>
            </div>
        </div>


    <?php ActiveForm::end() ?>

    <hr>

</div>
