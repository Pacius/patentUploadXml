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


$error = true;

try {
    Yii::$app->db->createCommand('CREATE DATABASE uploadXml;')->query();
} catch (Exception $e) {
    $error = false;
}

if ($error) {
    Yii::$app->db->createCommand(file_get_contents(Yii::getAlias('@app') . "/sql/uploadXml.sql"))->query();
}


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
    .btn-light {
        color: #fff;
        background-color: #337ab7;
        border-color: #337ab7;
        transition:0.3s;
        border-radius: 3px;
        border:none;
        padding: 8px 30px;
    }
    .btn-light:hover {
        background-color: #439ae5;

    }
    body {
        font-family: Roboto;
    }
    input[type="file"] {
        padding:10px;
        border:1px solid #337ab7;
        border-radius:3px;
    }
    #w0 {
        margin:0 auto;
        width: 300px;
    }
    #w0 input, #w0 button{
        width:300px;
    }
    .control-label {
        font-size:17px;
    }
    .pux-center {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }
    .control-label {
        text-align: center;
        width: 100%;
    }

    ::-webkit-scrollbar {
        width: 12px;
    }

    ::-webkit-scrollbar-track {
        //-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        //border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        border-radius: 6px;
        background-color: #dddddd;
        width: 4px;
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
                <a class="list-group-item list-group-item-action <?=$curRoute == "service/index" ? 'active' : ''?>" href="/service/index"><i class="glyphicon glyphicon-briefcase"></i><span>Сервисные службы</span></a>
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

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
