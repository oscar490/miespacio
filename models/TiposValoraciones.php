<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipos_valoraciones".
 *
 * @property int $id
 * @property string $denominacion
 * @property string $icono
 *
 * @property Valoraciones[] $valoraciones
 */
class TiposValoraciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipos_valoraciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['denominacion', 'icono'], 'required'],
            [['denominacion', 'icono'], 'string', 'max' => 255],
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
            'icono' => 'Icono',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValoraciones()
    {
        return $this->hasMany(Valoraciones::className(), ['tipo_id' => 'id'])->inverseOf('tipo');
    }
}
