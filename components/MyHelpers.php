<?php

namespace app\components;

use kartik\tabs\TabsX;
use kartik\dialog\Dialog;

class MyHelpers
{
    public static function tabs($items)
    {
        return TabsX::widget([
            'items'=>$items,
            'position'=>TabsX::POS_ABOVE,
            'align'=>TabsX::ALIGN_CENTER,
            'encodeLabels'=>false,
        ]);
    }

    /**
     * Muestra un mensaje de prompt preguntando si desea
     * realizar una acción de eliminar.
     * @return [type] [description]
     */
    public static function confirmacion($titulo)
    {
        return Dialog::widget([
            'dialogDefaults'=>[
                Dialog::DIALOG_CONFIRM => [
                    'type'=>Dialog::TYPE_DANGER,
                    'title'=>$titulo,
                    'btnOKLabel'=>'Si',
                    'btnCancelLabel'=>'No',
                    'btnOKClass'=>'btn-danger',
                ]
            ]
        ]);
    }
}
