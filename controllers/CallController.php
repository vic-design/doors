<?php

namespace app\controllers;


use app\fond\forms\manage\CallForm;
use app\fond\service\CallManageService;
use yii\web\Controller;
use app\modules\mainadmin\Module;

class CallController extends Controller
{
    private $service;

    public function __construct(
        $id,
        $module,
        CallManageService $service,
        array $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionNode()
    {
        $form = new CallForm();
        if ($form->load(\Yii::$app->request->post()) && $form->validate()){
            try{
                $this->service->create($form);
                \Yii::$app->session->setFlash('success', 'Спасибо! Ваше сообщение отправлено. Наши менеджеры свяжутся с Вами в ближайшее время.');
                return $this->redirect(\Yii::$app->request->referrer);
            }catch (\DomainException $e){
                \Yii::$app->errorHandler->logException($e);
                \Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->renderAjax('node', [
            'model' => $form,
        ]);
    }
}