<?php
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

?>

<?=
    ListView::widget([
        'dataProvider'=> new ActiveDataProvider([
            'query'=>$model->getAdjuntos(),
        ]),
        'itemView'=>'_adjunto',
        'summary'=>'',
    ]);
?>
