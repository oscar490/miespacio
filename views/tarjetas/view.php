<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Tarjetas */


$url = Url::to(['tarjetas/delete', 'id'=>$model->id]);
$js = <<<EOT

    eliminarElemento($('div.modal-body button#btn_delete_$model->id'), '$url');
EOT;

$this->registerJs($js);
?>
<div class='container'>
    <div class='row'>
        <div class='col-md-6'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <?= Html::encode('Descripción') ?>
                </div>
                <div class='panel-body'>

                </div>
            </div>
        </div>

        <div class='col-md-3'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <?= Html::encode('Acciones') ?>
                </div>
                <div class='panel-body'>
                    <?= Html::button(
                        'Eliminar',
                        [
                            'class'=>'btn btn-default btn-block',
                            'id'=>"btn_delete_$model->id",
                        ]
                    ) ?>
                </div>
            </div>
        </div>
    </div>
</div>
