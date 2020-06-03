<?php
/* @var $this \yii\web\View */

use yii\helpers\Html;
use app\widgets\SliderWidget;
use app\widgets\StockWidget;
use app\widgets\CompanyWidget;
use app\widgets\MapWidget;

$this->title = 'Главная';
?>

<?php $this->beginContent('@app/views/layouts/main.php') ?>
<?= SliderWidget::widget() ?>

<?= StockWidget::widget() ?>

<div class="doors-image">
    <?= Html::img(Yii::getAlias('@web/files/default/door_line.png'), ['alt' => 'Image', 'class' => 'img-responsive']) ?>
</div>

<?= CompanyWidget::widget() ?>

<?= MapWidget::widget() ?>

<?php $this->endContent() ?>
