<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\components\MyHelpers;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\Tarjetas */

$url_update = Url::to(['tarjetas/render-update', 'id'=>$model->id]);

$js = <<<EOT
    $("#btn_update_$model->id").on('click', function() {

        $.ajax({
            url: '$url_update',
            type: 'GET',
            success: function(data) {
                $("div[data-key='$model->id']  div.modal-body > div.container").html(data);
            }
        })
    })

EOT;

$css = <<<EOT
    .titulo {
        margin-top: 0px;
        margin-bottom: 20px;
    }


EOT;

$this->registerCss($css);
$this->registerJs($js);
?>
<div class='container'>
    <div class='row'>
        <!-- Título de la tarjeta -->
        <div class='col-md-9 titulo'>
            <h3>
                <span class='label label-default'>
                    <strong>
                        <?= Html::encode($model->denominacion) ?>
                    </strong>
                </span>
            </h3>
        </div>

        <!-- Descripcion -->
        <div id='descripcion' class='col-md-7'>
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
                    <?= Html::encode($model->descripcion) ?>
                </div>
            </div>
        </div>

        <!-- Modificar tarjeta -->
        <div class='col-md-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <p>
                        <?=
                            Html::tag(
                                'span',
                                '',
                                ['class'=>'glyphicon glyphicon-edit']
                            ) . ' Personalizar'
                        ?>
                    </p>

                </div>
                <div class='panel-body'>
                    <?=
                        Html::button(
                            Html::tag(
                                'span',
                                '',
                                ['class'=>'glyphicon glyphicon-cog']
                            ),
                            [
                                'class'=>'btn btn-default btn-block',
                                'id'=>"btn_update_$model->id"
                            ]
                        );
                    ?>
                </div>
            </div>
        </div>


    </div>

    <div class='row'>
        <!-- Lista de adjuntos -->
        <div class='col-md-6'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <p>
                        <?=
                            Html::tag(
                                'span',
                                '',
                                ['class'=>'glyphicon glyphicon-paperclip']
                            ) . ' Adjuntos';
                        ?>
                    </p>
                </div>
                <div class='panel-body'>
                    <?= ListView::widget([
                        'dataProvider'=> new ActiveDataProvider([
                            'query'=>$model->getAdjuntos(),
                        ]),
                        'itemView'=>'_adjunto',
                        'summary'=>'',
                    ]) ?>
                </div>
            </div>
        </div>

        <!-- Añadir un nievo adjunto -->
        <div class='col-md-3'>
            <?= $this->render('/adjuntos/create', [
                'model'=>$adjunto,
                'tarjeta'=>$model,
            ]) ?>
        </div>
    </div>
</div>
