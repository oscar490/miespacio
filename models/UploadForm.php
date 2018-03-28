<?php

namespace app\models;

use yii\base\Model;
use Spatie\Dropbox\Exceptions\BadRequest;
use Yii;

/**
 * Modelo de subida de archivos.
 */
class UploadForm extends Model
{
    /**
     * Contenido del archivo.
     */
    public $contenido;
    /**
     * Nombre del archivo
     * @var [type]
     */
    public $nombre;

    public function rules()
    {
        return [
            [['contenido'], 'file', 'extensions'=>'jpg'],
        ];
    }

    /**
     * Subida de archivo.
     * @return [type] [description]
     */
    public function upload()
    {
        if ($this->validate()) {
            $cliente = new \Spatie\Dropbox\Client(getenv('DROPBOX_TOKEN'));
            $this->contenido->saveAs(Yii::getAlias("@uploads/$this->nombre"));

            return $cliente->upload(
                $this->nombre,
                file_get_contents(Yii::getAlias("@uploads/$this->nombre")),
                'overwrite'
            );
        }
    }
}
