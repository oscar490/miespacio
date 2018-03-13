<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "datos_usuarios".
 *
 * @property int $id
 * @property string $nombre_completo
 * @property string $descripcion
 * @property string $iniciales
 * @property int $usuario_id
 *
 * @property Usuarios $usuario
 */
class DatosUsuarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'datos_usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id'], 'default', 'value' => null],
            [['usuario_id'], 'integer'],
            [['nombre_completo', 'descripcion'], 'string', 'max' => 255],
            [['iniciales'], 'string', 'max' => 4],
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
            'nombre_completo' => 'Nombre Completo',
            'descripcion' => 'Descripcion',
            'iniciales' => 'Iniciales',
            'usuario_id' => 'Usuario ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('datosUsuarios');
    }
}
