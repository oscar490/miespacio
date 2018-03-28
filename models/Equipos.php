<?php

namespace app\models;

use Yii;
use Spatie\Dropbox\Exceptions\BadRequest;

/**
 * This is the model class for table "equipos".
 *
 * @property int $id
 * @property string $denominacion
 * @property string $descripcion
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
            [['denominacion', 'descripcion'], 'string', 'max' => 255],
            [
                ['denominacion', 'usuario_id'],
                'unique',
                'targetAttribute' => ['denominacion', 'usuario_id'],
                'message'=>'Ya existe un equipo con ese nombre',
            ],
            [
                ['usuario_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Usuarios::className(),
                'targetAttribute' => ['usuario_id' => 'id'],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'denominacion' => 'Nombre del equipo',
            'descripcion' => 'Descripción (opcional)',
            'usuario_id' => 'Usuario ID',
        ];
    }

    /**
     * Nombre del formulario.
     * @return [type] [description]
     */
    public function formName()
    {
        return '';
    }

    /**
     * Subida de imágenes
     * @return [type] [description]
     */
    public function getUrlImagen()
    {
        $cliente = new \Spatie\Dropbox\Client(getenv('DROPBOX_TOKEN'));

        $res = $cliente->createSharedLinkWithSettings(
            $this->denominacion . Yii::$app->user->id . '.jpg',
            ['requested_visibility'=>'public']
        );

        return $res;
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
