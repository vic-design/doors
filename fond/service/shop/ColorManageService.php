<?php

namespace app\fond\service\shop;


use app\fond\entities\manage\shop\Color;
use app\fond\forms\manage\shop\ColorForm;
use app\fond\repositories\shop\ColorRepository;

class ColorManageService
{
    private $colors;

    public function __construct(ColorRepository $colors)
    {
        $this->colors = $colors;
    }

    public function create(ColorForm $form): Color
    {
        $color = Color::create(
            $form->name
        );
        if ($form->image){
            $color->setPhoto($form->image);
        }
        $this->colors->save($color);

        return $color;
    }

    public function edit($id, ColorForm $form): void
    {
        $color = $this->colors->get($id);
        $color->edit(
            $form->name
        );
        if ($form->image){
            $color->setPhoto($form->image);
        }
        $this->colors->save($color);
    }

    public function remove($id): void
    {
        $color = $this->colors->get($id);
        $this->colors->remove($color);
    }
}