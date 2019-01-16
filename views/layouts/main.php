<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

$curRoute = Yii::$app->controller->route;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<style>
    .nav-link {
        text-decoration: none!important;
        padding: 0 10px;
    }
    .nav-link:hover {
        color:black;
    }
    .list-group-item i{
        margin-right: 10px;
    }
    .main-container {
        border: 1px solid #ddd;
        border-radius: 2px;
        min-height: 247px;
        padding: 10px;
    }
    .nav-link {
        opacity: 0.6;
    }
    .nav-link.active {
        opacity: 1;
    }
</style>

<div class="container">
    <div class="row ">

        <div class="col-xs-12"
             style="display: flex;justify-content: space-between;justify-items: flex-start;align-items: center;padding-top:20px;padding-bottom:20px;flex-direction: row;">
            <div style="font-weight: bold;">
                ПРОГРАМНОЕ СРЕДСТВО ДЛЯ УЧЁТА И АНАЛИЗА БИЗНЕС-ПЛАНОВ ОРГАНИЗАЦИЙ ГОРОДА
            </div>
            <div style="justify-self: right;">
                <a href="/" class="nav-link <?=$curRoute == "site/index" ? 'active' : ''?>">На главную</a>
                <a href="/" class="nav-link ">Помощь</a>
                <a href="/" class="nav-link ">Поиск</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3">
            <div id="list-example" class="list-group">
                <a class="list-group-item list-group-item-action <?=$curRoute == "xml/upload" ? 'active' : ''?>" href="/xml/"><i class="glyphicon glyphicon-save-file"></i><span>Загрузка данных</span></a>
                <a class="list-group-item list-group-item-action" href="/"><i class="glyphicon glyphicon-th-list"></i><span>Просмотр загруженных</span></a>
                <a class="list-group-item list-group-item-action" href="/"><i class="glyphicon glyphicon-file"></i><span>Отчеты</span></a>
                <a class="list-group-item list-group-item-action" href="/"><i class="glyphicon glyphicon-open-file"></i><span>Экспорт</span></a>
                <a class="list-group-item list-group-item-action <?=$curRoute == "static-info/index" ? 'active' : ''?>" href="/static-info/index"><i class="glyphicon glyphicon-hdd"></i><span>Справочники</span></a>
                <a class="list-group-item list-group-item-action" href="/"><i class="glyphicon glyphicon-briefcase"></i><span>Сервисные службы</span></a>
            </div>
        </div>

        <div class="col-xs-9" >
                <div class="col-12 main-container">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
        </div>
    </div>
</div>

<div class="container">
    Мисько Никита
    <pre>
        <Поля данных>
        <Организация>
            параметры организации
            <Бизнес-план>
                <Показатели бизнес-плана>
                    <Дата/>
                </Показатели бизнес-плана>
                <Направления фин.оздоровления>
                    <Период С/>
                    <Период По/>
                </Направления фин.оздоровления>
            </Бизнес-план>
            <Мероприятия по эффект. использованию>
                параметры
            </Мероприятия по эффект. использованию>
            <Изменения бизнес-плана>
                параметры
            </Изменения бизнес-плана>
        </Организация>
    </Поля данных>
    </pre>

</div>


<!--<div class="wrap">
    <?php
/*    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    */ ?>

    <div class="container">
        <? /*= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) */ ?>
        <? /*= Alert::widget() */ ?>
        <? /*= $content */ ?>
    </div>
</div>-->
<!--
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer> -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
