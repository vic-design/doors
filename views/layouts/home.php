<?php
/* @var $this \yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\SliderWidget;
use app\widgets\StockWidget;
use app\widgets\CompanyWidget;
use app\widgets\MapWidget;

$this->title = 'Главная';
$this->registerMetaTag(['name' => 'description', 'content' => '']);
$this->registerMetaTag(['name' => 'keywords0', 'content' => '']);
?>

<?php $this->beginContent('@app/views/layouts/main.php') ?>
<?= SliderWidget::widget() ?>

<div class="down-menu">
    <nav class="navbar navbar-default">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-down-menu-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-down-menu-collapse-1">
            <ul class="nav nav-justified">
                <li><a href="<?= Url::to(['/stock/page']) ?>">Новости и акции</a></li>
                <li><a href="#">Оптовикам</a></li>
                <li><a href="#">Документация</a></li>
                <li><a href="#">Прайс-листы</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</div>

<?= StockWidget::widget() ?>

<div class="doors-image">
    <?= Html::img(Yii::getAlias('@web/files/default/door_line.png'), ['alt' => 'Image', 'class' => 'img-responsive']) ?>
</div>

<?= CompanyWidget::widget() ?>

<?= MapWidget::widget() ?>

<?php $this->endContent() ?>
