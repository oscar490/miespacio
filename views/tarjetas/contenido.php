<?php
/* Contenido y modificación de la tarjeta */

use app\components\MyHelpers;


$items = [
    [
        //  Contenido de la tarjeta
        'label'=>"<span class='glyphicon glyphicon-modal-window'></span>
            Contenido",
        'content'=>$this->render('view', [
            'model'=>$model,
        ]),
        'active'=>true
    ],
    [
        //  Modificación de la tarjeta.
        'label'=>"<span class='glyphicon glyphicon-edit'></span>
            Personalizar",
        'content'=>$this->render('update', [
            'model'=>$model,
            'tableros'=>$tableros,
        ])
    ]
];
?>

<?= MyHelpers::tabs($items) ?>
