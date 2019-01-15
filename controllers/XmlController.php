<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;
use app\models\UploadForm;

class XmlController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {

    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect("/xml/upload");
    }

    public function actionUpload() {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->xmlFile = UploadedFile::getInstance($model, 'xmlFile');
            if ($model->upload()) {
                // загрузка завершена
                return $this->processParsingXml($model->xmlFile->name);
            }
        }

        return $this->render('upload', [
            'model' => $model
        ]);
    }

    public function actionAdd() {
        return $this->render('add');
    }

    public function getLinkDirectoryXml() {
        return Yii::getAlias('@app') . "/".\app\models\PATH_FILE_SAVE."/";
    }

    public function processParsingXml($nameFile) {
        $file = file_get_contents($this->getLinkDirectoryXml() . $nameFile);

        $fileToObject = new \SimpleXMLElement($file);

        return $this->render('add', [
            'fileItems' => $fileToObject
        ]);
    }

}
