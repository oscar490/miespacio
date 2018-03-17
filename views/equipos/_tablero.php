<?php

/* @var $model app\models\Tableros */

use yii\helpers\Html;

$css = <<<EOT
    div.panel-tablero {
        background-color: #0266a0;
        color: white;
        border-radius: 5px;
    }

    a:link {
        text-decoration:none;
    }
EOT;

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
