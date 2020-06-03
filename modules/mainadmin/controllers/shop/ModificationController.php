<?php

namespace app\modules\mainadmin\controllers\shop;

use Yii;
use app\fond\entities\manage\shop\Product;
use app\fond\forms\manage\shop\ModificationForm;
use app\fond\service\shop\ProductManageService;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\base\Module;
use yii\web\NotFoundHttpException;

class ModificationController extends Controller
{
    private $service;

    public function __construct(
        string $id,
        Module $module,
        ProductManageService $service,
        array $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return \yii\web\Response
     */
    public function actionIndex()
    {
        return $this->redirect('shop/product');
    }

    /**
     * @param $productId
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionCreate($productId)
    {
        $product = $this->findModel($productId);
        $form = new ModificationForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->addModification($product->id, $form);
                return $this->redirect(['shop/product/view', 'id' => $product->id, '#' => 'modifications']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
            'product' => $product,
        ]);
    }

    /**
     * @param $productId
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($productId, $id)
    {
        $product = $this->findModel($productId);
        $modification = $product->getModification($id);
        $form = new ModificationForm($modification);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->editModification($product->id, $modification->id, $form);
                return $this->redirect(['shop/product/view', 'id' => $product->id, '#' => 'modifications']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'product' => $product,
            'modification' => $modification,
            'model' => $form,
        ]);
    }

    public function actionDelete($productId, $id)
    {
        $product = $this->findModel($productId);
        try {
            $this->service->removeModification($product->id, $id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['shop/product/view', 'id' => $product->id, '#' => 'modifications']);
    }

    /**
     * @param $id
     * @return Product
     * @throws NotFoundHttpException
     */
    private function findModel($id): Product
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
    }
}