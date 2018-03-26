<?php
/* Diseño del tablero, al seleccionarlo, nos redirecciona a su contenido. */
/* @var $model app\models\Tableros */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$css = <<<EOT
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
