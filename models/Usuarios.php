<?php

namespace app\models;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $nombre
 * @property string $password
 * @property string $email
 */
class Usuarios extends \yii\db\ActiveRecord
{
    public $password_repeat;
    const ESCENARIO_CREATE = 'create';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['nombre', 'password', 'email', 'password_repeat'],
                'required',
                'on' => self::ESCENARIO_CREATE,
            ],
            [['nombre', 'password', 'email'], 'string', 'max' => 255],
            [['nombre'], 'unique'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['password_repeat']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'password' => 'Password',
            'email' => 'Email',
        ];
    }
}
