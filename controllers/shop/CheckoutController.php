<?php
namespace app\controllers\shop;

use Yii;
use app\fond\cart\Cart;
use app\fond\forms\shop\OrderForm;
use app\fond\service\shop\OrderService;
use yii\web\Controller;
use yii\base\Module;
use yii\helpers\Url;

class CheckoutController extends Controller
{
    public $layout = 'blanck';

    private $service;
    private $cart;

    public function __construct(
        string $id,
        Module $module,
        OrderService $service,
        Cart $cart,
        array $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->cart = $cart;
    }

    public function actionIndex()
    {
        $form = new OrderForm($this->cart->getCost()->getTotal());
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->checkout($form);
                Yii::$app->session->setFlash('success', 'Спасибо! Ваш заказ принят. В ближайшее время с Вами свяжется менеджер для уточнения деталей оплаты, доставки и т.п.');
                return $this->redirect(Url::home());
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('index', [
            'cart' => $this->cart,
            'model' => $form,
        ]);
    }
}