<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\components\MyHelpers;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Tarjetas */



$js = <<<EOT


EOT;

$this->registerJs($js);
?>
<div class='container'>
    <div class='row'>
        <div class='col-md-9'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <p>
                        <?=
                            Html::tag(
                                'span',
                                '',
                                ['class'=>'glyphicon glyphicon-pencil']
                            ) . ' Descripción'
                        ?>
                    </p>

                </div>
                <div class='panel-body'>
                </div>
            </div>
        </div>
    </div>
</div>
