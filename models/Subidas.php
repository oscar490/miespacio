<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subidas".
 *
 * @property int $id
 * @property int $adjunto_id
 * @property int $tarjeta_id
 *
 * @property Adjuntos $adjunto
 * @property Tarjetas $tarjeta
 */
class Subidas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subidas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['adjunto_id', 'tarjeta_id'], 'required'],
            [['adjunto_id', 'tarjeta_id'], 'default', 'value' => null],
            [['adjunto_id', 'tarjeta_id'], 'integer'],
            [['adjunto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Adjuntos::className(), 'targetAttribute' => ['adjunto_id' => 'id']],
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
            'adjunto_id' => 'Adjunto ID',
            'tarjeta_id' => 'Tarjeta ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdjunto()
    {
        return $this->hasOne(Adjuntos::className(), ['id' => 'adjunto_id'])->inverseOf('subidas');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarjeta()
    {
        return $this->hasOne(Tarjetas::className(), ['id' => 'tarjeta_id'])->inverseOf('subidas');
    }
}
