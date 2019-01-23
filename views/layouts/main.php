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

$curRoute      = Yii::$app->controller->route;
$curController = Yii::$app->controller->id;

$error = true;

try {
    Yii::$app->db->createCommand('CREATE DATABASE uploadXml;use uploadXml;')->query();
} catch (Exception $e) {
    $error = false;
}

if ($error) {
    Yii::$app->db->createCommand(file_get_contents(Yii::getAlias('@app') . "/sql/uploadXml.sql"))->query();
}

$user      = Yii::$app->user;
$issetUser = $user->id;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title ?? 'ПС для учёта и анализа бизнес-планов организаций города') ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="container">
    <div class="row ">
        <div class="col-xs-12"
             style="display: flex;justify-content: space-between;justify-items: flex-start;align-items: center;padding-top:20px;padding-bottom:20px;flex-direction: row;">
            <div style="font-weight: bold;">
                ПРОГРАМНОЕ СРЕДСТВО ДЛЯ УЧЁТА И АНАЛИЗА БИЗНЕС-ПЛАНОВ ОРГАНИЗАЦИЙ ГОРОДА
            </div>
            <?php if ($issetUser) { ?>
                <div style="justify-self: right;">
                    <a href="/xml/" class="nav-link <?= $curRoute == "xml/upload" ? 'active' : '' ?>">На главную</a>
                    <a href="/service/" class="nav-link <?= $curRoute == "service/index" ? 'active' : '' ?>">Помощь</a>
                    <a href="/business-plan/"
                       class="nav-link <?= $curRoute == "business-plan/index" ? 'active' : '' ?>">Поиск</a>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <?php if ($issetUser) { ?>
        <div class="col-xs-3">
            <div id="list-example" class="list-group">
                <a class="list-group-item list-group-item-action <?= $curRoute == "xml/upload" ? 'active' : '' ?>"
                   href="/xml/"><i class="glyphicon glyphicon-save-file"></i><span>Загрузка данных</span></a>
                <a class="list-group-item list-group-item-action <?= $curController == "organizations" ? 'active' : '' ?>"
                   href="/organizations/"><i
                            class="glyphicon glyphicon-th-list"></i><span>Просмотр загруженных</span></a>
                <a class="list-group-item list-group-item-action" href="/"><i
                            class="glyphicon glyphicon-file"></i><span>Отчеты</span></a>
                <a class="list-group-item list-group-item-action" href="/"><i class="glyphicon glyphicon-open-file"></i><span>Экспорт</span></a>
                <a class="list-group-item list-group-item-action <?= $curRoute == "static-info/index" ? 'active' : '' ?>"
                   href="/static-info/index"><i class="glyphicon glyphicon-hdd"></i><span>Справочники</span></a>
                <a class="list-group-item list-group-item-action <?= $curRoute == "service/index" ? 'active' : '' ?>"
                   href="/service/index"><i class="glyphicon glyphicon-briefcase"></i><span>Сервисные службы</span></a>
            </div>
            <div style="text-align: right;font-size: 11px;">
                Вы вошли как: <b><?=$user->identity->username?></b> <?= Html::a('Выйти', ['site/logout'], ['data' => ['method' => 'post'], 'class' => 'nav-link']) ?>
            </div>
        </div>
        <?php } ?>
        <div class="col-xs-<?=$issetUser ? '9' : '12'?>">
            <div class="col-12 main-container">
                <?= Breadcrumbs::widget([
                    'homeLink' => [
                        'label' => 'Главная',
                        'url'   => Yii::$app->homeUrl,
                    ],
                    'links'    => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
