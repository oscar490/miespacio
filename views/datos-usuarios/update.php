<?php
/* Modificación de los datos del usuario */

/* @var $this yii\web\View */
/* @var $model app\models\DatosUsuarios */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<br>
<div class="datos-usuarios-update">
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <!-- Formulario de datos de usuario -->
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    <?=
                        Html::tag(
                            'p',
                            Html::tag(
                                'span',
                                '',
                                ['class'=>'glyphicon glyphicon-edit']
                            ) . ' ' . 'Datos de perfil'
                        );
                    ?>
                </div>
                <div class='panel-body'>
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
