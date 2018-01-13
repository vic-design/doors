<?php

namespace app\fond\service\shop;


use app\fond\entities\manage\shop\Size;
use app\fond\forms\manage\shop\SizeForm;
use app\fond\repositories\shop\SizeRepository;

class SizeManageService
{
    private $sizes;

    public function __construct(SizeRepository $sizes)
    {
        $this->sizes = $sizes;
    }

    public function create(SizeForm $form): Size
    {
        $size = Size::create(
            $form->name
        );
        $this->sizes->save($size);

        return $size;
    }

    public function edit($id, SizeForm $form): void
    {
        $size = $this->sizes->get($id);
        $size->edit(
            $form->name
        );
        $this->sizes->save($size);
    }

    public function remove($id): void
    {
        $size = $this->sizes->get($id);
        $this->sizes->remove($size);
    }
}