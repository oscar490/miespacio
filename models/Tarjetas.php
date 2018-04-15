<?php

namespace app\models;

use Yii;
use app\models\Adjuntos;

/**
 * This is the model class for table "tarjetas".
 *
 * @property int $id
 * @property string $denominacion
 * @property int $tablero_id
 * @property string $descripcion
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
            [['denominacion', 'descripcion'], 'string', 'max' => 255],
            [
                ['denominacion', 'tablero_id'],
                'unique',
                'targetAttribute' => ['denominacion', 'tablero_id'],
                'message'=>'Ya existe una tarjeta con ese nombre.',
            ],
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
            'denominacion' => 'Nombre de la tarjeta',
            'tablero_id' => 'Tablero ID',
        ];
    }

    public function formName()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTablero()
    {
        return $this->hasOne(Tableros::className(), ['id' => 'tablero_id'])->inverseOf('tarjetas');
    }

    /**
    *  @return \yii\db\ActiveQuery
    */
    public function getAdjuntos()
    {
        return $this->hasMany(Adjuntos::className(), ['tarjeta_id' => 'id'])->inverseOf('tarjeta');
    }


}
