<?php

namespace app\controllers;


use app\fond\entities\manage\Stock;
use yii\web\Controller;

class StockController extends Controller
{
    public $layout = 'catalog';

    public function actionPage()
    {
        $stocks = Stock::find()->andWhere(['status' => 1])->orderBy(['created_at' => SORT_DESC])->all();

        return $this->render('page', [
            'stocks' => $stocks,
        ]);
    }

    public function actionNode($slug)
    {
        $stock = Stock::find()->andWhere(['status' => 1])->andWhere(['slug' => $slug])->one();

        return $this->render('node', [
            'stock' => $stock,
        ]);
    }
}