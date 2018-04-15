<?php

namespace app\models;

use yii\base\Model;
use Spatie\Dropbox\Exceptions\BadRequest;
use yii\imagine\Image;
use Yii;

/**
 * Modelo de subida de archivos.
 */
class UploadFiles extends Model
{
    /**
     * Nombre del archivo a subir
     * @return [type] [description]
     */
    public $nombre_archivo;

    /**
     * Archivo que se va a subir.
     * @var [type]
     */
    public $archivo;
    /**
     * Subida de archivo al servidor.
     * @return [type] [description]
     */
    public function upload()
    {
        $nombre = Yii::getAlias("@uploads/$this->nombre_archivo");
        $res = $this->archivo->saveAs($nombre);



        return $this->uploadDropbox();
    }

    /**
     * Subida de archivo a Dropbox.
     * @return [type] [description]
     */
    public function uploadDropbox()
    {
        $cliente = new \Spatie\Dropbox\Client(getenv('DROPBOX_TOKEN'));
        $archivo = Yii::getAlias("@uploads/$this->nombre_archivo");

        try {
            $cliente->delete($this->nombre_archivo);
        } catch (BadRequest $e) {
        }

        $cliente->upload(
            $this->nombre_archivo,
            file_get_contents($archivo),
            'overwrite'
        );

        $resultado = $cliente->createSharedLinkWithSettings(
            $this->nombre_archivo,
            ['requested_visibility'=>'public']
        );

        return  substr($resultado['url'], 0, -1) . '1';


    }
}
