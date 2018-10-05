<?php

namespace app\models;

use yii\db\ActiveRecord;

class PrizeLoyalty extends ActiveRecord
{
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

    public function getUserPrise()
    {
        return $this->hasOne(UserPrize::class, ['id' => 'user_prise_id']);
    }
}