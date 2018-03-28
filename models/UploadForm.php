<?php

namespace app\models;

use yii\base\Model;
use Spatie\Dropbox\Exceptions\BadRequest;
use Yii;

class UploadForm extends Model
{
    /**
     * Imágen a subir
     */
    public $imagen;
    public $nombre_imagen;

    public function rules()
    {
        return [
            [['imagen'], 'file', 'extensions'=>'jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $cliente = new \Spatie\Dropbox\Client(getenv('DROPBOX_TOKEN'));
            $nombre = $this->nombre_imagen . Yii::$app->user->id . '.jpg';
            $this->imagen->saveAs(Yii::getAlias("@uploads/$nombre"));

            $cliente->upload(
                $nombre,
                file_get_contents(Yii::getAlias("@uploads/$nombre")),
                'overwrite'
            );
        }
    }
}
