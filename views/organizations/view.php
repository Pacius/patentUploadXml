<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Organizations */

$this->title                   = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="organizations-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Вы точно хотите удалить организацию?',
                'method'  => 'post',
            ],
        ]) ?>
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
                'attribute' => 'id_business_plan',
                'format'    => 'raw',
                'value'     => function ($model) {
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
                'attribute' => 'value',
                'value'     => function ($model) {
                    return $model->value ? 'Да' : 'Нет';
                }
            ],
            [
                'class'      => 'yii\grid\ActionColumn',
                'template'   => '{delete}',
                'controller' => 'business-plan-org'
            ],
        ],
        'emptyText' => 'Нет бизнес планов для организации!',

    ]); ?>

</div>
