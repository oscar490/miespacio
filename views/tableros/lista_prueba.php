<?php
/* Lista de prueba, se muestra cuando no hay ninguna lista creada
   en el tablero */


use yii\helpers\Html;
?>

<div class='row'>
    <div class='col-md-4'>
        <div class='panel panel-default'>
            <div class='panel-heading'>
                <?= Html::encode('Lista'); ?>
            </div>
            <div class='panel-body'>
                <p>
                    En una <strong>Lista</strong> se pueden colocar las
                    diferentes tarjetas para realizar sobre ellas una
                    clasificación y tener un orden sobre ellas. Desde
                    el menú <strong>Crear lista</strong> podemos empezar
                    a crear nuestras listas.
                </p>
            </div>
        </div>
    </div>
</div>
