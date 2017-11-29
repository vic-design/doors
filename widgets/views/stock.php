<?php
/* @var $this \yii\web\View */
/* @var $stocks \app\fond\entities\manage\Stock */

use yii\helpers\Url;
use yii\helpers\Html;
?>

<div class="stocks-block">
    <div class="row">
        <div class="col-sm-4">
            <h2>Новости и акции</h2>
        </div>
        <div class="col-sm-4 col-sm-offset-4 text-right">
            <a href="<?= Url::to(['/stock/page']) ?>">Смотреть все >>></a>
        </div>
    </div>
    <div class="row">
        <?php foreach ($stocks as $stock): ?>
        <div class="col-sm-3">
            <a href="<?= Url::to(['/stock/node', 'slug' => $stock->slug]) ?>">
                <h4><?= Html::encode($stock->name) ?></h4>
            </a>
            <p class="start">
                <?= $stock->start_day ?>
            </p>
            <div class="stock-summary">
                <?= $stock->summary ?>
            </div>
            <p>
                <a href="<?= Url::to(['/stock/node', 'slug' => $stock->slug]) ?>">
                    Подробнее >>>
                </a>
            </p>
        </div>
        <?php endforeach; ?>
    </div>
</div>
