<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "adjuntos".
 *
 * @property int $id
 * @property string $nombre
 * @property string $url_direccion
 * @property int $tarjeta_id
 *
 * @property Tarjetas $tarjeta
 */
class Adjuntos extends \yii\db\ActiveRecord
{
    const ESCENARIO_FILE = 'file';

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
                'on'=>self::ESCENARIO_FILE,
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

    public function formName()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarjeta()
    {
        return $this->hasOne(Tarjetas::className(), ['id' => 'tarjeta_id'])->inverseOf('adjuntos');
    }
}
