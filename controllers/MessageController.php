<?php

namespace app\controllers;


use app\fond\forms\manage\MessageForm;
use app\fond\service\MessageManageService;
use yii\web\Controller;
use yii\base\Module;

class MessageController extends Controller
{
    private $service;

    public function __construct(
        $id,
        Module $module,
        MessageManageService $service,
        array $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionNode()
    {
        $form = new MessageForm();
        if ($form->load(\Yii::$app->request->post()) && $form->validate()){
            try{
                $this->service->create($form);
                \Yii::$app->session->setFlash('success', 'Спасибо! Ваше сообщение отправлено. Вы получите ответ в ближайшее время.');
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