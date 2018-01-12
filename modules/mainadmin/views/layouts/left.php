<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image" style="height: 50px;">

            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity['username'] ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Меню администратора', 'options' => ['class' => 'header']],
                    ['label' => 'Сайт', 'icon' => 'folder', 'items' => [
                        ['label' => 'Статьи', 'icon' => 'clone', 'url' => ['/mainadmin/article']],
                        ['label' => 'Слайдеры', 'icon' => 'camera', 'url' => ['/mainadmin/slider']],
                        ['label' => 'Сообщения', 'icon' => 'envelope', 'url' => ['/mainadmin/message']],
                        ['label' => 'Заказы звонка', 'icon' => 'phone', 'url' => ['/mainadmin/call']],
                        ['label' => 'Акции и новости', 'icon' => 'money', 'url' => ['/mainadmin/stock']],
                    ]],
                    ['label' => 'Магазин', 'icon' => 'shopping-bag', 'items' => [
                        ['label' => 'Категории', 'icon' => 'list-alt', 'url' => ['/mainadmin/shop/category/index'], 'active' => Yii::$app->controller->id == 'shop/category'],
                        ['label' => 'Цвета', 'icon' => 'paint-brush', 'url' => ['/mainadmin/shop/color/index'], 'active' => Yii::$app->controller->id == 'shop/color'],
                        ['label' => 'Материалы', 'icon' => 'object-ungroup', 'url' => ['/mainadmin/shop/material/index'], 'active' => Yii::$app->controller->id == 'shop/material'],
                        ['label' => 'Товары', 'icon' => 'bank', 'url' => ['/mainadmin/shop/product/index'], 'active' => Yii::$app->controller->id == 'shop/product'],
                    ]],
                    /*['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Same tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],*/
                ],
            ]
        ) ?>

    </section>

</aside>
