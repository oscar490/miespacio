<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $datos app\models\DatosUsuarios */
/* @var $cuenta app\models\Usuarios */

$this->title = 'Perfil | MiEspacio';
$this->params['breadcrumbs'][] = $this->title;

$css = <<<EOT
    #datos-cuenta {
        display: none;
    }
EOT;

$js = <<<EOT
    $('ul.nav-tabs li a').on('click', function(e) {
        e.preventDefault();
        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');
        $("div[id^='datos']").hide();

        switch ($(this).text()) {
            case 'Perfil':
                $('#datos-perfil').show();
                break;
            case 'Configuración':
                $('#datos-cuenta').show();
                break;

        }
    })

EOT;

$this->registerJs($js);
$this->registerCss($css);
?>
<div class="datos-usuarios-view">
    <div class='row'>
        <div class='col-md-4'>
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
    <br>
    <?=
        Html::tag(
            'ul',
            Html::tag(
                'li',
                Html::a(
                    'Perfil',
                    ['#']
                ),
                ['class'=>'active', 'role'=>'presentacion']
            ) .
            Html::tag(
                'li',
                Html::a(
                    'Configuración',
                    ['#']
                ),
                ['role'=>'presentacion']
            ),
            ['class'=>'nav nav-tabs']
        )

    ?>
    <br>
    <div class='row' id='datos-cuenta'>
        <div class='col-md-6 col-md-offset-3'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    <?= Html::encode('Datos de cuenta') ?>
                </div>
                <div class='panel-body'>
                    <?php $form = ActiveForm::begin() ?>

                        <?= $form->field($cuenta, 'nombre')?>

                        <?= $form->field($cuenta, 'password')->passwordInput()?>

                        <?= $form->field($cuenta, 'password_repeat')->passwordInput()?>

                        <?= $form->field($cuenta, 'email')?>

                        <?= Html::submitButton('Guardar', [
                            'class'=>'btn btn-success btn-block'
                            ])?>

                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>

    <div class='row' id='datos-perfil'>
        <div class='col-md-6 col-md-offset-3'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    <?= Html::encode('Datos de perfil') ?>
                </div>

                <div class='panel-body'>
                    <?php $form = ActiveForm::begin([
                        'action'=>['datos-usuarios/update', 'id'=>$cuenta->id]
                    ]) ?>

                        <?= $form->field($datos, 'nombre_completo') ?>

                        <?= $form->field($datos, 'iniciales') ?>

                        <?= $form->field($datos, 'descripcion')->textarea([
                                'rows'=>2,
                        ]) ?>

                        <?= Html::hiddeninput('usuario_id', Yii::$app->user->id)?>

                        <?= Html::submitButton('Editar perfil', [
                            'class'=>'btn btn-success btn-block'
                        ])?>

                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
