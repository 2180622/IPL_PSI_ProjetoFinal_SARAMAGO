<?php

namespace app\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for "logotipos" insert on table "config".
 *
 * @property int $id
 * @property string|null $info
 * @property string|null $key
 * @property string|null $value
 */
class LogotiposForm extends \yii\db\ActiveRecord
{
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'string', 'max' => 255],
            [['imageFile'], 'image', 'skipOnEmpty' => false,
                'mimeTypes' => 'image/gif, image/jpeg, image/png, image/x-icon',
                'checkExtensionByMimeType'=>true,
                'maxSize' => 1024 * 1024 * 2,
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
            'info' => 'Info',
            'key' => 'Key',
            'value' => 'Value',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function upload($id)
    {
        if ($this->validate()) {
            $this->value = strtolower($this->key);
            $this->imageFile->saveAs(Url::to('img/' . $this->value . '.' . $this->imageFile->extension));
            $this->value = $this->value . '.' . $this->imageFile->extension;

            Yii::$app->db->createCommand()->update(self::tableName(), ['value' => $this->value], 'id = '. $id)->execute();

            return true;

        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function reset($id)
    {
        unlink(Url::to('img/' . $this->value));
        Yii::$app->db->createCommand()->update(self::tableName(), ['value' => null], 'id = '. $id)->execute();
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function infoLogo($info)
    {
        if ($info = 'favicon')
        {
            return 'Recomendado: 32x32 / Até 500B';
        }
        elseif($info = 'logotipo')
        {
            return 'Recomendado: Até 2 MB ';
        }

        return false;

    }

}
