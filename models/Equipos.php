<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipos".
 *
 * @property int $id
 * @property string $denominacion
 * @property string $descipcion
 * @property int $usuario_id
 *
 * @property Usuarios $usuario
 * @property Tableros[] $tableros
 */
class Equipos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['denominacion', 'usuario_id'], 'required'],
            [['usuario_id'], 'default', 'value' => null],
            [['usuario_id'], 'integer'],
            [['denominacion', 'descipcion'], 'string', 'max' => 255],
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
            'denominacion' => 'Denominacion',
            'descipcion' => 'Descipcion',
            'usuario_id' => 'Usuario ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('equipos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTableros()
    {
        return $this->hasMany(Tableros::className(), ['equipo_id' => 'id'])->inverseOf('equipo');
    }
}
