<?php

namespace app\models;

use yii\db\ActiveRecord;

class PrizeProduct extends ActiveRecord
{
    /**
     * @var int
     */
    public $id;

    public function getUserPrise()
    {
        return $this->hasOne(UserPrize::class, ['id' => 'user_prise_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public function getProducts()
    {
//        return $this->hasMany(Product::class, ['id' => 'id']);
        return []; // TODO: findAll()
    }
}