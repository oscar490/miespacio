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
 * @property string $iniciales
 * @property int $usuario_id
 *
 * @property Usuarios $usuario
 */
class DatosUsuarios extends \yii\db\ActiveRecord
{
    const ESCENARIO_IMAGEN = 'imagen';
    /**
     * Imagen de perfil del usuario.
     * @var [type]
     */
    public $imagen;
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

    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'imagen',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iniciales'], 'required'],
            [['usuario_id'], 'integer'],
            [['nombre_completo', 'descripcion'], 'string', 'max' => 50],
            [['nombre_completo'], 'required'],
            [['iniciales'], 'string', 'max' => 4],
            [
                ['foto'],
                'file',
                'extensions'=>'jpg, png',
                'on'=>self::ESCENARIO_IMAGEN,
            ],
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
            'descripcion' => 'Descripción (opcional)',
            'registro' => 'Registro',
            'ultimo_acceso' => 'Ultimo Acceso',
            'iniciales' => 'Iniciales',
            'usuario_id' => 'Usuario ID',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imagen->saveAs(
                Yii::getAlias('@app/web/uploads/') . $this->id
                . '.' . $this->imagen->extension
            );
            return true;

        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('datosUsuarios');
    }
}
