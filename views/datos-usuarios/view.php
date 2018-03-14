<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

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
                <?= Html::encode($datos->nombre_completo) ?>
                <small>
                    <?= Html::encode('(' . $datos->usuario->nombre . ')') ?>
                </small>
            </h2>
            <p>
                <?= Html::encode($datos->descripcion)?>
            </p>
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

    <!-- Formulario de modificación de datos de perfil -->
    <?php $form = ActiveForm::begin(['id'=>'datos-usuario']) ?>

        <div class='row'>
            <div class='col-md-4 col-md-offset-3'>
                <?= $form->field($datos, 'nombre_completo') ?>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-4 col-md-offset-3'>
                <?= $form->field($datos, 'iniciales') ?>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-7 col-md-offset-3'>
                <?= $form->field($datos, 'descripcion')->textarea([
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
    <br>
    <?=
        Html::tag(
            'ul',
            Html::tag(
                'li',
                Html::a(
                    'Configuración de cuenta',
                    ['datos-usuarios/update', 'id'=>1]
                ),
                ['role'=>'presentation', 'class'=>'active']
            ),
            ['class'=>'nav nav-tabs']
        );
    ?>
    <br>

    <!-- Formulario de modificación de datos de cuenta -->
    <?php $form = ActiveForm::begin() ?>

        <div class='row'>
            <div class='col-md-5 '>
                <?= $form->field($cuenta, 'nombre')?>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-5 '>
                <?= $form->field($cuenta, 'password')
                    ->passwordInput()?>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-5 '>
                <?= $form->field($cuenta, 'password_repeat')
                    ->passwordInput()?>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-5 '>
                <?= $form->field($cuenta, 'email')?>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-5 '>
                <?= Html::submitButton('Guardar', ['class'=>'btn btn-success'])?>
            </div>
        </div>



    <?php ActiveForm::end() ?>


</div>
