<?php

/* @var $model app\models\Tableros */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$css = <<<EOT
    div.panel-tablero {
        background-color: #0266a0;
        color: white;
        border-radius: 5px;
    }

    .crear-tablero {
        display: none;
    }

    a:link {
        text-decoration:none;
    }
EOT;

$js = <<<EOT
    $('#boton-crear').on('click', function(e) {
        e.preventDefault();
    })


EOT;

$this->registerCss($css);
$this->registerJs($js);

$this->registerCss($css);
?>
<?=
    Html::tag(
        'div',
        Html::a(
            Html::tag(
                'div',
                Html::tag(
                    'div',
                    Html::tag(
                        'p',
                        Html::tag(
                            'strong',
                            $model->denominacion
                        )
                    ),
                    ['class'=>'panel-heading']
                ) .
                Html::tag(
                    'div',
                    '',
                    ['class'=>'panel-body']
                ),
                ['class'=>'panel panel-primary']
            ),
            ['tableros/view', 'id'=>$model->id]
        ),
        ['class'=>'col-md-3']
    )
?>
