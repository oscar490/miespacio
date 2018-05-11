<?php
/* Vista de tableros favoritos */

/* @var $favoritos yii\data\ActiveDataProvider */
use yii\helpers\Html;
use app\components\MyHelpers;
use yii\widgets\ListView;

?>

<div class='row'>

    <!-- Imágen -->
    <div class='col-xs-3 col-md-1 col-lg-1 img_equipo'>
        <?=
            Html::img(
                'images/estrella.png',
                ['class'=>'img-circle logo-equipo']
            );
        ?>
    </div>

    <!-- Título -->
    <div id='texto_equipo' class='col-xs-8 col-md-11 col-lg-11'>
        <h4>
            <strong>
                <?= Html::encode('Tableros favoritos') ?>
            </strong>
        </h4>
    </div>


</div>
<br>

<!-- Lista de tableros -->
<div class='row'>
    <?= ListView::widget([
        'dataProvider'=>$favoritos,
        'itemView'=>'_tablero',

        'summary'=>'',
    ])?>
</div>


<hr>
