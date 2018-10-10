<?php

namespace app\models;

use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;

class PrizeProduct extends ActiveRecord
{
    /**
     * @var int
     */
    public $id;

    public static function tableName()
    {
        return '{{prize_product}}';
    }

    /**
     * @return ActiveQueryInterface|UserPrize
     */
    public function getUserPrise()
    {
        return $this->hasOne(UserPrize::class, ['id' => 'user_prize_id']);
    }

    /**
     * @return ActiveQueryInterface|Product
     */
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