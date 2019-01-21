<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use app\assets\AppConst;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $xmlFile;


    public function rules()
    {
        return [
            [['xmlFile'], 'required', 'message' => "Файл не выбран!"],
            [['xmlFile'], 'file',
                'skipOnEmpty' => false,
                'wrongExtension' => "Файл должен быть в формате xml!",
                'extensions' => 'xml'
                ],  // 'extensions' => 'xml'
        ];
    }

    public function attributeLabels()
    {
        return [
            'xmlFile' => 'Выберите файл Xml для загрузки',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->xmlFile->saveAs(\Yii::getAlias('@app') . "/" .appConst::SAVE_FILE_PATH_XML.'/' . $this->xmlFile->baseName . '.' . $this->xmlFile->extension);
            return true;
        } else {
            return false;
        }
    }
}