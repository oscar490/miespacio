<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tableros".
 *
 * @property int $id
 * @property string $denominacion
 * @property string $color
 * @property int $equipo_id
 *
 * @property Equipos $equipo
 */
class Tableros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tableros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['denominacion', 'equipo_id'], 'required'],
            [['equipo_id'], 'default', 'value' => null],
            [
                ['equipo_id'],
                'filter',
                'filter'=>'intval',
            ],
            [['equipo_id'], 'integer'],
            [['denominacion'], 'string', 'max' => 255],
            [
                ['denominacion', 'equipo_id'],
                'unique',
                'targetAttribute' => ['denominacion', 'equipo_id'],
                'message'=>'Ya existe un tablero con ese nombre.',
            ],
            [['equipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipos::className(), 'targetAttribute' => ['equipo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'denominacion' => 'Nombre del tablero',
            'equipo_id' => 'Equipo',
        ];
    }

    public function formName()
    {
        return '';
    }

    public function getContieneTarjetas()
    {
        return !empty($this->tarjetas);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipo()
    {
        return $this->hasOne(Equipos::className(), ['id' => 'equipo_id'])->inverseOf('tableros');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTarjetas()
    {
       return $this->hasMany(Tarjetas::className(), ['tablero_id' => 'id'])->inverseOf('tablero');
    }
}
