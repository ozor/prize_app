<?php

namespace app\models;

use yii\db\ActiveRecord;

class UserPrize extends ActiveRecord
{
    /**
     * @var int
     */
    public $id;

    /**
     * Type of prize (money|product|loyalty)
     *
     * @var string
     */
    public $prizeType;

    /**
     * Does User receive this prize (1) or not (0)
     *
     * @var int
     */
    public $isReceived = 0;

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getPrize()
    {
        switch ($this->prizeType) {
            case Prize::TYPE_PRODUCT:
                return $this->hasMany(PrizeProduct::class, ['user_prise_id' => 'id']);
            case Prize::TYPE_MONEY:
                return $this->hasOne(PrizeMoney::class, ['user_prise_id' => 'id']);
            case Prize::TYPE_LOYALTY:
                return $this->hasOne(PrizeLoyalty::class, ['user_prise_id' => 'id']);
            default:
                throw new \Exception('Wrong type of prize');
        }
    }
}