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

$js = <<<EOT
    $('div.panel-primary').hover(
        function() {
            $(this).toggleClass('sombra');
        },
        function() {
            $(this).toggleClass('sombra');
        }
    )
EOT;

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
