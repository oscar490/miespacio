<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Repesenta el correo electrónico a enviar.
 */
class Email extends Model
{
    /**
     * Asunto del email.
     * @var [type]
     */
    public $asunto;
    
    /**
     * Dirección receptora
     * a donde se envia.
     * @var [type]
     */
    public $direccion;
    
    /**
     * Vista que contiene
     * el contenido.
     * @var [type]
     */
    public $contenido;
    
    /**
     * Array de variables
     * que se pasan a la vista
     * @var [type]
     */
    public $options_view;
    
    
    /**
     * Enviar un correo electrónico 
     * a una dirección.
     * @return [type] [description]
     */
    public function send()
    {
        $send =  Yii::$app->mailer->compose($this->contenido, $this->options_view)
            ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
            ->setTo($this->direccion)
            ->setSubject($this->asunto)
            ->send();
            
        if (!$send) {
            Yii::$app->session->setFlash(
                'danger',
                'No se ha podido enviar el correo electrónico a la dirección indicada.'
            );
        }
        
        return $send;
    }
}