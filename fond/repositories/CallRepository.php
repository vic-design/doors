<?php

namespace app\fond\repositories;


use app\fond\entities\manage\Call;
use yii\web\NotFoundHttpException;

class CallRepository
{
    public function get($id): Call
    {
        if (!$call = Call::findOne($id)){
            throw new NotFoundHttpException('Сообщение не найдено.');
        }
        return $call;
    }

    public function save(Call $call)
    {
        if (!$call->save()){
            throw new \RuntimeException('Ошибка сохранения.');
        }
    }

    public function remove(Call $call)
    {
        if (!$call->delete()){
            throw new \RuntimeException('Ошибка удаления.');
        }
    }
}