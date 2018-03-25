<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = 'Registrarse';
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
