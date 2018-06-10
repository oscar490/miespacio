<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "valoraciones".
 *
 * @property int $id
 * @property int $tipo_id
 * @property int $usuario_id
 * @property int $tarjeta_id
 *
 * @property Tarjetas $tarjeta
 * @property TiposValoraciones $tipo
 * @property Usuarios $usuario
 */
class Valoraciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'valoraciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_id', 'usuario_id', 'tarjeta_id'], 'required'],
            [['tipo_id', 'usuario_id', 'tarjeta_id'], 'default', 'value' => null],
            [['tipo_id', 'usuario_id', 'tarjeta_id'], 'integer'],
            [['usuario_id', 'tarjeta_id', 'tipo_id'], 'unique', 'targetAttribute' => ['usuario_id', 'tarjeta_id', 'tipo_id']],
            [['tarjeta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tarjetas::className(), 'targetAttribute' => ['tarjeta_id' => 'id']],
            [['tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => TiposValoraciones::className(), 'targetAttribute' => ['tipo_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo_id' => 'Tipo ID',
            'usuario_id' => 'Usuario ID',
            'tarjeta_id' => 'Tarjeta ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarjeta()
    {
        return $this->hasOne(Tarjetas::className(), ['id' => 'tarjeta_id'])->inverseOf('valoraciones');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(TiposValoraciones::className(), ['id' => 'tipo_id'])->inverseOf('valoraciones');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('valoraciones');
    }
}
