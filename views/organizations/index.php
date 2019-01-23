<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrganizationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Организации';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(['enablePushState' => false]); ?>

<div class="organizations-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить организацию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'full_name',
                'format'    => 'raw',
                'value'     => function ($model) {
                    return Html::a($model->full_name, '/organizations/view?id=' . $model->id, [
                        'target'     => '_blank',
                        'data-pajax' => '0'
                    ]);
                }
            ],
            'unn',
            //'okno',
            //'name',

            //'form_realt',
            //'fio_director',
            'phone',
            //'email:email',
            //'url:url',
            //'index',

            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{delete}'
            ],
        ],
        'emptyText'    => 'Нет данных для отображения!',
    ]); ?>

</div>
<?php Pjax::end(); ?>
