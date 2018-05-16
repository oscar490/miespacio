<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipos_miembros".
 *
 * @property int $id
 * @property string $tipo
 *
 * @property Miembros[] $miembros
 */
class TiposMiembros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipos_miembros';
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
    public function getMiembros()
    {
        return $this->hasMany(Miembros::className(), ['tipo_id' => 'id'])->inverseOf('tipo');
    }
}
