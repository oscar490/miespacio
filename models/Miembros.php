<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "miembros".
 *
 * @property int $id
 * @property int $usuario_id
 * @property int $equipo_id
 * @property string $created_at
 *
 * @property Tableros $tablero
 * @property Usuarios $usuario
 */
class Miembros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'miembros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'equipo_id'], 'required'],
            [['usuario_id', 'equipo_id'], 'default', 'value' => null],
            [['usuario_id', 'equipo_id'], 'integer'],
            [['created_at'], 'safe'],
            [['equipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tableros::className(), 'targetAttribute' => ['equipo_id' => 'id']],
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
            'usuario_id' => 'Usuario ID',
            'equipo_id' => 'Tablero ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipo()
    {
        return $this->hasOne(Tableros::className(), ['id' => 'equipo_id'])->inverseOf('miembros');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('miembros');
    }
}
