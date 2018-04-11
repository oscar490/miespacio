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
 * @property string $url_imagen
 *
 * @property Usuarios $usuario
 * @property Tableros[] $tableros
 */
class Equipos extends \yii\db\ActiveRecord
{
    /**
     * Imágen del equipo.
     * @var [type]
     */
    public $imagen_equipo;

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
            [['denominacion', 'descripcion'], 'string', 'max' => 40],
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

    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'imagen_equipo'
        ]);
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
            'imagen_equipo'=>'Imágen de equipo'
        ];
    }

    /**
     * Devuelve un enlace a una vista del Equipo.
     * @return [type] [description]
     */
    public function getEnlace()
    {
        return Html::a(
            $this->denominacion,
            ['equipos/view', 'id'=>$this->id]
        );
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
     * Después de eliminarse el equipo, se elimina la imágen
     * del equipo.
     * @return [type] [description]
     */
    public function afterDelete()
    {
        $cliente = new \Spatie\Dropbox\Client(getenv('DROPBOX_TOKEN'));

        try {
            $cliente->delete(
                $this->id . Yii::$app->user->id . '.jpg'
            );
        } catch (BadRequest $e) {
        }
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
