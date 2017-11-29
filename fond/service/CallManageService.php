<?php

namespace app\fond\service;


use app\fond\entities\manage\Call;
use app\fond\forms\manage\CallForm;
use app\fond\repositories\CallRepository;

class CallManageService
{
    private $calls;

    public function __construct(CallRepository $calls) {
        $this->calls = $calls;
    }

    public function create(CallForm $form)
    {
        $call = Call::create(
            $form->name,
            $form->phone
        );
        $this->calls->save($call);

        $subject = $form->name.' хочет вызвать замерщика.';
        $body = '<p>Подробности: <br>';
        $body .= 'ФИО: '.$form->name.'<br>';
        $body .= 'Телефон: '.$form->phone.'</p>';
        $body .= '<p>Сайт '.\Yii::$app->name.'</p>';
        $to = \Yii::$app->params['adminEmail'];

        $sent = \Yii::$app->mailer->compose()
                ->setSubject($subject)
                ->setTo($to)
                ->setHtmlBody($body)
                ->send();

        if (!$sent){
            throw new \DomainException('Ошибка отправки.');
        }
    }

    public function activate($id)
    {
        $call = $this->calls->get($id);
        $call->activate();
        $this->calls->save($call);
    }

    public function remove($id)
    {
        $call = $this->calls->get($id);
        $this->calls->remove($call);
    }
}