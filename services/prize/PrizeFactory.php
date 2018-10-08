<?php

namespace app\services\prize;

use app\models\Prize;

class PrizeFactory
{
    public static function getPrize($prizeType)
    {
        switch ($prizeType) {
            case Prize::TYPE_PRODUCT:
                return new PrizeProduct();
            case Prize::TYPE_MONEY:
                return new PrizeMoney();
            case Prize::TYPE_LOYALTY:
                return new PrizeLoyalty();
            default:
                throw new \Exception('Unknown Prize type');
        }
    }
}