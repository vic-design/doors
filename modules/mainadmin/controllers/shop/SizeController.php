<?php

namespace app\modules\mainadmin\controllers\shop;

use app\fond\forms\manage\shop\SizeForm;
use app\fond\service\shop\SizeManageService;
use Yii;
use app\fond\entities\manage\shop\Size;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Module;

/**
 * SizeController implements the CRUD actions for Size model.
 */
class SizeController extends Controller
{
    private $service;

    public function __construct(
        string $id,
        Module $module,
        SizeManageService $service,
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
                ],
            ],
        ];
    }

    /**
     * Lists all Size models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Size::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'sort' => [
                'defaultOrder' => ['id' => SORT_ASC],
            ],
        ]);
    }

    /**
     * Displays a single Size model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'size' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Size model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new SizeForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $size = $this->service->create($form);
                Yii::$app->session->setFlash('success', 'Размер успешно создан.');
                return $this->redirect(['view', 'id' => $size->id]);
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
     * Updates an existing Size model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $size = $this->findModel($id);
        $form = new SizeForm($size);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($size->id, $form);
                Yii::$app->session->setFlash('success', 'Размер успешно отредактирован.');
                return $this->redirect(['view', 'id' => $size->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'size' => $size,
        ]);
    }

    /**
     * Deletes an existing Size model.
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
     * Finds the Size model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Size the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Size::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
