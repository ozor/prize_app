<?php

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    /**
     * @var int
     */
    public $id;

    /**
     * When User win this product, it product marks as reserver and doen't participating in lottery.
     * If User receives this product, the product will be deleted.
     * If User refuse to receive, the product will be unmarked as reserved.
     *
     * @var int
     */
    public $isReserved = 0;

    /**
     * If it product reserved this method will return User who win the product
     */
    public function getWinner()
    {
        return $this->hasOne(UserPrize::class, ['id' => 'winner_id']);
    }
}