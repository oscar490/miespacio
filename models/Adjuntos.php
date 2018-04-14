<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "adjuntos".
 *
 * @property int $id
 * @property string $nombre
 * @property string $url_direccion
 *
 * @property Subidas[] $subidas
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
            [['nombre', 'url_direccion'], 'required'],
            [['nombre', 'url_direccion'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubidas()
    {
        return $this->hasMany(Subidas::className(), ['adjunto_id' => 'id'])->inverseOf('adjunto');
    }
}
