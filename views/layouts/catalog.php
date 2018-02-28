<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\CategoryWidget;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php $this->beginContent('@app/views/layouts/main.php') ?>

<div class="row">
    <div class="aside col-sm-3">
        <div class="aside-menu">
            <ul>
                <?= CategoryWidget::widget([
                    'active' => $this->params['active_category'] ?? null,
                ]) ?>
            </ul>
        </div>
        <div class="sidebar-menu">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation"><a href="<?= Url::to(['/article/node', 'slug' => 'optovikam']) ?>">Оптовикам</a></li>
                <li role="presentation"><a href="<?= Url::to(['/article/node', 'slug' => 'dokumentacia']) ?>">Документация</a></li>
                <li role="presentation"><a href="<?= Url::to(['/article/node', 'slug' => 'prajs-listy']) ?>">Прайс-листы</a></li>
            </ul>
        </div>
    </div>
    <div class="content col-sm-9">
        <div class="container-fluid">
            <?= $content ?>
        </div>

    </div>
</div>

<?php $this->endContent() ?>
