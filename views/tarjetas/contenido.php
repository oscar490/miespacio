<?php
use app\components\MyHelpers;


$items = [
    [
        //  Lista de tableros del equipo.
        'label'=>"<span class='glyphicon glyphicon-modal-window'></span>
                Contenido",
        'content'=> $this->render('view', [
            'model'=>$model
        ]),
    ],
    [
        'label'=>"<span class='glyphicon glyphicon-modal-window'></span>
                Personalizar",
        'content'=> $this->render('update', [
            'model'=>$model
        ]),
    ]
]
?>
