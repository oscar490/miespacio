<?php
/* Formulario para modificar imágen de equipo */

use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Html;
?>
<br>
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
                            ['class'=>'glyphicon glyphicon-picture']
                        ) . ' Imágen de equipo'
                    );
                ?>
            </div>
            <div class='panel-body'>
                <?php $form = ActiveForm::begin() ?>

                    <?= $form->field($equipo, 'imagen')->widget(FileInput::className(), [
                        'options'=>['accept'=>'image/*'],
                        'pluginOptions'=>[
                            'showUpload'=>false,
                            'showPreview' => false,
                            'browseIcon'=> '<i class="glyphicon glyphicon-picture"></i>',
                        ],
                    ]);
                    ?>

                    <?= Html::submitButton('Cambiar imágen',[
                        'class'=>'btn btn-success btn-block'
                        ])
                    ?>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>
