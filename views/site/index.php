<?php

/* @var $this yii\web\View */
use kartik\tabs\TabsX;
use yii\helpers\Html;

$css = <<<EOT
    .panel-heading {
        display: flex;
        justify-content: center;
    }
    .well {
        background-color: #0266a0;
        color: white;
    }


EOT;

$this->registerCss($css);

$this->title = 'MiEspacio';

$items = [
    [
        'label'=>'Iniciar sesion',
        'content'=>$this->render('login', [
            'model'=>$model,
        ]),
    ],
    [
        'label'=>'Registrarse',
        'content'=>'registrando',
    ],
];
?>
<div class="site-index">
    <br><br><br>
    <div class='row'>
        <div class='col-md-5 col-md-offset-4'>
                <?=
                    Html::tag(
                        'h1',
                        Html::img(
                            'images/logotipo.png',
                            [
                                'alt'=>'logotipo',
                                'class'=>'logo-x3'
                            ]
                        ) .
                        Html::tag(
                            'p',
                            Html::tag(
                                'strong',
                                Yii::$app->name
                            )
                        )
                    )

                ?>

        </div>
    </div>
    <div class='row'>
        <div class='col-md-5'>

                    Es una aplicación perfecta para crear tus espacios de
                    trabajo, que son tableros virtuales.
                    En ellos puedes añadir muchos tipos de contenidos, desde
                    anotaciones hasta incluso datos multimedia.

        </div>
    </div>
    <div class='row'>
        <div class='col-md-6'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    <?=
                        Html::tag(
                            'h3',
                            Html::tag(
                                'p',
                                Html::img(
                                    'images/logotipo.png',
                                    [
                                        'alt'=>'logotipo',
                                        'class'=>'logo-x2',
                                    ]
                                ) . ' ' .
                                Html::tag(
                                    'strong',
                                    Yii::$app->name
                                )
                            )
                        )
                    ?>
                </div>
                <div class='panel-body'>
                    <?= TabsX::widget([
                        'items'=>$items,
                        'position'=>TabsX::POS_ABOVE,
                        'encodeLabels'=>false,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>


</div>
