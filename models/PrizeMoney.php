<?php

namespace app\models;

use yii\db\ActiveRecord;

class PrizeMoney extends ActiveRecord
{
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

    public function getUserPrise()
    {
        return $this->hasOne(UserPrize::class, ['id' => 'user_prise_id']);
    }

    public function getMoney()
    {
        return $this->hasOne(Money::class, ['id' => 'money_id']);
    }
}