<?php
/* Listas de un tablero */

/* $model app\models\Tableros */
/* $tarjeta app\models\Tarjetas */

use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

$listas = $model->getListas()
    ->orderBy(['created_at'=>SORT_DESC])->all();

?>

<?php if ($model->contieneListas): ?>
    <!-- Listas del Tablero -->
    <div class='row'>
        <?php foreach ($listas as $lista): ?>

            <?= $this->render('_lista', [
                'lista'=>$lista,
                'tarjeta' => $tarjeta,
                'adjunto'=>$adjunto
            ]) ?>

        <?php endforeach; ?>
    </div>

<?php else: ?>
    <!-- Lista de prueba -->
    <?= $this->render('lista_prueba') ?>
<?php endif; ?>
