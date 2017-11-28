<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
use app\assets\LtAppAsset;
use app\widgets\Alert;

AppAsset::register($this);
LtAppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>РД-ТРЕЙДИНГ | <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap container">
    <div class="top-string">
        <div class="row">
            <div class="top-address col-sm-4 text-center">
                <i class="fa fa-map-marker"></i> &nbsp; Ростов-на-Дону, Орская, д 31в, офис 4
            </div>
            <div class="left-phone col-sm-2 col-sm-offset-1 text-center">
                <i class="fa fa-phone"></i> &nbsp; +7 903 47 24 333
            </div>
            <div class="right-phone col-sm-2 text-center">
                <i class="fa fa-phone"></i> &nbsp; +7 863 22 15 082
            </div>
            <div class="measure col-sm-3">
                <?= Html::a('Вызвать замерщика', [''], ['class' => 'measureCall']) ?>
            </div>
        </div>
    </div><!--top-string-->
    <div class="header">
        <div class="row">
            <div class="logo col-sm-4">
                <div>
                    <?= Html::a(Html::img(Yii::getAlias('@web/files/default/logo.png'), ['alt' => 'На главную', 'class' => 'img-responsive']), Url::home()) ?>
                </div>
            </div>
            <div class="header-banner col-sm-4 text-center">
                Производство и продажа
                красивых и качественных
                входных и межкомнатных дверей
            </div>
            <div class="header-right col-sm-3 col-sm-offset-1">
                <div class="text-center">
                    <?= Html::img(Yii::getAlias('@web/files/default/clock.png'), ['alt' => 'Image', 'class' => 'xs-hidden']) ?>
                    Пн-пт 09:00 - 18:00 <br>
                    Сб-вс 10:00 - 14:00
                </div>
                <div>
                    <?= Html::a('Обратная связь', [''], ['backCall']) ?>
                </div>
            </div>
        </div>
    </div><!--header-->
    <div class="top-menu">
        <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav nav-justified">
                        <li><a href="#">Главная</a></li>
                        <li><a href="#">О компании</a></li>
                        <li><a href="#">Каталог</a></li>
                        <li><a href="#">Акции</a></li>
                        <li><a href="#">Оптовикам</a></li>
                        <li><a href="#">Контакты</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
        </nav>
    </div><!--top-menu-->
    <div class="alert-block">
        <?= Alert::widget() ?>
    </div>
    <div class="main-content">
        <?= $content ?>
        <div class="footer-push"></div>
    </div><!--main-content-->
</div><!--wrap-->
<div class="footer container">
    <div class="footer-top">
        <div class="row">
            <div class="footer-logo col-sm-5">
                <?= Html::a(Html::img(Yii::getAlias('@web/files/default/logo_bottom.png'), ['alt' => 'На главную', 'class' => 'img-responsive']), Url::home()) ?>
            </div>
            <div class="footer-contact col-sm-5 col-sm-offset-2">
                <p>
                    <i class="fa fa-map-marker"></i>  Ростов-на-Дону, Орская, д 31в, офис 4
                </p>
                <p>
                    <i class="fa fa-phone"></i>  +7 903 47 24 333  <i class="fa fa-phone"></i>  +7 863 22 15 082
                </p>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p class="text-center">
            &copy;  РД-ТРЕЙДИНГ &nbsp;&nbsp;<?= date('Y') ?>
        </p>
    </div>
</div><!--footer-->

<?php $this->endBody() ?>
</body>

<?php $this->endPage() ?>
