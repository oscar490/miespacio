<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipos_visibilidad".
 *
 * @property int $id
 * @property string $visibilidad
 *
 * @property Tableros[] $tableros
 */
class TiposVisibilidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipos_visibilidad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['visibilidad'], 'required'],
            [['visibilidad'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'visibilidad' => 'Visibilidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTableros()
    {
        return $this->hasMany(Tableros::className(), ['visibilidad_id' => 'id'])->inverseOf('visibilidad');
    }
}
