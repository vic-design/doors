<?php

namespace app\modules\mainadmin\controllers\shop;

use app\fond\entities\manage\shop\Modification;
use app\fond\forms\manage\shop\FeaturesForm;
use app\fond\forms\manage\shop\PhotosForm;
use app\fond\forms\manage\shop\PriceForm;
use app\fond\forms\manage\shop\ProductCreateForm;
use app\fond\forms\manage\shop\ProductEditForm;
use app\fond\forms\manage\shop\ThicknessForm;
use app\fond\service\shop\ProductManageService;
use Yii;
use app\fond\entities\manage\shop\Product;
use app\modules\mainadmin\forms\ProductSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Module;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'activate' => ['POST'],
                    'draft' => ['POST'],
                    'move-photo-up' => ['POST'],
                    'move-photo-down' => ['POST'],
                    'remove-photo' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $product = $this->findModel($id);
        $modificationsProvider = new ActiveDataProvider([
            'query' => $product->getModifications()->orderBy('name'),
            'key' => function (Modification $modification) use ($product) {
                return [
                    'productId' => $product->id,
                    'id' => $modification->id,
                ];
            },
            'pagination' => false,
        ]);
        $photosForm = new PhotosForm();
        if ($photosForm->load(Yii::$app->request->post()) && $photosForm->validate()) {
            try {
                $this->service->addPhotos($product->id, $photosForm);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('view', [
            'product' => $product,
            'photosForm' => $photosForm,
            'modificationsProvider' => $modificationsProvider,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new ProductCreateForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $product = $this->service->create($form);
                Yii::$app->session->setFlash('success', 'Новый товар успешно создан.');
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $product = $this->findModel($id);
        $form = new ProductEditForm($product);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($product->id, $form);
                Yii::$app->session->setFlash('success', 'Товар успешно отредактирован.');
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'product' => $product,
        ]);

    }

    public function actionPrice($id)
    {
        $product = $this->findModel($id);
        $form = new PriceForm($product);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->changePrice($product->id, $form);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('price', [
            'product' => $product,
            'model' => $form,
        ]);
    }

    public function actionThickness($id)
    {
        $product = $this->findModel($id);
        $form = new ThicknessForm($product);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->changeThickness($product->id, $form);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('thickness', [
            'product' => $product,
            'model' => $form,
        ]);
    }

    public function actionFeature($id)
    {
        $product = $this->findModel($id);
        $form = new FeaturesForm($product);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->changeFeatures($product->id, $form);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('feature', [
            'product' => $product,
            'model' => $form,
        ]);
    }

    public function actionDraft($id)
    {
        try {
            $this->service->draft($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getCode());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionActivate($id)
    {
        try {
            $this->service->activate($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getCode());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionMovePhotoUp($id, $photoId)
    {
        $this->service->movePhotoUp($id, $photoId);
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }

    public function actionMovePhotoDown($id, $photoId)
    {
        $this->service->movePhotoDown($id, $photoId);
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }

    public function actionRemovePhoto($id, $photoId)
    {
        try {
            $this->service->removePhoto($id, $photoId);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getCode());
        }
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
