<?php

namespace app\controllers\shop;


use app\fond\forms\shop\AddToCartForm;
use app\fond\readModels\CategoryReadRepository;
use app\fond\readModels\ProductReadRepository;
use yii\web\Controller;
use yii\base\Module;
use yii\web\NotFoundHttpException;

class CatalogController extends Controller
{
    public $layout = 'catalog';

    private $categories;
    private $products;

    public function __construct(
        string $id,
        Module $module,
        CategoryReadRepository $categories,
        ProductReadRepository $products,
        array $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->categories = $categories;
        $this->products = $products;
    }

    public function actionIndex()
    {
        $dataProvider = $this->products->getAll();
        $category = $this->categories->getRoot();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'category' => $category,
        ]);
    }

    public function actionCategory($slug)
    {
        if (!$category = $this->categories->findBySlug($slug)){
            throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
        }
        $dataProvider = $this->products->getAllByCategory($category);
        return $this->render('category', [
            'category' => $category,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionProduct($slug)
    {
        if (!$product = $this->products->findBySlug($slug)){
            throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
        }
        $cartForm = new AddToCartForm($product);
        return $this->render('product', [
            'product' => $product,
            'cartForm' => $cartForm,
        ]);
    }
}