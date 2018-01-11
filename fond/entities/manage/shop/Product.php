<?php

namespace app\fond\entities\manage\shop;


use app\fond\entities\manage\shop\queries\ProductQuery;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * @property int $id [int(11)]
 * @property string $name [varchar(255)]
 * @property int $category_id [int(11)]
 * @property int $main_photo_id [int(11)]
 * @property string $code [varchar(255)]
 * @property string $body
 * @property int $door_old_price [int(11)]
 * @property int $box_old_price [int(11)]
 * @property int $box_price [int(11)]
 * @property int $price [int(11)]
 * @property string $slug [varchar(255)]
 * @property int $status [smallint(6)]
 * @property float $door_thickness [float]
 * @property float $door_frame_thickness [float]
 * @property float $door_steel_thickness [float]
 * @property float $frame_steel_thickness [float]
 * @property string $features
 * @property string $inner_facing [varchar(255)]
 * @property string $out_facing [varchar(255)]
 * @property string $glass [varchar(255)]
 * @property string $title [varchar(255)]
 * @property string $description [varchar(255)]
 * @property string $keywords [varchar(255)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 *
 * @property CategoryAssignment[] categoryAssignments
 * @property Photo[] photos
 * @property Photo $mainPhoto
 */
class Product extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    public static function create($name, $categoryId, $code, $body, $slug, $title, $description, $keywords): self
    {
        $product = new static();
        $product->name = $name;
        $product->category_id = $categoryId;
        $product->code = $code;
        $product->body = $body;
        $product->slug = $slug;
        $product->title = $title;
        $product->description = $description;
        $product->keywords = $keywords;
        $product->status = self::STATUS_DRAFT;
        $product->created_at = time();

        return $product;
    }

    public function setPrice($doorOldPrice, $boxOldPrice, $boxPrice, $price)
    {
        $this->door_old_price = $doorOldPrice;
        $this->box_old_price = $boxOldPrice;
        $this->box_price = $boxPrice;
        $this->price = $price;
    }

    public function setThickness($doorThickness, $doorFrameThickness, $doorSteelThickness, $frameSteelThickness)
    {
        $this->door_thickness = $doorThickness;
        $this->door_frame_thickness = $doorFrameThickness;
        $this->door_steel_thickness = $doorSteelThickness;
        $this->frame_steel_thickness = $frameSteelThickness;
    }

    public function setFeatures($features, $innerFacing, $outFacing, $glass)
    {
        $this->features = $features;
        $this->inner_facing = $innerFacing;
        $this->out_facing = $outFacing;
        $this->glass = $glass;
    }

    public function changeMainCategory($categoryId): void
    {
        $this->category_id = $categoryId;
    }

    public function edit($name, $categoryId, $code, $body, $slug, $title, $description, $keywords)
    {
        $this->name = $name;
        $this->category_id = $categoryId;
        $this->code = $code;
        $this->body = $body;
        $this->slug = $slug;
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
        $this->updated_at = time();
    }

    #########

    public function isActive(): bool
    {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function isDraft(): bool
    {
        return $this->status == self::STATUS_DRAFT;
    }

    public function activate(): void
    {
        if ($this->isActive()){
            throw new \DomainException('Товар уже активен.');
        }
        $this->status = self::STATUS_ACTIVE;
    }

    public function draft(): void
    {
        if ($this->isDraft()){
            throw new \DomainException('Товар уже отключен.');
        }
        $this->status = self::STATUS_DRAFT;
    }

    #########

    public function assignCategory($id): void
    {
        $assignments = $this->categoryAssignments;
        foreach ($assignments as $assignment){
            if ($assignment->isForCategory($id)){
                return;
            }
        }
        $assignments[] = CategoryAssignment::create($id);
        $this->categoryAssignments = $assignments;
    }

    public function removeCategory($id): void
    {
        $assignments = $this->categoryAssignments;
        foreach ($assignments as $i => $assignment){
            if ($assignment->isForCategory($id)){
                unset($assignments[$i]);
                $this->categoryAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Категория не найдена.');
    }

    public function removeCategories(): void
    {
        $this->categoryAssignments = [];
    }

    #########

    public function addPhoto(UploadedFile $file): void
    {
        $photos = $this->photos;
        $photos[] = Photo::create($file);
        $this->updatePhotos($photos);
    }

    public function removePhoto($id): void
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo){
            if ($photo->isEqualTo($id)){
                unset($photos[$i]);
                $this->updatePhotos($photos);
                return;
            }
        }
        throw new \DomainException('Изображение не найдено.');
    }

    public function removePhotos(): void
    {
        $this->updatePhotos([]);
    }

    public function movePhotoUp($id): void
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo){
            if ($photo->isEqualTo($id)){
                if ($prev = $photos[$i - 1] ?? null){
                    $photos[$i - 1] = $photo;
                    $photos[$i] = $prev;
                    $this->updatePhotos($photos);
                }
                return;
            }
        }
        throw new \DomainException('Изображение не найдено.');
    }

    public function movePhotoDown($id): void
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo){
            if ($photo->isEqualTo($id)){
                if ($next = $photos[$i + 1] ?? null){
                    $photos[$i + 1] = $photo;
                    $photos[$i] = $next;
                    $this->updatePhotos($photos);
                }
                return;
            }
        }
        throw new \DomainException('Изображение не найдено.');
    }

    private function updatePhotos(array $photos): void
    {
        foreach ($photos as $i => $photo){
            $photo->setSort($i);
        }
        $this->photos = $photos;
    }

    #########

    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getCategoryAssignments(): ActiveQuery
    {
        return $this->hasMany(CategoryAssignment::class, ['product_id' => 'id']);
    }

    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])->via('categoryAssignments');
    }

    public function getPhotos(): ActiveQuery
    {
        return $this->hasMany(Photo::class, ['product_id' => 'id'])->orderBy('sort');
    }

    public function getMainPhoto(): ActiveQuery
    {
        return $this->hasOne(Photo::class, ['id' => 'main_photo_id']);
    }

    #########

    public function behaviors()
    {
        return [
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => [
                    'categoryAssignments',
                    'photos',
                ],
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()){
            foreach ($this->photos as $photo){
                $photo->delete();
            }
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if (!empty($this->photos)){
            $this->updateAttributes(['main_photo_id' => $this->photos[0]->id]);
        }
    }

    public static function find(): ProductQuery
    {
        return new ProductQuery(static::class);
    }

    #########

   public static function tableName()
   {
       return '{{%shop_products}}';
   }
}