<?php

namespace app\controllers;

use app\models\BusinessPlan;
use app\models\BusinessPlanOrg;
use Yii;
use app\models\Organizations;
use app\models\OrganizationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\BusinessPlanOrgSearch;
use app\models\BppValueSearch;

use yii\web\Request;

/**
 * OrganizationsController implements the CRUD actions for Organizations model.
 */
class OrganizationsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Organizations models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new OrganizationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Organizations model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $id_organization = Yii::$app->request->get('id');

        $searchModelBpo                  = new BusinessPlanOrgSearch();
        $searchModelBpo->id_organization = $id_organization;
        $dataProviderBpo                 = $searchModelBpo->search(Yii::$app->request->queryParams);


        $searchModelBpv = new BppValueSearch();

        $businessPlanId = BusinessPlanOrg::find()
            ->where(['value' => 1])
            ->andWhere(['id_organization' => $id_organization])
            ->one();
        $searchModelBpv->id_business_plan = $businessPlanId->id_business_plan;
        $dataProviderBpv = $searchModelBpv->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model'           => $this->findModel($id),
            'searchModelBpo'  => $searchModelBpo,
            'dataProviderBpo' => $dataProviderBpo,
            'searchModelBpv'  => $searchModelBpv,
            'dataProviderBpv' => $dataProviderBpv
        ]);
    }

    /**
     * Creates a new Organizations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Organizations();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Organizations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Organizations model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Organizations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Organizations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Organizations::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
