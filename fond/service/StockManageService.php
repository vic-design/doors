<?php

namespace app\fond\service;


use app\fond\entities\manage\Stock;
use app\fond\forms\manage\StockForm;
use app\fond\repositories\StockRepository;
use yii\helpers\Inflector;

class StockManageService
{
    private $stocks;

    public function __construct(StockRepository $stocks) {
        $this->stocks = $stocks;
    }

    public function create(StockForm $form): Stock
    {
        $stock = Stock::create(
            $form->name,
            $form->start_day,
            $form->summary,
            $form->body,
            $form->slug ? : Inflector::slug($form->name),
            $form->title,
            $form->description,
            $form->keywords
        );
        $this->stocks->save($stock);

        return $stock;
    }

    public function edit($id, StockForm $form)
    {
        $stock = $this->stocks->get($id);
        $stock->edit(
            $form->name,
            $form->start_day,
            $form->summary,
            $form->body,
            $form->slug ? : Inflector::slug($form->name),
            $form->title,
            $form->description,
            $form->keywords
        );
        $this->stocks->save($stock);
    }

    public function activate($id)
    {
        $stock = $this->stocks->get($id);
        $stock->activate();
        $this->stocks->save($stock);
    }

    public function draft($id)
    {
        $stock = $this->stocks->get($id);
        $stock->draft();
        $this->stocks->save($stock);
    }

    public function remove($id)
    {
        $stock = $this->stocks->get($id);
        $this->stocks->remove($stock);
    }
}