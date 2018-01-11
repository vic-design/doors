<?php

namespace app\fond\service;


use yii\db\Exception;

class TransactionManager
{
    public function wrap(callable $function)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            $function();
            $transaction->commit();
        }catch (Exception $e){
            $transaction->rollBack();
            throw $e;
        }
    }
}