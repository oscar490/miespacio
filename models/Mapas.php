<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mapas".
 *
 * @property int $id
 * @property string $ubicacion
 * @property int $latitud
 * @property int $longitud
 * @property int $tarjeta_id
 *
 * @property Tarjetas $tarjeta
 */
class Mapas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mapas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ubicacion','tarjeta_id'], 'required'],
            [['latitud', 'longitud', 'tarjeta_id'], 'default', 'value' => null],
            [['latitud', 'longitud'], 'number'],
            [['tarjeta_id'], 'integer'],
            [['ubicacion'], 'string', 'max' => 255],
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
            'ubicacion' => 'Ubicacion',
            'latitud' => 'Latitud',
            'longitud' => 'Longitud',
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
        return $this->hasOne(Tarjetas::className(), ['id' => 'tarjeta_id'])->inverseOf('mapas');
    }
}
