<?php
/* Configuración del equipo */

/* @var $this yii\web\View */
/* @var $equipo app\models\Equipos */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<br>
<div class="row">
    <div class='col-md-6 col-md-offset-3'>
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
</div>
