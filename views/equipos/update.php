<?php
/* Configuración del equipo */

/* @var $this yii\web\View */
/* @var $equipo app\models\Equipos */

use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>
<br>
<div class="row">
    <div class='col-md-6'>
        <div class='panel panel-primary'>
            <div class='panel-heading'>
                <?=
                    Html::tag(
                        'p',
                        Html::tag(
                            'span',
                            '',
                            ['class'=>'glyphicon glyphicon-wrench']
                        ) . ' Configuración'
                    );
                ?>
            </div>
            <div class='panel-body'>
                <?= $this->render('form-crear-equipo', [
                    'equipo'=>$equipo,
                ]) ?>
            </div>
        </div>
    </div>

    <div class='col-md-6'>
        <div class='panel panel-primary'>
            <div class='panel-heading'>
                <?=
                    Html::encode('imagen');
                ?>
            </div>
            <div class='panel-body'>
                <?php $form = ActiveForm::begin([
                    'action'=>['site/upload', 'alias_nombre'=>$nombre_imagen],
                ]) ?>
                    <?= $form->field($imagen, 'imagen')->fileInput() ?>
                    <?= Html::submitButton('Subir', ['class'=>'btn btn-success'])?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>



</div>
