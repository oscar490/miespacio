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
$imagen = Yii::getAlias('@uploads/') . $datos->usuario_id . '.jpg';
?>
<div class="datos-usuarios-view">

    <!-- Nombre de usuario e imagen de perfil -->
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <div class='contenedor'>
                <?php if (file_exists($imagen)): ?>
                    <?=
                        Html::img(
                            '/uploads/' . $datos->id . '.jpg',
                            ['class'=>'img-rounded']
                        );
                    ?>
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

    <!-- Seleccionador de pestañas -->
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

    <!-- Formulario de datos de cuenta -->
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

    <!-- Formulario de datos de perfil -->
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
