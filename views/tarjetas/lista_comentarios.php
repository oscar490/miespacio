<?php
/* Lista de comentarios de tarjeta */

/* @var $comentarios yii\db\ActiveRecord */
/* @var $tarjeta app\models\Tarjetas */

use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

$num_comentarios = $comentarios->count();

//  Establece el número de comentarios.
$js = <<<EOT
    $('span#$tarjeta->id').text('$num_comentarios');
EOT;

$this->registerJs($js);

$css = <<<EOT
     #btn_mas_comentarios {
         margin-left: 50px;
         margin-bottom: 20px;

     }

     #view_comentarios {
         height: 400px;
         margin-bottom: 20px;
     }

EOT;


$this->registerCss($css);

?>

<!-- Lista de comentarios -->
<div id="view_comentarios" class='content-scroll'>
    <?php if (!empty($tarjeta->comentarios)): ?>
        <?= ListView::widget([
            'dataProvider'=>new ActiveDataProvider([
                'query'=>$comentarios,
                'pagination'=>false,
                'sort'=>[
                    'defaultOrder'=>['created_at'=>SORT_DESC]
                ],
            ]),
            'itemView'=>'/comentarios/view',
            'summary'=>''
        ]) ?>

    <?php else: ?>
        <div class='centrado'>
            <p>
                ¡No esperes más! Se el primero en añadir tu comentario
                sobre el contenido de esta tarjeta.
            </p>
        </div>
    <?php endif; ?>
</div>



<!-- Formulario de crear un comentario -->
<?= $this->render('/comentarios/create', [
    'model'=>$nuevo_comentario,
    'tarjeta'=>$tarjeta,
]) ?>
