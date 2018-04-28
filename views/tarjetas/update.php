<?php
/* Renderización del formulario de modificación de tarjeta */

/* @var $this yii\web\View */
/* @var $model app\models\Tarjetas */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\dialog\Dialog;

$this->registerJsFile(
    '/js/tarjeta.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$url = Url::to(['tarjetas/update-ajax', 'id' => $model->id]);
$lista = $model->lista;

?>
