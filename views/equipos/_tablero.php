<?php
/* Vista parcial de un tablero */
/* Diseño del tablero, al seleccionarlo, nos redirecciona a su contenido. */
/* @var $model app\models\Tableros */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$css = <<<EOT
    a:link {
        text-decoration:none;
    }

    .sombra {
        box-shadow: 10px 10px 10px #75a4c1;
    }
EOT;

$this->registerJsFile(
    '/js/tablero.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);


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
                    [
                        'class'=>'panel-heading',
                        'id' => 'tablero'
                    ]
                ),
                ['class'=>'panel panel-primary tablero']
            ),
            ['tableros/view', 'id'=>$model->id]
        ),
        ['class'=>'col-md-3']
    )

?>
