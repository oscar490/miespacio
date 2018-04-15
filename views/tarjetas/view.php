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
$url_adjunto = Url::to(['adjuntos/create-ajax']);

$js = <<<EOT
    $("#btn_update_$model->id").on('click', function() {

        $.ajax({
            url: '$url_update',
            type: 'GET',
            success: function(data) {
                $("div[data-key='$model->id']  div.modal-body > div.container").html(data);
            }
        })
    });

    $("#form_imagen_$model->id").on('beforeSubmit', function(e) {
        e.preventDefault();

        let img = $('<img>');
        img.attr('src', 'images/cargando2.gif');
        $('div#loading').empty();
        $('div#loading').append(img);

        var form = $(this);

        if (form.find('.has-error').length) {
            console.log('entra');
            return false;
        }
        console.log('hola');
        $.ajax({
            url: '$url_adjunto',
            type: 'POST',
            data: new FormData(this),
            enctype: 'multipart/form-data',
            success: function(data) {
                $('div#loading').empty();
                $("div[data-key='$model->id'] div#lista_adjunto").html(data);
            },
            dataType: 'json',
            contentType: false,
            processData: false,

        })
        return false;


    });
EOT;

$css = <<<EOT
    .titulo {
        margin-top: 0px;
        margin-bottom: 20px;
    }

    #lista_adjuntos {
        height: 280px;
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
        <div  class='col-md-6'>
            <div id='lista_adjuntos' class='panel panel-default'>
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
                <div id="lista_adjunto" class='panel-body'>
                    <?=
                        $this->render('lista_adjuntos', [
                            'model'=>$model,
                        ]);
                     ?>
                </div>
            </div>


        </div>

        <!-- Añadir un nuevo adjunto -->
        <div class='col-md-3'>
            <?= $this->render('/adjuntos/create', [
                'model'=>$adjunto,
                'tarjeta'=>$model,
            ]) ?>
        </div>
    </div>

    <!-- Adjuntar un archivo -->
    <div class='row'>
        <div class='col-md-6'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <p>
                        <?=
                            Html::tag(
                                'span',
                                '',
                                ['class'=>'glyphicon glyphicon-file']
                            ) . ' Adjuntar un archivo'
                        ?>
                    </p>
                </div>
                <div class='panel-body'>
                    <?=
                        $this->render('/site/form_input_file', [
                            'model'=>$adjunto,
                            'attribute'=>'archivo',
                            'showUpload'=>false,
                            'showPreview'=>false,
                            'action'=>['adjuntos/create'],
                            'id_form'=>"$model->id",
                            'btn_id'=>"btn_file_$model->id",
                            'tarjeta'=>$model,
                        ]);
                    ?>
                </div>
            </div>
        </div>

        <div id='loading' class='col-md-3'>

        </div>

    </div>
</div>
