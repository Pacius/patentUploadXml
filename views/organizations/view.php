<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Organizations */

$this->title                   = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<style>
    a.glyphicon {
        text-decoration: none;
    }
</style>
<div class="organizations-view">

    <h1>
        <?= Html::encode($this->title) ?>
        <span style="font-size:16px;">
            <?= Html::a('', ['update', 'id' => $model->id], ['class' => 'glyphicon glyphicon-edit']) ?>
            <?= Html::a('', ['delete', 'id' => $model->id], [
                'class' => 'glyphicon glyphicon-remove',
                'data'  => [
                    'confirm' => 'Вы точно хотите удалить организацию?',
                    'method'  => 'post',
                ],
            ]) ?>
        </span>
    </h1>

    <p>

    </p>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            'unn',
            'okno',
            'name',
            'full_name',
            'form_realt',
            'fio_director',
            'phone',
            'email:email',
            'url:url',
            'index',
        ],
    ]) ?>

    <div>
        <h2>Бизнес планы организации</h2>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBpo,
        //'filterModel' => $searchModelBpo,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                //'attribute' => 'id_business_plan',
                'label'  => 'Бизнес план',
                'format' => 'raw',
                'value'  => function ($model) {
                    return '<a href="/business-plan-view/view?id=' . $model->businessPlan->id . '">' . $model->businessPlan->name . '</a>';
                }
            ],
            [
                'label' => 'Описание',
                'value' => function ($model) {
                    return $model->businessPlan->description;
                }
            ],
            [
                'label' => 'Используется?',
                'value' => function ($model) {
                    return $model->value ? 'Да' : 'Нет';
                }
            ],
            [
                'class'      => 'yii\grid\ActionColumn',
                'template'   => '{delete}',
                'controller' => 'business-plan-org'
            ],
        ],
        'emptyText'    => 'Нет бизнес планов для организации!',

    ]); ?>

    <div>
        <h2>Действия направленные на осуществление бизнес плана</h2>
    </div>

    <?php Pjax::begin(['enablePushState' => false]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProviderBpv,
        //'filterModel'  => $searchModelBpv,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Код',
                'value' => function ($model) {
                    return $model->planParams->code;
                }
            ],
            [
                'label' => 'Название',
                'value' => function ($model) {
                    return $model->planParams->name;
                }
            ],
            [
                'label' => 'Описание параметра',
                'value' => function ($model) {
                    return $model->planParams->name;
                }
            ],
            //'id_business_plan',
            [
                'label' => 'Значение',
                'value' => function ($model) {
                    return $model->value;
                }
            ],

            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{delete}'
            ],
        ],
        'emptyText'    => 'Данных по параметрам не найдено!',
    ]); ?>
    <?php Pjax::end(); ?>
</div>
