<?php
/* @var $this \yii\web\View */
/* @var  $cart \app\fond\cart\Cart */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = 'Корзина покупок';
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="shopping-cart-index container-fluid">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th class="text-left" style="width: 100px"></th>
                <th class="text-left">Название</th>
                <th class="text-left">Модель</th>
                <th class="text-left">Размер</th>
                <th class="text-left">Количество</th>
                <th class="text-right">Стоимость</th>
                <th class="text-right">Всего</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($cart->getItems() as $item): ?>
                <?php
                    $product = $item->getProduct();
                    $modification = $item->getModification();
                    $size = $item->getSize();
                    $url = ['/shop/catalog/product', 'slug' => $product->slug];
                ?>
            <tr>
                <td class="text-center td-image">
                    <?php if (!$modification): ?>
                        <a href="<?= Url::to($url) ?>">
                            <?= Html::img($product->mainPhoto->getThumbFileUrl('file', 'full'), ['alt' => $product->name, 'class' => 'img-responsive']) ?>
                        </a>
                    <?php else: ?>
                        <a href="<?= Url::to($url) ?>">
                            <?= Html::img($modification->getThumbFileUrl('photo', 'full'), ['alt' => $product->name, 'class' => 'img-responsive']) ?>
                        </a>
                    <?php endif; ?>
                </td>
                <td class="text-left">
                    <a href="<?= Url::to($url) ?>">
                        <?= Html::encode($product->name) ?>
                    </a>
                </td>
                <td class="text-left">
                    <?php if ($modification): ?>
                        <?= $modification->additional_name ?>
                    <?php else: ?>
                        <?= $product->additional_name ?>
                    <?php endif; ?>
                </td>
                <td class="text-left">
                    <?php if ($size): ?>
                        <?= $size ?>
                    <?php endif; ?>
                </td>
                <td class="text-left">
                    <?= Html::beginForm(['quantity', 'id' => $item->getId()]) ?>
                        <div class="input-group btn-block" style="max-width: 200px">
                            <label for="number" class="sr-only">Количество</label>
                            <input type="number" id="number" name="quantity" value="<?= $item->getQuantity() ?>" size="1" step="1" min="1" class="form-control">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary" data-original-title="Обновить">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <a href="<?= Url::to(['remove', 'id' => $item->getId()]) ?>" title="Удалить" data-method="post" class="btn btn-danger">
                                    <i class="fa fa-times-circle"></i>
                                </a>
                            </span>
                        </div>
                    <?= Html::endForm() ?>
                </td>
                <td class="text-right">
                    <strong><?= $item->getPrice() ?></strong> <i class="fa fa-rub"></i>
                </td>
                <td class="text-right">
                    <strong><?= $item->getCost() ?></strong> <i class="fa fa-rub"></i>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
            <?php $cost = $cart->getCost() ?>
            <table class="table table-bordered">
                <tr>
                    <td class="text-right">
                        <strong>Итого</strong>
                    </td>
                    <td class="text-right">
                        <?= $cost->getOrigin() ?> <i class="fa fa-rub"></i>
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        Вес
                    </td>
                    <td class="text-right">
                        <?= $cart->getWeight() ?> кг
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4 text-center">
            <?= Html::a('Продолжить покупки', ['/shop/catalog/index'], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="col-sm-4 text-center">
            <?= Html::a('Оформить заказ', ['/shop/checkout/index'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-sm-4 text-center">
            <?= Html::a('Очистить корзину', ['/shop/cart/clear'], ['class' => 'btn btn-danger']) ?>
        </div>
    </div>
</div>
