<?php

namespace app\models;

use Yii;
use yii\web\User;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "datos_usuarios".
 *
 * @property int $id
 * @property string $nombre_completo
 * @property string $descripcion
 * @property string $registro
 * @property string $ultimo_acceso
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

    public function behaviors()
    {
        return [
            [
                'class'=>TimestampBehavior::className(),
                'attributes'=>[
                    User::EVENT_AFTER_LOGIN=>['ultimo_acceso']
                ],
                'value'=>new Expression('current_timestamp(0)'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['registro', 'ultimo_acceso'], 'safe'],
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
            'nombre_completo' => 'Nombre completo',
            'descripcion' => 'Biografía (opcional)',
            'registro' => 'Registro',
            'ultimo_acceso' => 'Ultimo Acceso',
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
