<?php
/* Configuración del equipo */

/* @var $this yii\web\View */
/* @var $equipo app\models\Equipos */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\dialog\Dialog;


echo Dialog::widget([
    'dialogDefaults'=>[
        Dialog::DIALOG_CONFIRM => [
            'type'=>Dialog::TYPE_DANGER,
            'title'=>'Eliminar equipo',
            'btnOKLabel'=>'Si',
            'btnCancelLabel'=>'No',
            'btnOKClass'=>'btn-danger',
        ]
    ]
]);
$urlEliminarEquipo = Url::to(['equipos/delete', 'id'=>$equipo->id]);
$js = <<<EOT
    $('#btn-eliminar').on('click', function() {
        krajeeDialog.confirm("¿Deseas de verdad eliminarlo?", function (result) {
        if (result) {
            $.ajax({
                type: 'POST',
                url: "$urlEliminarEquipo",
            });
        }
    });
    })
EOT;

$this->registerJs($js);
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
                <?= $this->render('_form', [
                    'equipo'=>$equipo,
                ]) ?>
            </div>
        </div>
    </div>
</div>
<div class='row'>
    <div class='col-md-6 col-md-offset-5'>
        <?= Html::button(
            '¿Eliminar este equipo?',
            [
                'class'=>'btn btn-danger',
                'id'=>'btn-eliminar',
            ])
        ?>
    </div>
</div>
