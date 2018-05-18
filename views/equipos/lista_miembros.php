<?php
/* Lista de miembros del equipo */

/* @var $miembros yii\data\ActiveDataProvider */
/* @var $model app\models\Equipos */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

$css = <<<EOT
    #desconocido {
        width: 150px;
        height: 150px;
        margin-top: 20px;
    }
EOT;

$this->registerCss($css);

$contieneResultados = !empty($miembros->query->all());
?>
<?php if ($contieneResultados): ?>
    <?= ListView::widget([
        'dataProvider'=>$miembros,
        'itemView'=>'_miembro',
        'viewParams'=> [
            'equipo'=>$model,
        ],
        'summary'=>'',
    ]); ?>

<?php else: ?>
    <p>
        <strong class='centrado'>
            <?= Html::encode('No se han encontrado resultados.') ?>
        </strong>
    </p>

    <div class='centrado'>
        <?=
            Html::img(
                'images/usuario desconocido.png',
                [
                    'alt'=>'usuario desconocido',
                    'id'=>'desconocido'
                ]
            )
        ?>
    </div>

<?php endif; ?>
