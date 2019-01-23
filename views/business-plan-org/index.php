<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BusinessPlanOrgSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Business Plan Orgs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-plan-org-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Business Plan Org', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'id_business_plan',
                'format'    => 'raw',
                'value' => function ($model,$t) {
                    return '<a href="/business-plan-view/?view='.$model->businessPlan->id.'">'.$model->businessPlan->name.'</a>';
                }
            ],
            'id_organization',
            'value',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
