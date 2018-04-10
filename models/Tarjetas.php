<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tarjetas".
 *
 * @property int $id
 * @property string $denominacion
 * @property int $tablero_id
 *
 * @property Tableros $tablero
 */
class Tarjetas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tarjetas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['denominacion', 'tablero_id'], 'required'],
            [['tablero_id'], 'default', 'value' => null],
            [['tablero_id'], 'integer'],
            [['denominacion'], 'string', 'max' => 255],
            [['denominacion', 'tablero_id'], 'unique', 'targetAttribute' => ['denominacion', 'tablero_id']],
            [['tablero_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tableros::className(), 'targetAttribute' => ['tablero_id' => 'id']],
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
            'tablero_id' => 'Tablero ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTablero()
    {
        return $this->hasOne(Tableros::className(), ['id' => 'tablero_id'])->inverseOf('tarjetas');
    }
}
