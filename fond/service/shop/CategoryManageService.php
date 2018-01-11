<?php

namespace app\fond\service\shop;


use app\fond\entities\manage\shop\Category;
use app\fond\forms\manage\shop\CategoryForm;
use app\fond\repositories\shop\CategoryRepository;
use app\fond\repositories\shop\ProductRepository;
use yii\helpers\Inflector;

class CategoryManageService
{
    private $categories;
    private $products;

    public function __construct(CategoryRepository $categories, ProductRepository $products)
    {
        $this->categories = $categories;
        $this->products = $products;
    }

    public function create(CategoryForm $form): Category
    {
        $parent = $this->categories->get($form->parentId);
        $category = Category::create(
            $form->name,
            $form->body,
            $form->slug ? : Inflector::slug($form->name),
            $form->title,
            $form->description,
            $form->keywords
        );
        $category->appendTo($parent);
        $this->categories->save($category);

        return $category;
    }

    public function edit($id, CategoryForm $form)
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        $category->edit(
            $form->name,
            $form->body,
            $form->slug ? : Inflector::slug($form->name),
            $form->title,
            $form->description,
            $form->keywords
        );
        if ($form->parentId !== $category->parent->id){
            $parent = $this->categories->get($form->parentId);
            $category->appendTo($parent);
        }
        $this->categories->save($category);
    }

    public function moveUp($id): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($prev = $category->prev){
            $category->insertBefore($prev);
        }
        $this->categories->save($category);
    }

    public function moveDown($id): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($next = $category->next){
            $category->insertAfter($next);
        }
        $this->categories->save($category);
    }

    public function remove($id): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($this->products->existByMainCategory($category->id)){
            throw new \DomainException('Невозможно удалить категорию, к ней привязаны товары.');
        }
        $this->categories->remove($category);
    }

    private function assertIsNotRoot(Category $category): void
    {
        if ($category->isRoot()){
            throw new \DomainException('Невозможно редактировать корневую категорию.');
        }
    }
}