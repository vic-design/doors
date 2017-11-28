<?php

namespace app\fond\service;


use app\fond\entities\manage\Message;
use app\fond\forms\manage\MessageForm;
use app\fond\repositories\MessageRepository;

class MessageManageService
{
    private $messages;

    public function __construct(MessageRepository $messages) {
        $this->messages = $messages;
    }

    public function create(MessageForm $form)
    {
        $message = Message::create(
                $form->name,
                $form->phone,
                $form->email,
                $form->body
        );
        $this->messages->save($message);

        $subject = 'Опаньки ... '.$form->name.' написал Вам сообщение с Вашего сайта';
        $body = '<p> Подробности: <br>';
        $body .= 'ФИО : '.$form->name.'<br>';
        $body .= 'Телефон: '.$form->phone.'<br>';
        if ($form->email):
            $body .= 'Email :'.$form->email.'<br>';
        endif;
        $body .= 'Текст сообщения: <br>';
        $body .= $form->body.'</p>';
        $body .= '<p>Сайт '.\Yii::$app->name.'</p>';
        $to = \Yii::$app->params['adminEmail'];

        $send = \Yii::$app->mailer->compose()
                ->setSubject($subject)
                ->setTo($to)
                ->setHtmlBody($body)
                ->send();

        if (!$send){
            throw new \DomainException('Ошибка отправки');
        }
    }

    public function activate($id)
    {
        $message = $this->messages->get($id);
        $message->activate();
        $this->messages->save($message);
    }

    public function remove($id)
    {
        $message = $this->messages->get($id);
        $this->messages->remove($message);
    }
}