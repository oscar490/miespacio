<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "adjuntos".
 *
 * @property int $id
 * @property string $nombre
 * @property string $url_direccion
 * @property int $tarjeta_id
 *
 * @property Tarjetas $tarjeta
 */
class Adjuntos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adjuntos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'url_direccion', 'tarjeta_id'], 'required'],
            [['tarjeta_id'], 'default', 'value' => null],
            [['tarjeta_id'], 'integer'],
            [['nombre', 'url_direccion'], 'string', 'max' => 255],
            [['tarjeta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tarjetas::className(), 'targetAttribute' => ['tarjeta_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'url_direccion' => 'Url Direccion',
            'tarjeta_id' => 'Tarjeta ID',
        ];
    }

    public function formName()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarjeta()
    {
        return $this->hasOne(Tarjetas::className(), ['id' => 'tarjeta_id'])->inverseOf('adjuntos');
    }
}
