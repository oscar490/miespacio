<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentarios".
 *
 * @property int $id
 * @property string $contenido
 * @property int $tarjeta_id
 * @property int $usuario_id
 *
 * @property Tarjetas $tarjeta
 * @property Usuarios $usuario
 */
class Comentarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contenido', 'tarjeta_id', 'usuario_id'], 'required'],
            [['tarjeta_id', 'usuario_id'], 'default', 'value' => null],
            [['tarjeta_id', 'usuario_id'], 'integer'],
            [['contenido'], 'string', 'max' => 255],
            [['contenido', 'usuario_id'], 'unique', 'targetAttribute' => ['contenido', 'usuario_id']],
            [['tarjeta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tarjetas::className(), 'targetAttribute' => ['tarjeta_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contenido' => 'Contenido',
            'tarjeta_id' => 'Tarjeta ID',
            'usuario_id' => 'Usuario ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarjeta()
    {
        return $this->hasOne(Tarjetas::className(), ['id' => 'tarjeta_id'])->inverseOf('comentarios');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('comentarios');
    }
}
