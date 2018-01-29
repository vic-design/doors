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

<?= StockWidget::widget() ?>

<div class="doors-image">
    <?= Html::img(Yii::getAlias('@web/files/default/door_line.png'), ['alt' => 'Image', 'class' => 'img-responsive']) ?>
</div>

<?= CompanyWidget::widget() ?>

<?= MapWidget::widget() ?>

<?php $this->endContent() ?>
