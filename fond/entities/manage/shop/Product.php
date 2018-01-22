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
 * @property string $additional_name [varchar(255)]
 * @property int $category_id [int(11)]
 * @property int $main_photo_id [int(11)]
 * @property string $code [varchar(255)]
 * @property string $body
 * @property int $door_old_price [int(11)]
 * @property int $box_old_price [int(11)]
 * @property int $box_price [int(11)]
 * @property int $old_price [int(11)]
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
 * @property string $describe
 * @property string $reveal [varchar(255)]
 * @property string $opening
 * @property string $complect
 * @property string $cam
 * @property string $packing [varchar(255)]
 * @property string $door_insulation
 * @property string $box_insulation
 * @property string $intensive
 * @property string $bracing [varchar(255)]
 * @property float $weight [float]
 *
 * @property CategoryAssignment[] $categoryAssignments
 * @property Category $category
 * @property Photo[] photos
 * @property Photo $mainPhoto
 * @property ColorAssignment[] $colorAssignments
 * @property Color[] $colors
 * @property MaterialAssignment[] $materialAssignments
 * @property Material[] $materials
 * @property SizeAssignment[] $sizeAssignments
 * @property Size[] $sizes
 * @property RelatedAssignment[] $relatedAssignments
 * @property AdditionalAssignment[] $additionalAssignments
 * @property Product[] $relates
 * @property Product[] $additions
 * @property Modification[] $modifications
 */
class Product extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    public static function create($name, $additionalName, $categoryId, $code, $body, $slug, $title, $description, $keywords): self
    {
        $product = new static();
        $product->name = $name;
        $product->additional_name = $additionalName;
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

    public function setPrice($doorOldPrice, $boxOldPrice, $boxPrice, $oldPrice, $price)
    {
        $this->door_old_price = $doorOldPrice;
        $this->box_old_price = $boxOldPrice;
        $this->box_price = $boxPrice;
        $this->old_price = $oldPrice;
        $this->price = $price;
    }

    public function setThickness($doorThickness, $doorFrameThickness, $doorSteelThickness, $frameSteelThickness)
    {
        $this->door_thickness = $doorThickness;
        $this->door_frame_thickness = $doorFrameThickness;
        $this->door_steel_thickness = $doorSteelThickness;
        $this->frame_steel_thickness = $frameSteelThickness;
    }

    public function setFeatures($features, $innerFacing, $outFacing, $glass, $describe, $reveal, $opening, $complect, $cam, $packing, $door_insulation, $box_insulation, $intensive, $bracing, $weight)
    {
        $this->features = $features;
        $this->inner_facing = $innerFacing;
        $this->out_facing = $outFacing;
        $this->glass = $glass;
        $this->describe = $describe;
        $this->reveal =  $reveal;
        $this->opening = $opening;
        $this->complect = $complect;
        $this->cam = $cam;
        $this->packing = $packing ;
        $this->door_insulation = $door_insulation;
        $this->box_insulation = $box_insulation;
        $this->intensive = $intensive;
        $this->bracing = $bracing;
        $this->weight = $weight;
    }

    public function changeMainCategory($categoryId): void
    {
        $this->category_id = $categoryId;
    }

    public function edit($name, $additionalName, $categoryId, $code, $body, $slug, $title, $description, $keywords)
    {
        $this->name = $name;
        $this->additional_name = $additionalName;
        $this->category_id = $categoryId;
        $this->code = $code;
        $this->body = $body;
        $this->slug = $slug;
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
        $this->updated_at = time();
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'additional_name' => 'Доп. название',
            'additionalName' => 'Доп. название',
            'category_id' => 'Категория',
            'code' => 'Артикул',
            'body' => 'Описание',
            'slug' => 'Алиас',
            'title' => 'МЕТА заголовок',
            'description' => 'МЕТА описание',
            'keywords' => 'МЕТА ключевые слова',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'features' => 'Особенности',
            'innerFacing' => 'Внутренняя отделка',
            'inner_facing' => 'Внутренняя отделка',
            'outFacing' => 'Внешняя отделка',
            'out_facing' => 'Внешняя отделка',
            'glass' => 'Стекло',
            'describe' => 'Отделка',
            'reveal' =>  'Ширина наличника',
            'opening' => 'Открывание',
            'cam' => 'Эксцентрик',
            'packing' => 'Уплотнение',
            'doorInsulation' => 'Утепление двери',
            'door_insulation' => 'Утепление двери',
            'boxInsulation' => 'Утепление коробки',
            'box_insulation' => 'Утепление коробки',
            'intensive' => 'Усиление',
            'bracing' => 'Крепление',
            'weight' => 'Вес(кг)',
            'doorOldPrice' => 'Старая цена на полотно',
            'door_old_price' => 'Старая цена на полотно',
            'boxOldPrice' => 'Старая цена за комплект',
            'box_old_price' => 'Старая цена за комплект',
            'boxPrice' => 'Цена за комплект',
            'box_price' => 'Цена за комплект',
            'oldPrice' => 'Старая цена',
            'old_price' => 'Старая цена',
            'price' => 'Цена товара',
            'doorThickness' => 'Толщина полотна',
            'door_thickness' => 'Толщина полотна',
            'doorFrameThickness' => 'Толщина коробки',
            'door_frame_thickness' => 'Толщина коробки',
            'doorSteelThickness' => 'Толщина стали полотна',
            'door_steel_thickness' => 'Толщина стали полотна',
            'frame_steel_thickness' => 'Толщина стали коробки',
            'main_photo_id' => 'Главное фото',
            'status' => 'Состояние',
            'complect' => 'Комплектующие',
        ];
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

    public function addColor($id): void
    {
        $assignments = $this->colorAssignments;
        foreach ($assignments as $assignment){
            if ($assignment->isForColor($id)){
                return;
            }
        }
        $assignments[] = ColorAssignment::create($id);
        $this->colorAssignments = $assignments;
    }

    public function revokeColor($id): void
    {
        $assignments = $this->colorAssignments;
        foreach ($assignments as $i => $assignment){
            if ($assignment->isForColor($id)){
                unset($assignments[$i]);
                $this->colorAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Что то не получилось.');
    }

    public function revokeColors(): void
    {
        $this->colorAssignments = [];
    }

    #########

    public function addMaterial($id): void
    {
        $assignments = $this->materialAssignments;
        foreach ($assignments as $assignment){
            if ($assignment->isForMaterial($id)){
                return;
            }
        }
        $assignments[] = MaterialAssignment::create($id);
        $this->materialAssignments = $assignments;
    }

    public function revokeMaterial($id): void
    {
        $assignments = $this->materialAssignments;
        foreach ($assignments as $i => $assignment){
            if ($assignment->isForMaterial($id)){
                unset($assignments[$i]);
                $this->materialAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Что то пошло не так.');
    }

    public function revokeMaterials(): void
    {
        $this->materialAssignments = [];
    }

    #########

    public function addSize($id): void
    {
        $assignments = $this->sizeAssignments;
        foreach ($assignments as $assignment){
            if ($assignment->isForSize($id)){
                return;
            }
        }
        $assignments[] = SizeAssignment::create($id);
        $this->sizeAssignments = $assignments;
    }

    public function revokeSize($id): void
    {
        $assignments = $this->sizeAssignments;
        foreach ($assignments as $i => $assignment){
            if ($assignment->isForSize($id)){
                unset($assignments[$i]);
                $this->sizeAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Что то не получилось.');
    }

    public function revokeSizes(): void
    {
        $this->sizeAssignments = [];
    }

    #########

    public function assignRelatedProduct($id): void
    {
        $assignments = $this->relatedAssignments;
        foreach ($assignments as $assignment){
            if ($assignment->isForRelate($id)){
                return;
            }
        }
        $assignments[] = RelatedAssignment::create($id);
        $this->relatedAssignments = $assignments;
    }

    public function removeRelatedProduct($id): void
    {
        $assignments = $this->relatedAssignments;
        foreach ($assignments as $i => $assignment){
            if ($assignment->isForRelate($id)){
                unset($assignments[$i]);
                $this->relatedAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Упсс ... не получмлось.');
    }

    public function revokeRelatedProducts(): void
    {
        $this->relatedAssignments = [];
    }

    #########

    public function addAdditionalProduct($id): void
    {
        $assignments = $this->additionalAssignments;
        foreach ($assignments as $assignment){
            if ($assignment->isForAddition($id)){
                return;
            }
        }
        $assignments[] = AdditionalAssignment::create($id);
        $this->additionalAssignments = $assignments;
    }

    public function revokeAdditionalProduct($id): void
    {
        $assignments = $this->additionalAssignments;
        foreach ($assignments as $i => $assignment){
            if ($assignment->isForAddition($id)){
                unset($assignments[$i]);
                $this->additionalAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Что то не сработало.');
    }

    public function revokeAdditionalProducts(): void
    {
        $this->additionalAssignments = [];
    }

    #########

    public function getModification($id): Modification
    {
        foreach ($this->modifications as $modification){
            if ($modification->isEqualTo($id)){
                return $modification;
            }
        }
        throw new \DomainException('Такая модифмкация не найдена.');
    }

    public function getModificationPrice($id): int
    {
        foreach ($this->modifications as $modification){
            if ($modification->isEqualTo($id)){
                return $modification->price ? : $this->price;
            }
        }
        throw new \DomainException('Такая модифмкация не найдена.');
    }

    public function addModification($id, $name, $additionalName, $code, $price): void
    {
        $modifications = $this->modifications;
        foreach ($modifications as $modification){
            if ($modification->isCodeEqualTo($code)){
                throw new \DomainException('Такая модификация уже создана.');
            }
        }
        $modifications[] = Modification::create($id, $name, $additionalName, $code, $price);
        $this->modifications = $modifications;
    }

    public function addModificationPhoto($id, UploadedFile $photo): void
    {
        $modifications = $this->modifications;
        foreach ($modifications as $modification){
            if ($modification->isEqualTo($id)){
                $modification->setPhoto($photo);
                $modification->save();
                return;
            }
        }
        throw new \DomainException('Что то не прокатывает.');
    }

    public function editModification($id, $name, $additionalName, $code, $price): void
    {
        $modifications = $this->modifications;
        foreach ($modifications as $modification){
            if ($modification->isEqualTo($id)){
                $modification->edit($name, $additionalName, $code, $price);
                $this->modifications = $modifications;
                return;
            }
        }
        throw new \DomainException('Модификация не найдена.');
    }

    public function removeModification($id): void
    {
        $modifications = $this->modifications;
        foreach ($modifications as $i => $modification){
            if ($modification->isEqualTo($id)){
                unset($modifications[$i]);
                $this->modifications = $modifications;
                return;
            }
        }
        throw new \DomainException('Модификация не найдена.');
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

    public function getColorAssignments(): ActiveQuery
    {
        return $this->hasMany(ColorAssignment::className(), ['product_id' => 'id']);
    }
    public function getColors(): ActiveQuery
    {
        return $this->hasMany(Color::className(), ['id' => 'color_id'])->via('colorAssignments');
    }

    public function getMaterialAssignments(): ActiveQuery
    {
        return $this->hasMany(MaterialAssignment::className(), ['product_id' => 'id']);
    }
    public function getMaterials(): ActiveQuery
    {
        return $this->hasMany(Material::className(), ['id' => 'material_id'])->via('materialAssignments');
    }

    public function getSizeAssignments(): ActiveQuery
    {
        return $this->hasMany(SizeAssignment::className(), ['product_id' => 'id']);
    }
    public function getSizes(): ActiveQuery
    {
        return $this->hasMany(Size::className(), ['id' => 'size_id'])->via('sizeAssignments');
    }

    public function getRelatedAssignments(): ActiveQuery
    {
        return $this->hasMany(RelatedAssignment::className(), ['product_id' => 'id']);
    }
    public function getRelates(): ActiveQuery
    {
        return $this->hasMany(Product::className(), ['id' => 'related_id'])->via('relatedAssignments');
    }

    public function getAdditionalAssignments(): ActiveQuery
    {
        return $this->hasMany(AdditionalAssignment::className(), ['product_id' => 'id']);
    }
    public function getAdditions(): ActiveQuery
    {
        return $this->hasMany(Product::className(), ['id' => 'additional_id'])->via('additionalAssignments');
    }

    public function getModifications(): ActiveQuery
    {
        return $this->hasMany(Modification::className(), ['product_id' => 'id']);
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
                    'colorAssignments',
                    'materialAssignments',
                    'sizeAssignments',
                    'relatedAssignments',
                    'additionalAssignments',
                    'modifications',
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