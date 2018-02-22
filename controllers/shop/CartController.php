<?php

namespace app\controllers\shop;

use app\fond\forms\shop\AddToCartForm;
use Yii;
use app\fond\readModels\ProductReadRepository;
use app\fond\service\shop\CartService;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\base\Module;
use yii\web\NotFoundHttpException;

class CartController extends Controller
{
    public $layout = 'blanck';

    private $service;
    private $products;

    public function __construct(
        string $id,
        Module $module,
        CartService $service,
        ProductReadRepository $products,
        array $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->products = $products;
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'quantity' => ['POST'],
                    'remove' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $cart = $this->service->getCart();

        return $this->render('index', [
            'cart' => $cart,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionAdd($id)
    {
        if (!$product = $this->products->find($id)){
            throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
        }
        $form = new AddToCartForm($product);
        if ($form->load(Yii::$app->request->post()) && $form->validate()){
            try{
                $this->service->add($product->id, $form->modification ? : null, $form->size ?: null, $form->quantity);
                return $this->redirect(Yii::$app->request->referrer);
            }catch (\DomainException $e){
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->renderAjax('add', [
           'product' => $product,
            'model' => $form,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function actionQuantity($id)
    {
        try{
            $this->service->set($id, (int)Yii::$app->request->post('quantity'));
        }catch (\DomainException $e){
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    public function actionRemove($id)
    {
        try{
            $this->service->remove($id);
        }catch (\DomainException $e){
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    public function actionClear()
    {
        try{
            $this->service->clear();
        }catch (\DomainException $e){
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}