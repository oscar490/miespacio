<?php
/* Lista de Adjuntos */

/* @var $model app\models\Tarjetas */
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

?>
<?php if ($model->contieneAdjuntos): ?>
    <?=
        ListView::widget([
            'dataProvider'=> new ActiveDataProvider([
                'query'=>$model->getAdjuntos()->with('tarjeta'),
                'sort'=>[
                    'defaultOrder'=>['created_at'=>SORT_DESC]
                ]
            ]),
            'itemView'=>'_adjunto',
            'summary'=>'',
        ]);
    ?>
<?php else: ?>
    <p>
        En esta sección se pueden añadir <strong>Adjuntos</strong>,
        que se refieren a enlaces a otras páginas y archivos subidos.
    </p>
<?php endif; ?>
