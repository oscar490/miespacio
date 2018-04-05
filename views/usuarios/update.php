<?php
/* Modificacion de usuario */

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

use yii\helpers\Html;

?>
<br>
<div class="usuarios-update">
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    <?=
                        Html::tag(
                            'p',
                            Html::tag(
                                'span',
                                '',
                                ['class'=>'glyphicon glyphicon-edit']
                            ) . ' ' . 'Datos de cuenta'
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
