<?php

namespace app\models;

use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;

class PrizeMoney extends ActiveRecord
{
    const MAX_DEFAULT_AMOUNT = 100;

    /**
     * @var int
     */
    public $id;

    /**
     * Amount of money winned by User but not received yet.
     * It amount stored here because User may refuse to receive the prize.
     * If it happens the money will return to $amount.
     *
     * @var float
     */
    public $amount;

    public static function tableName()
    {
        return '{{%prize_money}}';
    }

    /**
     * @return ActiveQueryInterface|UserPrize
     */
    public function getUserPrise()
    {
        return $this->hasOne(UserPrize::class, ['id' => 'user_prize_id']);
    }

    /**
     * @return ActiveQueryInterface|Money
     */
    public function getMoney()
    {
        return $this->hasOne(Money::class, ['id' => 'money_id']);
    }

    public function getMinAmount()
    {
        return 1;
    }

    public function getMaxAmount()
    {
        $availableMoney = $this->getMoney()->amount;

        return (self::MAX_DEFAULT_AMOUNT >= $availableMoney)
            ? self::MAX_DEFAULT_AMOUNT
            : $availableMoney;
    }
}