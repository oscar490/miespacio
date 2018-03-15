<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $datos app\models\DatosUsuarios */
/* @var $cuenta app\models\Usuarios */

$this->title = 'Perfil | MiEspacio';
$this->params['breadcrumbs'][] = $this->title;

// Estilos CSS.
$css = <<<EOT
    #datos-cuenta {
        display: none;
    }

    .contenedor {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    #foto {
        background-color: #D8D8D8;
        border-radius: 250px;
        width: 100px;
        height: 100px;
    }

    img {
        width: 80px;
        height: 80px:
    }

EOT;
 // Código JavaScript.
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
        <div class='col-md-6 col-md-offset-3'>
            <div class='contenedor'>
                <?php if (file_exists(Url::to(Yii::getAlias('@app/web/uploads/' . $datos->id . '.png')))): ?>
                    <img src="<?= Url::to('/uploads/' . $datos->id . '.png')?>">
                <?php else: ?>
                    <h2>
                        <span class='label label-primary icono-x3'>
                            <?= Html::encode($datos->iniciales) ?>
                        </span>

                    </h2>
                <?php endif; ?>

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

                        <?= $form->field($datos, 'imagen')->fileInput() ?>

                        <?= Html::submitButton('Editar perfil', [
                            'class'=>'btn btn-success btn-block'
                        ])?>

                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
