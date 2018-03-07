<?php

namespace app\models;

use yii\base\Model;

class EstablecerPasswordForm extends Model
{
    public $password;
    public $password_repeat;

    /**
     * Se establecen las reglas de validación por cada atributo.
     * @return [type] [description]
     */
    public function rules()
    {
        return [
            [['password', 'password_repeat'], 'required'],
            [
                ['password_repeat'],
                'compare',
                'compareAttribute' => 'password',
            ],
        ];
    }

    /**
     * Se establece el nombre de las propieades a mostrar
     * por pantalla.
     * @return [type] [description]
     */
    public function attributeLabels()
    {
        return [
            'password' => 'Nueva contraseña',
            'password_repeat' => 'Nueva contraseña (otra vez)',
        ];
    }
}
