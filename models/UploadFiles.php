<?php

namespace app\models;

use yii\base\Model;
use Spatie\Dropbox\Exceptions\BadRequest;
use Yii;

/**
 * Modelo de subida de archivos.
 */
class UploadFiles extends Model
{
    /**
     * Contenido del archivo a subir.
     * @var [type]
     */
    public $archivo;

    public function rules()
    {
        return [
            [['archivo'], 'file', 'extensions'=>'jpg'],
        ];
    }

    /**
     * Subida de archivo.
     * @return [type] [description]
     */
    public function upload($nombre)
    {
        if ($this->validate()) {
            $cliente = new \Spatie\Dropbox\Client(getenv('DROPBOX_TOKEN'));
            $this->archivo->saveAs(Yii::getAlias("@uploads/$nombre"));

            try {
                $cliente->delete($nombre);
            } catch (BadRequest $e) {

            }
            $cliente->upload(
                $nombre,
                file_get_contents(Yii::getAlias("@uploads/$nombre")),
                'overwrite'
            );

            $resultado = $cliente->createSharedLinkWithSettings(
                $nombre,
                ['requested_visibility'=>'public']
            );

            return  substr($resultado['url'], 0, -1) . '1';
        }
    }
}
