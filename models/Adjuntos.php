<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "adjuntos".
 *
 * @property int $id
 * @property string $nombre
 * @property string $url_direccion
 * @property string $tipo
 * @property int $tarjeta_id
 *
 * @property Tarjetas $tarjeta
 */
class Adjuntos extends \yii\db\ActiveRecord
{
    const ESCENARIO_FILE = 'file';

    const ESCENARIO_URL = 'url';

    public $archivo;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adjuntos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['url_direccion', 'tarjeta_id',],
                'required',
                'on'=>self::ESCENARIO_URL,
            ],
            [['tarjeta_id'], 'default', 'value' => null],
            [['tarjeta_id'], 'integer'],
            [['nombre', 'url_direccion'], 'string', 'max' => 255],
            [
                ['nombre'],
                'default',
                'value'=>null,
            ],
            [
                ['archivo'],
                'file',
                'maxSize'=>1024*1024*2,
                'on'=>self::ESCENARIO_FILE,
            ],
            [
                ['archivo'],
                'required',
                'message'=>'No puede estar vacio,
                se debe seleccionar un archivo.',
                'on'=>self::ESCENARIO_FILE
            ],
            [
                ['url_direccion', 'tarjeta_id'],
                'unique',
                'targetAttribute' => ['url_direccion', 'tarjeta_id'],
                'message'=>'Ya existe ese adjunto',
            ],
            [
                ['url_direccion'],
                'url',
                'validSchemes' => ['http', 'https'],
            ],
            [['tarjeta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tarjetas::className(), 'targetAttribute' => ['tarjeta_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre (opcional)',
            'url_direccion' => 'Dirección',
            'tarjeta_id' => 'Tarjeta ID',
            'archivo' => '',
        ];
    }


    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'archivo',
        ]);
    }

    /**
     * Devuelve el ID del tipo de archivo adjunto.
     * @param  string $tipo Tipo de archivo.
     * @return integer       ID del tipo de archivo.
     */
    public function getConsultarTipo($tipo)
    {
        switch ($tipo) {
            case "image":
                $id_tipo = 1;
                break;

            case "application":
                $id_tipo = 2;
                break;

            default:
                $id_tipo = 4;
                break;
        }

        return $id_tipo;
    }

    public function getEsImagen()
    {
        return $this->tipo_id === 1;
    }

    public function getEsEnlace()
    {
        return $this->tipo_id === 3;
    }

    /**
     * Extrae una parte del tipo de archivo.
     * @param  string $tipo Propiedad del archivo.
     * @return string       Parte del tipo de archivo.
     */
    public static function extraerTipo($tipo)
    {
        $indice = strpos($tipo, '/');

        return substr($tipo ,0,  $indice);
    }


    public function formName()
    {
        return '';
    }

    /**
     * Devuelve al equipo donde pertenece.
     * @return Model El modelo de Equipo
     */
    public function getEquipo()
    {
        return $this->tablero->equipo;
    }

    /**
     * Devuelve al tablero donde pertenece.
     * @return Model Modelo de Tablero.
     */
    public function getTablero()
    {
        return $this->tarjeta->lista->tablero;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarjeta()
    {
        return $this->hasOne(Tarjetas::className(), ['id' => 'tarjeta_id'])->inverseOf('adjuntos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(TiposAdjuntos::className(), ['id'=>'tipo_id'])
            ->inverseOf('adjuntos');
    }

    /**
     * Cuando se elimina el adjunto, se elimina el archivo de
     * Dropbox. Se elimina antes de Dropbox y después se elimina
     * el adjunto.
     * @return [type] [description]
     */
    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        if (!$this->esEnlace) {
            $extension = substr(
                $this->nombre,
                strripos($this->nombre, '.')
            );

            UploadFiles::deleteDropbox(
                $nombre = 'adjunto' . $this->id . $this->tarjeta->id
                    . $extension
            );
        }

        return true;
    }

    /**
     * Se crea una notificación de tablero después de eliminar
     * un adjunto.
     * @return [type] [description]
     */
    public function afterDelete()
    {
        $tablero = $this->tarjeta->lista->tablero;
        $equipo = $tablero->equipo;

        $miembro = Miembros::find()
            ->where([
                'usuario_id'=>Yii::$app->user->id,
                'equipo_id'=>$equipo->id,
            ])->one();

        (new Notificaciones([
            'contenido'=>"ha eliminado el adjunto" .
                " <strong>$this->nombre</strong>",
            'miembro_id'=>$miembro->id,
            'tablero_id'=>$tablero->id
        ]))->save();
    }

    /**
     * Después de guardar el adjunto, si es un archivo, se sube
     * a Dropbox.
     * @param  boolean $insert            True si es insert, false si es update.
     * @param  array   $changedAttributes Atributos antes de modificarse.
     */
    public function afterSave($insert, $changedAttributes)
    {
        $tarjeta = $this->tarjeta;

        $contenido = "ha añadido el adjunto " .
            (($this->nombre === null) ? $this->url_direccion : $this->nombre) .
            " en la tarjeta <strong>$tarjeta->denominacion</strong>";

        if (!$insert) {
            return false;
            // $contenido = "ha modificado el adjunto " .
            // (($this->nombre === null) ? $this->url_direccion : $this->nombre) .
            //     " en la tarjeta $tarjeta->denominacion";
        }

        $miembro = $this->equipo->getMiembros()
            ->where([
                'usuario_id'=>Yii::$app->user->id,
                'equipo_id'=>$this->equipo->id,
            ])->one();

        (new Notificaciones([
            'contenido'=>$contenido,
            'miembro_id'=>$miembro->id,
            'tablero_id'=>$this->tablero->id,
        ]))->save();
    }


}
