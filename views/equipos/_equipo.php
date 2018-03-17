<?php

/* @var $model app\models\Equipos */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\Tableros;
use yii\widgets\ActiveForm;

$tableros = new ActiveDataProvider([
    'query'=>Tableros::find()
        ->where(['equipo_id'=>$model->id]),
]);

$css = <<<EOT
    .crear-tablero {
        display: none;
    }
EOT;

$js = <<<EOT
    $('#boton-crear').on('click', function(e) {
        e.preventDefault();
    })


EOT;

$this->registerCss($css);
$this->registerJs($js);
?>

<?=
    Html::tag(
        'h4',
        Html::tag(
            'span',
            '',
            ['class'=>'glyphicon glyphicon-list-alt']
        ) . ' ' .
        Html::tag(
            'strong',
            $model->denominacion
        )
    );
?>
<br>

<!-- Tableros -->
<?php if (!empty($tableros->query->all())): ?>
    <div class='row'>
        <?= ListView::widget([
            'dataProvider'=>$tableros,
            'itemView'=>'_tablero',
            'viewParams'=>[
                'tablero'=>$tablero,
            ],
            'summary'=>'',
        ]) ?>
    </div>
<?php endif; ?>

<?= Html::a('Crear nuevo tablero', ['tableros/create'], [
    'class'=>'btn-sm btn-success',
    'id'=>'boton-crear',
]) ?>
<hr>
