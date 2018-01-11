<?php

namespace app\fond\repositories;


use app\fond\entities\manage\Message;
use yii\web\NotFoundHttpException;

class MessageRepository
{
    public function get($id): Message
    {
        if (!$message = Message::findOne($id)){
            throw new NotFoundHttpException('Сообщение не найдено.');
        }
        return $message;
    }

    public function save(Message $message){
        if (!$message->save()){
            throw new \RuntimeException('Ошибка сохранения.');
        }
    }

    public function remove(Message $message)
    {
        if (!$message->delete()){
            throw new \RuntimeException('Ошибка удаления.');
        }
    }
}