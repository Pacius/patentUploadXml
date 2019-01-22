<?php

namespace app\controllers;

use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;
use app\models\UploadForm;
use app\assets\AppConst;

use app\models\BusinessPlanParams;
use app\models\BusinessPlan;
use app\models\BppValue;
use app\models\BusinessPlanOrg;
use app\models\Organizations;

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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
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

    public function actionUpload()
    {
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

    public function actionAdd()
    {
        return $this->render('add');
    }

    public function getLinkDirectoryXml()
    {
        return Yii::getAlias('@app') . "/" . appConst::SAVE_FILE_PATH_XML . "/";
    }

    public function processParsingXml($nameFile)
    {
        $logs = [];

        $file = file_get_contents($this->getLinkDirectoryXml() . $nameFile);

        $fileToObject = new \SimpleXMLElement($file);

        $unn = (string)$fileToObject['unn'];
        $organization = Organizations::find()->where(['unn' => $unn])->one();

        $isNewOrganization = false;

        if (!$organization) {
            $organization = new Organizations();
            $isNewOrganization = true;
        }

        $organization->unn = (string)$fileToObject['unn'] ?? null;
        $organization->okno = (string)$fileToObject['okno'] ?? null;
        $organization->name = (string)$fileToObject['name'] ?? null;
        $organization->full_name = (string)$fileToObject['full_name'] ?? null;
        $organization->form_realt = (string)$fileToObject['form_realt'] ?? null;
        $organization->fio_director = (string)$fileToObject['fio_director'] ?? null;
        $organization->phone = (string)$fileToObject['phone'] ?? null;
        $organization->email = (string)$fileToObject['email'] ?? null;
        $organization->url = (string)$fileToObject['url'] ?? null;
        $organization->index = (string)$fileToObject['index'] ?? null;

        if ($organization->validate()) {
            $organization->save();

            if ($isNewOrganization) {
                $logs['result'][] = 'Добавлена компания УНП: ' . (string)$fileToObject['unn'];
            } else {
                $logs['result'][] = 'Найдена и возможно обновлена компания УНП: ' . (string)$fileToObject['unn'];
            }
        }

        $businessPlans = $fileToObject->business_plans->business_plan;

        foreach ($businessPlans as $businessPlan) {

            $businessPlanArray = $businessPlan;

            $businessPlanModel = BusinessPlan::find()->where(['code' => (string)$businessPlanArray['id']])->one();

            if (!$businessPlanModel) {
                $logs['warnings'][] = 'Бизнес план не найден код: ' . (string)$businessPlanArray['id'];
            } else {
                $businessPlanOrg = BusinessPlanOrg::find()
                    ->where(['id_business_plan' => $businessPlanModel->id])
                    ->where(['id_organization' => $organization->id])
                    ->one();

                if (!$businessPlanOrg) {
                    $businessPlanOrg = new BusinessPlanOrg();
                    $businessPlanOrg->id_business_plan = $businessPlanModel->id;
                    $businessPlanOrg->id_organization = $organization->id;

                    if ($businessPlanOrg->validate()) {
                        $businessPlanOrg->save();
                        $logs['result'][] = 'К организации УНП: ' . $organization->unn . " добавлен бизнес план с кодом: " . $businessPlanModel->code;
                    }
                }
            }

            $businessPlanParamsXml = $businessPlanArray->business_params;

            foreach ($businessPlan->business_params as $bpp) {
                $businessPlanParams = BusinessPlanParams::find()
                    ->where(['code' => (string)$bpp['code']])->one();

                if (!$businessPlanParams) { // если есть параметр то выполняем
                    $logs['warnings'][] = 'Параметр бизнес плана с кодом ' . (string)$bpp['code'] . " не найден";
                } else {
                    $bbpValue = BppValue::find()
                        ->where(['id_plan_params' => $businessPlanParams->id])->one();

                    if (!$bbpValue) {
                        $bbpValue = new BppValue();
                        $bbpValue->id_business_plan = $businessPlanModel->id;
                        $bbpValue->id_plan_params = $businessPlanParams->id;
                        $bbpValue->value = trim((string)$bpp[0]);
                        if ($bbpValue->validate()) {
                            $bbpValue->save();
                            $logs['result'][] = 'Параметр: ' . $businessPlanParams->code . ' для плана ' . $businessPlanModel->code . " установлен на " . $bbpValue->value;
                        }
                    }
                }
            }
        }

        return $this->render('add', ['logs' => $logs, 'link' => '/organizations/view?id='.$organization->id]);
    }

}
