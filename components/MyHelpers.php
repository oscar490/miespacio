<?php

namespace app\components;

use kartik\tabs\TabsX;
use kartik\dialog\Dialog;
use yii\helpers\Html;

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

    public static function submit($nombre= '', $options = [])
    {
        if (!array_key_exists('class', $options)) {
            $options['class'] = 'btn btn-success btn-block';
        }

        $label = Html::tag(
            'span',
            '',
            ['class'=> 'glyphicon glyphicon-ok-sign']
        ) . ' ' . $nombre;

        return Html::submitButton($label, $options);
    }
}
