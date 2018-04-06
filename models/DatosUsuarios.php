<?php

namespace app\models;

use Yii;
use yii\web\User;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "datos_usuarios".
 *
 * @property int $id
 * @property string $nombre_completo
 * @property string $apellidos
 * @property string $descripcion
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
    public $avatar;
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
            [['usuario_id'], 'integer'],
            [['nombre_completo', 'descripcion', 'apellidos'], 'string', 'max' => 255],
            [['nombre_completo'], 'required'],
            [
                ['avatar'],
                'file',
                'extensions'=>'jpg',
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
            'apellidos'=>'Apellidos (opcional)',
            'usuario_id' => 'Usuario ID',
            'avatar'=>'Imágen de ávatar',
        ];
    }

    public function upload()
    {
        if ($this->imagen === null) {
            return true;
        }

        $nombre = Yii::getAlias('@uploads/') . $this->usuario_id . '.jpg';
        $res = $this->imagen->saveAs($nombre);

        if ($res) {
            Image::thumbnail($nombre, null, 150)->save($nombre);
        }

        return $res;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('datosUsuarios');
    }


    /**
     * Despues guardar los datos de usuario en la base de datos, se crea
     * un equipo y un tablero por defecto.
     * @param  boolean $insert true si se va a realizar un insert,
     *                         false en caso contrario.
     * @param  array   $changedAttributes valores antiguos antes de
     *                          guardar el modelo.
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $equipo = new Equipos([
                'denominacion'=>'Tableros personales',
                'url_imagen'=>'images/equipo.png',
                'usuario_id'=>$this->usuario_id
            ]);
            $equipo->save();

            (new Tableros([
                'denominacion'=>'Tablero de Bienvenida',
                'equipo_id'=>$equipo->id,
            ]))->save();
        }
    }

    /**
     * Se cambia la imagen de perfil y se sube a Dropbox.
     * Sólo en caso de que el usuario haya indicado la imágen
     * que desea subir.
     * @param  [type] $insert [description]
     * @return [type]         [description]
     */
    public function beforeSave($insert)
    {
        if (!$insert) {
            $this->avatar = UploadedFile::getInstance($this, 'avatar');

            if ($this->avatar !== null) {
                $subida = new UploadFiles([
                    'nombre_archivo'=>$this->usuario->id . '.jpg',
                    'archivo'=>$this->avatar,
                ]);
                $this->url_imagen = $subida->upload();
            }
            return true;
        }
        return true;
    }
}
