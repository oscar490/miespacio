<?php

namespace app\components;

use kartik\tabs\TabsX;
use kartik\dialog\Dialog;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap\Modal;

class MyHelpers extends View
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
     * Devuelve una etiqueta <span> que representa
     * un icono de Boostrap.
     * @param  string $class Clase que identifica un icono
     * @return string        La etiquta <span></span>
     */
    public static function icon($class)
    {
        return Html::tag(
            'span',
            '',
            ['class'=>$class]
        );
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

    /**
     * Muestra el botón de envio de formulario.
     * @param  string $nombre  Nombre que se muestra en etiqueta.
     * @param  array  $options Opcones para el botón.
     * @return string          El botón de submit.
     */
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

    /**
     * Renderiza las etiquetas de apertura de un Modal.
     * @param  [type] $header Titulo de cabecera.
     * @param  [type] $label  Nombre del botón.
     * @param  [type] $class  Clase del estilo del botón.
     * @param  [type] $size   Tamaño del modal.
     */
    public static function modal_begin($header, $label, $class,
        $size = Modal::SIZE_LARGE)
    {
        return Modal::begin([
            'header'=>$header,
            'toggleButton'=>[
                'label'=>$label,
                'class'=>'btn btn-xs btn-default'
            ],
            'size'=>$size
        ]);
    }

    /**
     * Renderiza las etiquetas de cierre de un Modal.
     * @return [type] [description]
     */
    public static function modal_end()
    {
        return Modal::end();
    }

}
