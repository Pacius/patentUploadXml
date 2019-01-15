<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

const PATH_FILE_SAVE = "xml";

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $xmlFile;


    public function rules()
    {
        return [
            [['xmlFile'], 'file', 'skipOnEmpty' => false],  // 'extensions' => 'xml'
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
            $this->xmlFile->saveAs(\Yii::getAlias('@app') . "/" .PATH_FILE_SAVE.'/' . $this->xmlFile->baseName . '.' . $this->xmlFile->extension);
            return true;
        } else {
            return false;
        }
    }
}