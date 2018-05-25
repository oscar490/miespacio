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
     * Subida de archivo a Dropbox.
     * @return [type] [description]
     */
    public function upload()
    {
        //  Se guarda en la aplicación.
        $this->archivo->saveAs(
            Yii::getAlias("@uploads/$this->nombre_archivo")
        );

        $cliente = Yii::$app->params['dropbox'];
        $archivo = Yii::getAlias("@uploads/$this->nombre_archivo");

        //  Se elimina antes de subir.
        $this->deleteDropbox();

        //  Se sube a dropbox.
        $cliente->upload(
            $this->nombre_archivo,
            file_get_contents($archivo),
            'overwrite'
        );

        $resultado = $cliente->createSharedLinkWithSettings(
            $this->nombre_archivo,
            ['requested_visibility'=>'public']
        );

        return substr($resultado['url'], 0, -4) . 'raw=1';

    }

    /**
     * Se elimina el archivo de Dropbox.
     * @return [type] [description]
     */
    public function deleteDropbox()
    {
        $cliente = Yii::$app->params['dropbox'];

        try{
            $cliente->delete($this->nombre_archivo);

        } catch (BadRequest $e) {
            //  No hace nada.
        }
    }
}
