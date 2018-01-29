<?php
/* @var $cart \app\fond\cart\Cart */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="btn-group btn-cart" id="cart">
    <?php  if ($cart->getAmount() == 0): ?>
    <button type="button" class="btn btn-block">
        <i class="fa fa-shopping-cart"></i> <span id="cart-total">
            Корзина пуста
        </span>
    </button>
    <?php else: ?>
    <button type="button" data-toggle="dropdown" data-loading-text="Загружаюсь ..." class="btn btn-block toggle-dropdown" aria-expanded="false">
        <i class="fa fa-shopping-cart"></i>
        <span id="cart-total">
            <?= $cart->getAmount() ?> товар (а, ов) - <?= $cart->getCost()->getTotal() ?> <i class="fa fa-rub"></i>
        </span>
    </button>
    <ul class="dropdown-menu pull-right dropdown-basket">
        <li>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tbody>
                    <?php foreach ($cart->getItems() as $item): ?>
                        <?php
                        $product = $item->getProduct();
                        $modification = $item->getModification();
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
                        <td class="text-right">x <?= $item->getQuantity() ?></td>
                        <td class="text-right">
                            <strong><?= $item->getCost() ?></strong> <i class="fa fa-rub"></i>
                        </td>
                        <td class="text-center">
                            <a href="<?= Url::to(['/shop/cart/remove', 'id' => $item->getId()]) ?>" title="Удалить" class="btn btn-danger btn-xs" data-method="post"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </li>
        <li>
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
            <div class="row">
                <div class="col-sm-3 text-center">
                    <?= Html::a('Продолжить покупки', ['/shop/catalog/index'], ['class' => 'btn btn-primary']) ?>
                </div>
                <div class="col-sm-3 text-center">
                    <?= Html::a('Перейти в корзину', ['/shop/cart/index'], ['class' => 'btn btn-warning']) ?>
                </div>
                <div class="col-sm-3 text-center">
                    <?= Html::a('Оформить заказ', ['/shop/checkout/index'], ['class' => 'btn btn-success']) ?>
                </div>
                <div class="col-sm-3 text-center">
                    <?= Html::a('Очистить корзину', ['/shop/cart/clear'], ['class' => 'btn btn-danger']) ?>
                </div>
            </div>
        </li>
    </ul>
    <?php endif; ?>
</div>
