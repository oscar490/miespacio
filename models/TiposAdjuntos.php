<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipos_adjuntos".
 *
 * @property int $id
 * @property string $tipo
 *
 * @property Adjuntos[] $adjuntos
 */
class TiposAdjuntos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipos_adjuntos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['tipo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdjuntos()
    {
        return $this->hasMany(Adjuntos::className(), ['tipo_id' => 'id'])->inverseOf('tipo');
    }
}
