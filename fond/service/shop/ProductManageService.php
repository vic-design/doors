<?php

namespace app\fond\service\shop;


use app\fond\entities\manage\shop\Product;
use app\fond\forms\manage\shop\FeaturesForm;
use app\fond\forms\manage\shop\PhotosForm;
use app\fond\forms\manage\shop\PriceForm;
use app\fond\forms\manage\shop\ProductCreateForm;
use app\fond\forms\manage\shop\ProductEditForm;
use app\fond\forms\manage\shop\ThicknessForm;
use app\fond\repositories\shop\CategoryRepository;
use app\fond\repositories\shop\ProductRepository;
use app\fond\service\TransactionManager;
use yii\helpers\Inflector;

class ProductManageService
{
    private $products;
    private $categories;
    private $transactions;

    public function __construct(ProductRepository $products, CategoryRepository $categories, TransactionManager $transactions)
    {
        $this->products = $products;
        $this->categories = $categories;
        $this->transactions = $transactions;
    }

    /**
     * @param ProductCreateForm $form
     * @return Product
     * @throws \yii\web\NotFoundHttpException
     */
    public function create(ProductCreateForm $form): Product
    {
        $category = $this->categories->get($form->categories->main);
        $product = Product::create(
            $form->name,
            $category->id,
            $form->code,
            $form->body,
            $form->slug ? : Inflector::slug($form->name),
            $form->title,
            $form->description,
            $form->slug
        );
        $product->setPrice(
            $form->price->doorOldPrice,
            $form->price->boxOldPrice,
            $form->price->boxPrice,
            $form->price->price
        );
        $product->setThickness(
            $form->thickness->doorThickness,
            $form->thickness->doorFrameThickness,
            $form->thickness->doorSteelThickness,
            $form->thickness->frameSteelThickness
        );
        $product->setFeatures(
            $form->features->features,
            $form->features->innerFacing,
            $form->features->outFacing,
            $form->features->glass
        );
        if (!empty($form->categories->others)){
            foreach ($form->categories->others as $otherId){
                $category = $this->categories->get($otherId);
                $product->assignCategory($category->id);
            }
        }
        if (!$form->photos->files){
            foreach ($form->photos->files as $file) {
                $product->addPhoto($file);
            }
        }
        $this->products->save($product);

        return $product;
    }

    /**
     * @param $id
     * @param ProductEditForm $form
     * @throws \yii\db\Exception
     * @throws \yii\web\NotFoundHttpException
     */
    public function edit($id, ProductEditForm $form): void
    {
        $product = $this->products->get($id);
        $category = $this->categories->get($form->categories->main);

        $product->edit(
            $form->name,
            $category->id,
            $form->code,
            $form->body,
            $form->slug ? : Inflector::slug($form->name),
            $form->title,
            $form->description,
            $form->slug
        );
        $product->changeMainCategory($category->id);
        $this->transactions->wrap(function () use ($product, $form){
           $product->removeCategories();
           $this->products->save($product);

            if (!empty($form->categories->others)){
                foreach ($form->categories->others as $otherId){
                    $category = $this->categories->get($otherId);
                    $product->assignCategory($category->id);
                }
            }
            $this->products->save($product);
        });
    }

    ##########

    /**
     * @param $id
     * @param PriceForm $form
     * @throws \yii\web\NotFoundHttpException
     */
    public function changePrice($id, PriceForm $form): void
    {
        $product = $this->products->get($id);
        $product->setPrice(
            $form->doorOldPrice,
            $form->boxOldPrice,
            $form->boxPrice,
            $form->price
        );
        $this->products->save($product);
    }

    /**
     * @param $id
     * @param ThicknessForm $form
     * @throws \yii\web\NotFoundHttpException
     */
    public function changeThickness($id, ThicknessForm $form): void
    {
        $product = $this->products->get($id);
        $product->setThickness(
            $form->doorThickness,
            $form->doorFrameThickness,
            $form->doorSteelThickness,
            $form->frameSteelThickness
        );
        $this->products->save($product);
    }

    /**
     * @param $id
     * @param FeaturesForm $form
     * @throws \yii\web\NotFoundHttpException
     */
    public function changeFeatures($id, FeaturesForm $form): void
    {
        $product = $this->products->get($id);
        $product->setFeatures(
            $form->features,
            $form->innerFacing,
            $form->outFacing,
            $form->glass
        );
        $this->products->save($product);
    }

    #########

    /**
     * @param $id
     * @throws \yii\web\NotFoundHttpException
     */
    public function draft($id): void
    {
        $product = $this->products->get($id);
        $product->draft();
        $this->products->save($product);
    }

    /**
     * @param $id
     * @throws \yii\web\NotFoundHttpException
     */
    public function activate($id): void
    {
        $product = $this->products->get($id);
        $product->activate();
        $this->products->save($product);
    }

    ###########

    /**
     * @param $id
     * @param PhotosForm $form
     * @throws \yii\web\NotFoundHttpException
     */
    public function addPhotos($id, PhotosForm $form): void
    {
        $product = $this->products->get($id);
        foreach ($form->files as $file){
            $product->addPhoto($file);
        }
        $this->products->save($product);
    }

    /**
     * @param $id
     * @param $photoId
     * @throws \yii\web\NotFoundHttpException
     */
    public function movePhotoUp($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->movePhotoUp($photoId);
        $this->products->save($product);
    }

    /**
     * @param $id
     * @param $photoId
     * @throws \yii\web\NotFoundHttpException
     */
    public function movePhotoDown($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->movePhotoDown($photoId);
        $this->products->save($product);
    }

    /**
     * @param $id
     * @param $photoId
     * @throws \yii\web\NotFoundHttpException
     */
    public function removePhoto($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->removePhoto($photoId);
        $this->products->save($product);
    }

    ##########

    /**
     * @param $id
     * @throws \yii\web\NotFoundHttpException
     */
    public function remove($id): void
    {
        $product = $this->products->get($id);
        $this->products->remove($product);
    }
}