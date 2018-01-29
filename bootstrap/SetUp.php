<?php
namespace app\bootstrap;

use app\fond\cart\Cart;
use app\fond\cart\cost\calculator\SimpleCost;
use app\fond\cart\storage\CookieStorage;
use yii\base\BootstrapInterface;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->set(CKEditor::class, [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder'),
        ]);

        $container->setSingleton(Cart::class, function () use ($app){
           return new Cart(
               new CookieStorage('cart', 3600 * 24),
               new SimpleCost()
           );
        });
    }
}