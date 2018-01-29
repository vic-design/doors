<?php
/* @var $this \yii\web\View */
/* @var $product \app\fond\entities\manage\shop\Product */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;

$url = Url::to(['product', 'slug' => $product->slug]);
?>

<div class="product-layout col-sm-4">
    <div class="product-image">
        <?php if ($product->mainPhoto): ?>
        <div class="product-image">
            <a href="<?= Html::encode($url) ?>">
                <?= Html::img($product->mainPhoto->getThumbFileUrl('file', 'list'), ['alt' => $product->name, 'class' => 'img-responsive']) ?>
            </a>
        </div>
        <?php endif; ?>
    </div>
    <div class="product-caption text-center">
        <a href="<?= Html::encode($url) ?>" class="product-caption-name">
            <h4><?= $product->name ?></h4>
        </a>
        <p class="product-caption-description">
            <?= strip_tags(StringHelper::truncateWords($product->body, 10) ) ?>
        </p>
        <p class="product-caption-old-price text-center">
            <?php if (!empty($product->box_old_price)): ?>
                <?= $product->box_old_price ?> <i class="fa fa-rub"></i>
            <?php endif; ?>
            <?php if (!empty($product->door_old_price)): ?>
                <?= $product->door_old_price ?> <i class="fa fa-rub"></i>
            <?php endif; ?>
        </p>
        <p class="product-caption-price text-center">
            <?= $product->price ?> <i class="fa fa-rub"></i>
        </p>
        <a class="btn btn-primary shopping-button" href="<?= Url::to(['/shop/cart/add', 'id' => $product->id]) ?>">
            <i class="fa fa-shopping-cart hidden-xs"></i> &nbsp;&nbsp; Добавить в корзину
        </a>
    </div>
</div>
