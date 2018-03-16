<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tableros".
 *
 * @property int $id
 * @property string $denominacion
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
            [['equipo_id'], 'integer'],
            [['denominacion'], 'string', 'max' => 255],
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
            'denominacion' => 'Denominacion',
            'equipo_id' => 'Equipo ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipo()
    {
        return $this->hasOne(Equipos::className(), ['id' => 'equipo_id'])->inverseOf('tableros');
    }
}
