<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php $this->beginContent('@app/views/layouts/main.php') ?>

<div class="row">
    <div class="sidebar-left col-sm-3">
        <div class="sidebar-menu">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation"><a href="#">Новости и акции</a></li>
                <li role="presentation"><a href="#">Оптовикам</a></li>
                <li role="presentation"><a href="#">Документация</a></li>
                <li role="presentation"><a href="#">Прайс-листы</a></li>
            </ul>
        </div>
    </div>
    <div class="content col-sm-9">

        <?= $content ?>

    </div>
</div>

<?php $this->endContent() ?>
