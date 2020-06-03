<?php

namespace app\modules\mainadmin\controllers;

use app\fond\forms\manage\SlideForm;
use app\fond\forms\manage\SliderCreateForm;
use app\fond\forms\manage\SliderEditForm;
use app\fond\service\SlidersManageService;
use Yii;
use app\fond\entities\manage\Slider;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Module;

/**
 * SliderController implements the CRUD actions for Slider model.
 */
class SliderController extends Controller
{
    private $service;

    public function __construct(
        $id,
        Module $module,
        SlidersManageService $service,
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
                    'delete-slide' => ['POST'],
                    'move-slide-up' => ['POST'],
                    'move-slide-down' => ['POST']
                ],
            ],
        ];
    }

    /**
     * Lists all Slider models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Slider::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Slider model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $slider = $this->findModel($id);
        $slidesForm = new SlideForm();

        if ($slidesForm->load(Yii::$app->request->post()) && $slidesForm->validate()) {
            try {
                $this->service->addSlides($slider->id, $slidesForm);
                return $this->redirect(['view', 'id' => $slider->id, '#' => 'slides']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('view', [
            'slider' => $slider,
            'slidesForm' => $slidesForm,
        ]);
    }

    /**
     * Creates a new Slider model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new SliderCreateForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $slider = $this->service->create($form);
                Yii::$app->session->setFlash('success', 'Слайдер успешно создан.');
                return $this->redirect(['view', 'id' => $slider->id]);
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
     * Updates an existing Slider model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $slider = $this->findModel($id);
        $form = new SliderEditForm($slider);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($slider->id, $form);
                Yii::$app->session->setFlash('success', 'Слайдер успешно отредактирован.');
                return $this->redirect(['view', 'id' => $slider->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'slider' => $slider,
        ]);
    }

    public function actionMoveSlideUp($id, $slideId)
    {
        try {
            $this->service->moveSlideUp($id, $slideId);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id, '#' => 'slides']);
    }

    public function actionMoveSlideDown($id, $slideId)
    {
        try {
            $this->service->moveSlideDown($id, $slideId);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id, '#' => 'slides']);
    }

    public function actionDeleteSlide($id, $slideId)
    {
        try {
            $this->service->removeSlide($id, $slideId);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id, '#' => 'slides']);
    }

    /**
     * Deletes an existing Slider model.
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
     * Finds the Slider model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Slider the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Slider::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
