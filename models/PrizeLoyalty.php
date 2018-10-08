<?php

namespace app\models;

use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;

class PrizeLoyalty extends ActiveRecord
{
    const MIN_AMOUNT = 1;

    const MAX_AMOUNT = 100;

    /**
     * Rate to exchange Money to Loyalty
     */
    const EXCHANGE_RATE = 10;

    /**
     * @var int
     */
    public $id;

    /**
     * Amount of loyalty points winned by User but not merged with User's loyalty points yet.
     * It amount stored here because User may refuse to receive the prize.
     * If it happens the loyalty points will erased.
     *
     * @var float
     */
    public $amount;

    /**
     * @return ActiveQueryInterface|UserPrize
     */
    public function getUserPrise()
    {
        return $this->hasOne(UserPrize::class, ['id' => 'user_prise_id']);
    }
}